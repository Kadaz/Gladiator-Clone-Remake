<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id']) || $_SESSION['is_admin'] != 1) {
    die("⛔ Access denied");
}

// ➤ Delete item
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM premium_shop_items WHERE id = $id");
    echo "<p style='color:red;'>❌ Item removed from Premium Shop.</p>";
}

// ➤ Add New item
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    $item_id = (int)$_POST['item_id'];
    $cost = (int)$_POST['cost'];
    $one_time = isset($_POST['one_time']) ? 1 : 0;

    $stmt = $conn->prepare("INSERT INTO premium_shop_items (item_id, cost, one_time) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $item_id, $cost, $one_time);
    $stmt->execute();
    echo "<p style='color:green;'>✅ New item added to Premium Shop.</p>";
}

// ➤ Download all shop items
$res = $conn->query("
    SELECT p.id, p.item_id, p.cost, p.one_time, i.name 
    FROM premium_shop_items p
    JOIN items i ON p.item_id = i.id
    ORDER BY p.id DESC
");

?>

<h2>⚙️ Manage Premium Shop</h2>

<h3>📋 Existing items</h3>
<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Cost 💎</th>
        <th>Unique</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $res->fetch_assoc()): ?>
        <tr>
            <td><?= $row['item_id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= $row['cost'] ?></td>
            <td><?= $row['one_time'] ? 'Yes' : 'No' ?></td>
            <td><a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Σίγουρα;')">Delete</a></td>
        </tr>
    <?php endwhile; ?>
</table>

<h3>➕ Add New Item</h3>
<form method="post">
    <label>Item ID:</label><br>
    <input type="number" name="item_id" required><br><br>

    <label>Cost (in premium coins):</label><br>
    <input type="number" name="cost" required><br><br>

    <label><input type="checkbox" name="one_time"> Can only be purchased 1 time</label><br><br>

    <button type="submit">➕ Add</button>
</form>
