<?php
require_once "db.php";

function unlock_achievement($conn, $player_id, $achievement_id) {
    // Check if already unlocked
    $check = $conn->prepare("SELECT 1 FROM player_achievements WHERE player_id = ? AND achievement_id = ?");
    $check->bind_param("ii", $player_id, $achievement_id);
    $check->execute();
    $result = $check->get_result();
    if ($result->num_rows > 0) return; // already has it

    // Insert into player_achievements
    $insert = $conn->prepare("INSERT INTO player_achievements (player_id, achievement_id) VALUES (?, ?)");
    $insert->bind_param("ii", $player_id, $achievement_id);
    $insert->execute();

    // Log
    $details = "Unlocked achievement ID: $achievement_id";
    $log = $conn->prepare("INSERT INTO logs (player_id, action, details) VALUES (?, 'achievement_unlocked', ?)");
    $log->bind_param("is", $player_id, $details);
    $log->execute();
}

function check_achievements_for_player($player_id) {
    global $conn;

    // Get basic player stats
    $stmt = $conn->prepare("SELECT nivel, victorias, perdidas FROM gracze WHERE id = ?");
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $player = $stmt->get_result()->fetch_assoc();

    // Achievement: Win 10 PvP battles
    if ($player['victorias'] >= 10) {
        unlock_achievement($conn, $player_id, 1); // Adjust ID to match database
    }

    // Level-based achievements
    if ($player['nivel'] >= 5) {
    unlock_achievement($conn, $player_id, 6); // Apprentice
    }
    if ($player['nivel'] >= 15) {
    unlock_achievement($conn, $player_id, 8); // Master
    }

    // Achievement: Lose 10 fights (for fun)
    if ($player['perdidas'] >= 10) {
        unlock_achievement($conn, $player_id, 4);
    }
	
	// Has 10+ items
    $stmt = $conn->prepare("SELECT COUNT(*) FROM player_items WHERE player_id = ?");
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $stmt->bind_result($item_count);
    $stmt->fetch();
    $stmt->close();
    if ($item_count >= 10) {
        unlock_achievement($conn, $player_id, 8); // Collector
    }

    // Has 1000+ gold
    $stmt = $conn->prepare("SELECT zloto FROM gracze WHERE id = ?");
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $stmt->bind_result($gold);
    $stmt->fetch();
    $stmt->close();
    if ($gold >= 1000) {
        unlock_achievement($conn, $player_id, 9); // Rich Boy
    }

    // Add more below with relevant achievement IDs

    // Example: Belong to a guild
    $stmt = $conn->prepare("SELECT guild_id FROM guild_members WHERE player_id = ?");
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $guild = $stmt->get_result();
    if ($guild->num_rows > 0) {
        unlock_achievement($conn, $player_id, 5);
    }

    // Example: Be in an alliance
    $stmt = $conn->prepare("SELECT am.alliance_id FROM alliance_members am JOIN guild_members gm ON am.guild_id = gm.guild_id WHERE gm.player_id = ?");
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $ally = $stmt->get_result();
    if ($ally->num_rows > 0) {
        unlock_achievement($conn, $player_id, 6);
    }
	// 🧪 Use your first potion (detected via session for now)
    if (!empty($_SESSION['potion_used_once'])) {
        unlock_achievement($conn, $player_id, 10); // Alchemist
    }

    // 🥇 Win your first battle
    if ($player['victorias'] >= 1) {
        unlock_achievement($conn, $player_id, 11); // Battle Tested
    }

    // 📘 Quest Completion Count (moved here from outside!)
    $stmt = $conn->prepare("SELECT value FROM counters WHERE player_id = ? AND name = 'quests_completed'");
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $counter = $res->fetch_assoc();
    $quest_count = $counter ? (int)$counter['value'] : 0;

    if ($quest_count >= 5) {
        unlock_achievement($conn, $player_id, 7); // 5 Quests Done
    }
}

// How to use:
// require_once 'achievements_check.php';
// check_achievements_for_player($player_id);
// Quest Completion Count
$stmt = $conn->prepare("SELECT value FROM counters WHERE player_id = ? AND name = 'quests_completed'");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$res = $stmt->get_result();
$counter = $res->fetch_assoc();
$quest_count = $counter ? (int)$counter['value'] : 0;

if ($quest_count >= 5) {
    unlock_achievement($conn, $player_id, 7); // ID 7: Complete 5 quests
}
