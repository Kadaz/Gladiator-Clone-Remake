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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>🎉 Event Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #222, #111);
            color: white;
            text-align: center;
            padding: 50px;
        }
        .event-box {
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid #ccc;
            border-radius: 12px;
            padding: 20px;
            margin: 20px;
            width: 280px;
            box-shadow: 0 0 10px rgba(255,255,255,0.2);
        }
        .event-box img {
            width: 100px;
            height: 100px;
        }
        .event-box h2 {
            margin: 10px 0;
        }
        .event-box p {
            font-size: 14px;
        }
        .event-box a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .event-box a:hover {
            background: #218838;
        }

        /* Snow and Fog */
        .snowflake {
            position: fixed;
            top: -10px;
            color: white;
            font-size: 24px;
            animation: fall linear infinite;
            z-index: 999;
            pointer-events: none;
        }

        @keyframes fall {
            0% { transform: translateY(0); }
            100% { transform: translateY(100vh); }
        }

        @keyframes movefog {
            0% { background-position: 0 0; }
            100% { background-position: 1000px 0; }
        }
    </style>
</head>
<body>

<h1>🎉 Seasonal Event Portal</h1>

<div class="event-box">
    <img src="images/christmas_bg.png" alt="Christmas"><br>
    <h2>🎄 Christmas Event</h2>
    <p>Battle festive enemies and earn rare holiday rewards!</p>
    <a href="event_battle.php?event=christmas">Enter Christmas Event</a>
</div>

<div class="event-box">
    <img src="images/halloween_bg.png" alt="Halloween"><br>
    <h2>🎃 Halloween Event</h2>
    <p>Face spooky monsters and collect creepy loot!</p>
    <a href="event_battle.php?event=halloween">Enter Halloween Event</a>
</div>

<script>
// ❄ Create snowflakes
for (let i = 0; i < 40; i++) {
    const flake = document.createElement("div");
    flake.className = "snowflake";
    flake.textContent = "❄";
    flake.style.left = Math.random() * 100 + "vw";
    flake.style.animationDuration = (5 + Math.random() * 5) + "s";
    flake.style.fontSize = (12 + Math.random() * 24) + "px";
    document.body.appendChild(flake);
}
</script>

</body>
</html>
