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

// Βρες guild_id και alliance_id
$guild_id = null;
$alliance_id = null;

$stmt = $conn->prepare("SELECT guild_id FROM guild_members WHERE player_id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $guild_id = $row['guild_id'];

    $stmt2 = $conn->prepare("SELECT alliance_id FROM alliance_members WHERE guild_id = ?");
    $stmt2->bind_param("i", $guild_id);
    $stmt2->execute();
    $res2 = $stmt2->get_result();
    if ($row2 = $res2->fetch_assoc()) {
        $alliance_id = $row2['alliance_id'];
    }
}

if ($action === 'send') {
    $msg = trim($_POST['message'] ?? '');
    $channel = $_POST['channel'] ?? 'global';

    if ($msg !== '') {
        $msg = htmlspecialchars($msg, ENT_QUOTES, 'UTF-8');
        $stmt = $conn->prepare("INSERT INTO chat_messages (player_id, message, channel) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $player_id, $msg, $channel);
        $stmt->execute();
        echo json_encode(['status' => 'ok']);
    } else {
        echo json_encode(['error' => 'Empty message']);
    }
    exit;
}

if ($action === 'fetch') {
    $channel = $_POST['channel'] ?? 'global';

    if ($channel === 'guild' && $guild_id) {
        $stmt = $conn->prepare("
            SELECT cm.message, cm.timestamp, g.login 
            FROM chat_messages cm 
            JOIN gracze g ON g.id = cm.player_id 
            WHERE cm.channel = 'guild' 
            AND g.id IN (SELECT player_id FROM guild_members WHERE guild_id = ?)
            ORDER BY cm.timestamp DESC LIMIT 30
        ");
        $stmt->bind_param("i", $guild_id);
    } elseif ($channel === 'alliance' && $alliance_id) {
        $stmt = $conn->prepare("
            SELECT cm.message, cm.timestamp, g.login 
            FROM chat_messages cm 
            JOIN gracze g ON g.id = cm.player_id 
            WHERE cm.channel = 'alliance' 
            AND g.id IN (
                SELECT gm.player_id FROM guild_members gm
                JOIN alliance_members am ON gm.guild_id = am.guild_id
                WHERE am.alliance_id = ?
            )
            ORDER BY cm.timestamp DESC LIMIT 30
        ");
        $stmt->bind_param("i", $alliance_id);
    } else {
        // global ή unauthorized access
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
