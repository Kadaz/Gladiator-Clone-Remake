<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$player_id = $_SESSION['id'];
$player_item_id = $_POST['player_item_id'] ?? 0;

// Get the slot of the item to equip
$sql = "SELECT i.slot 
        FROM player_items pi 
        JOIN items i ON pi.item_id = i.id 
        WHERE pi.id = ? AND pi.player_id = ? AND pi.equipped = 0";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $player_item_id, $player_id);
$stmt->execute();
$result = $stmt->get_result();

if ($item = $result->fetch_assoc()) {
    $slot = $item['slot'];

    // Unequip currently equipped item in the same slot
    $sql_unequip = "UPDATE player_items 
                    JOIN items ON player_items.item_id = items.id 
                    SET player_items.equipped = 0 
                    WHERE player_items.player_id = ? AND items.slot = ? AND player_items.equipped = 1";
    $stmt_unequip = $conn->prepare($sql_unequip);
    $stmt_unequip->bind_param("is", $player_id, $slot);
    $stmt_unequip->execute();

    // Equip the selected item
    $sql_equip = "UPDATE player_items SET equipped = 1 WHERE id = ? AND player_id = ?";
    $stmt_equip = $conn->prepare($sql_equip);
    $stmt_equip->bind_param("ii", $player_item_id, $player_id);
    $stmt_equip->execute();
}

header("Location: character_profile.php");
exit;
