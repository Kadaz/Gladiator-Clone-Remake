<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true || ($_SESSION['is_admin'] ?? 0) != 1) {
    die("Access denied.");
}

$postId = $_GET['post_id'] ?? null;
$action = $_GET['action'] ?? null;

if (!$postId || !$action || !is_numeric($postId)) {
    die("Invalid post ID or action.");
}

// Get category for redirect
$stmt = $conn->prepare("SELECT category_id FROM forum_posts WHERE id = ?");
$stmt->bind_param("i", $postId);
$stmt->execute();
$stmt->bind_result($categoryId);
$stmt->fetch();
$stmt->close();

if (!$categoryId) {
    die("Post not found.");
}

switch ($action) {
    case 'pin':
        $conn->query("UPDATE forum_posts SET is_pinned = 1 WHERE id = $postId");
        break;
    case 'unpin':
        $conn->query("UPDATE forum_posts SET is_pinned = 0 WHERE id = $postId");
        break;
    case 'lock':
        $conn->query("UPDATE forum_posts SET is_locked = 1 WHERE id = $postId");
        break;
    case 'unlock':
        $conn->query("UPDATE forum_posts SET is_locked = 0 WHERE id = $postId");
        break;
    case 'delete':
        // Delete replies first due to foreign key constraint
        $conn->query("DELETE FROM forum_replies WHERE post_id = $postId");
        $success = $conn->query("DELETE FROM forum_posts WHERE id = $postId");

        if (!$success) {
            die("❌ Delete failed: " . $conn->error);
        }
        break;
    default:
        die("Invalid action.");
}

header("Location: forum_category_view.php?id=$categoryId");
exit;
