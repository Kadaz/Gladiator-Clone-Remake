<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');
require_once('achievements_check.php');

if (!isset($_SESSION['id']) || !isset($_GET['quest_id'])) {
    header("Location: index.php");
    exit;
}

$player_id = $_SESSION['id'];
$quest_id = (int)$_GET['quest_id'];
// --- Init deity bonuses ---
$bonus_msg  = "";
$bonus_dmg  = 0;    // ⚡ Zeus
$bonus_def  = 0;    // 💧 Poseidon
$bonus_xp   = 0;    // 📘 Athena
$bonus_gold = 0;    // 💰 Hades
$bonus_crit = 0;    // 💥 Ares
// --------------------------
// ✅ Ensure the player has the mission and is active + requires_battle
$stmt = $conn->prepare("
    SELECT q.title, q.description, q.exp_reward, q.gold_reward, q.reward_item_id, q.enemy_id, q.requires_battle,
           pq.status,
           g.exp, g.nivel, g.sila, g.zycie, g.is_premium, g.deity_id
    FROM player_quests pq
    JOIN quests q ON pq.quest_id = q.id
    JOIN gracze g ON pq.player_id = g.id
    WHERE pq.player_id = ? AND pq.quest_id = ? AND pq.status = 'active'
");
$stmt->bind_param("ii", $player_id, $quest_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("❌ Quest not available or already completed.");
}
$data = $result->fetch_assoc();

// ✅ Load the enemy of the mission
$enemy_id = $data['enemy_id'];
$enemy = $conn->query("SELECT name, min_hp, max_hp, min_dmg, max_dmg FROM enemies WHERE id = $enemy_id")->fetch_assoc();
if (!$enemy) die("❌ Enemy not found.");

$log = [];
$player_hp = $data['zycie'];
$enemy_hp = rand($enemy['min_hp'], $enemy['max_hp']);
$turn = 1;
$bonus = "";
$xp = $data['exp_reward'];
$gold = $data['gold_reward'];
$premium_msg = "";

if (!empty($data['is_premium'])) {
    $xp = floor($xp * 1.25);
    $premium_msg .= " 👑 Premium Bonus applied: +25% XP!";
}

if ($bonus_xp > 0) {
    $xp = floor($xp * (1 + $bonus_xp / 100));
    $bonus_msg .= "📘 Athena: +$bonus_xp% XP. ";
}

if ($bonus_gold > 0) {
    $gold = floor($gold * (1 + $bonus_gold / 100));
    $bonus_msg .= "💰 Hades: +$bonus_gold% gold. ";
}


// ✅ Deity bonus
if (!empty($data['deity_id'])) {
    
if (!empty($data['deity_id'])) {
    $deity = $conn->query("SELECT bonus_type, bonus_value FROM deities WHERE id = {$data['deity_id']}")->fetch_assoc();
    if ($deity) {
        switch ($deity['bonus_type']) {
            case 'damage':
                $bonus_dmg = $deity['bonus_value'];
                $bonus_msg .= "⚡ Zeus: +{$bonus_dmg} Strength. ";
                break;
            case 'defense':
                $bonus_def = $deity['bonus_value'];
                $bonus_msg .= "💧 Poseidon: -{$bonus_def}% damage taken. ";
                break;
            case 'xp':
                $bonus_xp = $deity['bonus_value'];
                $bonus_msg .= "📘 Athena: +{$bonus_xp}% XP. ";
                break;
            case 'gold':
                $bonus_gold = $deity['bonus_value'];
                $bonus_msg .= "💰 Hades: +{$bonus_gold}% gold. ";
                break;
            case 'crit_chance':
                $bonus_crit = $deity['bonus_value'];
                $bonus_msg .= "💥 Ares: +{$bonus_crit}% crit chance. ";
                break;
        }
    }
}
}

// ✅ Battle
while ($player_hp > 0 && $enemy_hp > 0) {
    $log[] = "<strong>Turn $turn</strong>";

    // Player attacks
    $base_str = $data['sila'] + $bonus_dmg;
$player_dmg = rand(5, 15) + floor($base_str * 0.5);

// 💥 Ares crit
if ($bonus_crit > 0 && rand(1, 100) <= $bonus_crit) {
    $player_dmg *= 2;
    $log[] = "💥 Critical Hit (Ares Bonus)!";
}
    $enemy_hp -= $player_dmg;
    $log[] = "You hit {$enemy['name']} for $player_dmg damage. (Enemy HP: " . max(0, $enemy_hp) . ")";

    if ($enemy_hp <= 0) break;

    // Enemy attacks
    $enemy_dmg = rand($enemy['min_dmg'], $enemy['max_dmg']);

if ($bonus_def > 0) {
    $reduction = floor($enemy_dmg * ($bonus_def / 100));
    $enemy_dmg -= $reduction;
    $log[] = "💧 Poseidon Bonus: -$reduction damage taken.";
}

$player_hp -= $enemy_dmg;
    $log[] = "{$enemy['name']} hits you for $enemy_dmg damage. (Your HP: " . max(0, $player_hp) . ")";

    $turn++;
}

if ($player_hp > 0) {
    $log[] = "<strong style='color:green;'>🎉 You won the quest battle!</strong>";

    // ✅ Update player rewards
    $stmt = $conn->prepare("UPDATE gracze SET exp = exp + ?, zloto = zloto + ? WHERE id = ?");
    $stmt->bind_param("iii", $xp, $gold, $player_id);
    $stmt->execute();

    // ✅ Quest completion
    $now = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("UPDATE player_quests SET status = 'completed', completed_at = ? WHERE player_id = ? AND quest_id = ?");
    $stmt->bind_param("sii", $now, $player_id, $quest_id);
    $stmt->execute();

    // ✅ Reward item
    if (!empty($data['reward_item_id'])) {
        $stmt = $conn->prepare("INSERT INTO player_items (player_id, item_id, equipped) VALUES (?, ?, 0)");
        $stmt->bind_param("ii", $player_id, $data['reward_item_id']);
        $stmt->execute();
        $log[] = "🎁 You received a quest reward item!";
    }
	
	// ✅ Show rewards
    $log[] = "<span class='log-reward'>🏆 You earned $xp XP and $gold gold!</span>";
    if (!empty($premium_msg)) $log[] = "<span class='log-reward' style='color:gold;'>$premium_msg</span>";
    if (!empty($bonus_msg)) $log[] = "<span class='log-reward' style='color:blue;'>$bonus_msg</span>";

    // ✅ Counter & achievements
    $conn->query("INSERT INTO counters (player_id, name, value) VALUES ($player_id, 'quests_completed', 1)
                  ON DUPLICATE KEY UPDATE value = value + 1");
    check_achievements_for_player($player_id);

    // ✅ Level-up check
    $res = $conn->query("SELECT exp, nivel FROM gracze WHERE id = $player_id");
    $p = $res->fetch_assoc();
    $exp = $p['exp'];
    $lvl = $p['nivel'];
    while ($exp >= $lvl * 100) {
        $exp -= $lvl * 100;
        $lvl++;
        $conn->query("UPDATE gracze SET nivel = $lvl WHERE id = $player_id");
        $log[] = "<strong style='color:gold;'>🎉 Level up! You reached level $lvl!</strong>";
    }

    // ✅ Notify player
    $msg = "✅ You completed a battle quest and earned $gold gold & $xp XP. $bonus";
    $conn->query("INSERT INTO notifications (player_id, message) VALUES ($player_id, '$msg')");

} else {
    $log[] = "<strong style='color:red;'>💀 You were defeated by {$enemy['name']}.</strong>";
}

?>

<h2>⚔️ Quest Battle Result</h2>
<div>
    <?php foreach ($log as $entry): ?>
        <p><?= $entry ?></p>
    <?php endforeach; ?>
</div>

<br><a href="quest.php">← Back to Quests</a> | <a href="index.php">🏠 Dashboard</a>
