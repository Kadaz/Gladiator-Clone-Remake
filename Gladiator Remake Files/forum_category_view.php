<?php
session_start();
require_once('db.php');
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    die("You must be logged in.");
}

$categoryId = $_GET['id'] ?? null;
if (!$categoryId) {
    die("Category not found.");
}

// Get category title
$stmt = $conn->prepare("SELECT title FROM forum_categories WHERE id = ?");
$stmt->bind_param("i", $categoryId);
$stmt->execute();
$stmt->bind_result($categoryTitle);
$stmt->fetch();
$stmt->close();

if (!$categoryTitle) {
    die("Category not found.");
}

echo "<h2>📂 Category: " . htmlspecialchars($categoryTitle) . "</h2>";

echo "<p><a href='new_post.php?category_id=$categoryId'>✏️ Create New Post</a></p>";

// Get posts in this category
$stmt = $conn->prepare("
    SELECT p.id, p.title, p.created_at, p.is_pinned, p.is_locked, g.login AS author
    FROM forum_posts p
    JOIN gracze g ON p.user_id = g.id
    WHERE p.category_id = ?
    ORDER BY p.is_pinned DESC, p.created_at DESC
");
$stmt->bind_param("i", $categoryId);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php if ($result->num_rows > 0): ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Created At</th>
            <?php if (!empty($_SESSION['id'])): ?>
                <th>Actions</th>
            <?php endif; ?>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td>
                    <a href="forum_post.php?id=<?= $row['id'] ?>">
                        <?= $row['is_pinned'] ? '📌' : '' ?>
                        <?= $row['is_locked'] ? '🔒' : '' ?>
                        <?= htmlspecialchars($row['title']) ?>
                    </a>
                </td>
                <td><?= htmlspecialchars($row['author']) ?></td>
                <td><?= $row['created_at'] ?></td>
                <?php if (!empty($_SESSION['id'])): ?>
                    <td>
                        <?php
                        // Check if current user is admin
                        $uid = $_SESSION['id'];
                        $adminCheck = $conn->prepare("SELECT is_admin FROM gracze WHERE id = ?");
                        $adminCheck->bind_param("i", $uid);
                        $adminCheck->execute();
                        $adminCheck->bind_result($is_admin);
                        $adminCheck->fetch();
                        $adminCheck->close();

                        if ($is_admin): ?>
                            <form method="post" action="admin_post_action.php" style="display:inline;">
                                <input type="hidden" name="post_id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="category_id" value="<?= $categoryId ?>">
                                <button type="submit" name="action" value="pin"><?= $row['is_pinned'] ? 'Unpin' : 'Pin' ?></button>
                            </form>
                            <form method="post" action="admin_post_action.php" style="display:inline;">
                                <input type="hidden" name="post_id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="category_id" value="<?= $categoryId ?>">
                                <button type="submit" name="action" value="lock"><?= $row['is_locked'] ? 'Unlock' : 'Lock' ?></button>
                            </form>
                            <form method="post" action="admin_post_action.php" style="display:inline;" onsubmit="return confirm('Delete this post?');">
                                <input type="hidden" name="post_id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="category_id" value="<?= $categoryId ?>">
                                <button type="submit" name="action" value="delete">Delete</button>
                            </form>
                        <?php endif; ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No posts in this category yet.</p>
<?php endif;

$stmt->close();
$conn->close();
?>
