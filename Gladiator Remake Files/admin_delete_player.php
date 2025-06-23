<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    echo "<p>Not logged in.</p>";
    exit;
}

$player_id = $_SESSION['id'];

// Check if current player is admin
$stmt = $conn->prepare("SELECT is_admin FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$stmt->bind_result($is_admin);
$stmt->fetch();
$stmt->close();

if (!$is_admin) {
    echo "<p>Access denied.</p>";
    exit;
}

// Handle delete action
if (isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];

    // Prevent deleting yourself
    if ($delete_id === $player_id) {
        echo "<p style='color:red;'>❌ You cannot delete yourself.</p>";
    } else {
        // Get username before deletion
        $stmt = $conn->prepare("SELECT login FROM gracze WHERE id = ?");
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $target = $res->fetch_assoc();

        if ($target) {
            // Delete player
            $stmt = $conn->prepare("DELETE FROM gracze WHERE id = ?");
            $stmt->bind_param("i", $delete_id);
            $stmt->execute();

            // Log action
            $stmt = $conn->prepare("INSERT INTO logs (player_id, action, details) VALUES (?, 'delete_player', ?)");
            $details = "Deleted player: " . $target['login'] . " (ID $delete_id)";
            $stmt->bind_param("is", $player_id, $details);
            $stmt->execute();

            echo "<p style='color:green;'>✅ Player " . htmlspecialchars($target['login']) . " deleted.</p>";
        }
    }
}

// Fetch all players (except self)
$result = $conn->query("SELECT id, login FROM gracze WHERE id != $player_id ORDER BY login ASC");

?>

<h2>🗑️ Delete Player Accounts</h2>
<p style="color:red;">⚠️ Use with caution. This will permanently remove the player's data.</p>

<table border="1" cellpadding="5">
    <tr>
        <th>Username</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['login']) ?></td>
            <td>
                <form method="post" onsubmit="return confirm('Are you sure you want to delete <?= htmlspecialchars($row['login']) ?>?');">
                    <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                    <button type="submit" style="background:#dc3545; color:white;">Delete</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<br><a href="admin_panel.php">← Back to Admin Panel</a>
