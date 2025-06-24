<?php
if (!isset($_SESSION)) session_start();
require 'db.php';

// Έλεγξε αν το maintenance mode είναι ενεργό
$res = $conn->query("SELECT value FROM settings WHERE name = 'maintenance_mode'");
$row = $res->fetch_assoc();
$maintenance_on = isset($row['value']) && $row['value'] == '1';

if ($maintenance_on) {
    $user_id = $_SESSION['id'] ?? null;
    if ($user_id) {
        $stmt = $conn->prepare("SELECT is_admin FROM gracze WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($is_admin);
        $stmt->fetch();
        $stmt->close();

        if ($is_admin) return; // admin μπαίνει κανονικά
    }

    // Αν δεν είναι admin ή logged in
    echo "<h2>🛠 Server Under Maintenance</h2>";
    echo "<p>Please try again later.</p>";
    exit;
}
