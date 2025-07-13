<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');

# ───────────────────────────────────────────────────────────
# 0.  admin check  +  id param
# ───────────────────────────────────────────────────────────
if (!isset($_SESSION['id']))               die("⛔ Not logged‑in.");
$admin_id = (int)$_SESSION['id'];
$adm = $conn->query("SELECT is_admin FROM gracze WHERE id=$admin_id")->fetch_assoc();
if (!$adm || !$adm['is_admin'])            die("⛔ Access denied.");

if (!isset($_GET['id']))                   die("❌ Missing tournament id.");
$tour_id = (int)$_GET['id'];

# ───────────────────────────────────────────────────────────
# 1.  already finalised?
# ───────────────────────────────────────────────────────────
$chk = $conn->query("SELECT status FROM tournaments WHERE id=$tour_id")->fetch_assoc();
if (!$chk)                                 die("❌ Tournament not found.");
if ($chk['status']==='completed') {
    echo "⚠️  Tournament already completed."; exit;
}

# ───────────────────────────────────────────────────────────
# 2.  pull standings (active players)
# ───────────────────────────────────────────────────────────
$sql = "
SELECT player_id, wins, losses
FROM   tournament_players
WHERE  tournament_id = $tour_id
  AND  eliminated = 0
ORDER  BY wins DESC,   losses ASC
LIMIT  3";
$res = $conn->query($sql);

$prizes = [ 1 => [1000,100],   # place => [gold,xp]
            2 => [ 500, 50],
            3 => [ 250, 25] ];

$rank = 0;
while ($row = $res->fetch_assoc()) {
    $rank++;
    $pid   = $row['player_id'];
    [$g,$x]= $prizes[$rank];

    # 2a.  reward table
    $conn->query("
        INSERT INTO tournament_rewards
              (tournament_id, player_id, position, reward_gold, reward_xp)
        VALUES ($tour_id,$pid,$rank,$g,$x)
    ");

    # 2b.  credit player
    $conn->query("
        UPDATE gracze
        SET zloto = zloto + $g,
            exp   = exp   + $x
        WHERE id = $pid
    ");
}

# ───────────────────────────────────────────────────────────
# 3.  mark tournament completed
# ───────────────────────────────────────────────────────────
$conn->query("UPDATE tournaments SET status='completed' WHERE id=$tour_id");

echo "✅ Tournament finalised & rewards delivered.";
echo "<br><a href='tournament_bracket.php?id=$tour_id'>View bracket</a>";
echo " | <a href='player_tournaments.php'>Back</a>";
?>