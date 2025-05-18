<?php
//włączamy bufor
ob_start();

//pobieramy zawartość pliku ustawień
require_once('var/ustawienia.php');

//startujemy lub przedłużamy sesję
session_start();

//dołączamy plik, który sprawdzi czy napewno mamy dostęp do tej strony
require_once('test_zalogowanego.php');

//jeżeli wciśnięto przesyłanie obrazka
if(isset($_FILES['obrazek'])){
    $plik = $_FILES['obrazek']['tmp_name'];
    $plik_nazwa = $_FILES['obrazek']['name'];

    //jeżeli zakończono wgrywanie obrazka
    if(is_uploaded_file($plik)) {
        //przenieś do folderu avatarów
        move_uploaded_file($plik, "avatar/".$uzytkownik['gracz'].".jpg");

        //ustaw aktywny avatar
        mysql_query("update gracze set avatar = 1 where gracz = ".$uzytkownik['gracz']);
    } 
} 
    


//pobieramy nagłówek strony
require_once('gora_strony2.php');
//pobieramy zawartość menu
require_once('menu.php');

if($uzytkownik['rank'] > 4){

$uzytkownik['rank'] = 'Game Master';

} elseif($uzytkownik['rank'] > 3){

$uzytkownik['rank'] = 'Manager';

} elseif($uzytkownik['rank'] > 2){

$uzytkownik['rank'] = 'Moderator';

}

?>
<h><center><p><b>¡Hello <?php echo $uzytkownik['login']; ?>!<br> ¡Welcome to ADMIN PANEL! You rank is: <?php echo $uzytkownik['rank']; ?>!</b><hr/></p>
<?php

//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?> 
