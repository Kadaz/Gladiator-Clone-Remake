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
$rewards = ['🍀', '💰', '💎']; // τυχερά emoji
$all_slots = ['💩','🍀','🪙','💀','💰','🥔','💎','🪨','🍋','🐍']; // όλος ο τροχός

// 🧮 Έλεγχος attempts για σήμερα
$check = $conn->prepare("
    SELECT COUNT(*) AS count 
    FROM minigame_log 
    WHERE player_id = ? AND game_name = 'spin' AND DATE(played_at) = CURDATE()
");
$check->bind_param("i", $player_id);
$check->execute();
$count = $check->get_result()->fetch_assoc()['count'];
$check->close();

$remaining = 3 - $count;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $remaining > 0) {
    $result = $all_slots[array_rand($all_slots)];

    if (in_array($result, $rewards)) {
        $conn->query("UPDATE gracze SET coins = coins + 10, premium_coins = premium_coins + 1 WHERE id = $player_id");
        $message = "<p style='color:green;'>🎯 You landed on <strong>$result</strong> and won <strong>10 coins + 1 premium coin!</strong></p>";
    } else {
        $message = "<p style='color:red;'>😢 You landed on <strong>$result</strong>. Better luck next time!</p>";
    }

    // ➕ Καταγραφή με νίκη ή όχι
    $won = in_array($result, $rewards) ? 1 : 0;
    $stmt = $conn->prepare("INSERT INTO minigame_log (player_id, game_name, won) VALUES (?, 'spin', ?)");
    $stmt->bind_param("ii", $player_id, $won);
    $stmt->execute();
    $stmt->close();

    $remaining--;
} elseif ($remaining <= 0) {
    $message = "<p style='color:orange;'>⛔ You've reached the daily limit (3 spins).</p>";
}
?>

<h2>🎡 Spin the Wheel</h2>
<p>Spin the wheel and win <strong>10 coins + 1 premium coin</strong> if you land on a lucky symbol (🍀 💰 💎).</p>
<p>🎯 Attempts left today: <strong><?= $remaining ?></strong></p>

<?= $message ?>

<?php if ($remaining > 0): ?>
    <form method="post">
        <button type="submit">🎰 Spin</button>
    </form>
<?php endif; ?>

<br><a href="minigames.php">← Back to Mini-Games</a>
