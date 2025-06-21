<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    die("Access denied (not logged in).");
}

$player_id = $_SESSION['id'];

// Check If You Are An admin
$stmt = $conn->prepare("SELECT is_admin FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$stmt->bind_result($is_admin);
$stmt->fetch();
$stmt->close();

if (!$is_admin) {
    die("Access denied.");
}

$message = '';

// Fetch all players
$players_result = $conn->query("SELECT id, login, title FROM gracze ORDER BY login ASC");

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['player_id'])) {
    $player_id = (int)$_POST['player_id'];
    $new_title = trim($_POST['title']);

    if (strlen($new_title) > 50) {
        $message = "<p style='color:red;'>❌ Title too long (max 50 characters).</p>";
    } else {
        $stmt = $conn->prepare("UPDATE gracze SET title = ? WHERE id = ?");
        $stmt->bind_param("si", $new_title, $player_id);
        if ($stmt->execute()) {
            $message = "<p style='color:green;'>✅ Title updated!</p>";
        } else {
            $message = "<p style='color:red;'>❌ Failed to update title.</p>";
        }
    }
}

// Predefined Titles
$predefined_titles = [
    "Warrior",
    "Champion",
    "Gladiator",
    "Hero",
    "Legend",
    "The Brave",
    "The Merciless",
    "Arena King",
    "Bloodletter",
];
?>

<h2>🎖 Admin: Set Player Title</h2>

<?= $message ?>

<form method="post">
    <label>Select Player:</label><br>
    <select name="player_id" required>
        <option value="">-- Choose --</option>
        <?php while ($row = $players_result->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>">
                <?= htmlspecialchars($row['login']) ?> <?php if ($row['title']) echo "(" . htmlspecialchars($row['title']) . ")"; ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Choose Predefined Title:</label><br>
    <select onchange="document.getElementById('title').value = this.value">
        <option value="">-- None --</option>
        <?php foreach ($predefined_titles as $t): ?>
            <option value="<?= htmlspecialchars($t) ?>"><?= htmlspecialchars($t) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Or Enter Custom Title:</label><br>
    <input type="text" name="title" id="title" maxlength="50" style="width:300px;"><br><br>

    <button type="submit">💾 Set Title</button>
</form>

<br><a href="index.php">← Back to Dashboard</a>
