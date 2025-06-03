<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    die("You must be logged in.");
}

$userId = $_SESSION['id'];

if (!isset($_POST['trade_id'], $_POST['action'])) {
    die("Invalid request.");
}

$tradeId = (int)$_POST['trade_id'];
$action = $_POST['action'];

if (!in_array($action, ['accept', 'decline'])) {
    die("Invalid action.");
}

// Fetch the trade
$stmt = $conn->prepare("SELECT * FROM trades WHERE id = ? AND receiver_id = ?");
$stmt->bind_param("ii", $tradeId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Trade not found or not yours.");
}

$trade = $result->fetch_assoc();

if ($trade['status'] !== 'pending') {
    die("Trade is already processed.");
}

if ($action === 'decline') {
    $update = $conn->prepare("UPDATE trades SET status = 'declined' WHERE id = ?");
    $update->bind_param("i", $tradeId);
    $update->execute();
    echo "Trade declined.";
    exit;
}

// Accept trade
$conn->begin_transaction();

try {
    // Transfer gold
    if ($trade['gold'] > 0) {
        // Remove gold from sender
        $stmt = $conn->prepare("UPDATE gracze SET zloto = zloto - ? WHERE id = ? AND zloto >= ?");
        $stmt->bind_param("iii", $trade['gold'], $trade['sender_id'], $trade['gold']);
        $stmt->execute();
        if ($stmt->affected_rows === 0) {
            throw new Exception("Sender doesn't have enough gold.");
        }

        // Add gold to receiver
        $stmt = $conn->prepare("UPDATE gracze SET zloto = zloto + ? WHERE id = ?");
        $stmt->bind_param("ii", $trade['gold'], $userId);
        $stmt->execute();
    }

    // Transfer item (if offered)
    if ($trade['item_id']) {
        // Update owner of item
        $stmt = $conn->prepare("UPDATE player_items SET player_id = ? WHERE id = ? AND player_id = ?");
        $stmt->bind_param("iii", $userId, $trade['item_id'], $trade['sender_id']);
        $stmt->execute();
        if ($stmt->affected_rows === 0) {
            throw new Exception("Item not available.");
        }
    }

    // Update trade status
    $stmt = $conn->prepare("UPDATE trades SET status = 'accepted', updated_at = NOW() WHERE id = ?");
    $stmt->bind_param("i", $tradeId);
    $stmt->execute();

    $conn->commit();
    echo "Trade accepted successfully.";
} catch (Exception $e) {
    $conn->rollback();
    echo "Trade failed: " . $e->getMessage();
}
?>
