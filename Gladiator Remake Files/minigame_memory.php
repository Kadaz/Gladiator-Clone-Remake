<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$player_id = $_SESSION['id'];
$message = "";
$emoji_pairs = ['🍎', '🍌', '🍇']; // 3 pairs
$limit = 10;

// 📅 Πόσες φορές έχει παίξει σήμερα;
$check = $conn->prepare("
    SELECT COUNT(*) as count FROM minigame_log
    WHERE player_id = ? AND game_name = 'memory' AND DATE(played_at) = CURDATE()
");
$check->bind_param("i", $player_id);
$check->execute();
$res = $check->get_result()->fetch_assoc();
$plays_today = $res['count'] ?? 0;
$check->close();

$can_play = $plays_today < $limit;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['slot1']) && isset($_POST['slot2']) && $can_play) {
    $slot1 = (int)$_POST['slot1'];
    $slot2 = (int)$_POST['slot2'];

    // 🔀 Δημιουργία σταθερού πίνακα με βάση seed (ώστε να μη γίνεται cheating)
    srand($player_id + date('Ymd'));
    $deck = array_merge($emoji_pairs, $emoji_pairs);
    shuffle($deck);

    $emoji1 = $deck[$slot1];
    $emoji2 = $deck[$slot2];

    // ➕ Καταγραφή αποτελέσματος
    $won = ($emoji1 === $emoji2) ? 1 : 0;
    $stmt = $conn->prepare("INSERT INTO minigame_log (player_id, game_name, won) VALUES (?, 'memory', ?)");
    $stmt->bind_param("ii", $player_id, $won);
    $stmt->execute();
    $stmt->close();

    if ($won) {
        $conn->query("UPDATE gracze SET coins = coins + 10, premium_coins = premium_coins + 1 WHERE id = $player_id");
        $message = "<p style='color:green;'>🎉 You matched <strong>$emoji1</strong>!<br>You win 10 coins and 1 premium coin!</p>";
    } else {
        $message = "<p style='color:red;'>❌ No match! You flipped $emoji1 and $emoji2.</p>";
    }

    $plays_today++;
}
?>

<h2>🧠 Memory Flip</h2>
<p>Find a matching emoji pair! You can play up to <strong><?= $limit ?> times per day</strong>.</p>
<p><strong>Plays today:</strong> <?= $plays_today ?> / <?= $limit ?></p>

<?= $message ?>

<?php if ($can_play): ?>
<form method="post">
    <p>Select two cards to flip:</p>
    <select name="slot1" required>
        <?php for ($i = 0; $i < 6; $i++): ?>
            <option value="<?= $i ?>">Card <?= $i + 1 ?></option>
        <?php endfor; ?>
    </select>
    <select name="slot2" required>
        <?php for ($i = 0; $i < 6; $i++): ?>
            <option value="<?= $i ?>">Card <?= $i + 1 ?></option>
        <?php endfor; ?>
    </select>
    <button type="submit">🔍 Flip</button>
</form>
<?php else: ?>
<p style="color:orange;">⏳ You've reached your daily limit for this mini-game.</p>
<?php endif; ?>

<br><a href="minigames.php">← Back to Mini-Games</a>
