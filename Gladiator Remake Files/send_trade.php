<?php
session_start();
require_once("db.php");
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

$sender_id = $_SESSION['id'] ?? 0;

if (!$sender_id) {
    die("Not logged in.");
}

$recipient_username = $_POST['recipient'] ?? '';
$gold = $_POST['gold'] ?? 0;
$item_id = $_POST['item_id'] ?? null;
$item_request = $_POST['item_request'] ?? null;

// 🔍 Πάρε το ID του παραλήπτη από το όνομα χρήστη
$stmt = $conn->prepare("SELECT id FROM gracze WHERE login = ?");
$stmt->bind_param("s", $recipient_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Recipient not found.");
}

$row = $result->fetch_assoc();
$receiver_id = $row['id'];

// Απλή ασφάλεια: Δεν μπορείς να στείλεις στον εαυτό σου
if ($sender_id == $receiver_id) {
    die("You cannot trade with yourself.");
}

if ($item_id === null) {
    $stmt = $conn->prepare("INSERT INTO trades (sender_id, receiver_id, item_id, gold, status) VALUES (?, ?, NULL, ?, 'pending')");
    $stmt->bind_param("iii", $sender_id, $receiver_id, $gold);
} else {
    $stmt = $conn->prepare("INSERT INTO trades (sender_id, receiver_id, item_id, gold, status) VALUES (?, ?, ?, ?, 'pending')");
    $stmt->bind_param("iiii", $sender_id, $receiver_id, $item_id, $gold);
}

if ($stmt->execute()) {
    echo "Trade request sent!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
<br><a href="index.php">← Back to Dashboard</a>