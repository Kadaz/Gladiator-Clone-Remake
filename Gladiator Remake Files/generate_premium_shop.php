<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    die("Access denied.");
}

// Καθαρίζουμε τα παλιά αντικείμενα
$conn->query("DELETE FROM premium_shop_items");

// Τραβάμε 10 random αντικείμενα (potions ή κανονικά)
$result = $conn->query("
    SELECT id, value 
    FROM items 
    WHERE value > 0 
      AND value <= 1000 
      AND (type = 'potion' OR slot IS NOT NULL)
    ORDER BY RAND() LIMIT 10
");

while ($item = $result->fetch_assoc()) {
    $item_id = $item['id'];
    $cost = ceil($item['value'] / 2); // προσαρμόσιμο
    $one_time = 0;

    $insert = $conn->prepare("INSERT INTO premium_shop_items (item_id, cost, one_time) VALUES (?, ?, ?)");
    $insert->bind_param("iii", $item_id, $cost, $one_time);
    $insert->execute();
}

echo "<p style='color:green;'>✅ Premium shop refreshed with 10 new items.</p>";
echo "<br><a href='admin_panel.php'>← Back to Admin Panel</a>";
?>
