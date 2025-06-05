<?php
session_start();
require_once('db.php');
require_once('var/ustawienia.php');

if (!isset($_SESSION['id'])) {
    die("❌ You must be logged in.");
}

$userId = $_SESSION['id'];
$trade_id = $_POST['trade_id'] ?? 0;
$action = $_POST['action'] ?? '';

if (!$trade_id || !$action) {
    die("❌ Invalid request.");
}

// Fetch trade
$stmt = $conn->prepare("SELECT * FROM trades WHERE id = ? AND receiver_id = ?");
$stmt->bind_param("ii", $trade_id, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("❌ Trade not found.");
}

$trade = $result->fetch_assoc();
$sender_id = $trade['sender_id'];
$item_id = $trade['item_id'];
$item_request = $trade['item_request'];
$gold = (int)$trade['gold'];

if ($action === 'accept') {
    // Begin transaction
    $conn->begin_transaction();

    try {
        // Move gold from sender ➜ receiver
        if ($gold > 0) {
            $conn->query("UPDATE gracze SET zloto = zloto - $gold WHERE id = $sender_id");
            $conn->query("UPDATE gracze SET zloto = zloto + $gold WHERE id = $userId");
        }

        // Move item from sender ➜ receiver
        if ($item_id) {
            $stmt = $conn->prepare("UPDATE player_items SET player_id = ? WHERE id = ? AND player_id = ?");
            $stmt->bind_param("iii", $userId, $item_id, $sender_id);
            $stmt->execute();
            if ($stmt->affected_rows === 0) {
                throw new Exception("❌ Item not available (offered item).");
            }
        }

        // Move item_request from receiver ➜ sender
        if ($item_request) {
            $stmt = $conn->prepare("UPDATE player_items SET player_id = ? WHERE id = ? AND player_id = ?");
            $stmt->bind_param("iii", $sender_id, $item_request, $userId);
            $stmt->execute();
            if ($stmt->affected_rows === 0) {
                throw new Exception("❌ Requested item not available.");
            }
        }

        // Update trade as accepted
        $stmt = $conn->prepare("UPDATE trades SET status = 'accepted' WHERE id = ?");
        $stmt->bind_param("i", $trade_id);
        $stmt->execute();

        $conn->commit();
        echo "✅ Trade accepted successfully.";
    } catch (Exception $e) {
        $conn->rollback();
        echo $e->getMessage();
    }
} elseif ($action === 'decline') {
    $stmt = $conn->prepare("UPDATE trades SET status = 'declined' WHERE id = ?");
    $stmt->bind_param("i", $trade_id);
    $stmt->execute();
    echo "❌ Trade declined.";
} else {
    echo "❌ Unknown action.";
}

$conn->close();
?>
<br><a href="trade_inbox.php">← Back to Trade Inbox</a>
