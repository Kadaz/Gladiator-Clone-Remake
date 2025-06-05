<?php
session_start();
require_once("db.php");
require_once("var/ustawienia.php");
require_once("gora_strony.php");
require_once("menu_l.php");

$category_id = (int)($_GET['id'] ?? 0);

if ($category_id <= 0) {
    die("Invalid category.");
}

// Fetch category info
$stmt = $conn->prepare("SELECT title, description FROM forum_categories WHERE id = ?");
$stmt->bind_param("i", $category_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Category not found.");
}
$category = $result->fetch_assoc();
$stmt->close();

// Fetch posts in category
$stmt = $conn->prepare("SELECT p.id, p.title, p.is_pinned, p.is_locked, p.created_at, g.login AS author
    FROM forum_posts p
    JOIN gracze g ON p.user_id = g.id
    WHERE p.category_id = ?
    ORDER BY p.is_pinned DESC, p.created_at DESC");
$stmt->bind_param("i", $category_id);
$stmt->execute();
$posts = $stmt->get_result();

?>

<h2>📂 <?= htmlspecialchars($category['title']) ?></h2>
<p><?= nl2br(htmlspecialchars($category['description'])) ?></p>
<a href="new_post.php?category_id=<?= $category_id ?>">✍️ New Post</a>

<table border="1" cellpadding="5">
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Created</th>
    </tr>
    <?php while ($post = $posts->fetch_assoc()): ?>
        <tr>
            <td>
                <?php if ($post['is_pinned']): ?>📌<?php endif; ?>
                <?php if ($post['is_locked']): ?>🔒<?php endif; ?>
                <a href="forum_post.php?id=<?= $post['id'] ?>">
                    <?= htmlspecialchars($post['title']) ?>
                </a>
            </td>
            <td><?= htmlspecialchars($post['author']) ?></td>
            <td><?= $post['created_at'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<?php $stmt->close(); $conn->close(); ?>
<li><a href='forum.php'>← Back to Forum Categories</a></li>
