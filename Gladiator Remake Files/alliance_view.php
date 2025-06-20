<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    echo "<p>Not connected.</p>";
    exit;
}

$player_id = $_SESSION['id'];

// Find alliance_id if not provided
$alliance_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$alliance_id) {
    $stmt = $conn->prepare("SELECT am.alliance_id FROM guild_members gm JOIN alliance_members am ON gm.guild_id = am.guild_id WHERE gm.player_id = ?");
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        $alliance_id = $row['alliance_id'];
    } else {
        echo "<p>You are not in an alliance.</p>";
        exit;
    }
}

// Load alliance
$stmt = $conn->prepare("SELECT * FROM alliances WHERE id = ?");
$stmt->bind_param("i", $alliance_id);
$stmt->execute();
$alliance = $stmt->get_result()->fetch_assoc();

if (!$alliance) {
    echo "<p>Alliance not found.</p>";
    exit;
}

// Check if player is leader of a guild in this alliance
$stmt = $conn->prepare("SELECT g.id FROM guild_members gm JOIN guilds g ON gm.guild_id = g.id JOIN alliance_members am ON am.guild_id = g.id WHERE gm.player_id = ? AND gm.role = 'leader' AND am.alliance_id = ?");
$stmt->bind_param("ii", $player_id, $alliance_id);
$stmt->execute();
$is_alliance_leader = $stmt->get_result()->num_rows > 0;

// Handle flag update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_flag']) && $is_alliance_leader) {
    $new_flag = trim($_POST['flag']);
    if ($new_flag !== '') {
        $stmt = $conn->prepare("UPDATE alliances SET flag = ? WHERE id = ?");
        $stmt->bind_param("si", $new_flag, $alliance_id);
        $stmt->execute();
        $alliance['flag'] = $new_flag;
        echo "<p style='color:green;'>✅ Alliance flag updated!</p>";
    }
}

// Handle update info
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_alliance_info']) && $is_alliance_leader) {
    $name = trim($_POST['name']);
    $tag = strtoupper(trim($_POST['tag']));
    $desc = trim($_POST['description']);

    if ($name && $tag) {
        $stmt = $conn->prepare("UPDATE alliances SET name = ?, tag = ?, description = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $tag, $desc, $alliance_id);
        $stmt->execute();
        $alliance['name'] = $name;
        $alliance['tag'] = $tag;
        $alliance['description'] = $desc;
        echo "<p style='color:green;'>✅ Alliance info updated.</p>";
    } else {
        echo "<p style='color:red;'>❌ Name and tag are required.</p>";
    }
}

// Get guilds in alliance
$stmt = $conn->prepare("SELECT g.name FROM guilds g JOIN alliance_members am ON am.guild_id = g.id WHERE am.alliance_id = ?");
$stmt->bind_param("i", $alliance_id);
$stmt->execute();
$guilds_result = $stmt->get_result();

// Load flags
$flag_images = glob("images/alliances/*.png");
?>

<h2>🏛 Alliance: <?= htmlspecialchars($alliance['name']) ?> [<?= htmlspecialchars($alliance['tag']) ?>]</h2>

<?php if (!empty($alliance['flag'])): ?>
    <img src="images/alliances/<?= htmlspecialchars($alliance['flag']) ?>" alt="Flag" width="100"><br><br>
<?php else: ?>
    <p>(No Flag.)</p>
<?php endif; ?>

<p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($alliance['description'])) ?></p>

<?php if ($is_alliance_leader): ?>
    <h4>⚙️ Edit Alliance Info</h4>
    <form method="post">
        <label>Name:<br><input type="text" name="name" value="<?= htmlspecialchars($alliance['name']) ?>" maxlength="50" required></label><br><br>
        <label>Tag:<br><input type="text" name="tag" value="<?= htmlspecialchars($alliance['tag']) ?>" maxlength="10" required></label><br><br>
        <label>Description:<br><textarea name="description" rows="4" cols="40"><?= htmlspecialchars($alliance['description']) ?></textarea></label><br><br>
        <button type="submit" name="update_alliance_info">💾 Save Changes</button>
    </form>

    <h4>🏴 Change Flag</h4>
    <form method="post">
        <select name="flag" required>
            <option value="">-- Choose Flag --</option>
            <?php foreach ($flag_images as $img): 
                $file = basename($img);
                $selected = ($file === $alliance['flag']) ? 'selected' : '';
                echo "<option value='$file' $selected>$file</option>";
            endforeach; ?>
        </select>
        <button type="submit" name="update_flag">Update Flag</button>
    </form>
<?php endif; ?>

<h3>🏰 Joined Guilds:</h3>
<ul>
<?php
if ($guilds_result->num_rows > 0) {
    while ($g = $guilds_result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($g['name']) . "</li>";
    }
} else {
    echo "<li>No Guild is connected.</li>";
}
?>
</ul>

<a href="index.php">← Return</a>
