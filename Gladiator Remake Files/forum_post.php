<?php
session_start();
require_once('db.php');
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    die("You must be logged in.");
}

$postId = $_GET['id'] ?? null;
if (!$postId || !is_numeric($postId)) {
    die("Invalid post ID.");
}

// Fetch post
$stmt = $conn->prepare("
    SELECT p.*, g.login AS author 
    FROM forum_posts p
    JOIN gracze g ON p.user_id = g.id
    WHERE p.id = ?
");
$stmt->bind_param("i", $postId);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
$stmt->close();

if (!$post) {
    die("Post not found.");
}

echo "<h2>📝 " . htmlspecialchars($post['title']) . "</h2>";
echo "<p><strong>Author:</strong> " . htmlspecialchars($post['author']) . "</p>";
echo "<p><strong>Posted:</strong> " . $post['created_at'] . "</p>";
echo "<p>" . nl2br(htmlspecialchars($post['content'])) . "</p>";

$is_admin = $_SESSION['is_admin'] ?? 0;

if ($is_admin == 1): ?>
    <hr>
    <h3>⚙️ Admin Actions:</h3>
    <a href="admin_post_action.php?post_id=<?= $post['id'] ?>&action=<?= $post['is_pinned'] ? 'unpin' : 'pin' ?>">
        <?= $post['is_pinned'] ? '📍 Unpin' : '📌 Pin' ?>
    </a> |
    <a href="admin_post_action.php?post_id=<?= $post['id'] ?>&action=<?= $post['is_locked'] ? 'unlock' : 'lock' ?>">
        <?= $post['is_locked'] ? '🔓 Unlock' : '🔒 Lock' ?>
    </a> |
    <a href="admin_post_action.php?post_id=<?= $post['id'] ?>&action=delete" onclick="return confirm('Delete this post?');">
        🗑️ Delete
    </a>
<?php endif;

$conn->close();
?>
