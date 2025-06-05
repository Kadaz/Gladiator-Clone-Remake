<?php
session_start();
require_once("db.php");
require_once("var/ustawienia.php");
require_once("gora_strony.php");
require_once("menu_l.php");

echo "<h2>📚 Forum</h2>";

$sql = "SELECT * FROM forum_categories";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><a href='forum_category.php?id=" . $row['id'] . "'><strong>" . 
            htmlspecialchars($row['title']) . "</strong></a> — " . 
            htmlspecialchars($row['description']) . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No forum categories found.</p>";
}

$conn->close();
?>
