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

// Fetch current stats and gold
$stmt = $conn->prepare("SELECT sila, obrona, zrecznosc, zloto, nivel FROM gracze WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();
$player = $result->fetch_assoc();

$training_cost = 50;

if (isset($_POST['train'])) {
    $stat = $_POST['train'];

    if ($player['zloto'] >= $training_cost) {
        if (in_array($stat, ['sila', 'obrona', 'zrecznosc'])) {
            // Use prepared statements properly to avoid injection
            $query = "UPDATE gracze SET $stat = $stat + 1, zloto = zloto - ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            if (!$stmt) {
                die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
            }
            $stmt->bind_param("ii", $training_cost, $player_id);
            if ($stmt->execute()) {
                echo "<p style='color:green;'>Successfully trained $stat!</p>";
                header("Refresh:0");
                exit;
            } else {
                echo "<p style='color:red;'>Training failed.</p>";
            }
        }
    } else {
        echo "<p style='color:red;'>Not enough gold!</p>";
    }
}
?>

<h2>Training Grounds</h2>
<p><strong>Gold:</strong> <?php echo htmlspecialchars($player['zloto']); ?></p>
<p><strong>Level:</strong> <?php echo htmlspecialchars($player['nivel']); ?></p>
<form method="post">
    <p><strong>Strength:</strong> <?php echo htmlspecialchars($player['sila']); ?> 
        <button type="submit" name="train" value="sila">Train (<?php echo $training_cost; ?> gold)</button></p>
    <p><strong>Defense:</strong> <?php echo htmlspecialchars($player['obrona']); ?> 
        <button type="submit" name="train" value="obrona">Train</button></p>
    <p><strong>Dexterity:</strong> <?php echo htmlspecialchars($player['zrecznosc']); ?> 
        <button type="submit" name="train" value="zrecznosc">Train</button></p>
</form>

<br><a href="index.php">← Back to Dashboard</a>