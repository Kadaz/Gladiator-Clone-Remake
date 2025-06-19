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

// Find If You Are A Leader
$stmt = $conn->prepare("SELECT gm.guild_id FROM guild_members gm WHERE gm.player_id = ? AND gm.role = 'leader'");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo "<p>Only guild leaders can request alliance membership.</p>";
    exit;
}

$guild = $res->fetch_assoc();
$guild_id = $guild['guild_id'];

// Find If You Are In An alliance
$stmt = $conn->prepare("SELECT * FROM alliance_members WHERE guild_id = ?");
$stmt->bind_param("i", $guild_id);
$stmt->execute();
$is_in_alliance = $stmt->get_result()->num_rows > 0;

if ($is_in_alliance) {
    echo "<p>Your guild is already in an alliance.</p>";
    exit;
}

// Join Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alliance_id'])) {
    $target_id = (int)$_POST['alliance_id'];
    $message = trim($_POST['message'] ?? '');

    // Check For Double Request
    $stmt = $conn->prepare("SELECT id FROM alliance_join_requests WHERE guild_id = ? AND alliance_id = ? AND status = 'pending'");
    $stmt->bind_param("ii", $guild_id, $target_id);
    $stmt->execute();
    $existing = $stmt->get_result();

    if ($existing->num_rows > 0) {
        echo "<p style='color:gray;'>You already have a pending request to this alliance.</p>";
    } else {
        // Import
        $stmt = $conn->prepare("INSERT INTO alliance_join_requests (guild_id, alliance_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $guild_id, $target_id, $message);
        if ($stmt->execute()) {
            echo "<p style='color:green;'>✅ Request sent to alliance!</p>";
        } else {
            echo "<p style='color:red;'>❌ Failed to send request.</p>";
        }
    }
}

// Load alliances
$alliances = $conn->query("SELECT * FROM alliances ORDER BY name ASC");

?>

<h2>🛡️ Available Alliances</h2>

<?php if ($alliances->num_rows > 0): ?>
    <ul>
        <?php while ($a = $alliances->fetch_assoc()): ?>
            <li style="margin-bottom:15px;">
                <strong><?= htmlspecialchars($a['name']) ?> [<?= htmlspecialchars($a['tag']) ?>]</strong><br>
                <?php if (!empty($a['flag'])): ?>
                    <img src="images/alliances/<?= htmlspecialchars($a['flag']) ?>" width="64" alt="flag"><br>
                <?php endif; ?>
                <?= nl2br(htmlspecialchars($a['description'])) ?><br><br>

                <form method="post">
                    <input type="hidden" name="alliance_id" value="<?= $a['id'] ?>">
                    <textarea name="message" rows="2" cols="40" placeholder="Optional message..."></textarea><br>
                    <button type="submit">📨 Send Join Request</button>
                </form>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p>No alliances available.</p>
<?php endif; ?>

<br>
<a href="index.php">&larr; Back to Dashboard</a>
