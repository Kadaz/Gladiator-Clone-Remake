// ✅ arena_boss.php
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

// Get random boss enemy
$result = $conn->query("SELECT * FROM enemies WHERE is_boss = 1 ORDER BY RAND() LIMIT 1");
if ($enemy = $result->fetch_assoc()) {
    $enemy['hp'] = rand($enemy['min_hp'], $enemy['max_hp']);
    $_SESSION['enemy'] = $enemy;
    $_SESSION['battle_enemy_hp'] = $enemy['hp'];
    $_SESSION['battle_player_hp'] = 100; // or from player data
    $_SESSION['battle_log'] = [];
    $_SESSION['skill_cooldowns'] = [];
    $_SESSION['reward_given'] = false;
} else {
    echo "<p>No boss enemies available.</p>";
    exit;
}

header("Location: battle.php");
exit;
?>
