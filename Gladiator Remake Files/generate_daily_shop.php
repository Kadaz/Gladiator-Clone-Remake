<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id']) || $_SESSION['is_admin'] != 1) {
    die("⛔ Access denied");
}

$player_id = $_SESSION['id'];
$date_today = date('Y-m-d');
$fixed_cost = 100;

//  admin level
$stmt = $conn->prepare("SELECT nivel FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$stmt->bind_result($admin_level);
$stmt->fetch();
$stmt->close();

// Daily shop for today
$conn->query("DELETE FROM daily_shop_items WHERE day_date = '$date_today'");

// ➤ 1. Add 1 Potion
$res = $conn->query("SELECT id FROM items WHERE name LIKE '%Potion%' ORDER BY RAND() LIMIT 1");
if ($res && $res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $item_id = $row['id'];

    $stmt = $conn->prepare("INSERT INTO daily_shop_items (item_id, cost, day_date) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $item_id, $fixed_cost, $date_today);
    $stmt->execute();
    $stmt->close();
}

// ➤ 2. Add Items
$res = $conn->query("
    SELECT id FROM items 
    WHERE level_required = $admin_level 
    ORDER BY RAND() LIMIT 2
");

if (!$res) {
    die("❌ SQL Error: " . $conn->error);
}

if ($res->num_rows < 2) {
    // Fallback: Add lower lvl
    $fallback = $conn->query("
        SELECT DISTINCT level_required 
        FROM items 
        WHERE level_required < $admin_level 
        ORDER BY level_required DESC 
        LIMIT 1
    ");
    if ($fallback && $lvl_row = $fallback->fetch_assoc()) {
        $fallback_level = $lvl_row['level_required'];

        $res = $conn->query("
            SELECT id FROM items 
            WHERE level_required = $fallback_level 
            ORDER BY RAND() LIMIT 2
        ");
    }
}

// ➤ Add chosen items
while ($res && $row = $res->fetch_assoc()) {
    $item_id = $row['id'];

    $stmt = $conn->prepare("INSERT INTO daily_shop_items (item_id, cost, day_date) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $item_id, $fixed_cost, $date_today);
    $stmt->execute();
    $stmt->close();
}

echo "<p style='color:green;'>✅ Daily shop created with $fixed_cost coins</p>";
echo "<a href='admin_panel.php'>← Return to Admin Panel</a>";
?>
