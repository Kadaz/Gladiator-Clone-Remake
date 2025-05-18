<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$player_id = $_SESSION['id'];

if (!isset($_GET['id'])) {
    echo "Missing item ID.";
    exit;
}

$player_item_id = (int)$_GET['id'];

// Validate item ownership
$stmt = $conn->prepare("SELECT * FROM player_items WHERE id = ? AND player_id = ?");
$stmt->bind_param("ii", $player_item_id, $player_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Invalid item or not your item.";
    exit;
}

// Unequip the item
$update = $conn->prepare("UPDATE player_items SET equipped = 0 WHERE id = ?");
$update->bind_param("i", $player_item_id);
$update->execute();

// Redirect back to the previous page (e.g., character_profile.php or inventory.php)
$redirect = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $redirect");
exit;
?>