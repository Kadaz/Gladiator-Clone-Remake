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

// Fetch player data from 'gracze'
$stmt = $conn->prepare("SELECT login, nivel, exp, exp_max, zloto, sila, obrona, zrecznosc, avatar FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();
$player = $result->fetch_assoc();
$stmt->close();

if (!$player) {
    echo "<p style='color:red;'>Player not found.</p>";
    exit;
}

// Avatar display
$avatar_img = "avatars/avatar" . intval($player['avatar']) . ".gif";

// Get equipped item stat bonuses
$sql_bonus = "SELECT 
    SUM(items.attack_bonus) AS bonus_sila,
    SUM(items.defense_bonus) AS bonus_obrona,
    SUM(items.dex_bonus) AS bonus_zrecznosc
FROM player_items 
JOIN items ON player_items.item_id = items.id 
WHERE player_items.player_id = ? AND player_items.equipped = 1";
$stmt_bonus = $conn->prepare($sql_bonus);
$stmt_bonus->bind_param("i", $player_id);
$stmt_bonus->execute();
$result_bonus = $stmt_bonus->get_result();
$bonus = $result_bonus->fetch_assoc();
$stmt_bonus->close();

$bonus_sila = $bonus['bonus_sila'] ?? 0;
$bonus_obrona = $bonus['bonus_obrona'] ?? 0;
$bonus_zrecznosc = $bonus['bonus_zrecznosc'] ?? 0;

// Fetch equipped items
$sql_equipped = "SELECT player_items.id AS player_item_id, items.name, items.image, items.type, items.description, items.slot
                 FROM player_items 
                 JOIN items ON player_items.item_id = items.id 
                 WHERE player_items.player_id = ? AND player_items.equipped = 1";
$stmt_eq = $conn->prepare($sql_equipped);
$stmt_eq->bind_param("i", $player_id);
$stmt_eq->execute();
$result_eq = $stmt_eq->get_result();

$equipped_items = [];
while ($item = $result_eq->fetch_assoc()) {
    $slot = $item['slot'];
    $equipped_items[$slot] = $item;
}
$stmt_eq->close();

// Final stats
$total_sila = $player['sila'] + $bonus_sila;
$total_obrona = $player['obrona'] + $bonus_obrona;
$total_zrecznosc = $player['zrecznosc'] + $bonus_zrecznosc;
?>

<h2>🧝 Character Profile</h2>
<img src="<?= $avatar_img ?>" width="64" alt="Avatar"><br><br>
<p><strong>Username:</strong> <?= htmlspecialchars($player['login']) ?></p>
<p><strong>Level:</strong> <?= $player['nivel'] ?></p>
<p><strong>Experience:</strong> <?= $player['exp'] ?> / <?= $player['exp_max'] ?></p>
<p><strong>Gold:</strong> <?= $player['zloto'] ?></p>

<h3>Combat Stats</h3>
<ul>
    <li><strong>Strength:</strong> <?= $player['sila'] ?> + <?= $bonus_sila ?> = <strong><?= $total_sila ?></strong></li>
    <li><strong>Defense:</strong> <?= $player['obrona'] ?> + <?= $bonus_obrona ?> = <strong><?= $total_obrona ?></strong></li>
    <li><strong>Dexterity:</strong> <?= $player['zrecznosc'] ?> + <?= $bonus_zrecznosc ?> = <strong><?= $total_zrecznosc ?></strong></li>
</ul>

<h5>Equipped Items</h5>
<style>
.equip-grid {
    display: grid;
    grid-template-columns: repeat(3, 120px);
    gap: 10px;
    margin-bottom: 10px;
}
.equip-slot {
    text-align: center;
    padding: 6px;
    border: 1px solid #aaa;
    border-radius: 8px;
    background-color: #f3f3f3;
}
.equip-slot img {
    width: 64px;
    height: 64px;
}
</style>

<div class="equip-grid">
    <?php
    $slots = ['weapon', 'shield', 'armor', 'helm', 'boots', 'gloves', 'ring', 'ring2', 'necklace'];
    foreach ($slots as $slot_name):
        $item = $equipped_items[$slot_name] ?? null;
    ?>
    <div class="equip-slot">
        <strong><?= ucfirst($slot_name) ?></strong><br>
        <?php if ($item): ?>
            <img src="items/MORE/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>"><br>
            <?= htmlspecialchars($item['name']) ?>
            <form method="GET" action="unequip_item.php" style="margin-top: 4px;">
                <input type="hidden" name="id" value="<?= htmlspecialchars($item['player_item_id']) ?>">
                <button type="submit">Unequip</button>
            </form>
        <?php else: ?>
            <em>Empty</em>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>

<h4>Inventory</h4>
<div style="display: flex; flex-wrap: wrap; gap: 10px;">
<?php
$sql_inventory = "SELECT pi.id AS player_item_id, i.name, i.image, i.slot 
                  FROM player_items pi 
                  JOIN items i ON pi.item_id = i.id 
                  WHERE pi.player_id = ? AND pi.equipped = 0";
$stmt_inv = $conn->prepare($sql_inventory);
$stmt_inv->bind_param("i", $player_id);
$stmt_inv->execute();
$result_inv = $stmt_inv->get_result();

while ($item = $result_inv->fetch_assoc()):
?>
    <div style="text-align: center; border: 1px solid #ccc; padding: 5px;">
        <img src="items/<?= htmlspecialchars($item['image']) ?>" width="64"><br>
        <strong><?= htmlspecialchars($item['name']) ?></strong><br>
        <small>Slot: <?= htmlspecialchars($item['slot']) ?></small><br>
        <form method="POST" action="equip_item.php">
            <input type="hidden" name="player_item_id" value="<?= $item['player_item_id'] ?>">
            <button type="submit">Equip</button>
        </form>
    </div>
<?php endwhile; ?>
</div>

<br><a href="index.php">← Back to Dashboard</a>
