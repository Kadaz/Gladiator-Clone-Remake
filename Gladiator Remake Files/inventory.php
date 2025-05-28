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

// Inventory limit
$inv_count = $conn->query("SELECT COUNT(*) AS total FROM player_items WHERE player_id = $player_id")->fetch_assoc()['total'];
$inventory_limit = 20;

// Count current inventory items (unequipped only)
$count_query = $conn->prepare("SELECT COUNT(*) FROM player_items WHERE player_id = ? AND equipped = 0");
$count_query->bind_param("i", $player_id);
$count_query->execute();
$count_query->bind_result($inventory_count);
$count_query->fetch();
$count_query->close();

// Handle item equip
if (isset($_GET['equip']) && !$inventory_full) {
    $player_item_id = (int)$_GET['equip'];

    // Get item type
    $stmt = $conn->prepare("
        SELECT i.type 
        FROM player_items pi 
        JOIN items i ON pi.item_id = i.id 
        WHERE pi.id = ? AND pi.player_id = ?
    ");
    $stmt->bind_param("ii", $player_item_id, $player_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($item = $result->fetch_assoc()) {
        $type = $item['type'];

        // Unequip other items of the same type
        $unequip = $conn->prepare("
            UPDATE player_items 
            SET equipped = 0 
            WHERE player_id = ? AND equipped = 1 AND item_id IN (
                SELECT id FROM items WHERE type = ?
            )
        ");
        $unequip->bind_param("is", $player_id, $type);
        $unequip->execute();

        // Equip selected item
        $equip = $conn->prepare("UPDATE player_items SET equipped = 1 WHERE id = ?");
        $equip->bind_param("i", $player_item_id);
        $equip->execute();
    }

    header("Location: inventory.php");
    exit;
}
?>

<h2>Inventory</h2>
<p>Inventory: <?= $inv_count ?>/20</p>

<li><a href='character_equipment.php'>Character Equipment</a></li>
<?php
// Equipped Items
echo "<h3>Equipped Items</h3>";
$equipped_query = $conn->prepare("
    SELECT pi.id as player_item_id, i.name, i.type, i.value 
    FROM player_items pi 
    JOIN items i ON pi.item_id = i.id 
    WHERE pi.player_id = ? AND pi.equipped = 1
");
$equipped_query->bind_param("i", $player_id);
$equipped_query->execute();
$equipped_result = $equipped_query->get_result();

if ($equipped_result->num_rows > 0) {
    while ($item = $equipped_result->fetch_assoc()) {
        echo "<p>{$item['name']} ({$item['type']}) - Value: {$item['value']} 
            <a href='unequip_item.php?id={$item['player_item_id']}'>Unequip</a></p>";
    }
} else {
    echo "<p>No items equipped.</p>";
}

// Inventory Items
echo "<h3>Inventory</h3>";
$inv_query = $conn->prepare("
    SELECT pi.id as player_item_id, i.name, i.type, i.value, pi.equipped 
    FROM player_items pi 
    JOIN items i ON pi.item_id = i.id 
    WHERE pi.player_id = ?
");
$inv_query->bind_param("i", $player_id);
$inv_query->execute();
$inv_result = $inv_query->get_result();

if ($inv_result->num_rows > 0) {
    while ($item = $inv_result->fetch_assoc()) {
        echo "<p>{$item['name']} ({$item['type']}) - Value: {$item['value']} ";
        if ($item['equipped']) {
            echo "[Equipped]";
        } else {
            echo "<a href='inventory.php?equip={$item['player_item_id']}'>Equip</a> | ";
            echo "<a href='sell_item.php?id={$item['player_item_id']}' onclick=\"return confirm('Sell this item?');\">Sell</a>";
        }
        echo "</p>";
    }
} else {
    echo "<p>No items in inventory.</p>";
}
?>

<br><a href="index.php">← Back to Dashboard</a>
