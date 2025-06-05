<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    die("Not logged in.");
}

$userId = $_SESSION['id'];
$postId = (int)$_POST['post_id'];
$content = trim($_POST['content']);

if (!$content) {
    die("Reply cannot be empty.");
}

$stmt = $conn->prepare("INSERT INTO forum_replies (post_id, user_id, content) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $postId, $userId, $content);

if ($stmt->execute()) {
    header("Location: forum_post.php?id=$postId");
    exit;
} else {
    echo "❌ Failed to submit reply: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
