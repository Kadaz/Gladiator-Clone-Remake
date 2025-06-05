<?php
session_start();
require_once("db.php");
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    die("You must be logged in.");
}

$userId = $_SESSION['id'];
$recipient = $_POST['recipient'] ?? '';
$recipientItems = [];
$playerItems = [];

// Πάρε τα δικά σου αντικείμενα
$stmt = $conn->prepare("SELECT pi.id, i.name FROM player_items pi JOIN items i ON pi.item_id = i.id WHERE pi.player_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$playerItems = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Αν έχει σταλεί το username παραλήπτη, πάρε τα αντικείμενά του
if (!empty($recipient)) {
    $stmt = $conn->prepare("SELECT id FROM gracze WHERE login = ?");
    $stmt->bind_param("s", $recipient);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $receiver_id = $res->fetch_assoc()['id'];

        $stmt = $conn->prepare("SELECT pi.id, i.name FROM player_items pi JOIN items i ON pi.item_id = i.id WHERE pi.player_id = ?");
        $stmt->bind_param("i", $receiver_id);
        $stmt->execute();
        $recipientItems = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "<p style='color:red;'>❌ Recipient not found.</p>";
    }
}
?>

<h1>Create a New Trade</h1>

<form action="create_trade.php" method="post">
    <label>Recipient Username:</label>
    <input type="text" name="recipient" value="<?= htmlspecialchars($recipient) ?>" required>
    <input type="submit" value="Check Items">
</form>

<?php if (!empty($recipientItems)): ?>
    <form action="send_trade.php" method="post">
        <input type="hidden" name="recipient" value="<?= htmlspecialchars($recipient) ?>">

        <label>Gold to Offer:</label>
        <input type="number" name="gold" min="0" value="0" required><br>

        <label>Select Item to Offer (optional):</label>
        <select name="item_id">
            <option value="">-- No Item --</option>
            <?php foreach ($playerItems as $item): ?>
                <option value="<?= $item['id'] ?>">ID <?= $item['id'] ?> - <?= htmlspecialchars($item['name']) ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Select Item You Want (optional):</label>
        <select name="item_request">
            <option value="">-- No Request --</option>
            <?php foreach ($recipientItems as $item): ?>
                <option value="<?= $item['id'] ?>">ID <?= $item['id'] ?> - <?= htmlspecialchars($item['name']) ?></option>
            <?php endforeach; ?>
        </select><br>

        <input type="submit" value="Send Trade Request">
    </form>
<?php endif; ?>

<br><a href='online_players.php'>← Back</a>
