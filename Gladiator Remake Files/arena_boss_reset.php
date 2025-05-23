<?php
session_start();
unset($_SESSION['boss_enemy']);
unset($_SESSION['boss_enemy_hp']);
unset($_SESSION['boss_player_hp']);
unset($_SESSION['boss_log']);
unset($_SESSION['boss_skill_cd']);
header("Location: arena_boss.php");
exit;
