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

echo "<h2>🏆 PvP Rankings</h2>";
echo "<table border='1' cellpadding='5'><tr><th>Rank</th><th>Username</th><th>Victories</th><th>Defeats</th></tr>";

$result = $conn->query("SELECT login, victorias, perdidas FROM gracze ORDER BY victorias DESC, perdidas ASC LIMIT 50");
$rank = 1;
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$rank}</td>
        <td>" . htmlspecialchars($row['login']) . "</td>
        <td>{$row['victorias']}</td>
        <td>{$row['perdidas']}</td>
    </tr>";
    $rank++;
}

echo "</table><br><a href='index.php'>← Back to Dashboard</a>";
?>