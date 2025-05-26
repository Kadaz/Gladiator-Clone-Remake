<?php
if (!isset($_SESSION)) session_start();
require 'db.php';

$player_id = $_SESSION['id'] ?? 0;
$notifications = [];

if ($player_id > 0) {
    $stmt = $conn->prepare("SELECT id, message FROM notifications WHERE player_id = ? ORDER BY created_at DESC LIMIT 5");
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
    $stmt->close();

    // Delete notifications immediately after loading
    if (!empty($notifications)) {
        $ids = implode(",", array_column($notifications, 'id'));
        $conn->query("DELETE FROM notifications WHERE id IN ($ids)");
    }
}
