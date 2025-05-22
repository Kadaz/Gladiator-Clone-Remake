<?php
session_start();
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');
if (!isset($_SESSION['id'])) {
    die("⛔ Please log in to view your equipment.");
}

require 'db.php';

$player_id = $_SESSION['id'];

// Query equipped items from player_items table where equipped = 1
$query = "SELECT pi.item_id, i.name, i.type, i.image, i.attack_bonus, i.defense_bonus, i.dex_bonus
          FROM player_items pi
          JOIN items i ON pi.item_id = i.id
          WHERE pi.player_id = ? AND pi.equipped = 1";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("❌ Query preparation failed: " . $conn->error);
}

$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Your Equipped Items</h2>";

if ($result->num_rows == 0) {
    echo "<p>No items equipped.</p>";
} else {
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr>
            <th>Image</th>
            <th>Name</th>
            <th>Type</th>
            <th>Attack Bonus</th>
            <th>Defense Bonus</th>
			<th>Dexterity Bonus</tr>";

    while ($row = $result->fetch_assoc()) {
        $imageFile = $row['image']; // e.g., m1_1
        $imgPath = "/Gladiatus/items/MORE/" . $imageFile . ".png";

        // Determine image path based on filename prefix
        if (strpos($imageFile, 'm') === 0) {
            // PNG images inside MORE folder
            $imgPath = "items/MORE/" . $imageFile;
        } else {
            // GIF images inside items folder
            $imgPath = "items/" . $imageFile;
        }

        echo "<tr>";
        echo "<td><img src='" . htmlspecialchars($imgPath) . "' alt='" . htmlspecialchars($row['name']) . "' style='width:64px; height:64px;'></td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['type']) . "</td>";
        echo "<td>" . htmlspecialchars($row['attack_bonus']) . "</td>";
        echo "<td>" . htmlspecialchars($row['defense_bonus']) . "</td>";
		echo "<td>" . htmlspecialchars($row['dex_bonus']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

echo "<p><a href='index.php'>Back to Dashboard</a></p>";
?>