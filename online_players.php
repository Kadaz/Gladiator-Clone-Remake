<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

echo "<h2>🟢 Online Players (last 5 minutes)</h2>";

$five_minutes_ago = time() - 300;

$stmt = $conn->prepare("SELECT login, nivel FROM gracze WHERE ostatnio_zregenerowano >= ?");
$stmt->bind_param("i", $five_minutes_ago);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><strong>" . htmlspecialchars($row['login']) . "</strong> (Level: {$row['nivel']})</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No players are online.</p>";
}

echo "<br><a href='index.php'>← Back to Dashboard</a>";
?>