<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in.");
}

$user_id = $_SESSION['user_id'];
$trade_id = isset($_POST['trade_id']) ? intval($_POST['trade_id']) : 0;
$gold_amount = isset($_POST['gold']) ? intval($_POST['gold']) : 0;

if ($trade_id <= 0 || $gold_amount <= 0) {
    die("Invalid trade or gold amount.");
}

// Confirm user is part of the trade and it's still pending
$stmt = $conn->prepare("SELECT * FROM trades WHERE id = ? AND (sender_id = ? OR receiver_id = ?) AND status = 'pending'");
$stmt->bind_param("iii", $trade_id, $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Trade not found or not authorized.");
}

// Check if user has enough gold
$stmt = $conn->prepare("SELECT gold FROM gracze WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$gold_result = $stmt->get_result();

if ($gold_result->num_rows === 0) {
    die("User not found.");
}

$user_data = $gold_result->fetch_assoc();

if ($user_data['gold'] < $gold_amount) {
    die("Not enough gold.");
}

// Deduct gold from user
$stmt = $conn->prepare("UPDATE gracze SET gold = gold - ? WHERE id = ?");
$stmt->bind_param("ii", $gold_amount, $user_id);
$stmt->execute();

// Add entry to trade_gold
$stmt = $conn->prepare("INSERT INTO trade_gold (trade_id, from_user_id, gold_amount) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $trade_id, $user_id, $gold_amount);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Gold added to the trade.";
} else {
    echo "Failed to add gold.";
}
?>
