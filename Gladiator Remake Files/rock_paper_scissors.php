<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) { header("Location: index.php"); exit; }
$player_id = $_SESSION['id'];
$game_key  = 'rps';
$today     = date('Y-m-d');

// ---------- helper : πόσες φορές έπαιξε σήμερα;
$limit = 3;
$check = $conn->prepare("
    SELECT plays_today FROM mini_game_plays
    WHERE player_id = ? AND game_key = ? AND play_date = ?");
$check->bind_param('iss', $player_id,$game_key,$today);
$check->execute();
$plays = $check->get_result()->fetch_assoc()['plays_today'] ?? 0;
$check->close();

$resultMsg = '';
$user_choice = '';
$cpu_choice  = '';
$win = false;

// ---------- όταν κάνει επιλογή
if ($_SERVER['REQUEST_METHOD']==='POST' && $plays < $limit) {
    $choices = ['rock','paper','scissors'];
    $user_choice = $_POST['move'];
    $cpu_choice  = $choices[array_rand($choices)];

    // κανόνες νίκης
    $winsOver = ['rock'=>'scissors','paper'=>'rock','scissors'=>'paper'];
    if ($user_choice === $cpu_choice){
        $resultMsg = "🤝 It's a draw!";
    } elseif ($winsOver[$user_choice] === $cpu_choice) {
        $win = true;
        $resultMsg = "🏆 You win! +10 coins +1 premium coin";
        $conn->query("UPDATE gracze SET coins = coins+10, premium_coins=premium_coins+1 WHERE id=$player_id");
    } else {
        $resultMsg = "💀 You lose!";
    }
	
	// ➕ Καταγραφή στο minigame_log
    $won = $win ? 1 : 0;
    $stmt = $conn->prepare("INSERT INTO minigame_log (player_id, game_name, won) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $player_id, $game_key, $won);
    $stmt->execute();
    $stmt->close();

    // ενημέρωσε counter
    if ($plays == 0){
        $ins = $conn->prepare("INSERT INTO mini_game_plays (player_id,game_key,play_date,plays_today) VALUES (?,?,?,1)");
        $ins->bind_param('iss',$player_id,$game_key,$today);
        $ins->execute();
    } else {
        $conn->query("UPDATE mini_game_plays SET plays_today = plays_today+1 
                      WHERE player_id=$player_id AND game_key='$game_key' AND play_date='$today'");
    }
    $plays++;
}
?>
<h2>✊✋✌️ Rock‑Paper‑Scissors</h2>
<p>Plays today: <?= $plays ?> / <?= $limit ?></p>

<?php if ($plays >= $limit): ?>
    <p style="color:red;">⛔ Daily limit reached. Come back tomorrow!</p>
<?php else: ?>
    <form method="post" id="rpsForm">
        <button type="submit" name="move" value="rock"     class="rps">🪨 Rock</button>
        <button type="submit" name="move" value="paper"    class="rps">📄 Paper</button>
        <button type="submit" name="move" value="scissors" class="rps">✂️ Scissors</button>
    </form>
<?php endif; ?>

<?php if ($resultMsg): ?>
    <div id="result" class="fade">
        <p><strong>You:</strong> <?= $user_choice ?> &nbsp; | &nbsp;
           <strong>CPU:</strong> <?= $cpu_choice ?></p>
        <h3><?= $resultMsg ?></h3>
    </div>
<?php endif; ?>

<br><a href="minigames.php">← Back to Mini‑Games</a>

<style>
.rps{margin:4px 6px;padding:8px 12px;font-size:18px}
.fade{animation:fadeIn .6s}@keyframes fadeIn{from{opacity:0}to{opacity:1}}
</style>
