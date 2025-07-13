<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id']) || !isset($_GET['id'])) {
    die("⛔ Invalid access.");
}

$tournament_id = (int)$_GET['id'];

// ➤ Λήψη όλων των ματς ταξινομημένα κατά round
$sql = "
    SELECT tm.*, 
           g1.login AS p1_name, 
           g2.login AS p2_name, 
           g3.login AS winner_name
    FROM tournament_matches tm
    LEFT JOIN gracze g1 ON tm.player1_id = g1.id
    LEFT JOIN gracze g2 ON tm.player2_id = g2.id
    LEFT JOIN gracze g3 ON tm.winner_id = g3.id
    WHERE tm.tournament_id = ?
    ORDER BY tm.round ASC, tm.match_time ASC
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tournament_id);
$stmt->execute();
$result = $stmt->get_result();

$matches_by_round = [];
while ($row = $result->fetch_assoc()) {
    $round = $row['round'] ?? 1;
    $matches_by_round[$round][] = $row;
}
$stmt->close();
?>

<h2>📊 Tournament Bracket</h2>
<?php foreach ($matches_by_round as $round => $matches): ?>
    <h3>🔁 Round <?= $round ?></h3>
    <table border="1" cellpadding="6" style="margin-bottom:15px;">
        <tr><th>Player 1</th><th>Player 2</th><th>Winner</th><th>Time</th></tr>
        <?php foreach ($matches as $match): ?>
            <tr>
                <td><?= htmlspecialchars($match['p1_name'] ?? '---') ?></td>
                <td><?= htmlspecialchars($match['p2_name'] ?? '---') ?></td>
                <td>
                    <?= $match['winner_name'] 
                        ? "🏆 " . htmlspecialchars($match['winner_name']) 
                        : "<em>Pending</em>" ?>
                </td>
                <td><?= $match['match_time'] ?? '-' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endforeach; ?>

<br>
<a href="tournament_lobby.php?id=<?= $tournament_id ?>">← Back to Lobby</a> | 
<a href="player_tournaments.php">← My Tournaments</a>

<style>
table {
    border-collapse: collapse;
    min-width: 480px;
}
th, td {
    padding: 8px;
    text-align: center;
}
</style>
