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
$stmt = $conn->prepare("SELECT login, nivel, exp, exp_max, zloto, sila, obrona, zrecznosc, avatar, title  FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();
$player = $result->fetch_assoc();
$stmt->close();
// PvP Streak Counter
$pvp_streak = 0;
$stmt_streak = $conn->prepare("SELECT value FROM counters WHERE player_id = ? AND name = 'pvp_streak'");
$stmt_streak->bind_param("i", $player_id);
$stmt_streak->execute();
$stmt_streak->bind_result($pvp_streak);
$stmt_streak->fetch();
$stmt_streak->close();
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
<p>
    <strong>Username:</strong> <?= htmlspecialchars($player['login']) ?>
    <?php if (!empty($player['title'])): ?>
        <span style="color: darkblue; font-style: italic;">(<?= htmlspecialchars($player['title']) ?>)</span>
    <?php endif; ?>
</p>
<a href="player_titles.php" style="display:inline-block; background:#007bff; color:white; padding:6px 12px; border-radius:5px; text-decoration:none;">🎖️ Change Title</a>
<p><strong>Level:</strong> <?= $player['nivel'] ?></p>
<p><strong>Experience:</strong> <?= $player['exp'] ?> / <?= $player['exp_max'] ?></p>
<p><strong>Gold:</strong> <?= $player['zloto'] ?></p>
<p><strong>🔥 PvP Win Streak:</strong> <?= $pvp_streak ?> consecutive wins</p>

<h3>Combat Stats</h3>
<ul>
    <li><strong>Strength:</strong> <?= $player['sila'] ?> + <?= $bonus_sila ?> = <strong><?= $total_sila ?></strong></li>
    <li><strong>Defense:</strong> <?= $player['obrona'] ?> + <?= $bonus_obrona ?> = <strong><?= $total_obrona ?></strong></li>
    <li><strong>Dexterity:</strong> <?= $player['zrecznosc'] ?> + <?= $bonus_zrecznosc ?> = <strong><?= $total_zrecznosc ?></strong></li>
</ul>

<h5>Equipped Items</h5>
<style>
.character-wrapper {
    width: 262px;
    height: 281px;
    background: url('images/canta.jpg') no-repeat center center;
    background-size: cover;
    position: relative;
    margin: auto;
    margin-bottom: 20px;
}

.slot-box {
    position: absolute;
    width: 64px;
    height: 30px;
    
    
    text-align: center;
    font-size: 10px;
    padding-top: 2px;
}

.slot-box img {
    width: 48px;
    height: 48px;
}
</style>

<div class="character-wrapper">
<?php
$slot_positions = [
    'helm' => ['top' => 12, 'left' => 100],
    'necklace' => ['top' => 20, 'left' => 166],
    'weapon' => ['top' => 100, 'left' => 20],
    'armor' => ['top' => 100, 'left' => 100],
    'shield' => ['top' => 100, 'left' => 180],
    'gloves' => ['top' => 190, 'left' => 22],
    'boots' => ['top' => 195, 'left' => 100],
    'ring' => ['top' => 175, 'left' => 165],
    'ring2' => ['top' => 180, 'left' => 200],
];

foreach ($slot_positions as $slot => $pos):
    $item = $equipped_items[$slot] ?? null;
?>
    <div class="slot-box" style="top: <?= $pos['top'] ?>px; left: <?= $pos['left'] ?>px;">
        <strong><?= ucfirst($slot) ?></strong><br>
        <?php if ($item): ?>
            <img src="items/MORE/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" ondblclick="submitUnequip(<?= $item['player_item_id'] ?>)"><br>
            <?= htmlspecialchars($item['name']) ?>
            <form id="unequipForm<?= $item['player_item_id'] ?>" method="GET" action="unequip_item.php" style="display:none;">
                <input type="hidden" name="id" value="<?= htmlspecialchars($item['player_item_id']) ?>">
            </form>
        <?php else: ?>
            <em>Empty</em>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
</div>

<h4>Inventory</h4>
<div style="background: url('images/menu_bg.jpg') no-repeat center center; background-size: cover; padding: 15px; border-radius: 10px; display: flex; flex-wrap: wrap; gap: 10px;">
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
    <div style="text-align: center; border: 1px solid #ccc; padding: 5px;" ondblclick="submitEquip(<?= $item['player_item_id'] ?>)">
    <img src="items/<?= htmlspecialchars($item['image']) ?>" width="64"><br>
    <span style="font-weight: bold; color: #FFD700; text-shadow: 1px 1px 2px black;"><?= htmlspecialchars($item['name']) ?></span><br>
    <small>Slot: <?= htmlspecialchars($item['slot']) ?></small><br>
    <form id="equipForm<?= $item['player_item_id'] ?>" method="POST" action="equip_item.php">
        <input type="hidden" name="player_item_id" value="<?= $item['player_item_id'] ?>">
    </form>
</div>
<?php endwhile; ?>
</div>
<script>
const equipSound = new Audio('sounds/equip.mp3');
const unequipSound = new Audio('sounds/unequip.mp3');

function submitEquip(id) {
    equipSound.currentTime = 0; // για να παίζει από την αρχή αν πατήσεις πολλά
    equipSound.play().then(() => {
        const form = document.getElementById('equipForm' + id);
        if (form) {
            form.submit();
        }
    }).catch(() => {
        // fallback αν δεν παίζει ο ήχος (πχ auto play blocked)
        const form = document.getElementById('equipForm' + id);
        if (form) {
            form.submit();
        }
    });
}

function submitUnequip(id) {
    unequipSound.currentTime = 0;
    unequipSound.play().then(() => {
        const form = document.getElementById('unequipForm' + id);
        if (form) {
            form.submit();
        }
    }).catch(() => {
        const form = document.getElementById('unequipForm' + id);
        if (form) {
            form.submit();
        }
    });
}
</script>
<br><a href="index.php">← Back to Dashboard</a>
