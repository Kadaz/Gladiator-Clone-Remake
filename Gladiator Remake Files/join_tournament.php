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
} else {
    $_SESSION['tourn_msg'] = "❌ Failed to join tournament: " . $insert->error;
}

header("Location: tournament_lobby.php?id=$tournament_id");
exit;
