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

// Show all quests
$result = $conn->query("SELECT * FROM quests");

echo "<h2>Available Quests</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<p><strong>{$row['title']}</strong><br>";
    echo "{$row['description']}<br>";
    echo "Gold: {$row['gold_reward']} | EXP: {$row['exp_reward']}<br>";
    echo "<a href='quest.php?accept={$row['id']}'>Accept Quest</a></p><hr>";
}

// Show active/completed quests
echo "<h2>Your Quests</h2>";
$stmt = $conn->prepare("
    SELECT q.title, pq.status, q.id 
    FROM player_quests pq 
    JOIN quests q ON pq.quest_id = q.id 
    WHERE pq.player_id = ?
");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$user_quests = $stmt->get_result();

while ($quest = $user_quests->fetch_assoc()) {
    echo "<p><strong>{$quest['title']}</strong> - Status: {$quest['status']}<br>";
    if ($quest['status'] === 'active') {
        echo "<a href='complete_quest.php?quest_id={$quest['id']}'>Complete Quest</a>";
    }
    echo "</p>";
}
?>
<br><a href="index.php">← Back to Dashboard</a>