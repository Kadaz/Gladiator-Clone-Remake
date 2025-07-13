<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id']) || !isset($_GET['tournament_id'])) {
    die("⛔ Invalid access.");
}

$player_id = (int)$_SESSION['id'];
$tournament_id = (int)$_GET['tournament_id'];

// Έλεγξε αν υπάρχει ήδη
$check = $conn->prepare("SELECT id FROM tournament_players WHERE player_id = ? AND tournament_id = ?");
$check->bind_param("ii", $player_id, $tournament_id);
$check->execute();
$res = $check->get_result();
if ($res->num_rows > 0) {
    header("Location: tournament_lobby.php?id=$tournament_id");
    exit;
}

// Κάνε εγγραφή
$insert = $conn->prepare("INSERT INTO tournament_players (player_id, tournament_id, wins, losses, eliminated) VALUES (?, ?, 0, 0, 0)");
$insert->bind_param("ii", $player_id, $tournament_id);
if ($insert->execute()) {
    $_SESSION['tourn_msg'] = "✅ You joined the tournament successfully!";
    
    // ✅ Auto-matchmaking immediately after joining
    $eligible = [];
    $res = $conn->query("
        SELECT tp.player_id
        FROM tournament_players tp
        LEFT JOIN (
            SELECT player1_id AS pid FROM tournament_matches WHERE tournament_id = $tournament_id AND winner_id IS NULL
            UNION
            SELECT player2_id AS pid FROM tournament_matches WHERE tournament_id = $tournament_id AND winner_id IS NULL
        ) active ON tp.player_id = active.pid
        WHERE tp.tournament_id = $tournament_id AND tp.eliminated = 0 AND active.pid IS NULL
        ORDER BY RAND()
    ");

    while ($row = $res->fetch_assoc()) {
        $eligible[] = $row['player_id'];
    }

    if (count($eligible) >= 2) {
        $p1 = $eligible[0];
        $p2 = $eligible[1];

        $conn->query("
            INSERT INTO tournament_matches (tournament_id, player1_id, player2_id, match_time)
            VALUES ($tournament_id, $p1, $p2, NOW())
        ");
    }

} else {
    $_SESSION['tourn_msg'] = "❌ Failed to join tournament: " . $insert->error;
}

header("Location: tournament_lobby.php?id=$tournament_id");
exit;
