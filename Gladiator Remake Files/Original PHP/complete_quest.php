<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$player_id = $_SESSION['id'];
$quest_id = isset($_GET['quest_id']) ? (int)$_GET['quest_id'] : 0;

if ($quest_id > 0) {
    // First, mark quest as completed if not already
    $stmt = $conn->prepare("UPDATE player_quests SET status = 'completed' WHERE player_id = ? AND quest_id = ? AND status = 'active'");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ii", $player_id, $quest_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Fetch quest reward info
        $reward_stmt = $conn->prepare("SELECT gold_reward, exp_reward FROM quests WHERE id = ?");
        $reward_stmt->bind_param("i", $quest_id);
        $reward_stmt->execute();
        $reward_result = $reward_stmt->get_result();

        if ($reward_result->num_rows > 0) {
            $reward = $reward_result->fetch_assoc();

            // Update player's gold and exp
            $update_stmt = $conn->prepare("UPDATE gracze SET zloto = zloto + ?, exp = exp + ? WHERE id = ?");
            $update_stmt->bind_param("iii", $reward['gold_reward'], $reward['exp_reward'], $player_id);
            $update_stmt->execute();
            $update_stmt->close();
        }
        $reward_stmt->close();
    }

    $stmt->close();
    header("Location: quest.php");
    exit;
} else {
    echo "Invalid quest ID.";
}