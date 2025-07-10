<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$player_id = $_SESSION['id'];
$cost = 100; // Τιμή για 30 μέρες

// Φόρτωσε coins και τρέχουσα premium_until
$stmt = $conn->prepare("SELECT premium_coins, premium_until FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$stmt->bind_result($coins, $premium_until);
$stmt->fetch();
$stmt->close();

// Αν πατήσει "Αγορά"
if (isset($_POST['buy'])) {
    if ($coins < $cost) {
        echo "<p style='color:red;'>❌ Not enough premium coins.</p>";
    } else {
        $today = new DateTime();
        $current_until = $premium_until ? new DateTime($premium_until) : $today;

        if ($current_until < $today) {
            $new_until = $today->modify('+30 days');
        } else {
            $new_until = $current_until->modify('+30 days');
        }

        $date_str = $new_until->format('Y-m-d');

        // Αφαίρεσε coins και όρισε νέα ημερομηνία
        $stmt = $conn->prepare("UPDATE gracze SET premium_coins = premium_coins - ?, premium_until = ? WHERE id = ?");
        $stmt->bind_param("isi", $cost, $date_str, $player_id);
        if ($stmt->execute()) {
            echo "<p style='color:green;'>✅ You are now Premium until <strong>$date_str</strong>.</p>";
        } else {
            echo "<p style='color:red;'>Error updating premium status.</p>";
        }
        $stmt->close();
    }
}
?>

<h2>👑 Become a Premium Member</h2>
<p>Cost: <strong>100 premium coins</strong></p>
<p>Benefit: +30 days premium time</p>
<form method="post">
    <button type="submit" name="buy">Activate Premium</button>
</form>

<p><a href="index.php">← Back</a></p>
