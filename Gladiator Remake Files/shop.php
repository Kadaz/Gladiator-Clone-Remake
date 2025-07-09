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

// Fetch player info
$player = $conn->query("SELECT nivel, zloto FROM gracze WHERE id = $player_id")->fetch_assoc();
$level = $player['nivel'];
$gold = $player['zloto'];

// Check if player is premium
$res = $conn->query("SELECT is_premium FROM gracze WHERE id = $player_id");
$is_premium = $res->fetch_assoc()['is_premium'] ?? 0;

// Set inventory limit based on premium status
$inventory_limit = $is_premium ? 30 : 20;

// Inventory limit
$inv_count = $conn->query("SELECT COUNT(*) AS total FROM player_items WHERE player_id = $player_id")->fetch_assoc()['total'];

// Filter system
$item_types = ['weapon', 'armor', 'shield', 'helm', 'boots', 'gloves', 'ring', 'ring2', 'necklace', 'potion',];
$selected_type = $_GET['type'] ?? 'all';

// Buy item
if (isset($_GET['buy'])) {
    $item_id = (int)$_GET['buy'];
    $item = $conn->query("SELECT * FROM items WHERE id = $item_id")->fetch_assoc();

    if ($inv_count >= $inventory_limit) {
    echo "<p style='color:red;'>❌ Inventory full ($inv_count/$inventory_limit). Sell or use items first.</p>";
    } elseif ($item && $item['level_required'] <= $level && $item['value'] <= $gold) {
        $conn->query("UPDATE gracze SET zloto = zloto - {$item['value']} WHERE id = $player_id");
        $conn->query("INSERT INTO player_items (player_id, item_id, equipped) VALUES ($player_id, $item_id, 0)");
        echo "<p style='color:green;'>✅ You bought: {$item['name']}</p>";
        $gold -= $item['value'];
        $inv_count++;
    } else {
        echo "<p style='color:red;'>❌ Not enough gold or invalid item.</p>";
    }
}

// Load items
$where = "level_required <= $level";
if ($selected_type !== 'all' && in_array($selected_type, $item_types)) {
    $where .= " AND (slot = '$selected_type' OR type = '$selected_type')";
}
$shop_items = $conn->query("SELECT * FROM items WHERE $where ORDER BY RAND() LIMIT 20");
?>

<h2>🏪 Shop</h2>
<p>Gold: <strong><?= $gold ?></strong> | Inventory: <?= $inv_count ?>/<?= $inventory_limit ?> <?= $is_premium ? "👑 Premium" : "" ?></p>
<p><br><a href="daily_shop.php">← 🛒 Daily Shop</a></p>
<p><br><a href="premium_shop.php">← 🛍️ Premium Shop</a></p>
<div>
    <strong>Filter:</strong>
    <a href="shop.php?type=all">All</a>
    <?php foreach ($item_types as $type): ?>
        <a href="shop.php?type=<?= $type ?>"><?= ucfirst($type) ?></a>
    <?php endforeach; ?>
</div>

<?php
// Εδώ ελέγχουμε αν είμαστε στο φίλτρο weapon, και βγάζουμε την ειδική εικόνα με το label
$shop_images = [
    'weapon'    => '0_1.png',
    'armor'     => '0_2.png',
    'shield'    => '0_3.png',
    'helm'      => '0_4.png',
    'boots'     => '0_5.png',
    'gloves'    => '0_6.png',
    'ring'      => '1_1.png',
    'ring2'     => '1_2.png',
    'necklace'  => '1_3.png',
    'potion'    => '1_4.png'
];

if (array_key_exists($selected_type, $shop_images)): ?>
    <div class="item-box special-weapon">
        <div class="item-label"><?= ucfirst($selected_type) ?></div>
        <img src="images/shop/<?= $shop_images[$selected_type] ?>" alt="<?= $selected_type ?> image" />
    </div>
<?php endif; ?>

<style>
.item-box {
    display: inline-block;
    text-align: center;
    border: 1px solid #ccc;
    padding: 10px;
    margin: 8px;
    width: 140px;
    border-radius: 8px;
    background: #fdfdfd;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
}
.item-box img {
    width: 64px;
    height: 64px;
}
.item-box a.buy-btn {
    display: inline-block;
    margin-top: 6px;
    padding: 4px 10px;
    background: #28a745;
    color: white;
    text-decoration: none;
    border-radius: 4px;
}
.item-box a.buy-btn:hover {
    background: #218838;
}

.special-weapon {
    display: inline-block;
    text-align: center;
    border: 2px solid #444;
    padding: 10px;
    margin: 8px;
    width: 140px;
    border-radius: 8px;
    background: #f9f9f9;
    box-shadow: 0 0 8px rgba(0,0,0,0.2);
}
.special-weapon img {
    width: 64px;
    height: 64px;
    margin-top: 5px;
}
.item-label {
    font-weight: bold;
    font-size: 14px;
    color: #b22222;
    text-transform: uppercase;
    margin-bottom: 5px;
}
</style>

<?php while ($item = $shop_items->fetch_assoc()): ?>
    <div class="item-box">
        <img src="items/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>"><br>
        <strong><?= htmlspecialchars($item['name']) ?></strong><br>
        <small><?= htmlspecialchars($item['description']) ?></small><br>
        Lvl: <?= $item['level_required'] ?><br>
        💰 <?= $item['value'] ?><br>
        <a class="buy-btn" href="shop.php?buy=<?= $item['id'] ?>&type=<?= urlencode($selected_type) ?>">Buy</a>
    </div>
<?php endwhile; ?>

<br><a href="index.php">← Back to Dashboard</a>
