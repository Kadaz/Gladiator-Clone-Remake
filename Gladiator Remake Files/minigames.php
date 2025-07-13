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

<h2>🎮 Mini-Games</h2>
<p>Welcome to the Arena of Fun! Choose a game and try your luck to win rewards.</p>

<div style="margin-top:20px;">
    <ul style="list-style:none;padding:0;">
	<p><li><a href="minigame_leaderboard.php">📊 Mini-Game Leaderboard</a></li></p>
        <li>
            🎲 <strong>Guess the Number</strong><br>
            <a href="minigame_guess.php"><button>Play</button></a>
            <small>Guess a number from 1 to 10 and win coins if correct!</small>
        </li>
        <li>
            ✊✋✌️ <strong>Rock-Paper-Scissors</strong><br>
            <a href="rock_paper_scissors.php"><button>Play</button></a>
            <small>Choose rock or paper or scissors</small>
        </li>
		<li>
            🍀 <strong>Spin Wheel</strong><br>
            <a href="spin_wheel.php"><button>Play</button></a>
            <small>The player presses a button to “spin” the wheel.The result appears randomly from a few predetermined choices.</small>
        </li>
		<li>
            🧠 <strong>Memory Flip</strong><br>
            <a href="minigame_memory.php"><button>Play</button></a>
            <small>The player is asked to find 2 identical emojis among 6 hidden boxes (3 pairs). If they find them in 3 attempts or less, they win 10 coins and 1 premium coin. The system counts the attempts and has a limit of 3 times/day.</small>
        </li>

        <!-- Μπορείς να προσθέσεις κι άλλα εδώ -->
        <!--
        <li>
            🃏 <strong>Card Flip</strong><br>
            <a href="minigame_cards.php"><button>Play</button></a>
            <small>Flip a card to win a random reward!</small>
        </li>
        -->
    </ul>
</div>

<br><a href="index.php">← Back to Dashboard</a>
