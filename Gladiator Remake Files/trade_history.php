<?php
session_start();
require_once('db.php');
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    die("You must be logged in.");
}

$userId = $_SESSION['id'];

$stmt = $conn->prepare("SELECT t.*, 
                            s.login AS sender_name, 
                            r.login AS receiver_name,
                            io.name AS item_offered_name,
                            io.image AS item_offered_image,
                            ir.name AS item_requested_name,
                            ir.image AS item_requested_image
                        FROM trades t
                        LEFT JOIN gracze s ON t.sender_id = s.id
                        LEFT JOIN gracze r ON t.receiver_id = r.id
                        LEFT JOIN items io ON t.item_id = io.id
                        LEFT JOIN items ir ON t.item_request = ir.id
                        WHERE t.sender_id = ? OR t.receiver_id = ?
                        ORDER BY t.created_at DESC");
$stmt->bind_param("ii", $userId, $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>Trade History</h2>

<?php if ($result->num_rows > 0): ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Gold</th>
            <th>Item Offered</th>
            <th>Item Requested</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['sender_name']) ?></td>
                <td><?= htmlspecialchars($row['receiver_name']) ?></td>
                <td><?= (int)$row['gold'] ?></td>
                <td>
                    <?php if ($row['item_offered_name']): ?>
                        <img src="items/<?= htmlspecialchars($row['item_offered_image']) ?>" width="32"> 
                        <?= htmlspecialchars($row['item_offered_name']) ?>
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($row['item_requested_name']): ?>
                        <img src="items/<?= htmlspecialchars($row['item_requested_image']) ?>" width="32"> 
                        <?= htmlspecialchars($row['item_requested_name']) ?>
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </td>
                <td><?= ucfirst(htmlspecialchars($row['status'])) ?></td>
                <td><?= htmlspecialchars($row['created_at']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No trade history found.</p>
<?php endif; ?>

<?php
$stmt->close();
$conn->close();
echo "<br><a href='online_players.php'>← Back to Online Players</a>";
echo "<br><a href='trade_inbox.php'>← Trade Inbox</a>";
?>
