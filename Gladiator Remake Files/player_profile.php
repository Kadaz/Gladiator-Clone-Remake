<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_GET['id'])) {
    echo "<p>No player selected.</p>";
    exit;
}

$player_id = (int)$_GET['id'];

// Fetch player info
$stmt = $conn->prepare("SELECT id, login, nivel, exp, victorias, perdidas, honor, title, is_premium FROM gracze WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $player_id);
$stmt->execute();
$player = $stmt->get_result()->fetch_assoc();

if (!$player) {
    echo "<p>Player not found.</p>";
    exit;
}

// Fetch guild (if any)
$stmt = $conn->prepare("
    SELECT g.id, g.name, g.tag
    FROM guild_members gm
    JOIN guilds g ON gm.guild_id = g.id
    WHERE gm.player_id = ?
");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$guild = $stmt->get_result()->fetch_assoc();

// Fetch alliance (if any)
$alliance = null;
if ($guild) {
    $stmt = $conn->prepare("
        SELECT a.id, a.name, a.tag
        FROM alliance_members am
        JOIN alliances a ON am.alliance_id = a.id
        WHERE am.guild_id = ?
    ");
    $stmt->bind_param("i", $guild['id']);
    $stmt->execute();
    $alliance = $stmt->get_result()->fetch_assoc();
}
?>

<h2>🧍 Player Profile: <?= htmlspecialchars($player['login']) ?>
    <?php if (!empty($player['title'])): ?>
        <span style="font-size:14px; color:#888;"> - <?= htmlspecialchars($player['title']) ?></span>
    <?php endif; ?>
    <?php if (!empty($player['is_premium'])): ?>
        <span style="color:gold; font-weight:bold; font-size:14px;"> 👑 Premium</span>
    <?php endif; ?>
</h2>

<p><strong>Level:</strong> <?= $player['nivel'] ?></p>
<p><strong>Experience:</strong> <?= number_format($player['exp']) ?></p>
<p><strong>Wins:</strong> <?= $player['victorias'] ?> | <strong>Losses:</strong> <?= $player['perdidas'] ?></p>
<p><strong>Honor:</strong> <?= $player['honor'] ?></p>

<?php if ($guild): ?>
    <p><strong>Guild:</strong>
        <a href="guild.php?id=<?= $guild['id'] ?>">
            <?= htmlspecialchars($guild['name']) ?> [<?= htmlspecialchars($guild['tag']) ?>]
        </a>
    </p>
<?php endif; ?>

<?php if ($alliance): ?>
    <p><strong>Alliance:</strong>
        <a href="alliance_view.php?id=<?= $alliance['id'] ?>">
            <?= htmlspecialchars($alliance['name']) ?> [<?= htmlspecialchars($alliance['tag']) ?>]
        </a>
    </p>
<?php endif; ?>

<a href="index.php">← Back</a>
