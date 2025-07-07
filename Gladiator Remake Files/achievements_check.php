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

    // 👉 Fetch achievement name + reward title
    $stmt = $conn->prepare("SELECT name, title_reward FROM achievements WHERE id = ?");
    $stmt->bind_param("i", $achievement_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) return; // query error
    $data = $result->fetch_assoc();
    if (!$data) return;

    $name = $data['name'];
    $title = $data['title_reward'];

    // ✅ Send notification
    $message = "🎯 Achievement Unlocked: <strong>$name</strong>";
    if (!empty($title)) {
        $message .= " — New title unlocked: <strong>$title</strong>";
    }
    $notif = $conn->prepare("INSERT INTO notifications (player_id, message) VALUES (?, ?)");
    $notif->bind_param("is", $player_id, $message);
    $notif->execute();

    // Log for admin
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

    // 🔥 PvP streak achievement
    $stmt = $conn->prepare("SELECT value FROM counters WHERE player_id = ? AND name = 'pvp_streak'");
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $stmt->bind_result($streak);
    $stmt->fetch();
    $stmt->close();

    if ($streak >= 3) {
        unlock_achievement($conn, $player_id, 61); // Winning Streak
    }

    // Add more below with relevant achievement IDs

// PvP Veteran (50 wins)
    if ($player['victorias'] >= 50) {
        unlock_achievement($conn, $player_id, 55);
    }

    // Quest Master (20 quests)
    $stmt = $conn->prepare("SELECT value FROM counters WHERE player_id = ? AND name = 'quests_completed'");
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $counter = $res->fetch_assoc();
    $quest_count = $counter ? (int)$counter['value'] : 0;

    if ($quest_count >= 20) {
        unlock_achievement($conn, $player_id, 56);
    }

    // Gladiator Elite (level 30)
    if ($player['nivel'] >= 30) {
        unlock_achievement($conn, $player_id, 57);
    }

    // Socializer (chat messages >= 10)
    $stmt = $conn->prepare("SELECT value FROM counters WHERE player_id = ? AND name = 'chat_messages'");
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $chat_result = $stmt->get_result();
    $chat_counter = $chat_result->fetch_assoc();
    if ($chat_counter && $chat_counter['value'] >= 10) {
        unlock_achievement($conn, $player_id, 58);
    }

    // Wealthy Merchant (gold >= 5000)
    if ($gold >= 5000) {
        unlock_achievement($conn, $player_id, 59);
    }

    // Maxed Out (skills at max level)
    //$stmt = $conn->prepare("SELECT COUNT(*) FROM player_skills ps JOIN skills s ON ps.skill_id = s.id WHERE ps.player_id = ? AND ps.level = s.max_level");
    //$stmt->bind_param("i", $player_id);
    //$stmt->execute();
    //$stmt->bind_result($maxed);
    //$stmt->fetch();
    //$stmt->close();
    //if ($maxed >= 3) {
    //    unlock_achievement($conn, $player_id, 60);
    //}
	
	// PvP: First win
if ($player['victorias'] >= 1) {
    unlock_achievement($conn, $player_id, 61);
}

// PvP: 10 in a row (θα χρειαστείς counter `pvp_streak`)
$stmt = $conn->prepare("SELECT value FROM counters WHERE player_id = ? AND name = 'pvp_streak'");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$streak_res = $stmt->get_result()->fetch_assoc();
if ($streak_res && $streak_res['value'] >= 10) {
    unlock_achievement($conn, $player_id, 68);
}

// Quests: 100 completed
$stmt = $conn->prepare("SELECT value FROM counters WHERE player_id = ? AND name = 'quests_completed'");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$quests = $stmt->get_result()->fetch_assoc();
if ($quests && $quests['value'] >= 100) {
    unlock_achievement($conn, $player_id, 62);
}

// Gold: 10,000
if ($gold >= 10000) {
    unlock_achievement($conn, $player_id, 63);
}

// Chat: 100 messages
$stmt = $conn->prepare("SELECT value FROM counters WHERE player_id = ? AND name = 'chat_messages'");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$chat = $stmt->get_result()->fetch_assoc();
if ($chat && $chat['value'] >= 100) {
    unlock_achievement($conn, $player_id, 64);
}

// Items owned
$stmt = $conn->prepare("SELECT COUNT(*) FROM player_items WHERE player_id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$stmt->bind_result($item_count);
$stmt->fetch();
$stmt->close();
if ($item_count >= 50) {
    unlock_achievement($conn, $player_id, 65);
}

// Bankrupt (gold 0 and level >= 10)
if ($gold == 0 && $player['nivel'] >= 10) {
    unlock_achievement($conn, $player_id, 69);
}

// Night owl: 2–5am logins counter (night_logins)
$stmt = $conn->prepare("SELECT value FROM counters WHERE player_id = ? AND name = 'night_logins'");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$night = $stmt->get_result()->fetch_assoc();
if ($night && $night['value'] >= 7) {
    unlock_achievement($conn, $player_id, 70);
}

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
