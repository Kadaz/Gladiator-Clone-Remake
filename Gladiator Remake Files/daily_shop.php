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
$date_today = date('Y-m-d');

// Take the items
$stmt = $conn->prepare("
    SELECT d.item_id, d.cost, i.name, i.image 
    FROM daily_shop_items d 
    JOIN items i ON d.item_id = i.id 
    WHERE d.day_date = ?
");
$stmt->bind_param("s", $date_today);
$stmt->execute();
$res = $stmt->get_result();
$shop_items = [];
while ($row = $res->fetch_assoc()) {
    $shop_items[] = $row;
}
$stmt->close();

// Order The Coins
$res = $conn->query("SELECT coins FROM gracze WHERE id = $player_id");
$player = $res->fetch_assoc();
$player_coins = $player['coins'];

// Shop Control
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    $item_id = (int)$_POST['item_id'];

    // Check If You already buy it
    $stmt = $conn->prepare("SELECT id FROM daily_shop_purchases WHERE player_id = ? AND item_id = ? AND purchase_date = ?");
    $stmt->bind_param("iis", $player_id, $item_id, $date_today);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<p style='color:red;'>❌ Έχεις ήδη αγοράσει αυτό το αντικείμενο σήμερα.</p>";
    } else {
        $stmt->close();

        // Take the items' valew
        $stmt = $conn->prepare("SELECT cost FROM daily_shop_items WHERE item_id = ? AND day_date = ?");
        $stmt->bind_param("is", $item_id, $date_today);
        $stmt->execute();
        $stmt->bind_result($cost);
        if ($stmt->fetch()) {
            $stmt->close();

            // Check if you have coins
            $res = $conn->query("SELECT coins FROM gracze WHERE id = $player_id");
            $row = $res->fetch_assoc();
            $player_coins = $row['coins'];

            if ($player_coins >= $cost) {
                // Complete Order
                $conn->query("UPDATE gracze SET coins = coins - $cost WHERE id = $player_id");
                $conn->query("INSERT INTO player_items (player_id, item_id, equipped) VALUES ($player_id, $item_id, 0)");
                $conn->query("INSERT INTO daily_shop_purchases (player_id, item_id, purchase_date) VALUES ($player_id, $item_id, '$date_today')");

                echo "<p style='color:green;'>✅ Success Order !</p>";
            } else {
                echo "<p style='color:red;'>❌ Not Enough Coins.</p>";
            }
        } else {
            echo "<p style='color:red;'>❌ Error: Item Not Found.</p>";
        }
    }
}
?>

<h2>🛒 Daily Shop</h2>

<div style="background: #f0f0f0; border: 1px solid #999; padding: 10px; margin-bottom: 10px; font-size: 18px;">
    💰 You Have <strong><?= $player_coins ?></strong> coins available
</div>

<?php if (empty($shop_items)): ?>
    <p>No available Items For Today.</p>
<?php else: ?>
    <table border="1" cellpadding="6">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Coins</th>
            <th>Order</th>
        </tr>
        <?php foreach ($shop_items as $item): ?>
            <tr>
                <td><img src="items/<?= htmlspecialchars($item['image']) ?>" width="32"></td>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= $item['cost'] ?> 🪙</td>
                <td>
                    <?php
                    // Check if you already buy it
                    $item_id = $item['item_id'];
                    $stmt = $conn->prepare("SELECT id FROM daily_shop_purchases WHERE player_id = ? AND item_id = ? AND purchase_date = ?");
                    $stmt->bind_param("iis", $player_id, $item_id, $date_today);
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        echo "<span style='color:gray;'>Already Buy it</span>";
                    } else {
                        echo "<form method='post'>
                                <input type='hidden' name='item_id' value='$item_id'>
                                <button type='submit'>Shop</button>
                              </form>";
                    }
                    $stmt->close();
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
