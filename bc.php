<?php
//włączamy bufor
ob_start();

//pobieramy zawartość pliku ustawień
require_once('var/ustawienia.php');

//startujemy lub przedłużamy sesję
session_start();

//dołączamy plik, który sprawdzi czy napewno mamy dostęp do tej strony
require_once('test_zalogowanego.php');


//pobieramy nagłówek strony
require_once('gora_strony2.php');
 //pobieramy zawartość menu
require_once('menu.php');

echo '<center><br>';

		$pozostalo = $uzytkownik['centurion_time'] - time();

    ?>
    <script type='text/javascript'>        
        function liczCzas(ile) {
            godzin = Math.floor(ile / 3600);
            minut = Math.floor((ile - godzin * 3600) / 60);
            sekund = ile - minut * 60 - godzin * 3600;
            if (godzin < 10){ godzin = "0"+ godzin; }
            if (minut < 10){ minut = "0" + minut; }
            if (sekund < 10){ sekund = "0" + sekund; }
            if (ile > 0) {
                ile--;
                document.getElementById("zegar").innerHTML = godzin + ':' + minut + ':' + sekund;
                setTimeout("liczCzas("+ile+")", 1000);
            } else {
                document.getElementById("zegar").innerHTML = "[Not centurion]";
            }
        }
    </script><p><br><center>
    Your character is a centurion, time remaining: <span id='zegar'></span> <?php echo "<script type='text/javascript'>liczCzas(".$pozostalo.")</script>"; ?>
    </p><?php

if($uzytkownik['centurion_time'] > 0) {

echo 'Already centurion!';

} else {
	
if($uzytkownik['rubies'] >= 14) {

$koniec = time() + (24 * 14) * 3600;

echo 'Congratulations are centurion!';

mysql_query("update gracze set rubies = rubies - 14, centurion_time = '".$koniec."', rank = 2 where gracz = ".$uzytkownik['gracz']);

} else { 

echo 'You do not have enough rubies.';

}
}

//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?>