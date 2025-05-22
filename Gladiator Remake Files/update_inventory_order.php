<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id'])) exit;

$data = json_decode(file_get_contents("php://input"), true);
$player_id = $_SESSION['id'];

if (isset($data['order'])) {
    foreach ($data['order'] as $item) {
        $item_id = (int)$item['id'];
        $position = (int)$item['position'];

        $stmt = $conn->prepare("UPDATE player_items SET position = ? WHERE id = ? AND player_id = ?");
        $stmt->bind_param("iii", $position, $item_id, $player_id);
        $stmt->execute();
        $stmt->close();
    }
    echo "OK";
}
?>
