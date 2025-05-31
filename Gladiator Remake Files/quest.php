 <style>
body {
  background-image: url('images/papierus.jpg');
}
</style> 
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

// Handle quest acceptance
if (isset($_GET['accept'])) {
    $quest_id = (int)$_GET['accept'];

    // Check if already accepted
    $check = $conn->prepare("SELECT * FROM player_quests WHERE player_id = ? AND quest_id = ?");
    $check->bind_param("ii", $player_id, $quest_id);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows === 0) {
        $stmt = $conn->prepare("INSERT INTO player_quests (player_id, quest_id, status) VALUES (?, ?, 'active')");
        $stmt->bind_param("ii", $player_id, $quest_id);
        $stmt->execute();
        echo "<p style='color:green;'>Quest accepted!</p>";
    } else {
        echo "<p style='color:orange;'>You already have this quest.</p>";
    }
}

// Handle quest abandonment
if (isset($_GET['abandon'])) {
    $abandon_id = (int)$_GET['abandon'];

    $stmt = $conn->prepare("DELETE FROM player_quests WHERE player_id = ? AND quest_id = ? AND status = 'active'");
    $stmt->bind_param("ii", $player_id, $abandon_id);
    if ($stmt->execute()) {
        echo "<p style='color:red;'>Quest abandoned.</p>";
    } else {
        echo "<p style='color:orange;'>Failed to abandon quest.</p>";
    }
}

// Show all quests
$result = $conn->query("SELECT * FROM quests");

echo "<h2>📜 Available Quests</h2>";

$player_stmt = $conn->prepare("SELECT nivel FROM gracze WHERE id = ?");
$player_stmt->bind_param("i", $player_id);
$player_stmt->execute();
$player_result = $player_stmt->get_result();
$player_data = $player_result->fetch_assoc();
$level = $player_data['nivel'];

$result = $conn->query("SELECT * FROM quests WHERE required_level <= $level");

while ($row = $result->fetch_assoc()) {
    $q_id = $row['id'];

    // Skip non-repeating quests that have already been completed
    $done = $conn->prepare("SELECT 1 FROM player_quests WHERE player_id = ? AND quest_id = ? AND completed_at IS NOT NULL");
    $done->bind_param("ii", $player_id, $q_id);
    $done->execute();
    $done_result = $done->get_result();
    if ($done_result->num_rows > 0 && !$row['is_repeatable']) continue;

    // If it has a previous_quest_id, check if it has been completed.
    if (!empty($row['previous_quest_id'])) {
        $prev_id = (int)$row['previous_quest_id'];
        $prev_check = $conn->prepare("SELECT status FROM player_quests WHERE player_id = ? AND quest_id = ?");
        $prev_check->bind_param("ii", $player_id, $prev_id);
        $prev_check->execute();
        $prev_result = $prev_check->get_result();
        $prev_data = $prev_result->fetch_assoc();

        // If the previous one has not been completed, skip
        if (!$prev_data || $prev_data['status'] !== 'completed') {
            continue;
        }
    }

    // Show mission
    echo "<div style='border:1px solid #ccc;padding:10px;margin:10px;border-radius:5px;background:#f9f9f9'>";
    echo "<img src='images/npc/{$row['npc_image']}' width='64' style='float:left;margin-right:10px'>";
    echo "<strong>{$row['npc_name']}</strong><br>";
    echo "<em>{$row['npc_description']}</em><br><br>";
    echo "<strong>{$row['title']}</strong><br>";
    echo "{$row['description']}<br><br>";
    echo "<strong>Rewards:</strong> {$row['gold_reward']} gold, {$row['exp_reward']} XP";

    if ($row['reward_item_id']) {
        $item_id = $row['reward_item_id'];
        $item_query = $conn->prepare("SELECT name FROM items WHERE id = ?");
        $item_query->bind_param("i", $item_id);
        $item_query->execute();
        $item_result = $item_query->get_result();
        $item_data = $item_result->fetch_assoc();
        $item_name = $item_data ? $item_data['name'] : "Unknown Item";
        echo ", Item: <strong>{$item_name}</strong>";
    }

    echo "<br><a href='quest.php?accept={$row['id']}'>✅ Accept Quest</a>";
    echo "<div style='clear:both'></div></div>";
}


// Show active/completed quests
echo "<h2>📘 Your Active Quests</h2>";

$stmt = $conn->prepare("
    SELECT q.id, q.title, q.exp_reward, q.gold_reward, q.reward_item_id, pq.status 
    FROM player_quests pq 
    JOIN quests q ON pq.quest_id = q.id 
    WHERE pq.player_id = ? AND pq.status = 'active'
");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$user_quests = $stmt->get_result();

while ($quest = $user_quests->fetch_assoc()) {
    echo "<p><strong>{$quest['title']}</strong> - Status: {$quest['status']}<br>";
    echo "<a href='complete_quest.php?quest_id={$quest['id']}'>🏁 Complete</a> ";
    echo "<a href='quest.php?abandon={$quest['id']}' class='abandon-btn'>❌ Abandon</a>";
    echo "</p>";
}

?>
<br><a href="index.php">← Back to Dashboard</a>