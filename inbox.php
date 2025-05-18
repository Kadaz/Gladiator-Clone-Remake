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

$stmt = $conn->prepare("SELECT * FROM mensajes WHERE id_user_r = ? ORDER BY fecha DESC");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>📬 Inbox</title>
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
        .delete-btn {
            color: red;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }
        .back {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">📬 Your Messages</h2>
    <a href="send_message.php">✉️ Send New Message</a>
	<div style="text-align:center; margin-bottom: 10px;">
    <a href="sent_messages.php">📤 View Sent Messages</a>
</div>
    <?php if ($result->num_rows > 0): ?>
        <form method="POST" action="delete_message.php">
        <table>
            <tr>
                <th>From</th>
                <th>Message</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['login_user_s']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['mensaje'])) ?></td>
                    <td><?= htmlspecialchars($row['fecha']) ?></td>
                    <td>
                        <button class="delete-btn" type="submit" name="delete_id" value="<?= $row['id_msj'] ?>" onclick="return confirm('Delete this message?');">❌ Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        </form>
    <?php else: ?>
        <p style="text-align:center;">You have no messages.</p>
    <?php endif; ?>

    <div class="back">
        <a href="index.php">← Back to Dashboard</a>
    </div>
</body>
</html>
