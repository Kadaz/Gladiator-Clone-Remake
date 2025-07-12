<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

// ✅ Admin check
if (!isset($_SESSION['id'])) {
    die("⛔ Access denied.");
}

$check = $conn->prepare("SELECT is_admin FROM gracze WHERE id = ?");
$check->bind_param("i", $_SESSION['id']);
$check->execute();
$check->bind_result($is_admin);
$check->fetch();
$check->close();

if (!$is_admin) {
    die("⛔ Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $start = $_POST['start_time'];
    $end = $_POST['end_time'];

    if (empty($name) || empty($start) || empty($end)) {
        echo "<p style='color:red;'>⚠️ Please fill in all fields.</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO tournaments (name, start_time, end_time) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $start, $end);
        if ($stmt->execute()) {
            echo "<p style='color:green;'>✅ Tournament '$name' created successfully!</p>";
        } else {
            echo "<p style='color:red;'>❌ Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
}
?>

<h2>🏆 Create New Tournament</h2>
<form method="post">
    <label>Tournament Name:</label><br>
    <input type="text" name="name"><br><br>

    <label>Start Time (YYYY-MM-DD HH:MM:SS):</label><br>
    <input type="text" name="start_time" value="<?= date('Y-m-d H:i:s') ?>"><br><br>

    <label>End Time (YYYY-MM-DD HH:MM:SS):</label><br>
    <input type="text" name="end_time" value="<?= date('Y-m-d H:i:s', strtotime('+7 days')) ?>"><br><br>

    <button type="submit">➕ Create Tournament</button>
</form>

<br><a href="admin_panel.php">← Back to Admin Panel</a>
