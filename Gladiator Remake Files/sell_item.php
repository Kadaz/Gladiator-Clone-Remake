<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$player_id = $_SESSION['id'];
$item_id = (int)$_GET['id'] ?? 0;

// Get item value
$stmt = $conn->prepare("
    SELECT i.value 
    FROM player_items pi 
    JOIN items i ON pi.item_id = i.id 
    WHERE pi.id = ? AND pi.player_id = ? AND pi.equipped = 0
");
$stmt->bind_param("ii", $item_id, $player_id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();

if ($item) {
    $gold = $item['value'];

    // Give gold and remove item
    $conn->query("UPDATE gracze SET zloto = zloto + $gold WHERE id = $player_id");
    $conn->query("DELETE FROM player_items WHERE id = $item_id");

    header("Location: inventory.php");
    exit;
} else {
    echo "Invalid item or already equipped.";
}
