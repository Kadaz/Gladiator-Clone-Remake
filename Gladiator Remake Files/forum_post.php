<?php
session_start();
require_once('db.php');
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    die("Unauthorized access.");
}

$postId = $_GET['id'] ?? null;
if (!$postId) {
    die("Invalid post ID.");
}

// Fetch post info
$stmt = $conn->prepare("
    SELECT p.title, p.content, p.created_at, p.updated_at, p.is_pinned, p.is_locked,
           g.login AS author, c.title AS category_title, p.category_id
    FROM forum_posts p
    JOIN gracze g ON p.user_id = g.id
    JOIN forum_categories c ON p.category_id = c.id
    WHERE p.id = ?
");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $postId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Post not found.");
}

$post = $result->fetch_assoc();
$stmt->close();
?>

<h2><?= htmlspecialchars($post['title']) ?> <?= $post['is_pinned'] ? "📌" : "" ?> <?= $post['is_locked'] ? "🔒" : "" ?></h2>
<p><strong>By:</strong> <?= htmlspecialchars($post['author']) ?> |
   <strong>Created:</strong> <?= $post['created_at'] ?> |
   <strong>Updated:</strong> <?= $post['updated_at'] ?></p>

<div style="border: 1px solid #ccc; padding: 10px; margin-top: 10px;">
    <?= nl2br(htmlspecialchars($post['content'])) ?>
</div>

<h3>Write a Reply</h3>
<form method="post" action="post_reply.php">
    <textarea name="content" rows="4" cols="60" required></textarea><br>
    <input type="hidden" name="post_id" value="<?= $postId ?>">
    <input type="submit" value="Reply">
</form>
<p><a href="forum_category_view.php?id=<?= (int)$post['category_id'] ?>">← Back to <?= htmlspecialchars($post['category_title']) ?></a></p>

<?php
// Fetch replies
$replyStmt = $conn->prepare("
    SELECT r.content, r.created_at, g.login
    FROM forum_replies r
    JOIN gracze g ON r.user_id = g.id
    WHERE r.post_id = ?
    ORDER BY r.created_at ASC
");
$replyStmt->bind_param("i", $postId);
$replyStmt->execute();
$replies = $replyStmt->get_result();

echo "<h3>Replies</h3>";
if ($replies->num_rows > 0) {
    while ($reply = $replies->fetch_assoc()) {
        echo "<div style='border:1px solid #ccc; margin:5px; padding:5px;'>
                <b>" . htmlspecialchars($reply['login']) . "</b> replied:<br>
                " . nl2br(htmlspecialchars($reply['content'])) . "<br>
                <small><i>" . $reply['created_at'] . "</i></small>
              </div>";
    }
} else {
    echo "<p>No replies yet.</p>";
}
$replyStmt->close();
?>
