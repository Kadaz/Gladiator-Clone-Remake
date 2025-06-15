<?php
session_start();
require 'db.php';

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$player_id = $_SESSION['id'];
$action = $_POST['action'] ?? null;

if ($action === 'send') {
    $msg = trim($_POST['message'] ?? '');
    $channel = $_POST['channel'] ?? 'global';

    if ($msg !== '') {
        $msg = htmlspecialchars($msg, ENT_QUOTES, 'UTF-8');

        $stmt = $conn->prepare("INSERT INTO chat_messages (player_id, message, channel) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $player_id, $msg, $channel);
        $stmt->execute();
        $stmt->close();

        echo json_encode(['status' => 'ok']);
    } else {
        echo json_encode(['error' => 'Empty message']);
    }
    exit;
}

if ($action === 'fetch') {
    $channel = $_POST['channel'] ?? 'global';

    $stmt = $conn->prepare("
        SELECT cm.message, cm.timestamp, g.login 
        FROM chat_messages cm 
        JOIN gracze g ON g.id = cm.player_id 
        WHERE cm.channel = ? 
        ORDER BY cm.timestamp DESC 
        LIMIT 30
    ");
    $stmt->bind_param("s", $channel);
    $stmt->execute();
    $result = $stmt->get_result();

    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    echo json_encode(array_reverse($messages));
    $stmt->close();
    exit;
}

echo json_encode(['error' => 'Invalid action']);
?>
