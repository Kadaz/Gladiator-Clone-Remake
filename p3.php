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

		$pozostalo = $uzytkownik['bendicion3_time'] - time();

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

if($uzytkownik['bendicion3_time'] > 0) {

echo 'Already have this covenant asset.';

} else {

if(!empty($_GET['pb3'])){
    //jeżeli gracz wcisnął trenowanie jakiegoś atrybutu, w zmiennej $_GET['trenuj'] przetrzymywany jest typ
    
switch($_GET['pb3']){
		 
case 1:
	
if($uzytkownik['rubies'] >= 14) {

$koniec = time() + (24 * 14) * 3600;

echo "Congratulations, you've activated your covenant!";

mysql_query("update gracze set rubies = rubies - 14, bendicion3_time = '".$koniec."', bendicion3_type = 1 where gracz = ".$uzytkownik['gracz']);

} else { 

echo 'You do not have enough rubies.';

}
break;
case 2:
	
if($uzytkownik['rubies'] >= 14) {

$koniec = time() + (24 * 14) * 3600;

echo "Congratulations, you've activated your covenant!";

mysql_query("update gracze set rubies = rubies - 14, bendicion3_time = '".$koniec."', bendicion3_type = 2 where gracz = ".$uzytkownik['gracz']);

} else { 

echo 'You do not have enough rubies.';

}
break;
case 3:
	
if($uzytkownik['rubies'] >= 14) {

$koniec = time() + (24 * 14) * 3600;

echo "Congratulations, you've activated your covenant!";

mysql_query("update gracze set rubies = rubies - 14, bendicion3_time = '".$koniec."', bendicion3_type = 3 where gracz = ".$uzytkownik['gracz']);

} else { 

echo 'You do not have enough rubies.';

}
break;
case 4:
	
if($uzytkownik['rubies'] >= 14) {

$koniec = time() + (24 * 14) * 3600;

echo "Congratulations, you've activated your covenant!";

mysql_query("update gracze set rubies = rubies - 14, bendicion3_time = '".$koniec."', bendicion3_type = 4 where gracz = ".$uzytkownik['gracz']);

} else { 

echo 'You do not have enough rubies.';

}
break;
case 5:
	
if($uzytkownik['rubies'] >= 14) {

$koniec = time() + (24 * 14) * 3600;

echo "Congratulations, you've activated your covenant!";

mysql_query("update gracze set rubies = rubies - 14, bendicion3_time = '".$koniec."', bendicion3_type = 5 where gracz = ".$uzytkownik['gracz']);

} else { 

echo 'You do not have enough rubies.';

}
        break;		
		
		default:
            //jeżeli wybrał typ którego nie ma (np sam coś kombinuje w adresie strony, chcąc namieszać)
            echo "<p>No such covenant.</p>";
        break;
}
}
}
//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?>