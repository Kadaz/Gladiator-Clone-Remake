<?php
session_start();
require_once("db.php");
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$sender_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient_name = trim($_POST['recipient'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($recipient_name) || empty($message)) {
        $error = "Please fill in all fields.";
    } else {
        // Get recipient ID
        $stmt = $conn->prepare("SELECT id FROM gracze WHERE login = ?");
        $stmt->bind_param("s", $recipient_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $recipient = $result->fetch_assoc();

        if (!$recipient) {
            $error = "Recipient not found.";
        } else {
            $recipient_id = $recipient['id'];

            // Get sender username
            $stmt2 = $conn->prepare("SELECT login FROM gracze WHERE id = ?");
            $stmt2->bind_param("i", $sender_id);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $sender = $result2->fetch_assoc();

            $sender_name = $sender['login'] ?? 'Unknown';

            // Insert message
            $stmt3 = $conn->prepare("INSERT INTO mensajes (id_user_r, login_user_r, id_user_s, login_user_s, mensaje) VALUES (?, ?, ?, ?, ?)");
            $stmt3->bind_param("issss", $recipient_id, $recipient_name, $sender_id, $sender_name, $message);

            if ($stmt3->execute()) {
                $success = "Message sent to $recipient_name!";
            } else {
                $error = "Failed to send message.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Message</title>
</head>
<body>
<h2>📨 Send Message</h2>

<?php if (isset($success)): ?>
    <p style="color: green;"><?= htmlspecialchars($success) ?></p>
<?php elseif (isset($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
    <label for="recipient">To (Username):</label><br>
    <input type="text" id="recipient" name="recipient" required><br><br>

    <label for="message">Message:</label><br>
    <textarea id="message" name="message" rows="5" cols="40" required></textarea><br><br>

    <input type="submit" value="Send">
</form>

<p><a href="index.php">← Back to Dashboard</a></p>
<a href="inbox.php">← Back to Inbox</a> |
</body>
</html>