<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    die("Not logged in.");
}

// Check admin
$admin_id = $_SESSION['id'];
$res = $conn->query("SELECT is_admin FROM gracze WHERE id = $admin_id")->fetch_assoc();
if (!$res || !$res['is_admin']) die("Access denied.");

// Get current active tournament
$now = date('Y-m-d H:i:s');
$tour = $conn->query("SELECT * FROM tournaments WHERE start_time <= '$now' AND end_time >= '$now' ORDER BY id DESC LIMIT 1")->fetch_assoc();
if (!$tour) {
    echo "<p style='color:red;'>❌ No active tournament found.</p>";
    exit;
}

$tournament_id = $tour['id'];

// Get all active players (not eliminated) in the tournament
$players = [];
$q = $conn->query("SELECT player_id FROM tournament_players WHERE tournament_id = $tournament_id AND eliminated = 0 ORDER BY RAND()");
while ($r = $q->fetch_assoc()) $players[] = $r['player_id'];

$total = count($players);
$created = 0;

for ($i = 0; $i < $total - 1; $i += 2) {
    $p1 = $players[$i];
    $p2 = $players[$i + 1];

    // Check if they already have a pending match
    $dupe = $conn->query("SELECT id FROM tournament_matches 
                          WHERE tournament_id = $tournament_id 
                          AND winner_id IS NULL 
                          AND ((player1_id = $p1 AND player2_id = $p2) OR (player1_id = $p2 AND player2_id = $p1))")->num_rows;

    if ($dupe == 0) {
        $stmt = $conn->prepare("INSERT INTO tournament_matches (tournament_id, player1_id, player2_id) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $tournament_id, $p1, $p2);
        $stmt->execute();
        $created++;
    }
}

echo "<h3>✅ Match generation complete</h3>";
echo "<p>🔢 Total participants: $total<br>";
echo "✅ Matches created: $created</p>";
echo "<a href='tournament_lobby.php?id=$tournament_id'>← Go to Lobby</a>";
?>
