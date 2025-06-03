<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in.");
}

$user_id = $_SESSION['user_id'];
$trade_id = isset($_POST['trade_id']) ? intval($_POST['trade_id']) : 0;
$item_id = isset($_POST['item_id']) ? intval($_POST['item_id']) : 0;

if ($trade_id <= 0 || $item_id <= 0) {
    die("Invalid trade or item.");
}

// Check if the trade exists and the user is a participant
$stmt = $conn->prepare("SELECT * FROM trades WHERE id = ? AND (sender_id = ? OR receiver_id = ?) AND status = 'pending'");
$stmt->bind_param("iii", $trade_id, $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Trade not found or not authorized.");
}

// Check if the item belongs to the user and is not equipped
$stmt = $conn->prepare("SELECT * FROM player_items WHERE id = ? AND user_id = ? AND equipped = 0");
$stmt->bind_param("ii", $item_id, $user_id);
$stmt->execute();
$item_result = $stmt->get_result();

if ($item_result->num_rows === 0) {
    die("Item not found or cannot be traded.");
}

// Add the item to the trade
$stmt = $conn->prepare("INSERT INTO trade_items (trade_id, item_id, from_user_id) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $trade_id, $item_id, $user_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Item successfully added to the trade.";
} else {
    echo "Failed to add item to the trade.";
}
?>
