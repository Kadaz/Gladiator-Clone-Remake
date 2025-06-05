<?php
session_start();
require_once('db.php');
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    die("You must be logged in to view this page.");
}

$postId = $_GET['id'] ?? null;
$userId = $_SESSION['id'];

if (!$postId) {
    die("No post selected.");
}

// Fetch main post
$stmt = $conn->prepare("SELECT fp.*, g.login AS author_name FROM forum_posts fp JOIN gracze g ON fp.author_id = g.id WHERE fp.id = ?");
$stmt->bind_param("i", $postId);
$stmt->execute();
$postResult = $stmt->get_result();
$post = $postResult->fetch_assoc();
$stmt->close();

if (!$post) {
    die("Post not found.");
}

// Handle new reply
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$post['locked']) {
    $reply = trim($_POST['reply']);
    if ($reply) {
        $stmt = $conn->prepare("INSERT INTO forum_replies (post_id, author_id, content, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $postId, $userId, $reply);
        $stmt->execute();
        $stmt->close();
        header("Location: view_post.php?id=$postId");
        exit;
    } else {
        echo "⚠️ Cannot submit empty reply.";
    }
}

// Fetch replies
$stmt = $conn->prepare("SELECT fr.*, g.login AS author_name FROM forum_replies fr JOIN gracze g ON fr.author_id = g.id WHERE fr.post_id = ? ORDER BY fr.created_at ASC");
$stmt->bind_param("i", $postId);
$stmt->execute();
$repliesResult = $stmt->get_result();
?>

<h2><?= htmlspecialchars($post['title']) ?></h2>
<p>📅 Posted by <strong><?= htmlspecialchars($post['author_name']) ?></strong> on <?= $post['created_at'] ?></p>
<p><?= nl2br(htmlspecialchars($post['content'])) ?></p>

<?php if ($post['pinned']) echo "<p>📌 <strong>Pinned</strong></p>"; ?>
<?php if ($post['locked']) echo "<p>🔒 <strong>Locked</strong></p>"; ?>

<hr>
<h3>Replies</h3>

<?php if ($repliesResult->num_rows > 0): ?>
    <?php while ($reply = $repliesResult->fetch_assoc()): ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin: 5px 0;">
            <strong><?= htmlspecialchars($reply['author_name']) ?></strong> on <?= $reply['created_at'] ?><br>
            <?= nl2br(htmlspecialchars($reply['content'])) ?>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>— No replies yet —</p>
<?php endif; ?>

<?php if (!$post['locked']): ?>
    <hr>
    <h4>Reply to this Post</h4>
    <form method="post">
        <textarea name="reply" rows="5" cols="60" required></textarea><br>
        <input type="submit" value="Submit Reply">
    </form>
<?php else: ?>
    <p>⚠️ This post is locked. Replies are disabled.</p>
<?php endif; ?>

<p><a href="forum_category_view.php?id=<?= $post['category_id'] ?>">← Back to Category</a></p>

<?php
$stmt->close();
$conn->close();
?>
