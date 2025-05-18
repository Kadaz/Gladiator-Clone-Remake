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


?><br><center>

<p><b>Bank</b></p><hr/>
<p>
Our city is not as great as it seems, it goes! In a batch of bank is best to hide our gold.</br>
<hr/>
</p>
<?php
if(!empty($_POST['wplac'])){
    //jeżeli gracz wpłaca złoto do skarbca

    //zabezpiecz dane, można przesłać tylko liczby
    $_POST['wplac'] = (int)$_POST['wplac'];

    if($_POST['wplac'] < 2) {
        //można wpłacić minimum 2 złota
        echo "<p>Not enough gold deposit, minimum 2 gold.</p>";
    } else {
        //pobierz 10% podatku
        $podatek = floor($_POST['wplac'] * 0.05);

        //ustaw minimalny podatek = 1
        if($podatek < 1) $podatek = 1;
        
        //od wpłacanej kwoty odejmij podatek
        $kwota_wplacana = $_POST['wplac'] - $podatek;

        //wpłać
        mysql_query("update gracze set zloto = zloto - ".$_POST['wplac'].", zloto_skarbiec = zloto_skarbiec + ".$kwota_wplacana." where gracz = ".$uzytkownik['gracz']);

        //wyświetl wiadomość
        echo "<p>You have saved a total of ".$_POST['wplac']." gold in the bank, the bank takes ".$podatek." gold as taxes and saved the bank a total of ".$kwota_wplacana." gold.</p>";


        //zmień stan bez przeładowania strony
        $uzytkownik['zloto'] -= $_POST['wplac'];
        $uzytkownik['zloto_skarbiec'] += $kwota_wplacana;

    }
} elseif(!empty($_POST['wyplac'])){
    //jeżeli gracz wpłaca złoto do skarbca

    //zabezpiecz dane, można przesłać tylko liczby
    $_POST['wyplac'] = (int)$_POST['wyplac'];
    

    if($_POST['wyplac'] < 1) {
        //gracz chce wypłacić wartość ujemną
        echo "<p>The amount must be positive.</p>";
    } elseif($_POST['wyplac'] > $uzytkownik['zloto_skarbiec']) {
        //gracz chce wypłacić za dużo
        echo "<p>You do not have enough gold in the bank.</p>";
    } else {
        
        //wpłać
        mysql_query("update gracze set zloto_skarbiec = zloto_skarbiec - ".$_POST['wyplac'].", zloto = zloto + ".$_POST['wyplac']." where gracz = ".$uzytkownik['gracz']);

        //wyświetl wiadomość
        echo "<p>You withdraw the bank: ".$_POST['wyplac']." gold.</p>";


        //zmień stan bez przeładowania strony
        $uzytkownik['zloto'] += $_POST['wyplac'];
        $uzytkownik['zloto_skarbiec'] -= $_POST['wyplac'];

    }
}
?>
<p>
You have: <?php echo $uzytkownik['zloto'] ?> gold.<br/>
You keep in the bank: <?php echo $uzytkownik['zloto_skarbiec'] ?> gold.<br/>
<form action='skarbiec.php' method='post'>
    <p>
        Deposit: <input type='text' name='wplac' value='<?php echo $uzytkownik['zloto'] ?>'/>
        <input type='submit' value='Deposit!'/>
        <br/>
    </p>
</form>

<form action='skarbiec.php' method='post'>
    <p>
        Withdraw: <input type='text' name='wyplac' value='<?php echo $uzytkownik['zloto_skarbiec'] ?>'/>
        <input type='submit' value='Withdraw!'/>
        <br/>
    </p>
</form>
</p>
<?php

//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?> 
