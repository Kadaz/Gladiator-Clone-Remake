<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

// Check login
if (!isset($_SESSION['id'])) {
    echo "<p>You are not logged in.</p>";
    exit;
}

$player_id = $_SESSION['id'];

// Check if admin
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

$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_id = (int)$_POST['target_id'];
    $gold = (int)$_POST['gold'];
    $level = (int)$_POST['nivel'];
    $exp = (int)$_POST['exp'];

    $stmt = $conn->prepare("UPDATE gracze SET zloto = ?, nivel = ?, exp = ? WHERE id = ?");
    $stmt->bind_param("iiii", $gold, $level, $exp, $target_id);
    if ($stmt->execute()) {
        $message = "<p style='color:green;'>✅ Player stats updated successfully.</p>";

        // Log the change
        $details = "Changed stats of player ID $target_id to Gold: $gold, Level: $level, Exp: $exp";
        $log = $conn->prepare("INSERT INTO logs (player_id, action, details) VALUES (?, 'edit_stats', ?)");
        $log->bind_param("is", $player_id, $details);
        $log->execute();
    } else {
        $message = "<p style='color:red;'>❌ Failed to update stats.</p>";
    }
}

// Fetch all players
$players = $conn->query("SELECT id, login FROM gracze ORDER BY login ASC");
?>

<h2>🛠️ Edit Player Stats</h2>

<?= $message ?>

<form method="post">
    <label>Select Player:</label><br>
    <select name="target_id" required>
        <option value="">-- Choose Player --</option>
        <?php while ($row = $players->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['login']) ?> (ID: <?= $row['id'] ?>)</option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Gold:</label><br>
    <input type="number" name="gold" min="0" required><br><br>

    <label>Level:</label><br>
    <input type="number" name="nivel" min="1" required><br><br>

    <label>Experience:</label><br>
    <input type="number" name="exp" min="0" required><br><br>

    <button type="submit">💾 Save Changes</button>
</form>

<br><a href="admin_panel.php">← Back to Admin Panel</a>
