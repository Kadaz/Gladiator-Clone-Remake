<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    die("Not logged in.");
}

if (!isset($_POST['trade_id'])) {
    die("Trade ID not provided.");
}

$tradeId = intval($_POST['trade_id']);
$userId = $_SESSION['id'];

// Έλεγχος αν το trade ανήκει στον χρήστη και είναι ακόμα pending
$query = $conn->prepare("SELECT id FROM trades WHERE id = ? AND sender_id = ? AND status = 'pending'");
$query->bind_param("ii", $tradeId, $userId);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    die("Trade not found or cannot be cancelled.");
}

// Ακύρωση trade (αλλάζουμε το status σε declined)
$cancel = $conn->prepare("UPDATE trades SET status = 'declined' WHERE id = ?");
$cancel->bind_param("i", $tradeId);
$cancel->execute();

echo "Trade cancelled successfully.<br><a href='trade_history.php'>Back to Trade History</a>";
