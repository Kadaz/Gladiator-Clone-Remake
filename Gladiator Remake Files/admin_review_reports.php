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

// Handle review action
if (isset($_POST['mark_reviewed'])) {
    $report_id = (int)$_POST['report_id'];
    $stmt = $conn->prepare("UPDATE player_reports SET status = 'reviewed' WHERE id = ?");
    $stmt->bind_param("i", $report_id);
    $stmt->execute();
    echo "<p style='color:green;'>✅ Report marked as reviewed.</p>";
}

$result = $conn->query("SELECT r.*, 
                                gr.login AS reporter_name, 
                                gp.login AS reported_name 
                         FROM player_reports r
                         JOIN gracze gr ON r.reporter_id = gr.id
                         JOIN gracze gp ON r.reported_id = gp.id
                         ORDER BY r.created_at DESC");
?>

<h2>🛡️ Admin Report Panel</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Reporter</th>
        <th>Reported</th>
        <th>Reason</th>
        <th>Status</th>
        <th>Submitted</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['reporter_name']) ?> (ID: <?= $row['reporter_id'] ?>)</td>
            <td><?= htmlspecialchars($row['reported_name']) ?> (ID: <?= $row['reported_id'] ?>)</td>
            <td><?= nl2br(htmlspecialchars($row['reason'])) ?></td>
            <td><?= $row['status'] === 'reviewed' ? '✅ Reviewed' : '⏳ Pending' ?></td>
            <td><?= $row['created_at'] ?></td>
            <td>
                <?php if ($row['status'] === 'pending'): ?>
                    <form method="post">
                        <input type="hidden" name="report_id" value="<?= $row['id'] ?>">
                        <button name="mark_reviewed">Mark Reviewed</button>
                    </form>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<br>
<a href="admin_panel.php">← Back to Admin Panel</a>
