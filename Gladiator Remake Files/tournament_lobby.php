<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id']) || !isset($_GET['id'])) die('⛔ Invalid access.');

$player_id     = $_SESSION['id'];
$tournament_id = (int)$_GET['id'];

/* ─────────────────────────────────────────────────────────
   1.  Έλεγχος συμμετοχής παίκτη στο τουρνουά
   ───────────────────────────────────────────────────────── */
$chk = $conn->prepare("SELECT * FROM tournament_players
                       WHERE tournament_id = ? AND player_id = ?");
$chk->bind_param("ii", $tournament_id, $player_id);
$chk->execute();
$participant = $chk->get_result()->fetch_assoc();
$chk->close();
if (!$participant) die('<p style="color:red;">⛔ You are not part of this tournament.</p>');

/* ─────────────────────────────────────────────────────────
   2.  Info τουρνουά
   ───────────────────────────────────────────────────────── */
$tour = $conn->query("SELECT name,start_time,end_time
                      FROM tournaments WHERE id=$tournament_id")->fetch_assoc();
if (!$tour) die('❌ Tournament not found.');

echo "<h2>🏆 Tournament Lobby: " . htmlspecialchars($tour['name']) . "</h2>";
echo "<p><strong>⏳ Start:</strong> {$tour['start_time']} | <strong>🏁 Ends:</strong> {$tour['end_time']}</p>";

/* ─────────────────────────────────────────────────────────
   3.  Ημερήσιο όριο μαχών
   ───────────────────────────────────────────────────────── */
$cfg   = $conn->query("SELECT cfg_value FROM config
                       WHERE cfg_key='tournament_daily_limit'")->fetch_assoc();
$limit = (int)($cfg['cfg_value'] ?? 5);               // fallback 5

$today_start = date('Y-m-d 00:00:00');
$today_end   = date('Y-m-d 23:59:59');

$cnt = $conn->prepare("SELECT COUNT(*) AS n
                       FROM tournament_matches
                       WHERE tournament_id = ?
                         AND match_time BETWEEN ? AND ?
                         AND (player1_id = ? OR player2_id = ?)");
$cnt->bind_param("issii",
                 $tournament_id, $today_start, $today_end,
                 $player_id, $player_id);
$cnt->execute();
$daily_fights = $cnt->get_result()->fetch_assoc()['n'] ?? 0;
$cnt->close();

/* ─────────────────────────────────────────────────────────
   4.  Συμμετέχοντες
   ───────────────────────────────────────────────────────── */
$res = $conn->query("
   SELECT g.login, tp.wins, tp.eliminated
   FROM tournament_players tp
   JOIN gracze g ON g.id = tp.player_id
   WHERE tp.tournament_id = $tournament_id
   ORDER BY tp.wins DESC
");

echo "<h3>👥 Participants</h3>";
echo "<table border='1' cellpadding='5'><tr>
        <th>Player</th><th>Wins</th><th>Status</th></tr>";
while ($row = $res->fetch_assoc()) {
    echo "<tr><td>".htmlspecialchars($row['login'])."</td>
              <td>{$row['wins']}</td>
              <td>".($row['eliminated']?'❌ Eliminated':'✅ Active')."</td></tr>";
}
echo "</table>";

/* ─────────────────────────────────────────────────────────
   5.  Τρέχων αγώνας παίκτη
   ───────────────────────────────────────────────────────── */
echo "<h3>⚔️ Your Current Match</h3>";

$match = $conn->query("
   SELECT tm.id, g1.login AS p1, g2.login AS p2
   FROM tournament_matches tm
   JOIN gracze g1 ON g1.id = tm.player1_id
   JOIN gracze g2 ON g2.id = tm.player2_id
   WHERE tm.tournament_id = $tournament_id
     AND tm.winner_id IS NULL
     AND (tm.player1_id = $player_id OR tm.player2_id = $player_id)
   LIMIT 1
")->fetch_assoc();

if ($match) {
    if ($daily_fights >= $limit) {
        echo "<p style='color:red;'>⛔ Daily limit ({$limit}) reached ⇒ come back tomorrow.</p>";
    } else {
        echo "<p><strong>Match:</strong> {$match['p1']} vs {$match['p2']}</p>";
        echo "<form method='post' action='tournament_fight.php'>
                <input type='hidden' name='match_id' value='{$match['id']}'>
                <button type='submit'>⚔️ Enter Fight</button>
              </form>";
        echo "<p><em>Today’s fights: {$daily_fights}/{$limit}</em></p>";
    }
} else {
    echo "<p>— You have no ongoing match at the moment —</p>";
}

/* ─────────────────────────────────────────────────────────
   6.  Completed matches (history)
   ───────────────────────────────────────────────────────── */
echo "<h3>📜 Completed Matches</h3>";
$past = $conn->query("
   SELECT g1.login p1, g2.login p2, g3.login winner, tm.match_time
   FROM tournament_matches tm
   JOIN gracze g1 ON g1.id = tm.player1_id
   JOIN gracze g2 ON g2.id = tm.player2_id
   JOIN gracze g3 ON g3.id = tm.winner_id
   WHERE tm.tournament_id = $tournament_id
   ORDER BY tm.match_time DESC
");
if ($past->num_rows == 0) {
    echo "<p>No matches completed yet.</p>";
} else {
    echo "<ul>";
    while ($row = $past->fetch_assoc()) {
        echo "<li>{$row['p1']} vs {$row['p2']} → 🏆 <strong>{$row['winner']}</strong> ({$row['match_time']})</li>";
    }
    echo "</ul>";
}
?>
<a href="tournament_bracket.php?id=<?= $tournament_id ?>"><button>🧩 View Bracket</button></a>
<br><a href="player_tournaments.php">← My Tournaments</a> | <a href="index.php">🏠 Dashboard</a>
