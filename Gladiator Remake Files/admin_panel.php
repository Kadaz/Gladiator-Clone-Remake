<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    echo "<p>Not logged in.</p>";
    exit;
}

// Check If You Are An admin
$player_id = $_SESSION['id'];
$stmt = $conn->prepare("SELECT is_admin FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$stmt->bind_result($is_admin);
$stmt->fetch();
$stmt->close();

if (!$is_admin) {
    echo "<p>Access denied.</p>";
    exit;
}
?>

<h2>🛠️ Admin Panel</h2>
<p>Welcome, Admin.</p>

<ul style="line-height: 1.8;">
    <li><a href="admin_set_title.php">🎖️ Set Player Title</a></li>
    <li><a href="admin_ban_panel.php">🔒 Ban / Unban Players</a></li>
    <li><a href="admin_log.php">📜 View Logs</a></li>
	<li><a href="admin_delete_player.php">🗑️ Delete Players</a></li>
	<li><a href="admin_edit_stats.php">🛠️ Edit Player Stats</a></li>
    <li><a href="admin_config.php">⚙️ Game Settings</a></li>
	<li><a href="admin_review_reports.php">🚨 Review Player Reports</a></li>
	<li><a href="admin_edit_achievements.php">🏅 Manage Achievements</a></li>
    <li><a href="index.php">← Back to Dashboard</a></li>
</ul>
