<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: logowanie.php");
    exit;
}

// Connect to DB
require_once('var/ustawienia.php');
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT * FROM gracze WHERE id = $user_id");
$gracz = $result->fetch_assoc();

echo "<h1>Welcome, " . htmlspecialchars($gracz['login']) . "</h1>";
echo "<p>Gold: " . $gracz['zloto'] . "</p>";
echo "<p>Level: " . $gracz['poziom'] . "</p>";
echo "<p>Strength: " . $gracz['sila'] . "</p>";

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Character Stats</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2><?php echo htmlspecialchars($character['login']); ?>'s Character Stats</h2>
    <ul>
        <li><strong>Level:</strong> <?php echo $character['nivel']; ?></li>
        <li><strong>Experience:</strong> <?php echo $character['exp']; ?></li>
        <li><strong>Gold:</strong> <?php echo $character['zloto']; ?></li>
        <li><strong>Life:</strong> <?php echo $character['zycie']; ?> / <?php echo $character['zycie_max']; ?></li>
        <li><strong>Strength:</strong> <?php echo $character['sila']; ?></li>
        <li><strong>Agility:</strong> <?php echo $character['zrecznosc']; ?></li>
        <li><strong>Vitality:</strong> <?php echo $character['wyrzymalosc']; ?></li>
        <li><strong>Constitution:</strong> <?php echo $character['constitucion']; ?></li>
        <li><strong>Charisma:</strong> <?php echo $character['carisma']; ?></li>
        <li><strong>Intelligence:</strong> <?php echo $character['inteligencja']; ?></li>
    </ul>

    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>