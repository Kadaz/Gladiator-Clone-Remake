<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');
require_once 'deity_helpers.php';

function update_counter($conn, $player_id, $name, $delta = 1, $reset = false) {
    if ($reset) {
        $stmt = $conn->prepare("UPDATE counters SET value = 0 WHERE player_id = ? AND name = ?");
        $stmt->bind_param("is", $player_id, $name);
        $stmt->execute();
        return;
    }

    $stmt = $conn->prepare("UPDATE counters SET value = value + ? WHERE player_id = ? AND name = ?");
    $stmt->bind_param("iis", $delta, $player_id, $name);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        $stmt = $conn->prepare("INSERT INTO counters (player_id, name, value) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE value = value + ?");
        $stmt->bind_param("isii", $player_id, $name, $delta, $delta);
        $stmt->execute();
    }
}

if (!isset($_SESSION['id']) || !isset($_POST['enemy_id'])) {
    header("Location: index.php");
    exit;
}

$player_id = $_SESSION['id'];
$enemy_id = (int)$_POST['enemy_id'];

// Load player
$stmt1 = $conn->prepare("SELECT id, login, zycie, sila, obrazenia_min, obrazenia_max, is_premium FROM gracze WHERE id = ?");
$stmt1->bind_param("i", $player_id);
$stmt1->execute();
$player = $stmt1->get_result()->fetch_assoc();
$is_premium = $player['is_premium'];
$stmt1->close();

// Load enemy
$stmt2 = $conn->prepare("SELECT id, login, zycie, sila, obrazenia_min, obrazenia_max FROM gracze WHERE id = ?");
$stmt2->bind_param("i", $enemy_id);
$stmt2->execute();
$enemy = $stmt2->get_result()->fetch_assoc();
$stmt2->close();

if (!$player || !$enemy) {
    die("Player or opponent not found.");
}

// Initial HP
$p1_hp = $player['zycie'];
$p2_hp = $enemy['zycie'];

$log = [];
$turn = 1;
$winner = null;

// === Get all deity bonuses for player ===
$deity_bonus = $conn->query("
    SELECT d.bonus_type, d.bonus_value 
    FROM gracze g 
    JOIN deities d ON g.deity_id = d.id 
    WHERE g.id = $player_id
")->fetch_assoc();

$bonus_damage = 0;
$bonus_crit = 0;
$bonus_xp = 0;
$bonus_gold = 0;

if ($deity_bonus) {
    switch ($deity_bonus['bonus_type']) {
        case 'damage': $bonus_damage = (int)$deity_bonus['bonus_value']; break;
        case 'crit_chance': $bonus_crit = (int)$deity_bonus['bonus_value']; break;
        case 'xp': $bonus_xp = (int)$deity_bonus['bonus_value']; break;
        case 'gold': $bonus_gold = (int)$deity_bonus['bonus_value']; break;
    }
}

// === PvP Battle Loop ===
while ($p1_hp > 0 && $p2_hp > 0) {
    $log[] = "<strong>Turn $turn</strong>";

    // Zeus / Ares bonus
    $player_strength = $player['sila'];
    $crit_multiplier = 1;

    if ($bonus_damage > 0) {
        $player_strength += $bonus_damage;
        $log[] = "<span style='color:orange;'>⚡ Zeus Bonus: +$bonus_damage STR</span>";
    }

    if ($bonus_crit > 0 && rand(1, 100) <= $bonus_crit) {
        $crit_multiplier = 2;
        $log[] = "<span style='color:red;'>💥 Ares Critical Hit!</span>";
    }

    // Player attacks
    $p1_damage = (rand($player['obrazenia_min'], $player['obrazenia_max']) + floor($player_strength * 0.5)) * $crit_multiplier;
    $p2_hp -= $p1_damage;
    $log[] = "{$player['login']} hits {$enemy['login']} for $p1_damage damage. (Enemy HP: " . max($p2_hp, 0) . ")";
    if ($p2_hp <= 0) {
        $winner = $player['login'];
        break;
    }

    // Enemy attacks
    $p2_damage = rand($enemy['obrazenia_min'], $enemy['obrazenia_max']) + floor($enemy['sila'] * 0.5);
    $p1_hp -= $p2_damage;
    $log[] = "{$enemy['login']} hits {$player['login']} for $p2_damage damage. (Your HP: " . max($p1_hp, 0) . ")";
    if ($p1_hp <= 0) {
        $winner = $enemy['login'];
        break;
    }

    $turn++;
}

// Save fight timestamp for cooldown
$now = time();
$update_stmt = $conn->prepare("UPDATE gracze SET ostatnia_walka_pvp = ? WHERE id = ?");
$update_stmt->bind_param("ii", $now, $player_id);
$update_stmt->execute();
$update_stmt->close();

// Update stats (optional)
if ($winner === $player['login']) {
    $xp = 20;
    if (!empty($is_premium)) {
        $xp = floor($xp * 1.25);
        $log[] = "<em style='color:gold;'>👑 Premium Bonus: +25% XP</em>";
    }
    if ($bonus_xp > 0) {
        $xp = floor($xp * (1 + $bonus_xp / 100));
        $log[] = "<span style='color:purple;'>📘 Athena Bonus: +$bonus_xp% XP</span>";
    }

    $gold_reward = 10;
    if ($bonus_gold > 0) {
        $gold_reward += floor($gold_reward * ($bonus_gold / 100));
        $log[] = "<span style='color:gold;'>💰 Hades Bonus: +$bonus_gold% gold</span>";
    }

    mysqli_query($conn, "UPDATE gracze SET victorias = victorias + 1, zloto = zloto + $gold_reward, exp = exp + $xp WHERE id = $player_id");
    update_counter($conn, $player_id, 'pvp_streak');
    update_counter($conn, $enemy_id, 'pvp_streak', 0, true);

    require_once 'achievements_check.php';
    check_achievements_for_player($player_id);

    mysqli_query($conn, "UPDATE gracze SET perdidas = perdidas + 1, zloto = GREATEST(0, zloto - 10) WHERE id = $enemy_id");

    $log[] = "<br><strong>🎉 You defeated {$enemy['login']}! You gained $gold_reward gold and $xp XP.</strong>";
    if (!empty($is_premium)) {
        $log[] = "<em style='color:gold;'>👑 Premium Bonus applied: +25% XP</em>";
    }
} else {
    mysqli_query($conn, "UPDATE gracze SET perdidas = perdidas + 1 WHERE id = $player_id");
    mysqli_query($conn, "UPDATE gracze SET victorias = victorias + 1, zloto = zloto + 5, exp = exp + 10 WHERE id = $enemy_id");
    $log[] = "<br><strong>💀 You were defeated by {$enemy['login']}.</strong>";
}
?>

<h2>⚔️ PvP Battle Result</h2>
<div>
    <?php foreach ($log as $entry): ?>
        <p><?= $entry ?></p>
    <?php endforeach; ?>
</div>

<br>
<a href="pvp_arena.php">← Back to Arena</a> | <a href="index.php">🏠 Dashboard</a>
