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

// Take premium coins From Player
$res = $conn->query("SELECT premium_coins FROM gracze WHERE id = $player_id");
$row = $res->fetch_assoc();
$premium_coins = $row['premium_coins'];

// ➤ Show Item From premium shop
$res = $conn->query("
    SELECT p.item_id, p.cost, p.one_time, i.name, i.image 
    FROM premium_shop_items p 
    JOIN items i ON p.item_id = i.id
");

$shop_items = [];
while ($row = $res->fetch_assoc()) {
    $shop_items[] = $row;
}

// ➤ Buy Item
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    $item_id = (int)$_POST['item_id'];

    // Watch Item info
    $stmt = $conn->prepare("SELECT cost, one_time FROM premium_shop_items WHERE item_id = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $stmt->bind_result($cost, $one_time);
    if ($stmt->fetch()) {
        $stmt->close();

        // If one-time, Check If You Already Buy It
        if ($one_time) {
            $check = $conn->prepare("SELECT id FROM premium_shop_purchases WHERE player_id = ? AND item_id = ?");
            $check->bind_param("ii", $player_id, $item_id);
            $check->execute();
            $check->store_result();
            if ($check->num_rows > 0) {
                echo "<p style='color:red;'>❌ You Already Buy It.</p>";
                $check->close();
                return;
            }
            $check->close();
        }

        if ($premium_coins >= $cost) {
            // Remove coins
            $conn->query("UPDATE gracze SET premium_coins = premium_coins - $cost WHERE id = $player_id");

            // Give item
            $conn->query("INSERT INTO player_items (player_id, item_id, equipped) VALUES ($player_id, $item_id, 0)");

            // Purchases
            $conn->query("INSERT INTO premium_shop_purchases (player_id, item_id) VALUES ($player_id, $item_id)");

            echo "<p style='color:green;'>✅ Buy Complete!</p>";
        } else {
            echo "<p style='color:red;'>❌ Not enough premium coins.</p>";
        }
    } else {
        echo "<p style='color:red;'>❌ Item Not Available.</p>";
    }
}
?>

<h2>🏛️ Premium Shop</h2>
<p>Έχεις: <strong><?= $premium_coins ?></strong> 💎 premium coins</p>

<?php if (empty($shop_items)): ?>
    <p>No premium items for now.</p>
<?php else: ?>
    <table border="1" cellpadding="6">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Cost</th>
            <th>Action</th>
        </tr>
        <?php foreach ($shop_items as $item): ?>
            <tr>
                <td><img src="items/<?= $item['image'] ?>" width="32"></td>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= $item['cost'] ?> 💎</td>
                <td>
                    <?php
                    // Check If You Already Buy It
                    if ($item['one_time']) {
                        $check = $conn->prepare("SELECT id FROM premium_shop_purchases WHERE player_id = ? AND item_id = ?");
                        $check->bind_param("ii", $player_id, $item['item_id']);
                        $check->execute();
                        $check->store_result();
                        if ($check->num_rows > 0) {
                            echo "<span style='color:gray;'>Purchased</span>";
                            $check->close();
                            continue;
                        }
                        $check->close();
                    }
                    ?>
                    <form method="post">
                        <input type="hidden" name="item_id" value="<?= $item['item_id'] ?>">
                        <button type="submit">Buy</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
<br><a href="shop.php">← Back to the Shop </a>