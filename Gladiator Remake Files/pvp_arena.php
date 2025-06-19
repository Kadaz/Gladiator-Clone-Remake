<style>
body {
  background-image: url('images/background.jpg');
}
</style>
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
$conn->query("UPDATE gracze SET ostatnio_zregenerowano = UNIX_TIMESTAMP() WHERE id = $player_id");

// Get current player name
$stmt_self = $conn->prepare("SELECT login FROM gracze WHERE id = ?");
if (!$stmt_self) {
    die("Prepare failed (self): " . $conn->error);
}
$stmt_self->bind_param("i", $player_id);
$stmt_self->execute();
$stmt_self->bind_result($player_name);
$stmt_self->fetch();
$stmt_self->close();

// PvP cooldown check
$current_time = time();
$pvp_cooldown_seconds = 300;
$can_fight = true;

$stmt_cooldown = $conn->prepare("SELECT ostatnia_walka_pvp FROM gracze WHERE id = ?");
$stmt_cooldown->bind_param("i", $player_id);
$stmt_cooldown->execute();
$stmt_cooldown->bind_result($last_fight_time);
$stmt_cooldown->fetch();
$stmt_cooldown->close();

$remaining = 0;
if ($last_fight_time > 0 && ($current_time - $last_fight_time) < $pvp_cooldown_seconds) {
    $can_fight = false;
    $remaining = $pvp_cooldown_seconds - ($current_time - $last_fight_time);
}

// Get all other players + guild + alliance info
$stmt = $conn->prepare("
    SELECT g.id, g.login, g.nivel, g.zloto, g.victorias, g.perdidas,
           gu.name AS guild_name, gu.id AS guild_id,
           al.name AS alliance_name, al.id AS alliance_id
    FROM gracze g
    LEFT JOIN guild_members gm ON gm.player_id = g.id
    LEFT JOIN guilds gu ON gu.id = gm.guild_id
    LEFT JOIN alliance_members am ON gu.id = am.guild_id
    LEFT JOIN alliances al ON al.id = am.alliance_id
    WHERE g.id != ?
");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>🏟️ PvP Arena</h2>
<p>Logged in as: <strong><?= htmlspecialchars($player_name) ?></strong></p>

<?php if (!$can_fight): ?>
    <p style="color:red;">⚠️ You must wait <?= $remaining ?> seconds before your next PvP battle.</p>
<?php endif; ?>

<table border="1" cellpadding="5">
    <tr>
        <th>Opponent</th>
        <th>Level</th>
        <th>Gold</th>
        <th>Victories</th>
        <th>Defeats</th>
        <th>Guild</th>
        <th>Alliance</th>
        <th>Action</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td>
            <a href="player_profile.php?id=<?= $row['id'] ?>">
                <?= htmlspecialchars($row['login']) ?>
            </a>
        </td>
        <td><?= $row['nivel'] ?></td>
        <td><?= $row['zloto'] ?></td>
        <td><?= $row['victorias'] ?></td>
        <td><?= $row['perdidas'] ?></td>
        <td>
            <?php if ($row['guild_name']): ?>
                <a href="guild.php?id=<?= $row['guild_id'] ?>">
                    <?= htmlspecialchars($row['guild_name']) ?>
                </a>
            <?php else: ?>
                <em>-</em>
            <?php endif; ?>
        </td>
        <td>
            <?php if ($row['alliance_name']): ?>
                <a href="alliance_view.php?id=<?= $row['alliance_id'] ?>">
                    <?= htmlspecialchars($row['alliance_name']) ?>
                </a>
            <?php else: ?>
                <em>-</em>
            <?php endif; ?>
        </td>
        <td>
            <?php if ($can_fight): ?>
                <form method="POST" action="pvp_fight.php" onsubmit="return confirm('Fight <?= htmlspecialchars($row['login']) ?>?');">
                    <input type="hidden" name="enemy_id" value="<?= $row['id'] ?>">
                    <button type="submit">Fight</button>
                </form>
            <?php else: ?>
                <button disabled>Cooldown</button>
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<br><a href="index.php">← Back to Dashboard</a>
