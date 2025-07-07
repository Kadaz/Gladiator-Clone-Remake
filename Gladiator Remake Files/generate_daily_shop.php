<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id']) || $_SESSION['is_admin'] != 1) {
    die("⛔ Access denied");
}

$player_id = $_SESSION['id'];
$date_today = date('Y-m-d');

// Παίρνουμε level admin (χρησιμοποιούμε το δικό του για να γεμίσει το shop αναλόγως)
$stmt = $conn->prepare("SELECT nivel FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$stmt->bind_result($admin_level);
$stmt->fetch();
$stmt->close();

$level_limit = min($admin_level, 100);

// Καθαρισμός shop για σήμερα
$conn->query("DELETE FROM daily_shop_items WHERE day_date = '$date_today'");

// ➤ 1. Προσθήκη Potion (πάντα μία)
$res = $conn->query("SELECT id, zloto FROM items WHERE name LIKE '%Potion%' ORDER BY RAND() LIMIT 1");
if ($res && $res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $item_id = $row['id'];
    $cost = $row['zloto'] * 2;

    $stmt = $conn->prepare("INSERT INTO daily_shop_items (item_id, cost, day_date) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $item_id, $cost, $date_today);
    $stmt->execute();
    $stmt->close();
}

// ➤ 2. Προσθήκη 2 αντικειμένων για το level του admin
$res = $conn->query("
    SELECT id, zloto FROM items 
    WHERE level_required = $level_limit AND (rarity IS NULL OR rarity != 'legendary')
    ORDER BY RAND() LIMIT 2
");
while ($res && $row = $res->fetch_assoc()) {
    $item_id = $row['id'];
    $cost = $row['zloto'] * 2;

    $stmt = $conn->prepare("INSERT INTO daily_shop_items (item_id, cost, day_date) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $item_id, $cost, $date_today);
    $stmt->execute();
    $stmt->close();
}

echo "<p style='color:green;'>✅ Daily shop για level $level_limit δημιουργήθηκε με επιτυχία.</p>";
echo "<a href='admin_panel.php'>← Επιστροφή στο Admin Panel</a>";
?>
