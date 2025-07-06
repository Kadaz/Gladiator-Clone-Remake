<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    echo "<p>You must be logged in.</p>";
    exit;
}

$player_id = $_SESSION['id'];

// Load unlocked achievements
$unlocked_stmt = $conn->prepare("SELECT achievement_id FROM player_achievements WHERE player_id = ?");
$unlocked_stmt->bind_param("i", $player_id);
$unlocked_stmt->execute();
$res = $unlocked_stmt->get_result();
$unlocked = [];
while ($row = $res->fetch_assoc()) {
    $unlocked[] = $row['achievement_id'];
}

// Fetch all achievements
$achievements = $conn->query("SELECT * FROM achievements ORDER BY id ASC");

echo "<h2>🏆 All Achievements</h2>";
echo "<div style='display: flex; flex-wrap: wrap;'>";

while ($a = $achievements->fetch_assoc()) {
    $is_unlocked = in_array($a['id'], $unlocked);
    $style = $is_unlocked ? "background:#e5ffe5; border:2px solid green;" : "opacity:0.4; background:#f2f2f2;";
    echo "<div style='width:200px;margin:10px;padding:10px;$style;border-radius:8px;text-align:center'>";
    if ($a['image']) echo "<img src='images/achievements/{$a['image']}' width='64'><br>";
    echo "<strong>{$a['name']}</strong><br>";
    echo "<small>{$a['description']}</small><br>";
    echo $is_unlocked ? "<span style='color:green'>✅ Unlocked</span>" : "<span style='color:gray'>🔒 Locked</span>";
    echo "</div>";
}

echo "</div><br><a href='index.php'>← Back</a>";
?>
