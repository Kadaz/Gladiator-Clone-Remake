<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    die("Access denied.");
}

// Delete today's existing premium shop entries
$conn->query("DELETE FROM premium_shop_items WHERE date = CURDATE()");
$today = date('Y-m-d');

// Levels 1 to 100
for ($level = 1; $level <= 100; $level++) {
    $stmt = $conn->prepare("
        SELECT id, value 
        FROM items 
        WHERE level_required = ? 
          AND value > 0 
          AND value <= 1000 
          AND (type = 'potion' OR slot IS NOT NULL)
        ORDER BY RAND() LIMIT 3
    ");
    $stmt->bind_param("i", $level);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($item = $result->fetch_assoc()) {
        $item_id = $item['id'];
        $cost = ceil($item['value'] / 2); // Adjust if needed
        $one_time = 0; // ή 1 αν θες να είναι limited

        $insert = $conn->prepare("
            INSERT INTO premium_shop_items (item_id, cost, one_time, date, level) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $insert->bind_param("iiisi", $item_id, $cost, $one_time, $today, $level);
        $insert->execute();
    }
}

echo "<p style='color:green;'>✅ Premium shop refreshed for today.</p>";
echo "<br><a href='admin_panel.php'>← Back to Admin Panel</a>";
?>
