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
$now = date('Y-m-d H:i:s');

/* 1. Check if Player Statistics you are already logged in */
$stat_sql = "
    SELECT 
        COUNT(*) AS total_entries,
        SUM(CASE WHEN tp.bracket_position = 1 THEN 1 END) AS wins
    FROM tournament_players tp
    WHERE tp.player_id = ?";
$stat = $conn->prepare($stat_sql);
if (!$stat) {
    die("Stat query failed: " . $conn->error);
}
$stat->bind_param("i", $player_id);
$stat->execute();
$stats = $stat->get_result()->fetch_assoc();
$entries = $stats['total_entries'] ?? 0;
$wins    = $stats['wins'] ?? 0;
$rate    = $entries ? round($wins / $entries * 100, 1) : 0;

/* 2. Active tournaments */
$active_sql = "
    SELECT t.id, t.name, t.end_time,
           tp.wins AS pvp_wins,
           tp.eliminated
    FROM tournaments t
    JOIN tournament_players tp ON tp.tournament_id = t.id
    WHERE tp.player_id = ?
      AND t.end_time >= ?";
$active = $conn->prepare($active_sql);
if (!$active) {
    die("Active query failed: " . $conn->error);
}
$active->bind_param("is", $player_id, $now);
$active->execute();
$active_res = $active->get_result();

/* 3. Completed tournaments */
$finished_sql = "
    SELECT t.id, t.name, t.end_time,
           tp.bracket_position,
           tp.eliminated
    FROM tournaments t
    JOIN tournament_players tp ON tp.tournament_id = t.id
    WHERE tp.player_id = ?
      AND t.end_time < ?
    ORDER BY t.end_time DESC";
$finished = $conn->prepare($finished_sql);
if (!$finished) {
    die("Finished query failed: " . $conn->error);
}
$finished->bind_param("is", $player_id, $now);
$finished->execute();
$finished_res = $finished->get_result();
?>

<!-- =======================  HTML OUTPUT  =========================== -->
<h2>🏆 My Tournament Record</h2>

<h3>📊 Overall Stats</h3>
<ul>
  <li>Total participations: <strong><?= $entries ?></strong></li>
  <li>Tournament wins (1st place): <strong><?= $wins ?></strong></li>
  <li>Success rate: <strong><?= $rate ?>%</strong></li>
</ul>

<h3>⏳ Active Tournaments</h3>
<?php if ($active_res->num_rows === 0): ?>
  <p>— You are not currently participating in any active tournament —</p>
<?php else: ?>
  <?php while ($row = $active_res->fetch_assoc()): ?>
    <div class="tour-card">
      <strong><?= htmlspecialchars($row['name']) ?></strong><br>
      Ends: <?= $row['end_time'] ?><br>
      Wins: <span style="color:green;"><?= $row['pvp_wins'] ?>W</span><br>
      Status: <?= $row['eliminated'] ? '<span style="color:red;">Eliminated</span>' : '<span style="color:green;">Active</span>' ?>
    </div>
  <?php endwhile; ?>
<?php endif; ?>

<h3>✅ Finished Tournaments</h3>
<?php if ($finished_res->num_rows === 0): ?>
  <p>— None yet —</p>
<?php else: ?>
  <table border="1" cellspacing="0" cellpadding="4">
    <tr><th>Name</th><th>Ended</th><th>Final Position</th><th>Status</th></tr>
    <?php while ($row = $finished_res->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= $row['end_time'] ?></td>
        <td><?= $row['bracket_position'] ?? '-' ?></td>
        <td><?= $row['eliminated'] ? '❌ Eliminated' : '🏆 Finished' ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
<?php endif; ?>

<br><a href="tournament_list.php">← Back to Tournaments</a>
<br><a href="index.php">← Dashboard</a>

<style>
.tour-card{
  border:1px solid #ccc;padding:8px;margin:6px 0;border-radius:6px;
  background:#f9f9f9;max-width:320px;
}
</style>
