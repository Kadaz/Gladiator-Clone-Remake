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

// Check if the player is a leader in a guild
$stmt = $conn->prepare("SELECT g.id FROM guild_members gm JOIN guilds g ON gm.guild_id = g.id WHERE gm.player_id = ? AND gm.role = 'leader'");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p>You are not a guild leader.</p>";
    exit;
}

$guild = $result->fetch_assoc();
$guild_id = $guild['id'];

// Handle accept
if (isset($_POST['accept_request_id'])) {
    $request_id = (int)$_POST['accept_request_id'];
    // Add to guild_members
    $stmt = $conn->prepare("SELECT player_id FROM guild_join_requests WHERE id = ? AND guild_id = ? AND status = 'pending'");
    $stmt->bind_param("ii", $request_id, $guild_id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows > 0) {
        $player = $res->fetch_assoc();
        $stmt = $conn->prepare("INSERT INTO guild_members (guild_id, player_id, role) VALUES (?, ?, 'member')");
        $stmt->bind_param("ii", $guild_id, $player['player_id']);
        $stmt->execute();
        $conn->query("UPDATE guild_join_requests SET status = 'accepted' WHERE id = $request_id");
    }
}

// Handle reject
if (isset($_POST['reject_request_id'])) {
    $request_id = (int)$_POST['reject_request_id'];
    $conn->query("UPDATE guild_join_requests SET status = 'rejected' WHERE id = $request_id AND guild_id = $guild_id");
}

// Fetch all pending requests
$stmt = $conn->prepare("SELECT gjr.id, gjr.message, gjr.requested_at, g.login FROM guild_join_requests gjr JOIN gracze g ON g.id = gjr.player_id WHERE gjr.guild_id = ? AND gjr.status = 'pending' ORDER BY gjr.requested_at ASC");
$stmt->bind_param("i", $guild_id);
$stmt->execute();
$requests = $stmt->get_result();
?>

<h2>👥 Pending Guild Join Requests</h2>

<?php if ($requests->num_rows > 0): ?>
    <ul>
        <?php while ($r = $requests->fetch_assoc()): ?>
            <li>
                <strong><?= htmlspecialchars($r['login']) ?></strong><br>
                <em><?= nl2br(htmlspecialchars($r['message'])) ?></em><br>
                <form method="post" style="display:inline-block;">
                    <input type="hidden" name="accept_request_id" value="<?= $r['id'] ?>">
                    <button type="submit">✅ Accept</button>
                </form>
                <form method="post" style="display:inline-block;">
                    <input type="hidden" name="reject_request_id" value="<?= $r['id'] ?>">
                    <button type="submit">❌ Reject</button>
                </form>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p>No pending requests at the moment.</p>
<?php endif; ?>

<br><a href="guild.php">&larr; Back to Guild</a>
