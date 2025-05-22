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

if($uzytkownik['bendicion2_type'] == 4){
$oxtt = 2;
} else {
$oxtt = 0;
}

if($uzytkownik['nivel'] >= 2){

?>
<div id="popupmessage" style="display:block;filter:alpha(opacity=100);-moz-opacity:1.0;"></div>

<script type="text/javascript" src="4115/js/work.js"></script>

<p class="buildingDesc">

    <img src="img/praca.jpg" align="left" />

The Judiciary, the laboratory is located in the shadow of the building next door. You can choose different jobs here - none of them are particularly pleasant, but they are not nearly as dangerous as fighting in the arena.

<br><br>In some of the jobs do not pay much, but at least get paid for what remains to the end of the day.</p>

<?php

if($uzytkownik['rank'] > 2) {

//sprawdzamy czy gracz pracuje

if( ($uzytkownik['pracuje'] > 0) && ($uzytkownik['pracuje'] < time()) ){
    //jeżeli gracz ma ustawione, że pracuje, ale czas pracy już się zakończył to wydaj mu odpowiednią ilość złota za pracę i ustaw, że już nie pracuje
    
    //w naszym przykładzie ilość otrzymanego złota za wykonanie pracy zależy od posiadanych punktów 
    $zloto1 = 6 * (30 + 10 * $uzytkownik['punkty']) / 2;
	$zloto = $zloto1 + (int)($zloto1 * $oxtt);
    

    //wysyłamy polecenie do bazy danych
    mysql_query("update gracze set pracuje = 0, zloto = zloto + ".$zloto." where gracz = ".$uzytkownik['gracz']);
    
    //odświeżamy stronę
    header("Location: praca.php");
} elseif ($uzytkownik['pracuje'] > 0){
    //jeżeli gracz ma ustawione, że pracuje, ale czas pracy jeszcze się nie zakończył


    if(isset($_GET['przerwij'])){
        //jeżeli wciśnięto przerwanie pracy
        mysql_query("update gracze set pracuje = 0 where gracz = ".$uzytkownik['gracz']);
        //odświeżamy stronę
        header("Location: praca.php");
    }
    
    //obliczamy ile czasu pozostało do końca pracy
    $pozostalo = $uzytkownik['pracuje'] - time();

    //dodajemy funkcję liczącą czas
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
                document.getElementById("zegar").innerHTML = "[Finished]";
            }
        }
    </script><p><br><center>
    Your character is at work, time remaining: <span id='zegar'></span> <a href='praca.php?przerwij'>[Stop]</a> <?php echo "<script type='text/javascript'>liczCzas(".$pozostalo.")</script>"; ?>
    </p><?php

} else {
    //gracz nie pracuje
    
    if(isset($_GET['pracuj1'])){
        //jeżeli wciśnięto pracowanie
        
        //koniec pracy = aktualny czas + ilość_godzin * 3600
        $koniec = time() + 0.5 * 3600;
        mysql_query("update gracze set pracuje = ".$koniec." where gracz = ".$uzytkownik['gracz']);
        //odświeżamy stronę
        header("Location: praca.php");
    }

    //obliczamy ile otrzyma wynagrodzenia za pracę, u nas 4godziny
    $otrzyma1 = 6 * (30 + 10 * $uzytkownik['punkty']) / 2 * 1.20;
	$otrzyma = $otrzyma1 + (int)($otrzyma1 * $oxtt);
    

    echo "
    <p>
        <br><center>You can go to work. It lasts <b> 30 minutes </b> and get<b> ".$otrzyma." gold</b> -         <a href='praca.php?pracuj1'>[Go to work]</a>
    </p>
    ";
    
	}
} else {

//sprawdzamy czy gracz pracuje

if( ($uzytkownik['pracuje'] > 0) && ($uzytkownik['pracuje'] < time()) ){
    //jeżeli gracz ma ustawione, że pracuje, ale czas pracy już się zakończył to wydaj mu odpowiednią ilość złota za pracę i ustaw, że już nie pracuje
    
    //w naszym przykładzie ilość otrzymanego złota za wykonanie pracy zależy od posiadanych punktów 
    $zloto = 6 * (25 + 5 * $uzytkownik['punkty']);
    

    //wysyłamy polecenie do bazy danych
    mysql_query("update gracze set pracuje = 0, zloto = zloto + ".$zloto." where gracz = ".$uzytkownik['gracz']);
    
    //odświeżamy stronę
    header("Location: praca.php");
} elseif ($uzytkownik['pracuje'] > 0){
    //jeżeli gracz ma ustawione, że pracuje, ale czas pracy jeszcze się nie zakończył


    if(isset($_GET['przerwij'])){
        //jeżeli wciśnięto przerwanie pracy
        mysql_query("update gracze set pracuje = 0 where gracz = ".$uzytkownik['gracz']);
        //odświeżamy stronę
        header("Location: praca.php");
    }
    
    //obliczamy ile czasu pozostało do końca pracy
    $pozostalo = $uzytkownik['pracuje'] - time();

    //dodajemy funkcję liczącą czas
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
                document.getElementById("zegar").innerHTML = "[Finished]";
            }
        }
    </script><p><br><center>
    Your character is at work, time remaining: <span id='zegar'></span> <a href='praca.php?przerwij'>[Stop]</a> <?php echo "<script type='text/javascript'>liczCzas(".$pozostalo.")</script>"; ?>
    </p><?php

} else {
    //gracz nie pracuje
    
    if(isset($_GET['pracuj1'])){
        //jeżeli wciśnięto pracowanie
        
        //koniec pracy = aktualny czas + ilość_godzin * 3600
        $koniec = time() + 2 * 3600;
        mysql_query("update gracze set pracuje = ".$koniec." where gracz = ".$uzytkownik['gracz']);
        //odświeżamy stronę
        header("Location: praca.php");
    }

    //obliczamy ile otrzyma wynagrodzenia za pracę, u nas 4godziny
    $otrzyma = 6 * (25 + 5 * $uzytkownik['punkty']);
    

    echo "
    <p>
        <br><center>You can go to work. It lasts <b> 2 hours </b> and get<b> ".$otrzyma." gold</b> -         <a href='praca.php?pracuj1'>[Go to work]</a>
    </p>
    ";
    
}
}
} else {

echo "<h2>No tienes nivel suficiente.</h2>";

}
//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?> 
