<?php
$host_bazy_danych = 'localhost'; // Host predeterminado del MYSQL
$uzytkownik_bazy_danych = 'root'; // Usuario del MYSQl
$haslo_bazy_danych = '3227'; // Contraseña para el usuario del MYSQL
$nazwa_bazy_danych = 'gladiatus';  // Nombre de la DB

$polacz = mysql_connect($host_bazy_danych, $uzytkownik_bazy_danych, $haslo_bazy_danych) or die('Error');

mysql_select_db($nazwa_bazy_danych, $polacz) or die('Error');

mysql_query("SET NAMES 'utf8'");
?>
