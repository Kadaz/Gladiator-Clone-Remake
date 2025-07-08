<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id']) || $_SESSION['is_admin'] != 1) {
    die("⛔ Access denied");
}

$player = null;
$message = "";

if (isset($_GET['login'])) {
    $login = $conn->real_escape_string($_GET['login']);

    $stmt = $conn->prepare("SELECT id, login, is_premium FROM gracze WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();
    $player = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['player_id'])) {
    $player_id = (int)$_POST['player_id'];
    $set_premium = isset($_POST['make_premium']) ? 1 : 0;

    $stmt = $conn->prepare("UPDATE gracze SET is_premium = ? WHERE id = ?");
    $stmt->bind_param("ii", $set_premium, $player_id);
    $stmt->execute();
    $stmt->close();

    $message = $set_premium ? "✅ Player is now Premium." : "⚠️ Player is no longer Premium.";
}
?>

<h2>👑 Manage Premium Status</h2>

<form method="get">
    <label>Search by login:</label>
    <input type="text" name="login" required>
    <button type="submit">Search</button>
</form>

<?php if (!empty($message)): ?>
    <p style="color: green;"><?= $message ?></p>
<?php endif; ?>

<?php if ($player): ?>
    <hr>
    <h3>Player: <?= htmlspecialchars($player['login']) ?></h3>
    <p>Current status: <strong><?= $player['is_premium'] ? '✅ Premium' : '❌ Regular' ?></strong></p>

    <form method="post">
        <input type="hidden" name="player_id" value="<?= $player['id'] ?>">
        <label>
            <input type="checkbox" name="make_premium" <?= $player['is_premium'] ? 'checked' : '' ?>>
            Mark as Premium
        </label><br><br>
        <button type="submit">Save</button>
    </form>
<?php endif; ?>
