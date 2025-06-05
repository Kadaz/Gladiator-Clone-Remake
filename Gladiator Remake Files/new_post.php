<?php
session_start();
require_once('db.php');
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    die("You must be logged in to post.");
}

$userId = $_SESSION['id'];
$categoryId = $_GET['category_id'] ?? null;

if (!$categoryId) {
    die("Invalid forum category.");
}

// Submit post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $isPinned = isset($_POST['pinned']) ? 1 : 0;
    $isLocked = isset($_POST['locked']) ? 1 : 0;

    if ($title && $content) {
        $stmt = $conn->prepare("
            INSERT INTO forum_posts (category_id, user_id, title, content, is_pinned, is_locked, created_at)
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("iissii", $categoryId, $userId, $title, $content, $isPinned, $isLocked);
        if ($stmt->execute()) {
            header("Location: forum_category_view.php?id=$categoryId");
            exit;
        } else {
            echo "❌ Failed to post: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "⚠️ Title and content are required.";
    }
}
?>

<h2>Create New Post</h2>
<form method="post">
    <label>Title:<br><input type="text" name="title" required></label><br><br>
    <label>Content:<br><textarea name="content" rows="6" cols="60" required></textarea></label><br><br>

    <label><input type="checkbox" name="pinned"> 📌 Pinned</label><br>
    <label><input type="checkbox" name="locked"> 🔒 Locked</label><br><br>

    <input type="submit" value="Create Post">
</form>

<p><a href="forum_category_view.php?id=<?= (int)$categoryId ?>">← Back to Category</a></p>
