<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$player_id = $_SESSION['id'];

// Fetch player data
$stmt = $conn->prepare("SELECT login, email, avatar, lock_login FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();
$player = $result->fetch_assoc();
$stmt->close();

$success = "";
$error = "";

// Change password
if (isset($_POST['change_password'])) {
    $current = md5($_POST['current_password']);
    $new = md5($_POST['new_password']);
    $confirm = md5($_POST['confirm_password']);

    // Verify current password
    $stmt = $conn->prepare("SELECT id FROM gracze WHERE id = ? AND haslo = ?");
    $stmt->bind_param("is", $player_id, $current);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        if ($new === $confirm) {
            $stmt = $conn->prepare("UPDATE gracze SET haslo = ? WHERE id = ?");
            $stmt->bind_param("si", $new, $player_id);
            if ($stmt->execute()) {
                $success = "Password updated successfully.";
            } else {
                $error = "Failed to update password.";
            }
        } else {
            $error = "New passwords do not match.";
        }
    } else {
        $error = "Current password incorrect.";
    }
    $stmt->close();
}

// Change email
if (isset($_POST['change_email'])) {
    $email = $_POST['email'];
    $stmt = $conn->prepare("UPDATE gracze SET email = ? WHERE id = ?");
    $stmt->bind_param("si", $email, $player_id);
    if ($stmt->execute()) {
        $success = "Email updated successfully.";
    } else {
        $error = "Failed to update email.";
    }
    $stmt->close();
}

// Change avatar
if (isset($_POST['change_avatar'])) {
    $avatar = (int)$_POST['avatar'];
    $stmt = $conn->prepare("UPDATE gracze SET avatar = ? WHERE id = ?");
    $stmt->bind_param("ii", $avatar, $player_id);
    if ($stmt->execute()) {
        $success = "Avatar updated successfully.";
    } else {
        $error = "Failed to update avatar.";
    }
    $stmt->close();
}

// Toggle username lock
if (isset($_POST['toggle_lock'])) {
    $new_lock = $player['lock_login'] ? 0 : 1;
    $stmt = $conn->prepare("UPDATE gracze SET lock_login = ? WHERE id = ?");
    $stmt->bind_param("ii", $new_lock, $player_id);
    if ($stmt->execute()) {
        $success = $new_lock ? "Username locked." : "Username unlocked.";
        $player['lock_login'] = $new_lock;
    } else {
        $error = "Failed to toggle username lock.";
    }
    $stmt->close();
}
?>

<h2>⚙️ Account Settings</h2>

<p><strong>Username:</strong> <?= htmlspecialchars($player['login']) ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($player['email']) ?></p>
<?php if ($success) echo "<p style='color:green;'>✅ $success</p>"; ?>
<?php if ($error) echo "<p style='color:red;'>❌ $error</p>"; ?>

<!-- Show Avatar -->
<p><strong>Current Avatar:</strong><br>
<img src="avatars/avatar<?= (int)$player['avatar'] ?>.gif" width="100" alt="Avatar"></p>

<!-- Change Password -->
<form method="post">
    <h3>🔒 Change Password</h3>
    <input type="password" name="current_password" placeholder="Current Password" required><br>
    <input type="password" name="new_password" placeholder="New Password" required><br>
    <input type="password" name="confirm_password" placeholder="Confirm New Password" required><br>
    <button type="submit" name="change_password">Change Password</button>
</form>

<!-- Change Email -->
<form method="post">
    <h3>📧 Change Email</h3>
    <input type="email" name="email" value="<?= htmlspecialchars($player['email']) ?>" required>
    <button type="submit" name="change_email">Update Email</button>
</form>

<!-- Change Avatar -->
<form method="post">
    <h3>🧙 Select Avatar</h3>
    <select name="avatar">
        <?php for ($i = 1; $i <= 20; $i++): ?>
            <option value="<?= $i ?>" <?= ($player['avatar'] == $i ? 'selected' : '') ?>>Avatar <?= $i ?></option>
        <?php endfor; ?>
    </select>
    <button type="submit" name="change_avatar">Change Avatar</button>
</form>

<!-- Lock Username -->
<form method="post">
    <h3>🔒 Username Lock</h3>
    <p>Current Status: <?= $player['lock_login'] ? '🔒 Locked' : '🔓 Unlocked' ?></p>
    <button type="submit" name="toggle_lock">
        <?= $player['lock_login'] ? 'Unlock Username' : 'Lock Username' ?>
    </button>
</form>

<br>
<a href="index.php">← Back to Dashboard</a>