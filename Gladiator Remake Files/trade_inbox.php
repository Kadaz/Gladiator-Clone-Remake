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

// Fetch trades where the user is the receiver
$stmt = $conn->prepare("
    SELECT t.id, t.sender_id, g.login AS sender_name, t.gold, t.item_id, t.item_request, t.status, t.created_at
    FROM trades t
    JOIN gracze g ON t.sender_id = g.id
    WHERE t.receiver_id = ? AND t.status = 'pending'
    ORDER BY t.created_at DESC
");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>Trade Inbox</h2>

<?php if ($result->num_rows > 0): ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>From</th>
            <th>Gold</th>
            <th>Item Offered</th>
            <th>Item Wanted</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['sender_name']) ?></td>
                <td><?= (int)$row['gold'] ?></td>
                <td><?= $row['item_id'] ? (int)$row['item_id'] : '—' ?></td>
                <td><?= $row['item_request'] ? (int)$row['item_request'] : '—' ?></td>
                <td>
                    <form action="trade_action.php" method="post" style="display:inline;">
                        <input type="hidden" name="trade_id" value="<?= $row['id'] ?>">
                        <button type="submit" name="action" value="accept">Accept</button>
                        <button type="submit" name="action" value="decline">Decline</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No trade offers at the moment.</p>
<?php endif; ?>

<?php
$stmt->close();
$conn->close();
?>
<li><a href='trade_history.php'>Trade History</a></li>