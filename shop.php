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

// Fetch player level and gold
$player = $conn->query("SELECT nivel, zloto FROM gracze WHERE id = $player_id")->fetch_assoc();
$level = $player['nivel'];
$gold = $player['zloto'];

// Buy item logic
if (isset($_GET['buy'])) {
    $item_id = (int)$_GET['buy'];
    $item = $conn->query("SELECT * FROM items WHERE id = $item_id")->fetch_assoc();
    
    if ($item && $item['level_required'] <= $level && $gold >= $item['value']) {
        // Deduct gold
        $conn->query("UPDATE gracze SET zloto = zloto - {$item['value']} WHERE id = $player_id");

        // Add to player inventory
        $conn->query("INSERT INTO player_items (player_id, item_id, equipped) VALUES ($player_id, $item_id, 0)");

        echo "<p style='color:green;'>You bought: {$item['name']}</p>";
        $gold -= $item['value'];
    } else {
        echo "<p style='color:red;'>Not enough gold or level too low.</p>";
    }
}

// Get shop items (random items for now)
$shop_items = $conn->query("SELECT * FROM items WHERE level_required <= $level ORDER BY RAND() LIMIT 6");
?>

<h2>🏪 Shop</h2>
<p>Your Gold: <strong><?= $gold ?></strong></p>

<style>
.item-box {
    display: inline-block;
    text-align: center;
    border: 1px solid #ccc;
    padding: 10px;
    margin: 8px;
    width: 120px;
    border-radius: 8px;
    background: #fdfdfd;
}
.item-box img {
    width: 64px;
    height: 64px;
}
</style>

<?php while ($item = $shop_items->fetch_assoc()): ?>
    <div class="item-box">
        <img src="items/<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['name']) ?>"><br>
        <strong><?= htmlspecialchars($item['name']) ?></strong><br>
        Value: <?= $item['value'] ?> G<br>
        <a href="shop.php?buy=<?= $item['id'] ?>">Buy</a>
    </div>
<?php endwhile; ?>

<br><a href="index.php">← Back to Dashboard</a>
