<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    echo "<p>You must be logged in.</p>";
    exit;
}

$player_id = $_SESSION['id'];

// Fetch unlocked achievements with titles
$stmt = $conn->prepare("SELECT a.title_reward FROM player_achievements pa JOIN achievements a ON pa.achievement_id = a.id WHERE pa.player_id = ? AND a.title_reward IS NOT NULL AND a.title_reward != ''");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$res = $stmt->get_result();

$unlocked_titles = [];
while ($row = $res->fetch_assoc()) {
    $unlocked_titles[] = $row['title_reward'];
}

// Get current title
$stmt = $conn->prepare("SELECT title FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$stmt->bind_result($current_title);
$stmt->fetch();
$stmt->close();

// Handle title change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_title'])) {
    $new_title = $_POST['selected_title'];
    if ($new_title === '' || in_array($new_title, $unlocked_titles)) {
        $stmt = $conn->prepare("UPDATE gracze SET title = ? WHERE id = ?");
        $stmt->bind_param("si", $new_title, $player_id);
        $stmt->execute();
        echo "<p style='color:green;'>✅ Title updated!</p>";
        $current_title = $new_title;
    } else {
        echo "<p style='color:red;'>❌ Invalid title selected.</p>";
    }
}
?>

<h2>🎖️ Select Your Title</h2>

<p><strong>Current Title:</strong> <?= $current_title ? htmlspecialchars($current_title) : '<em>None</em>' ?></p>

<?php if (count($unlocked_titles) > 0): ?>
    <form method="post">
        <select name="selected_title">
            <option value="">-- No Title --</option>
            <?php foreach ($unlocked_titles as $title): ?>
                <option value="<?= htmlspecialchars($title) ?>" <?= $title === $current_title ? 'selected' : '' ?>><?= htmlspecialchars($title) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Set Title</button>
    </form>
<?php else: ?>
    <p>You haven't unlocked any titles yet.</p>
<?php endif; ?>

<br><a href="index.php">&larr; Back to Dashboard</a>
