<?php
session_start();
unset($_SESSION['dungeon_enemy']);
unset($_SESSION['dungeon_enemy_hp']);
unset($_SESSION['dungeon_player_hp']);
unset($_SESSION['dungeon_log']);
unset($_SESSION['enemy_skill_cds']);
header("Location: dungeon.php");
exit;
