<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    echo "<p>Access denied.</p>";
    exit;
}

$player_id = $_SESSION['id'];

// Check if admin
$stmt = $conn->prepare("SELECT is_admin FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();

if (!$row || !$row['is_admin']) {
    echo "<p>Access denied.</p>";
    exit;
}

// Fetch last 100 logs
$result = $conn->query("SELECT * FROM logs ORDER BY created_at DESC LIMIT 100");
?>

<h2>📝 System Logs</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Player ID</th>
        <th>Action</th>
        <th>Details</th>
        <th>Time</th>
    </tr>
    <?php while ($log = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $log['id'] ?></td>
        <td><?= $log['player_id'] ?></td>
        <td><?= htmlspecialchars($log['action']) ?></td>
        <td><?= nl2br(htmlspecialchars($log['details'])) ?></td>
        <td><?= $log['created_at'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<br><a href="admin_panel.php">← Back to Admin Panel</a>
