<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

$games = [
    'guess'  => '🎯 Guess the Number',
    'rps'    => '✊ Rock‑Paper‑Scissors',
    'spin'   => '🎡 Spin the Wheel',
    'memory' => '🧠 Memory Flip'
];

foreach ($games as $game_key => $game_name):
    echo "<h2>$game_name — Today's Top 10</h2>";

    $sql = "
        SELECT g.login, COUNT(*) AS total_games,
               SUM(CASE WHEN l.won = 1 THEN 1 ELSE 0 END) AS wins
        FROM minigame_log l
        JOIN gracze g ON l.player_id = g.id
        WHERE l.game_name = ? AND DATE(l.played_at) = CURDATE()
        GROUP BY l.player_id
        ORDER BY wins DESC, total_games ASC
        LIMIT 10
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "<p style='color:red;'>❌ SQL Error: " . $conn->error . "</p>";
        continue;
    }

    $stmt->bind_param("s", $game_key);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "<p>— No activity today in this mini-game —</p>";
    } else {
        echo "<table border='1' cellpadding='6'>
                <tr><th>Player</th><th>Wins</th><th>Games Played</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['login']) . "</td>
                    <td style='color:green;'>" . $row['wins'] . "</td>
                    <td>" . $row['total_games'] . "</td>
                  </tr>";
        }
        echo "</table>";
    }

    echo "<br>";
endforeach;
?>

<br><a href="minigames.php">← Back to Mini-Games</a>
