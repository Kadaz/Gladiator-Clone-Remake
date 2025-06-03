<?php
session_start();
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    die("You must be logged in.");
}

$userId = $_SESSION['id']; // <-- ΔΙΟΡΘΩΘΗΚΕ από user_id σε id
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Trade</title>
</head>
<body>
    <h1>Create a New Trade</h1>
    <form action="send_trade.php" method="post">
        <label for="recipient">Recipient Username:</label>
        <input type="text" name="recipient" required><br>

        <label for="gold">Gold to Offer:</label>
        <input type="number" name="gold" min="0" required><br>

        <label for="item_id">Item ID to Offer (optional):</label>
        <input type="number" name="item_id"><br>

        <label for="item_request">Item ID Wanted (optional):</label>
        <input type="number" name="item_request"><br>

        <input type="submit" value="Send Trade Request">
    </form>
</body>
</html>
<li><a href='online_players.php'>Back To Online Players</a></li>