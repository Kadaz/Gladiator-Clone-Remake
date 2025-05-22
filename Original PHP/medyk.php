<?php
//włączamy bufor
ob_start();

//pobieramy zawartość pliku ustawień
require_once('var/ustawienia.php');

//startujemy lub przedłużamy sesję
session_start();

//dołączamy plik, który sprawdzi czy napewno mamy dostęp do tej strony
require_once('test_zalogowanego.php');

//sprawdzamy czy gracz pracuje
if ($uzytkownik['pracuje'] > 0){
    //jeżeli gracz ma ustawione, że pracuje, to nie ma dostępu do medyka i przenosimy go do zakładki praca
    header("Location: praca.php");
}

//pobieramy nagłówek strony
require_once('gora_strony2.php');
//pobieramy zawartość menu
require_once('menu.php');
?><br><center>

<p><b>Hospital</b></p><hr/>
<p>
Welcome to the Hospital <?php echo $uzytkownik['login']; ?>.<br/>
<hr/>

</p>
<?php

    //gracz nie pracuje
    
    if(isset($_POST['lecz'])){
        //jeżeli wciśnięto leczenie
        
        //ustaw ile gracz chce wyleczyć życia, upewnij się, że wpisano liczbę
        $lecz = (int)$_POST['lecz'];

        //startowy koszt leczenia
        $koszt = 3;
        
        //cena leczenia - tyle gracz musi zapłacić
        $cena = $lecz * $koszt;
        
        if($lecz < 1){
            //gracz wpisał nieprawidłową wartość
            echo "Wrong value.<hr/>";
        }elseif($uzytkownik['zloto'] < $cena){
            //gracz nie posiada tyle złota, nie może się zatem wyleczyć
            echo "You do not have much gold.<hr/>";

        }elseif($uzytkownik['zycie_max'] - $uzytkownik['zycie'] < $lecz){
            //gracz próbuje wyleczyć więcej życia niż stracił 
            echo "Not lost life.<hr/>";

        } else {
            //gracz ma odpowiednią ilość złota i może wyleczyć taką ilość punktów życia

             mysql_query("update gracze set zloto = zloto - ".$cena.", zycie = zycie + ".$lecz." where gracz = ".$uzytkownik['gracz']);

             $uzytkownik['zloto'] -= $cena;
             $uzytkownik['zycie'] += $lecz;
        }



    }

    

    echo "
    <p>
    You have ".$uzytkownik['zloto']." gold.<br/>
    Life: ".$uzytkownik['zycie']." / ".$uzytkownik['zycie_max']."<br/><br/>
     <form action='medyk.php' method='post'>
    Cure: <input type='text' name='lecz' value='".($uzytkownik['zycie_max']-$uzytkownik['zycie'])."'/>
    <input type ='submit' value='Heal!'/>
    </form>
    </p>
    ";

//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?> 
