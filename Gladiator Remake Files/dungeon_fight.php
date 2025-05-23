<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id']) || !isset($_SESSION['dungeon_enemy'])) {
    header("Location: dungeon.php");
    exit;
}

$player_id = $_SESSION['id'];
$player = $conn->query("SELECT * FROM gracze WHERE id = $player_id")->fetch_assoc();
if (!$player) die("Player not found.");

$enemy = $_SESSION['dungeon_enemy'];
$enemy_hp = $_SESSION['dungeon_enemy_hp'];
$player_hp = $_SESSION['dungeon_player_hp'];
$log = $_SESSION['dungeon_log'] ?? [];
$time = date("H:i:s");

// Damage calculation
$player_dmg = rand(10, 20) + floor($player['sila'] * 0.5);
$enemy_dmg = rand($enemy['min_dmg'], $enemy['max_dmg']);

// Player attacks
$enemy_hp -= $player_dmg;
$log[] = "<span style='color:green;'>[$time] You hit {$enemy['name']} for $player_dmg damage!</span>";

// Enemy attacks back if alive
if ($enemy_hp > 0) {
    $player_hp -= $enemy_dmg;
    $log[] = "<span style='color:red;'>[$time] {$enemy['name']} hits you for $enemy_dmg damage!</span>";
}

// Victory
if ($enemy_hp <= 0 && $player_hp > 0) {
    $xp = $enemy['xp_reward'];
    $gold = $enemy['gold_reward'];

    $new_exp = $player['exp'] + $xp;
    $new_lvl = $player['nivel'];
    $new_hp = $player['zycie'];
    $new_str = $player['sila'];
    $leveled_up = false;

    while ($new_exp >= $new_lvl * 100) {
        $new_exp -= $new_lvl * 100;
        $new_lvl++;
        $new_hp += 10;
        $new_str += 2;
        $leveled_up = true;
        $log[] = "<span style='color:gold;'>🎉 Level up! Now level $new_lvl. +10 HP, +2 Strength!</span>";
    }

    $stmt = $conn->prepare("UPDATE gracze SET exp = ?, nivel = ?, zloto = zloto + ?, zycie = ?, sila = ? WHERE id = ?");
    $stmt->bind_param("iiiiii", $new_exp, $new_lvl, $gold, $new_hp, $new_str, $player_id);
    $stmt->execute();

    $log[] = "<span style='color:purple;'>🏆 You defeated {$enemy['name']}! +$xp XP, +$gold gold</span>";
}

// Save battle state
$_SESSION['dungeon_enemy_hp'] = max(0, $enemy_hp);
$_SESSION['dungeon_player_hp'] = max(0, $player_hp);
$_SESSION['dungeon_log'] = $log;

header("Location: dungeon.php");
exit;
