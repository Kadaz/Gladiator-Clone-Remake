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

// 🎯 Get the active tournaments
$stmt = $conn->prepare("SELECT id, name, start_time, end_time FROM tournaments WHERE start_time <= ? AND end_time >= ? ORDER BY start_time ASC");
$stmt->bind_param("ss", $now, $now);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>🏆 Available Tournaments</h2>

<?php if ($result->num_rows === 0): ?>
    <p>— No active tournaments currently —</p>
<?php else: ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>Name</th>
            <th>Start</th>
            <th>Ends</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <?php
            // Check if you are already logged in.
            $joined = $conn->prepare("SELECT 1 FROM tournament_players WHERE player_id = ? AND tournament_id = ?");
            $joined->bind_param("ii", $player_id, $row['id']);
            $joined->execute();
            $has_joined = $joined->get_result()->num_rows > 0;
            $joined->close();
            ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= $row['start_time'] ?></td>
                <td><?= $row['end_time'] ?></td>
                <td>
                    <?php if ($has_joined): ?>
                        <a href="tournament_lobby.php?id=<?= $row['id'] ?>"><button>🏁 Enter</button></a>
                    <?php else: ?>
                        <a href="join_tournament.php?tournament_id=<?= $row['id'] ?>"><button>➕ Join</button></a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php endif; ?>

<br><a href="player_tournaments.php">← My Tournaments</a> | <a href="index.php">🏠 Dashboard</a>
<br><a href="index.php">← Back to Dashboard</a>
