<?php
session_start();
require_once("db.php");
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

$sender_id = $_SESSION['id'] ?? 0;
if (!$sender_id) {
    die("❌ Not logged in.");
}

$recipient_username = $_POST['recipient'] ?? '';
$gold = (int)($_POST['gold'] ?? 0);
$item_id = $_POST['item_id'] !== '' ? (int)$_POST['item_id'] : null;
$item_request = $_POST['item_request'] !== '' ? (int)$_POST['item_request'] : null;

// 🔍 Get recipient ID
$stmt = $conn->prepare("SELECT id FROM gracze WHERE login = ?");
$stmt->bind_param("s", $recipient_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("❌ Recipient not found.");
}

$receiver_id = $result->fetch_assoc()['id'];

// ❌ Prevent sending to self
if ($sender_id == $receiver_id) {
    die("❌ You cannot trade with yourself.");
}

// ✅ Validate item_id belongs to sender (if given)
if ($item_id !== null) {
    $stmt = $conn->prepare("SELECT id FROM player_items WHERE id = ? AND player_id = ?");
    $stmt->bind_param("ii", $item_id, $sender_id);
    $stmt->execute();
    $check = $stmt->get_result();
    if ($check->num_rows === 0) {
        die("❌ Item to offer does not belong to you.");
    }
}

// ✅ Insert trade
$stmt = $conn->prepare("INSERT INTO trades (sender_id, receiver_id, item_id, item_request, gold, status) VALUES (?, ?, ?, ?, ?, 'pending')");
$stmt->bind_param("iiiii", $sender_id, $receiver_id, $item_id, $item_request, $gold);

if ($stmt->execute()) {
    echo "✅ Trade request sent!";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
<br><a href="index.php">← Back to Dashboard</a>
