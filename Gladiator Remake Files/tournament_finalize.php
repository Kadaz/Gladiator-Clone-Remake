<?php
require 'db.php';

$now = date('Y-m-d H:i:s');

// Πιάσε τουρνουά που έληξαν αλλά δεν έχουν δοθεί rewards
$tournaments = $conn->query("
    SELECT id FROM tournaments 
    WHERE end_time < '$now' 
      AND id NOT IN (SELECT DISTINCT tournament_id FROM tournament_rewards)
");

while ($row = $tournaments->fetch_assoc()) {
    $tid = $row['id'];

    // Βρες Top 3 βάσει wins
    $res = $conn->query("
        SELECT player_id, wins 
        FROM tournament_players 
        WHERE tournament_id = $tid AND eliminated = 0 
        ORDER BY wins DESC 
        LIMIT 3
    ");

    $rank = 1;
    while ($p = $res->fetch_assoc()) {
        $pid = $p['player_id'];

        // Rewards ανά θέση
        if ($rank == 1) { $gold = 1000; $xp = 100; }
        elseif ($rank == 2) { $gold = 500; $xp = 50; }
        else { $gold = 250; $xp = 25; }

        // Δώσε reward
        $conn->query("UPDATE gracze SET zloto = zloto + $gold, exp = exp + $xp WHERE id = $pid");

        // Καταγραφή rewards
        $conn->query("
            INSERT INTO tournament_rewards (tournament_id, player_id, position, reward_gold, reward_xp)
            VALUES ($tid, $pid, $rank, $gold, $xp)
        ");

        // Notification
        $conn->query("
            INSERT INTO notifications (player_id, message)
            VALUES ($pid, '🏆 You placed #$rank in tournament #$tid and earned $gold gold & $xp XP!')
        ");

        $rank++;
    }
}
echo "✅ Tournament rewards distributed.";
