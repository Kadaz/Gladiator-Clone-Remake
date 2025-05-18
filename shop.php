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

// Handle buying
if (isset($_GET['buy'])) {
    $item_id = (int)$_GET['buy'];

    // Get item info
    $stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $item = $stmt->get_result()->fetch_assoc();

    if ($item) {
        // Check gold
        $gold_check = $conn->prepare("SELECT zloto FROM gracze WHERE id = ?");
        $gold_check->bind_param("i", $player_id);
        $gold_check->execute();
        $gold = $gold_check->get_result()->fetch_assoc()['zloto'];

        if ($gold >= $item['price']) {
            // Deduct gold and add item
            $new_gold = $gold - $item['price'];

            $conn->begin_transaction();
            try {
                $update = $conn->prepare("UPDATE gracze SET zloto = ? WHERE id = ?");
                $update->bind_param("ii", $new_gold, $player_id);
                $update->execute();

                $insert = $conn->prepare("INSERT INTO player_items (player_id, item_id) VALUES (?, ?)");
                $insert->bind_param("ii", $player_id, $item_id);
                $insert->execute();

                $conn->commit();
                echo "<p style='color:green;'>Item bought successfully!</p>";
            } catch (Exception $e) {
                $conn->rollback();
                echo "<p style='color:red;'>Transaction failed.</p>";
            }
        } else {
            echo "<p style='color:red;'>Not enough gold.</p>";
        }
    }
}

// Show available items
$result = $conn->query("SELECT * FROM items");

echo "<h2>Shop Inventory</h2>";
while ($item = $result->fetch_assoc()) {
    echo "<p><strong>{$item['name']}</strong><br>";
    echo "Type: {$item['type']}<br>";
    echo "Value: {$item['value']} | Price: {$item['price']}<br>";
    echo "<a href='shop.php?buy={$item['id']}'>Buy</a></p><hr>";
}

echo "<br><a href='index.php'>← Back to Dashboard</a>";
?>
