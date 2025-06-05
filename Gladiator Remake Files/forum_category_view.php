<?php
session_start();
require_once('db.php');
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    die("Unauthorized access.");
}

$categoryId = $_GET['id'] ?? null;
if (!$categoryId) {
    die("Invalid forum category.");
}

// Fetch category info
$stmt = $conn->prepare("SELECT title, description FROM forum_categories WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $categoryId);
$stmt->execute();
$stmt->bind_result($categoryTitle, $categoryDescription);
if (!$stmt->fetch()) {
    die("Category not found.");
}
$stmt->close();

echo "<h2>$categoryTitle</h2>";
echo "<p>$categoryDescription</p>";

// Fetch posts
$stmt = $conn->prepare("
    SELECT p.id, p.title, p.created_at, g.login AS author
    FROM forum_posts p
    JOIN gracze g ON p.user_id = g.id
    WHERE p.category_id = ?
    ORDER BY p.is_pinned DESC, p.created_at DESC
");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $categoryId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Title</th><th>Author</th><th>Date</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a href='forum_post.php?id=" . (int)$row['id'] . "'>" . htmlspecialchars($row['title']) . "</a></td>";
        echo "<td>" . htmlspecialchars($row['author']) . "</td>";
        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No posts in this category yet.</p>";
}

echo "<p><a href='new_post.php?category_id=" . (int)$categoryId . "'>✏️ Create New Post</a></p>";
?>
