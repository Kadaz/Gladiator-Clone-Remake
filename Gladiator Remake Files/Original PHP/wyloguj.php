<?php
//włączamy bufor
ob_start();

//startujemy lub przedłużamy sesję
session_start();

//czyścimy dane sesji
$_SESSION = array();

//niszczymy sesję
session_destroy();

//przenosimy użytkownika do strony głównej
header('Location: index.php');
//wyłączamy bufor
ob_end_flush();
?> 