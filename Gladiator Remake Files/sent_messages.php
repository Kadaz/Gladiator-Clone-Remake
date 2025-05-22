<?php
session_start();
require_once("var/ustawienia.php");
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$player_id = $_SESSION['id'];

$stmt = $conn->prepare("SELECT * FROM mensajes WHERE id_user_s = ? ORDER BY fecha DESC");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>📤 Sent Messages</title>
    <style>
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #aaa;
        }
        th {
            background-color: #f2f2f2;
        }
        .back {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">📤 Sent Messages</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>To</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['login_user_r']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['mensaje'])) ?></td>
                    <td><?= htmlspecialchars($row['fecha']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align:center;">You haven't sent any messages yet.</p>
    <?php endif; ?>

    <div class="back">
        <a href="inbox.php">← Back to Inbox</a> |
        <a href="index.php">🏠 Dashboard</a>
    </div>
</body>
</html>