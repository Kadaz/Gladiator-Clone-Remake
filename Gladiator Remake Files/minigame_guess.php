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
$game_key  = 'guess';
$today     = date('Y-m-d');
$limit     = 3;
$message   = "";

// 🧮 Έλεγχος πόσες φορές έπαιξε σήμερα
$check = $conn->prepare("
    SELECT plays_today FROM mini_game_plays
    WHERE player_id = ? AND game_key = ? AND play_date = ?");
$check->bind_param("iss", $player_id, $game_key, $today);
$check->execute();
$plays_today = $check->get_result()->fetch_assoc()['plays_today'] ?? 0;
$check->close();

// 🎮 Αν πάτησε επιλογή
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $plays_today < $limit && isset($_POST['guess'])) {
    $guess  = (int)$_POST['guess'];
    $secret = rand(1, 10);

    if ($guess === $secret) {
        $conn->query("UPDATE gracze SET coins = coins + 10, premium_coins = premium_coins + 1 WHERE id = $player_id");
        $message = "<p style='color:green;'>🎉 Correct! You guessed $guess and the number was $secret.<br>You won 10 coins and 1 premium coin!</p>";
    } else {
        $message = "<p style='color:red;'>❌ Wrong! You guessed $guess but the number was $secret. Try again!</p>";
    }
	
	// ➕ Καταγραφή στο minigame_log
    $won = ($guess === $secret) ? 1 : 0;
    $stmt = $conn->prepare("INSERT INTO minigame_log (player_id, game_name, won) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $player_id, $game_key, $won);
    $stmt->execute();
    $stmt->close();

    // ➕ Ενημέρωσε counter
    if ($plays_today == 0) {
        $stmt = $conn->prepare("INSERT INTO mini_game_plays (player_id, game_key, play_date, plays_today) VALUES (?, ?, ?, 1)");
        $stmt->bind_param("iss", $player_id, $game_key, $today);
        $stmt->execute();
        $stmt->close();
    } else {
        $conn->query("UPDATE mini_game_plays SET plays_today = plays_today + 1 
                      WHERE player_id = $player_id AND game_key = '$game_key' AND play_date = '$today'");
    }

    $plays_today++;
}

?>

<h2>🎲 Guess the Number</h2>
<p>Pick a number between <strong>1</strong> and <strong>10</strong>.</p>
<p>You can play up to <strong>3 times per day</strong>. Each correct guess gives <strong>10 coins</strong> and <strong>1 premium coin</strong>.</p>
<p><strong>Attempts today:</strong> <?= $plays_today ?> / <?= $limit ?></p>

<?= $message ?>

<?php if ($plays_today < $limit): ?>
<form method="post">
    <select name="guess" required>
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <option value="<?= $i ?>"><?= $i ?></option>
        <?php endfor; ?>
    </select>
    <button type="submit">🎰 Guess</button>
</form>
<?php else: ?>
    <p style="color:orange;">⏳ Daily limit reached. Come back tomorrow!</p>
<?php endif; ?>

<br><a href="minigames.php">← Back to Mini‑Games</a>
