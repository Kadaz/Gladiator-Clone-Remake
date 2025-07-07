<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

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
$stmt1 = $conn->prepare("SELECT id, login, zycie, sila, obrazenia_min, obrazenia_max FROM gracze WHERE id = ?");
$stmt1->bind_param("i", $player_id);
$stmt1->execute();
$player = $stmt1->get_result()->fetch_assoc();
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

while ($p1_hp > 0 && $p2_hp > 0) {
    $log[] = "<strong>Turn $turn</strong>";

    // Player attacks
    $p1_damage = rand($player['obrazenia_min'], $player['obrazenia_max']) + floor($player['sila'] * 0.5);
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
    mysqli_query($conn, "UPDATE gracze SET victorias = victorias + 1, zloto = zloto + 10, exp = exp + 20 WHERE id = $player_id");
	update_counter($conn, $player_id, 'pvp_streak'); // Αύξησε το streak του νικητή
    update_counter($conn, $enemy_id, 'pvp_streak', 0, true); // Reset του ηττημένου
	
	require_once 'achievements_check.php';
    check_achievements_for_player($player_id);
    mysqli_query($conn, "UPDATE gracze SET perdidas = perdidas + 1, zloto = GREATEST(0, zloto - 10) WHERE id = $enemy_id");
    $log[] = "<br><strong>🎉 You defeated {$enemy['login']}! You gained 10 gold and 20 XP.</strong>";
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