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

$player_id = $_SESSION['id'];

// Έλεγχος αν είναι admin
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

// Χειρισμός υποβολής
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settings = [
        'xp_rate' => $_POST['xp_rate'],
        'gold_rate' => $_POST['gold_rate'],
        'pvp_cooldown' => $_POST['pvp_cooldown'],
        'maintenance_mode' => isset($_POST['maintenance_mode']) ? '1' : '0',
    ];

    foreach ($settings as $key => $val) {
        $stmt = $conn->prepare("UPDATE settings SET value = ? WHERE name = ?");
        $stmt->bind_param("ss", $val, $key);
        $stmt->execute();
    }

    echo "<p style='color:green;'>✅ Settings updated!</p>";
}

// Ανάγνωση τρεχουσών ρυθμίσεων
$settings = [];
$res = $conn->query("SELECT name, value FROM settings");
while ($row = $res->fetch_assoc()) {
    $settings[$row['name']] = $row['value'];
}
?>

<h2>⚙️ Game Configuration Panel</h2>

<form method="post">
    <label>XP Rate:<br>
        <input type="number" step="0.1" name="xp_rate" value="<?= htmlspecialchars($settings['xp_rate']) ?>" required>
    </label><br><br>

    <label>Gold Rate:<br>
        <input type="number" step="0.1" name="gold_rate" value="<?= htmlspecialchars($settings['gold_rate']) ?>" required>
    </label><br><br>

    <label>PvP Cooldown (seconds):<br>
        <input type="number" name="pvp_cooldown" value="<?= htmlspecialchars($settings['pvp_cooldown']) ?>" required>
    </label><br><br>

    <label>
        <input type="checkbox" name="maintenance_mode" <?= $settings['maintenance_mode'] == '1' ? 'checked' : '' ?>>
        Enable Maintenance Mode
    </label><br><br>

    <button type="submit">💾 Save Settings</button>
</form>

<br><a href="admin_panel.php">← Back to Admin Panel</a>
