<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

?>

<h2>🏆 Guild Rankings</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>Rank</th>
        <th>Flag</th>
        <th>Guild Name</th>
        <th>Tag</th>
        <th>Members</th>
    </tr>
    <?php
    $rank = 1;
    $result = $conn->query("
        SELECT g.id, g.name, g.tag, g.flag, COUNT(gm.player_id) AS member_count 
        FROM guilds g
        LEFT JOIN guild_members gm ON g.id = gm.guild_id
        GROUP BY g.id
        ORDER BY member_count DESC
    ");

    while ($row = $result->fetch_assoc()):
    ?>
    <tr>
        <td><?= $rank++ ?></td>
        <td>
            <?php if (!empty($row['flag'])): ?>
                <img src="images/guild/flags/<?= htmlspecialchars($row['flag']) ?>" width="32" height="32">
            <?php else: ?>
                -
            <?php endif; ?>
        </td>
        <td>
            <a href="guild_view.php?id=<?= $row['id'] ?>">
                <?= htmlspecialchars($row['name']) ?>
            </a>
        </td>
        <td><?= htmlspecialchars($row['tag']) ?></td>
        <td><?= $row['member_count'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>


<br><div style="text-align:center;"><a href="guild.php">← Back to Guild</a></div>
