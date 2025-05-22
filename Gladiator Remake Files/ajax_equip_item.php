<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id'])) {
    echo "not_logged_in";
    exit;
}

$player_id = $_SESSION['id'];
$item_id = (int)($_POST['item_id'] ?? 0);

// Get the type of this item
$stmt = $conn->prepare("
    SELECT i.type 
    FROM player_items pi 
    JOIN items i ON pi.item_id = i.id 
    WHERE pi.id = ? AND pi.player_id = ?
");
$stmt->bind_param("ii", $item_id, $player_id);
$stmt->execute();
$result = $stmt->get_result();
if (!$result || !$row = $result->fetch_assoc()) {
    echo "invalid_item";
    exit;
}
$type = $row['type'];

// Unequip other items of the same type
$conn->query("
    UPDATE player_items 
    SET equipped = 0 
    WHERE player_id = $player_id AND equipped = 1 AND item_id IN (
        SELECT id FROM items WHERE type = '$type'
    )
");

// Equip this one
$equip_stmt = $conn->prepare("UPDATE player_items SET equipped = 1 WHERE id = ? AND player_id = ?");
$equip_stmt->bind_param("ii", $item_id, $player_id);
if ($equip_stmt->execute()) {
    echo "success";
} else {
    echo "db_error";
}
