<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');

if (!isset($_SESSION['id']) || !isset($_POST['match_id'])) {
    die("⛔ Invalid access.");
}

$player_id = (int)$_SESSION['id'];
$match_id  = (int)$_POST['match_id'];

/* -----------------------------------------------------------
   1) Load the match & verify participation / if completed
------------------------------------------------------------ */
$sql = "
SELECT tm.*,
       g1.login AS p1_name, g2.login AS p2_name
FROM   tournament_matches tm
JOIN   gracze g1 ON g1.id = tm.player1_id
JOIN   gracze g2 ON g2.id = tm.player2_id
WHERE  tm.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $match_id);
$stmt->execute();
$match = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$match)            die("❌ Match not found.");
if ($match['winner_id']) die("⚠️  Match already finished.");
if ($player_id != $match['player1_id'] && $player_id != $match['player2_id'])
    die("⛔ You are not in this match.");

$enemy_id   = ($player_id == $match['player1_id']) ? $match['player2_id'] : $match['player1_id'];
$enemy_name = ($player_id == $match['player1_id']) ? $match['p2_name']     : $match['p1_name'];

/* -----------------------------------------------------------
   2) Load stats of both players
------------------------------------------------------------ */
$p  = $conn->query("SELECT zycie, sila, obrazenia_min, obrazenia_max FROM gracze WHERE id=$player_id")->fetch_assoc();
$e  = $conn->query("SELECT zycie, sila, obrazenia_min, obrazenia_max FROM gracze WHERE id=$enemy_id")->fetch_assoc();
if (!$p || !$e) die("Player data missing.");

/* -----------------------------------------------------------
   3) Simple fight loop
------------------------------------------------------------ */
$p_hp = $p['zycie'];   $e_hp = $e['zycie'];
while ($p_hp > 0 && $e_hp > 0) {

    /* 🟡  YOUR  PVP  ENGINE  HERE  ------------------------- */
    $p_dmg = rand($p['obrazenia_min'], $p['obrazenia_max']) + floor($p['sila']*0.5);
    $e_hp -= $p_dmg;
    if ($e_hp <= 0) break;

    $e_dmg = rand($e['obrazenia_min'], $e['obrazenia_max']) + floor($e['sila']*0.5);
    $p_hp -= $e_dmg;
    /* ------------------------------------------------------ */
}

$winner_id = ($p_hp > 0) ? $player_id : $enemy_id;

/* -----------------------------------------------------------
   4) Update the matches table
------------------------------------------------------------ */
$upd = $conn->prepare("
    UPDATE tournament_matches 
    SET winner_id = ?, match_time = NOW()
    WHERE id = ?");
$upd->bind_param("ii", $winner_id, $match_id);
$upd->execute();
$upd->close();

/* -----------------------------------------------------------
   5) Update tournament_players (wins / losses)
------------------------------------------------------------ */
if ($winner_id == $player_id) {
    // the user won
    $conn->query("UPDATE tournament_players 
                  SET wins = wins + 1
                  WHERE player_id = $player_id 
                    AND tournament_id = {$match['tournament_id']}");
    $conn->query("UPDATE tournament_players 
                  SET losses = losses + 1
                  WHERE player_id = $enemy_id 
                    AND tournament_id = {$match['tournament_id']}");
} else {
    // the user lost
    $conn->query("UPDATE tournament_players 
                  SET wins = wins + 1
                  WHERE player_id = $enemy_id 
                    AND tournament_id = {$match['tournament_id']}");
    $conn->query("UPDATE tournament_players 
                  SET losses = losses + 1
                  WHERE player_id = $player_id 
                    AND tournament_id = {$match['tournament_id']}");
}

/* -----------------------------------------------------------
   6) Redirect back
------------------------------------------------------------ */
$_SESSION['tourn_msg'] = ($winner_id == $player_id)
    ? "🏆 You defeated $enemy_name!"
    : "💀 You were defeated by $enemy_name.";

header("Location: tournament_lobby.php?id={$match['tournament_id']}");
exit;

?>
