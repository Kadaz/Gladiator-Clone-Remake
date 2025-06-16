<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

// ----------------------
// Find alliance_id
// ----------------------
$alliance_id = null;

// If GET id use it.
if (isset($_GET['id'])) {
    $alliance_id = (int)$_GET['id'];
} else {
    // If not, find it from logged-in
    if (!isset($_SESSION['id'])) {
        echo "<p>Not connect.</p>";
        exit;
    }

    $player_id = $_SESSION['id'];

    $stmt = $conn->prepare("
        SELECT am.alliance_id
        FROM guild_members gm
        JOIN alliance_members am ON gm.guild_id = am.guild_id
        WHERE gm.player_id = ?
    ");
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        $alliance_id = $row['alliance_id'];
    } else {
        echo "<p>You are not in an alliance.</p>";
        exit;
    }
}

// ----------------------
// Alliance Data
// ----------------------
$stmt = $conn->prepare("SELECT * FROM alliances WHERE id = ?");
$stmt->bind_param("i", $alliance_id);
$stmt->execute();
$alliance = $stmt->get_result()->fetch_assoc();

if (!$alliance) {
    echo "<p>Alliance not found.</p>";
    exit;
}

// ----------------------
// Guilds From Alliance
// ----------------------
$stmt = $conn->prepare("
    SELECT g.name 
    FROM guilds g
    JOIN alliance_members am ON am.guild_id = g.id
    WHERE am.alliance_id = ?
");
$stmt->bind_param("i", $alliance_id);
$stmt->execute();
$guilds_result = $stmt->get_result();
?>

<h2>🏛 Alliance: <?php echo htmlspecialchars($alliance['name']); ?> [<?php echo htmlspecialchars($alliance['tag']); ?>]</h2>

<?php if (!empty($alliance['flag'])): ?>
    <img src="images/alliances/<?php echo htmlspecialchars($alliance['flag']); ?>" alt="Flag" width="100"><br><br>
<?php else: ?>
    <p>(No Flag.)</p>
<?php endif; ?>

<p><strong>Description:</strong><br>
<?php echo nl2br(htmlspecialchars($alliance['description'])); ?></p>

<h3>🏰 Joined Guilds:</h3>
<ul>
<?php
if ($guilds_result->num_rows > 0) {
    while ($g = $guilds_result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($g['name']) . "</li>";
    }
} else {
    echo "<li>No Guild is connected.</li>";
}
?>
</ul>

<a href="index.php">← Return</a>
