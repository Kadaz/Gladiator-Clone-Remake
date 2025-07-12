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

// ✅ Update tournament daily limit
if (isset($_POST['save_limit'])) {
    $new_limit = max(1, (int)$_POST['daily_limit']);
    $stmt = $conn->prepare("
        INSERT INTO config (cfg_key, cfg_value)
        VALUES ('tournament_daily_limit', ?)
        ON DUPLICATE KEY UPDATE cfg_value = VALUES(cfg_value)
    ");
    $stmt->bind_param("s", $new_limit);
    $stmt->execute();
    echo "<p style='color:green;'>✅ Daily limit set to $new_limit fights/day.</p>";
}

// ✅ Load current value
$cfg = $conn->query("SELECT cfg_value FROM config WHERE cfg_key = 'tournament_daily_limit'");
$limit = $cfg && $cfg->num_rows ? (int)$cfg->fetch_assoc()['cfg_value'] : 5;

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
	<li><a href="generate_daily_shop.php">🛒 Refresh Daily Shop</a></li>
	<li><a href="generate_premium_shop.php">🔄 Refresh Premium Shop</a></li>
	<li><a href="admin_create_tournament.php">Create Tournament</a></li>
	<li><a href="premium_shop.php">🛍️ Open Premium Shop</a></li>
	<li><a href="admin_edit_premium_shop.php">🛍️ Manage Premium Shop</a></li>
	<li><a href="admin_set_premium.php">🛍️ Manage Premium Players</a></li>
	<h3>⚙️ Tournament Settings</h3>
<form method="post">
    <label>Daily match limit per player:</label>
    <input type="number" name="daily_limit" min="1" max="20"
           value="<?= $limit ?>" style="width:60px;">
    <button type="submit" name="save_limit">💾 Save</button>
</form>
    <li><a href="index.php">← Back to Dashboard</a></li>
</ul>
