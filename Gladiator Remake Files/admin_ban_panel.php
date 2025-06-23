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

// Check if current player is admin
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

// Handle Ban/Unban actions
if (isset($_POST['ban_id'])) {
    $ban_id = (int)$_POST['ban_id'];
    $stmt = $conn->prepare("UPDATE gracze SET is_banned = 1 WHERE id = ?");
    $stmt->bind_param("i", $ban_id);
    if ($stmt->execute()) {
        // Log the ban action
        $log = $conn->prepare("INSERT INTO logs (player_id, action, details) VALUES (?, 'ban', ?)");
        $details = "Banned player ID $ban_id";
        $log->bind_param("is", $player_id, $details);
        $log->execute();
    }
}

if (isset($_POST['unban_id'])) {
    $unban_id = (int)$_POST['unban_id'];
    $stmt = $conn->prepare("UPDATE gracze SET is_banned = 0 WHERE id = ?");
    $stmt->bind_param("i", $unban_id);
    if ($stmt->execute()) {
        // Log the unban action
        $log = $conn->prepare("INSERT INTO logs (player_id, action, details) VALUES (?, 'unban', ?)");
        $details = "Unbanned player ID $unban_id";
        $log->bind_param("is", $player_id, $details);
        $log->execute();
    }
}

// Fetch all players
$result = $conn->query("SELECT id, login, is_banned FROM gracze ORDER BY login ASC");

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<h2>🔒 Ban / Unban Players</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Username</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['login']) ?></td>
            <td><?= $row['is_banned'] ? '❌ BANNED' : '✅ Active' ?></td>
            <td>
                <form method="post" style="display:inline;">
                    <?php if ($row['is_banned']): ?>
                        <input type="hidden" name="unban_id" value="<?= $row['id'] ?>">
                        <button type="submit">Unban</button>
                    <?php else: ?>
                        <input type="hidden" name="ban_id" value="<?= $row['id'] ?>">
                        <button type="submit">Ban</button>
                    <?php endif; ?>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<br>
<a href="admin_panel.php">← Back to Admin Panel</a>
