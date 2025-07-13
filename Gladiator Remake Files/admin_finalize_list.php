<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

// ✅ Admin check
if (!isset($_SESSION['id'])) {
    die("⛔ Not logged in.");
}
$player_id = $_SESSION['id'];
$stmt = $conn->prepare("SELECT is_admin FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$stmt->bind_result($is_admin);
$stmt->fetch();
$stmt->close();

if (!$is_admin) {
    die("⛔ Access denied.");
}

// ✅ Fetch all tournaments that have ended
$now = date('Y-m-d H:i:s');
$res = $conn->query("SELECT id, name, end_time FROM tournaments WHERE end_time < '$now' ORDER BY end_time DESC");

echo "<h2>🏁 Finalize Ended Tournaments</h2>";

if ($res->num_rows === 0) {
    echo "<p>🎉 No tournaments need finalizing.</p>";
} else {
    echo "<table border='1' cellpadding='6' cellspacing='0'>";
    echo "<tr><th>Name</th><th>Ended</th><th>Action</th></tr>";
    while ($row = $res->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . $row['end_time'] . "</td>";
        echo "<td>
            <a href='admin_finalize_tournament.php?id={$row['id']}'>
                <button>🏁 Finalize</button>
            </a>
        </td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

<br><a href="admin_panel.php">← Back to Admin Panel</a>
