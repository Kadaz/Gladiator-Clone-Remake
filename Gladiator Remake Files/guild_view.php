<?php
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

$guild_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM guilds WHERE id = ?");
$stmt->bind_param("i", $guild_id);
$stmt->execute();
$guild = $stmt->get_result()->fetch_assoc();

if (!$guild) {
    echo "<p>❌ Guild not found.</p>";
    exit;
}
?>

<h2>🏰 Guild: <?= htmlspecialchars($guild['name']) ?> [<?= htmlspecialchars($guild['tag']) ?>]</h2>
<?php if (!empty($guild['flag'])): ?>
    <img src="images/guild/flags/<?= htmlspecialchars($guild['flag']) ?>" width="64" alt="Flag"><br>
<?php endif; ?>
<p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($guild['description'])) ?></p>

<h3>👥 Members:</h3>
<ul>
<?php
$members = $conn->query("
    SELECT g.login, gm.role 
    FROM guild_members gm
    JOIN gracze g ON gm.player_id = g.id
    WHERE gm.guild_id = $guild_id
    ORDER BY gm.role = 'leader' DESC, g.login
");
while ($m = $members->fetch_assoc()):
?>
    <li><?= htmlspecialchars($m['login']) ?> - <?= $m['role'] ?></li>
<?php endwhile; ?>
</ul>

<a href="guild_rankings.php">← Back to Guild Rankings</a>
