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

echo "<h2>Trade History</h2>";

$stmt = $conn->prepare("
    SELECT t.*, 
           s.login AS sender_name, 
           r.login AS receiver_name 
    FROM trades t
    JOIN gracze s ON t.sender_id = s.id
    JOIN gracze r ON t.receiver_id = r.id
    WHERE t.sender_id = ? OR t.receiver_id = ?
    ORDER BY t.created_at DESC
");
$stmt->bind_param("ii", $userId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No trades yet.";
    exit;
}

echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>You Are</th>
            <th>With</th>
            <th>Gold</th>
            <th>Item Given</th>
            <th>Item Requested</th>
            <th>Status</th>
            <th>Created</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    $role = $row['sender_id'] == $userId ? "Sender" : "Receiver";
    $with = $row['sender_id'] == $userId ? $row['receiver_name'] : $row['sender_name'];
	// Cancel:
    $cancelButton = '';
    if ($row['sender_id'] == $userId && $row['status'] === 'pending') {
        $cancelButton = "<form action='cancel_trade.php' method='post' style='display:inline;'>
                            <input type='hidden' name='trade_id' value='{$row['id']}'>
                            <input type='submit' value='Cancel'>
                         </form>";
    }

    echo "<tr>
            <td>{$row['id']}</td>
            <td>$role</td>
            <td>$with</td>
            <td>{$row['gold']}</td>
            <td>" . ($row['item_id'] ?? '-') . "</td>
            <td>" . ($row['item_request'] ?? '-') . "</td>
            <td>{$row['status']}</td>
            <td>{$row['created_at']}<br>$cancelButton</td>
         </tr>";
}
echo "</table>";
echo "<br><a href='online_players.php'>← Back to Online Players</a>";
echo "<br><a href='trade_inbox.php'>← Trade Inbox</a>";