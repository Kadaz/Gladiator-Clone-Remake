<?php
session_start();
require 'db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$player_id = $_SESSION['id'];
$action = $_POST['action'] ?? null;
$now = time();

// Find guild_id and alliance_id
$guild_id = $alliance_id = null;

$stmt = $conn->prepare("SELECT guild_id FROM guild_members WHERE player_id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$res = $stmt->get_result();
if ($row = $res->fetch_assoc()) {
    $guild_id = $row['guild_id'];
    $stmt2 = $conn->prepare("SELECT alliance_id FROM alliance_members WHERE guild_id = ?");
    $stmt2->bind_param("i", $guild_id);
    $stmt2->execute();
    $res2 = $stmt2->get_result();
    if ($row2 = $res2->fetch_assoc()) {
        $alliance_id = $row2['alliance_id'];
    }
}

// DELETE old messages older than 7 days (auto-clean)
$conn->query("DELETE FROM chat_messages WHERE timestamp < NOW() - INTERVAL 7 DAY");

if ($action === 'send') {
    $message = trim($_POST['message'] ?? '');
    $channel = $_POST['channel'] ?? 'global';

    if ($message === '') {
        echo json_encode(['error' => 'Empty message']);
        exit;
    }

    // Emoji & message formatting
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

    // Whisper mode
    if ($channel === 'whisper' && preg_match('/^\/w\s+(\w+)\s+(.+)/i', $message, $m)) {
        $target_login = $m[1];
        $real_message = $m[2];

        // Find recipient ID
        $stmt = $conn->prepare("SELECT id FROM gracze WHERE login = ?");
        $stmt->bind_param("s", $target_login);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($row = $res->fetch_assoc()) {
            $target_id = $row['id'];
            $stmt = $conn->prepare("INSERT INTO chat_messages (player_id, message, channel, alliance_id) VALUES (?, ?, 'whisper', ?)");
            $msg_formatted = "To [$target_login]: " . $real_message;
            $stmt->bind_param("isi", $player_id, $msg_formatted, $target_id);  // alliance_id πεδίο = recipient_id για whisper
            $stmt->execute();
            echo json_encode(['status' => 'ok']);
        } else {
            echo json_encode(['error' => 'User not found']);
        }
        exit;
    }

    // Trade & other messages
    $stmt = $conn->prepare("INSERT INTO chat_messages (player_id, message, channel) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $player_id, $message, $channel);
    $stmt->execute();
    echo json_encode(['status' => 'ok']);
    exit;
}

if ($action === 'fetch') {
    $channel = $_POST['channel'] ?? 'global';

    if ($channel === 'guild' && $guild_id) {
        $stmt = $conn->prepare("
            SELECT cm.message, cm.timestamp, g.login 
            FROM chat_messages cm 
            JOIN gracze g ON g.id = cm.player_id 
            WHERE cm.channel = 'guild' AND cm.player_id IN 
                (SELECT player_id FROM guild_members WHERE guild_id = ?)
            ORDER BY cm.timestamp DESC LIMIT 30
        ");
        $stmt->bind_param("i", $guild_id);

    } elseif ($channel === 'alliance' && $alliance_id) {
        $stmt = $conn->prepare("
            SELECT cm.message, cm.timestamp, g.login 
            FROM chat_messages cm 
            JOIN gracze g ON g.id = cm.player_id 
            WHERE cm.channel = 'alliance' AND cm.player_id IN 
                (SELECT gm.player_id FROM guild_members gm 
                 JOIN alliance_members am ON gm.guild_id = am.guild_id 
                 WHERE am.alliance_id = ?)
            ORDER BY cm.timestamp DESC LIMIT 30
        ");
        $stmt->bind_param("i", $alliance_id);

    } elseif ($channel === 'trade') {
        $stmt = $conn->prepare("
            SELECT cm.message, cm.timestamp, g.login 
            FROM chat_messages cm 
            JOIN gracze g ON g.id = cm.player_id 
            WHERE cm.channel = 'trade' 
            ORDER BY cm.timestamp DESC LIMIT 30
        ");

    } elseif ($channel === 'whisper') {
        $stmt = $conn->prepare("
            SELECT cm.message, cm.timestamp, g.login 
            FROM chat_messages cm 
            JOIN gracze g ON g.id = cm.player_id 
            WHERE cm.channel = 'whisper' AND (cm.alliance_id = ? OR cm.player_id = ?)
            ORDER BY cm.timestamp DESC LIMIT 30
        ");
        $stmt->bind_param("ii", $player_id, $player_id);

    } else {
        // Global chat
        $stmt = $conn->prepare("
            SELECT cm.message, cm.timestamp, g.login 
            FROM chat_messages cm 
            JOIN gracze g ON g.id = cm.player_id 
            WHERE cm.channel = 'global' 
            ORDER BY cm.timestamp DESC LIMIT 30
        ");
    }

    $stmt->execute();
    $messages = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    echo json_encode(array_reverse($messages));
    exit;
}

echo json_encode(['error' => 'Invalid action']);
?>
