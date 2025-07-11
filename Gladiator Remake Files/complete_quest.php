<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$player_id = $_SESSION['id'];

if (!isset($_GET['quest_id'])) {
    die("No quest selected.");
}

$quest_id = (int)$_GET['quest_id'];

// Check if player has accepted the quest and it's active
$stmt = $conn->prepare("SELECT * FROM player_quests WHERE player_id = ? AND quest_id = ? AND status = 'active'");
$stmt->bind_param("ii", $player_id, $quest_id);
$stmt->execute();
$quest_status = $stmt->get_result();

if ($quest_status->num_rows === 0) {
    die("You have not accepted this quest or it is already completed.");
}

// Fetch player premium status
$stmt = $conn->prepare("SELECT is_premium FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$stmt->bind_result($is_premium);
$stmt->fetch();
$stmt->close();

// Fetch quest rewards
$stmt = $conn->prepare("SELECT exp_reward, gold_reward, reward_item_id FROM quests WHERE id = ?");
$stmt->bind_param("i", $quest_id);
$stmt->execute();
$stmt->bind_result($exp, $zloto, $item_id);
$stmt->fetch();
$stmt->close();

// Apply Premium XP bonus
$premium_msg = '';
if (!empty($is_premium)) {
    $exp = floor($exp * 1.25);
    $premium_msg = " 👑 Premium Bonus applied: +25% XP!";
}

// Update player's EXP and gold (zloto)
$update = $conn->prepare("UPDATE gracze SET exp = exp + ?, zloto = zloto + ? WHERE id = ?");
$update->bind_param("iii", $exp, $zloto, $player_id);
if (!$update->execute()) {
    die("Error updating player rewards: " . $update->error);
}

// Give reward item (if any)
if ($item_id) {
    $stmt = $conn->prepare("INSERT INTO player_items (player_id, item_id, equipped) VALUES (?, ?, 0)");
    $stmt->bind_param("ii", $player_id, $item_id);
    $stmt->execute();
}

// Mark quest as completed
$now = date('Y-m-d H:i:s');
$update_status = $conn->prepare("UPDATE player_quests SET status = 'completed', completed_at = ? WHERE player_id = ? AND quest_id = ?");
$update_status->bind_param("sii", $now, $player_id, $quest_id);
$update_status->execute();

// ✅ Increase quests_completed counter manually
$stmt = $conn->prepare("SELECT value FROM counters WHERE player_id = ? AND name = 'quests_completed'");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();

if ($row) {
    $new_val = $row['value'] + 1;
    $update = $conn->prepare("UPDATE counters SET value = ? WHERE player_id = ? AND name = 'quests_completed'");
    $update->bind_param("ii", $new_val, $player_id);
    $update->execute();
} else {
    $insert = $conn->prepare("INSERT INTO counters (player_id, name, value) VALUES (?, 'quests_completed', 1)");
    $insert->bind_param("i", $player_id);
    $insert->execute();
}

// Level-up check
$xp_check = $conn->prepare("SELECT exp, nivel FROM gracze WHERE id = ?");
$xp_check->bind_param("i", $player_id);
$xp_check->execute();
$xp_result = $xp_check->get_result();
$data = $xp_result->fetch_assoc();

$current_exp = $data['exp'];
$current_level = $data['nivel'];
$required_exp = $current_level * 100;

if ($current_exp >= $required_exp) {
    $new_level = $current_level + 1;
    $level_up = $conn->prepare("UPDATE gracze SET nivel = ? WHERE id = ?");
    $level_up->bind_param("ii", $new_level, $player_id);
    $level_up->execute();
    echo "<p style='color:green;'>🎉 Congratulations! You leveled up to level $new_level!</p>";
}

echo "<p style='color:green;'>✅ Quest completed! You earned $zloto złoto and $exp XP.$premium_msg</p>";
if ($item_id) echo "<p>🎁 You also received a new item!</p>";

// ✅ Check for achievements
require_once 'achievements_check.php';
check_achievements_for_player($player_id);

echo "<br><a href='quest.php'>← Back to Quests</a>";
?>
