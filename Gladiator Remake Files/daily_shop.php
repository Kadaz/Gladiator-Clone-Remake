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

// Πάρε τα σημερινά αντικείμενα του shop
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

// Χειρισμός αγοράς
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    $item_id = (int)$_POST['item_id'];

    // Έλεγχος αν έχει ήδη αγοράσει
    $stmt = $conn->prepare("SELECT id FROM daily_shop_purchases WHERE player_id = ? AND item_id = ? AND purchase_date = ?");
    $stmt->bind_param("iis", $player_id, $item_id, $date_today);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<p style='color:red;'>❌ Έχεις ήδη αγοράσει αυτό το αντικείμενο σήμερα.</p>";
    } else {
        $stmt->close();

        // Παίρνουμε το κόστος του αντικειμένου
        $stmt = $conn->prepare("SELECT cost FROM daily_shop_items WHERE item_id = ? AND day_date = ?");
        $stmt->bind_param("is", $item_id, $date_today);
        $stmt->execute();
        $stmt->bind_result($cost);
        if ($stmt->fetch()) {
            $stmt->close();

            // Έλεγχος αν έχει coins
            $res = $conn->query("SELECT coins FROM gracze WHERE id = $player_id");
            $row = $res->fetch_assoc();
            $player_coins = $row['coins'];

            if ($player_coins >= $cost) {
                // Ολοκλήρωση αγοράς
                $conn->query("UPDATE gracze SET coins = coins - $cost WHERE id = $player_id");
                $conn->query("INSERT INTO player_items (player_id, item_id, equipped) VALUES ($player_id, $item_id, 0)");
                $conn->query("INSERT INTO daily_shop_purchases (player_id, item_id, purchase_date) VALUES ($player_id, $item_id, '$date_today')");

                echo "<p style='color:green;'>✅ Επιτυχής αγορά!</p>";
            } else {
                echo "<p style='color:red;'>❌ Δεν έχεις αρκετά coins.</p>";
            }
        } else {
            echo "<p style='color:red;'>❌ Σφάλμα: Το αντικείμενο δεν βρέθηκε.</p>";
        }
    }
}
?>

<h2>🛒 Daily Shop</h2>

<?php if (empty($shop_items)): ?>
    <p>Δεν υπάρχουν αντικείμενα διαθέσιμα σήμερα.</p>
<?php else: ?>
    <table border="1" cellpadding="6">
        <tr>
            <th>Εικόνα</th>
            <th>Όνομα</th>
            <th>Κόστος (coins)</th>
            <th>Ενέργεια</th>
        </tr>
        <?php foreach ($shop_items as $item): ?>
            <tr>
                <td><img src="items/<?= htmlspecialchars($item['image']) ?>" width="32"></td>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= $item['cost'] ?> 🪙</td>
                <td>
                    <?php
                    // Έλεγχος αν έχει ήδη αγοράσει
                    $item_id = $item['item_id'];
                    $stmt = $conn->prepare("SELECT id FROM daily_shop_purchases WHERE player_id = ? AND item_id = ? AND purchase_date = ?");
                    $stmt->bind_param("iis", $player_id, $item_id, $date_today);
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        echo "<span style='color:gray;'>Ήδη αγοράστηκε</span>";
                    } else {
                        echo "<form method='post'>
                                <input type='hidden' name='item_id' value='$item_id'>
                                <button type='submit'>Αγορά</button>
                              </form>";
                    }
                    $stmt->close();
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
