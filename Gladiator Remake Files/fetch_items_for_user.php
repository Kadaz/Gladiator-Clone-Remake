<?php
require_once('db.php');

$username = $_GET['username'] ?? '';

if ($username === '') {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("
    SELECT pi.id AS player_item_id, i.name 
    FROM player_items pi 
    JOIN gracze g ON pi.player_id = g.id 
    JOIN items i ON pi.item_id = i.id 
    WHERE g.login = ?
");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

echo json_encode($items);
