<?php
session_start();
require_once('maintenance_check.php');
require 'db.php';  // Your database connection file (make sure $conn is defined here)
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (isset($_SESSION['id'])) {
    $player_id = $_SESSION['id'];
    $conn->query("UPDATE gracze SET ostatnio_zregenerowano = UNIX_TIMESTAMP() WHERE id = $player_id");
}

if (!isset($_SESSION['id'])) {
    header("Location: logowanie.php");
    exit;
}
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $now = time();
    mysqli_query($conn, "UPDATE gracze SET ostatnia_aktywnosc = $now WHERE id = $id");
}

$player_id = $_SESSION['id'];
$stmt = $conn->prepare("SELECT login, avatar FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$stmt->bind_result($login, $avatar);
$stmt->fetch();
$stmt->close();
$avatarPath = "avatars/avatar" . ($avatar ?? 1) . ".gif";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gladiatus - Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eee; margin: 0; padding: 20px; }
        .container { background: #fff; padding: 20px; border-radius: 10px; max-width: 600px; margin: auto; }
        h2 { margin-top: 0; }
        ul { list-style-type: none; padding-left: 0; }
        li { margin-bottom: 10px; }
        a { text-decoration: none; color: #0077cc; }
        a:hover { text-decoration: underline; }
        .avatar { float: right; }
    </style>
</head>
<body>
<div class="container">
    <img class="avatar" src="<?= $avatarPath ?>" alt="Avatar" width="80" height="80">
    <h2>Welcome, <?= htmlspecialchars($login) ?>!</h2>
    <p>You are logged in to <strong>Gladiatus</strong>.</p>
	<?php if (!empty($_SESSION['daily_reward_msg'])): ?>
    <div id="daily-popup" style="position:fixed;top:20%;left:50%;transform:translateX(-50%);
         background:#fff;border:3px solid #33cc33;padding:20px;border-radius:10px;z-index:9999;
         box-shadow:0 0 20px rgba(0,0,0,0.5);text-align:center;max-width:400px;">
        <h3 style="margin-top:0;">🎁 Daily Reward</h3>
        <p style="white-space:pre-line;"><?= nl2br(htmlspecialchars($_SESSION['daily_reward_msg'])) ?></p>
        <button onclick="document.getElementById('daily-popup').style.display='none'" style="margin-top:10px;">OK</button>
    </div>
    <?php unset($_SESSION['daily_reward_msg']); ?>
<?php endif; ?>

    <h3>Main Menu</h3>
    <ul>
        <li><a href='character_profile.php'>🧍 Character Profile</a></li>
		<li><a href='online_players.php'>🌐 Online Players</a></li>
		<li><a href='dungeon.php'>🏰  Dungeons</a></li>
		<li><a href="battle.php">⚔️ Fight a Training Dummy</a></li>
        <li><a href="pvp_arena.php">🥊  Arena</a></li>
        <li><a href="quest.php">🗺️  Quests</a></li>
        <li><a href="inventory.php">🎒 Inventory</a></li>
        <li><a href="training.php">📈 Training</a></li>
        <li><a href="shop.php">🛒 Shop</a></li>
		 <li><a href="inbox.php">📥 Inbox</a></li>
        <li><a href="account_settings.php">⚙️ Account Settings</a></li>
        <li><a href="logout.php">🚪 Logout</a></li>
    </ul>
</div>
</body>
</html>
