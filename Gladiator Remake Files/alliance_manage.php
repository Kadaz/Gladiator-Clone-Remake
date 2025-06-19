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

// Find if player is leader of a guild in an alliance
$stmt = $conn->prepare("SELECT am.alliance_id FROM guild_members gm JOIN alliance_members am ON gm.guild_id = am.guild_id WHERE gm.player_id = ? AND gm.role = 'leader'");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo "<p>You must be a guild leader in an alliance to manage requests.</p>";
    exit;
}

$alliance_id = $res->fetch_assoc()['alliance_id'];

// Handle accept
if (isset($_POST['accept_request_id'])) {
    $request_id = (int)$_POST['accept_request_id'];

    $stmt = $conn->prepare("SELECT guild_id FROM alliance_join_requests WHERE id = ? AND alliance_id = ? AND status = 'pending'");
    $stmt->bind_param("ii", $request_id, $alliance_id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows > 0) {
        $guild = $res->fetch_assoc();
        $stmt = $conn->prepare("INSERT INTO alliance_members (alliance_id, guild_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $alliance_id, $guild['guild_id']);
        $stmt->execute();
        $conn->query("UPDATE alliance_join_requests SET status = 'accepted' WHERE id = $request_id");
    }
}

// Handle reject
if (isset($_POST['reject_request_id'])) {
    $request_id = (int)$_POST['reject_request_id'];
    $conn->query("UPDATE alliance_join_requests SET status = 'rejected' WHERE id = $request_id AND alliance_id = $alliance_id");
}

// Fetch pending requests
$stmt = $conn->prepare("SELECT ajr.id, ajr.message, ajr.requested_at, g.name FROM alliance_join_requests ajr JOIN guilds g ON g.id = ajr.guild_id WHERE ajr.alliance_id = ? AND ajr.status = 'pending' ORDER BY ajr.requested_at ASC");
$stmt->bind_param("i", $alliance_id);
$stmt->execute();
$requests = $stmt->get_result();
?>

<h2>👥 Pending Alliance Join Requests</h2>

<?php if ($requests->num_rows > 0): ?>
    <ul>
        <?php while ($r = $requests->fetch_assoc()): ?>
            <li>
                <strong><?= htmlspecialchars($r['name']) ?></strong><br>
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

<br><a href="alliance_view.php?id=<?= $alliance_id ?>">&larr; Back to Alliance</a>
