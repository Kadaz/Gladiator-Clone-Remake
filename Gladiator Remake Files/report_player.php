<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    echo "<p>You must be logged in to report a player.</p>";
    exit;
}

$reporter_id = $_SESSION['id'];

if (!isset($_GET['id'])) {
    echo "<p>No player selected for report.</p>";
    exit;
}

$reported_id = (int)$_GET['id'];

// Prevent self-reporting
if ($reporter_id === $reported_id) {
    echo "<p>You cannot report yourself.</p>";
    exit;
}

// Fetch reported player info
$stmt = $conn->prepare("SELECT login FROM gracze WHERE id = ?");
$stmt->bind_param("i", $reported_id);
$stmt->execute();
$result = $stmt->get_result();
$reported_player = $result->fetch_assoc();

if (!$reported_player) {
    echo "<p>Player not found.</p>";
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reason = trim($_POST['reason']);

    if ($reason === '') {
        $message = "<p style='color:red;'>❌ Reason is required.</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO player_reports (reporter_id, reported_id, reason) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $reporter_id, $reported_id, $reason);
        $stmt->execute();
        $message = "<p style='color:green;'>✅ Report submitted successfully.</p>";
    }
}
?>

<h2>🚨 Report Player: <?= htmlspecialchars($reported_player['login']) ?></h2>

<?= $message ?>

<form method="post">
    <label>Reason for Report:<br>
        <textarea name="reason" rows="4" cols="50" required></textarea>
    </label><br><br>
    <button type="submit">Submit Report</button>
</form>

<br><a href="player_profile.php?id=<?= $reported_id ?>">← Back to Profile</a>
