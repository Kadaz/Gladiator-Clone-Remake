<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['login'])) {
    header("Location: logowanie.php");
    exit;
}

$login = $_SESSION['login'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arena - Gladiatus</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        header, nav, main, footer {
            text-align: center;
            padding: 15px;
        }

        nav a {
            color: #fff;
            margin: 0 10px;
            text-decoration: none;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .arena-box {
            background-color: #2c2c2c;
            margin: 20px auto;
            padding: 20px;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>
    <header>
        <h1>Arena</h1>
    </header>

    <nav>
        <a href="index.php">Home</a>
        <a href="quest.php">Quest</a>
        <a href="inventory.php">Inventory</a>
        <a href="training.php">Training</a>
        <a href="shop.php">Shop</a>
        <a href="konto.php">Account Settings</a>
        <a href="logout.php">Logout</a>
    </nav>

    <main>
        <div class="arena-box">
            <h2>Fight an Opponent</h2>
            <p>Here you will soon be able to challenge other players in PvP combat!</p>
            <form action="#" method="post">
                <input type="text" name="opponent" placeholder="Opponent name">
                <button type="submit">Challenge</button>
            </form>
        </div>
    </main>

    <footer>
        &copy; 2025 Gladiatus Arena
    </footer>
</body>
</html>
