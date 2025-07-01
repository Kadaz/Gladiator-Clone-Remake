<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    echo "<p>Access denied.</p>";
    exit;
}

// Check if admin
$player_id = $_SESSION['id'];
$stmt = $conn->prepare("SELECT is_admin FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$stmt->bind_result($is_admin);
$stmt->fetch();
$stmt->close();

if (!$is_admin) {
    echo "<p>Access denied.</p>";
    exit;
}

// Handle new or update achievement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['achievement_id']) ? (int)$_POST['achievement_id'] : null;
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $image = trim($_POST['image']);
    $title_reward = trim($_POST['title_reward']);

    if ($id) {
        $stmt = $conn->prepare("UPDATE achievements SET name=?, description=?, image=?, title_reward=? WHERE id=?");
        $stmt->bind_param("ssssi", $name, $description, $image, $title_reward, $id);
        $stmt->execute();
        echo "<p style='color:green;'>✅ Achievement updated.</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO achievements (name, description, image, title_reward) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $description, $image, $title_reward);
        $stmt->execute();
        echo "<p style='color:green;'>✅ Achievement created.</p>";
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM achievements WHERE id = $id");
    echo "<p style='color:red;'>❌ Achievement deleted.</p>";
}

// Fetch all achievements
$achievements = $conn->query("SELECT * FROM achievements ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC);
?>

<h2>🏆 Manage Achievements</h2>

<h3>Create or Edit</h3>
<form method="post">
    <input type="hidden" name="achievement_id" value="<?= $_GET['edit'] ?? '' ?>">

    <?php
    $a = ['name' => '', 'description' => '', 'image' => '', 'title_reward' => ''];
    if (isset($_GET['edit'])) {
        $id = (int)$_GET['edit'];
        $stmt = $conn->prepare("SELECT * FROM achievements WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            $a = $res->fetch_assoc();
        }
    }
    ?>

    <label>Name:<br>
        <input type="text" name="name" value="<?= htmlspecialchars($a['name']) ?>" required>
    </label><br><br>

    <label>Description:<br>
        <textarea name="description" rows="3" cols="40"><?= htmlspecialchars($a['description']) ?></textarea>
    </label><br><br>

    <label>Image Filename (in /images/achievements/):<br>
        <input type="text" name="image" value="<?= htmlspecialchars($a['image']) ?>" required>
    </label><br><br>

    <label>Title Reward (optional):<br>
        <input type="text" name="title_reward" value="<?= htmlspecialchars($a['title_reward']) ?>" maxlength="50">
    </label><br><br>

    <button type="submit">💾 Save Achievement</button>
</form>

<hr>

<h3>📋 All Achievements</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Image</th>
        <th>Title Reward</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($achievements as $ach): ?>
    <tr>
        <td><?= $ach['id'] ?></td>
        <td><?= htmlspecialchars($ach['name']) ?></td>
        <td><?= htmlspecialchars($ach['description']) ?></td>
        <td>
            <?php if ($ach['image']): ?>
                <img src="images/achievements/<?= htmlspecialchars($ach['image']) ?>" width="32">
                <br><?= htmlspecialchars($ach['image']) ?>
            <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($ach['title_reward']) ?></td>
        <td>
            <a href="?edit=<?= $ach['id'] ?>">✏️ Edit</a> |
            <a href="?delete=<?= $ach['id'] ?>" onclick="return confirm('Are you sure?')">🗑️ Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<br><a href="admin_panel.php">← Back to Admin Panel</a>
