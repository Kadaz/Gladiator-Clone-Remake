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

    // Fetch IDs of equipped items in the same slot
    $sql_ids = "SELECT pi.id 
                FROM player_items pi 
                JOIN items i ON pi.item_id = i.id 
                WHERE pi.player_id = ? AND pi.equipped = 1 AND i.slot = ?";
    $stmt_ids = $conn->prepare($sql_ids);
    $stmt_ids->bind_param("is", $player_id, $slot);
    $stmt_ids->execute();
    $result_ids = $stmt_ids->get_result();

    while ($row = $result_ids->fetch_assoc()) {
        $unequip_id = $row['id'];
        $conn->query("UPDATE player_items SET equipped = 0 WHERE id = $unequip_id");
    }

    // Equip the selected item
    $sql_equip = "UPDATE player_items SET equipped = 1 WHERE id = ? AND player_id = ?";
    $stmt_equip = $conn->prepare($sql_equip);
    $stmt_equip->bind_param("ii", $player_item_id, $player_id);
    $stmt_equip->execute();
}

header("Location: character_profile.php");
exit;
