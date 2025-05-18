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

?> <br><center>
<?php
//wyświetlimy nagłówek sklepu
echo "<p><b>Shop</b><hr/></p>";

//wyświetlamy działy sklepu
echo "
<div style='width:100%; text-align:center;'>
    
	<a target='' title='Weapon' href='sklep.php?typ=bron' >
    <img src='www/przedmioty/miecz4.png'></a>
| 
    
<a target='' title='Shell' href='sklep.php?typ=tarcza' >
    <img src='www/przedmioty/tarcza4.png'></a>	| 
    
<a target='' title='Chest' href='sklep.php?typ=zbroja' >
    <img src='www/przedmioty/zbroja2.png'></a>	| 
    
	<a target='' title='Helm' href='sklep.php?typ=helm' >
    <img src='www/przedmioty/helm10.png'></a><br>
	
	<a target='' title='Boots' href='sklep.php?typ=buty' >
    <img src='www/przedmioty/buty3.png'></a>	| 
	
	<a target='' title='Gloves' href='sklep.php?typ=pusty' >
    <img src='www/przedmioty/pusty.png'></a>	| 
	
	<a target='' title='Rings' href='sklep.php?typ=pierscien' >
    <img src='www/przedmioty/pierscien1.png'></a>	| 
	
	<a target='' title='Amulet' href='sklep.php?typ=amulet' >
    <img src='www/przedmioty/amulet3.png'></a>
	
</div>
<hr/>

";


//lista typów przedmiotów, bez polskich liter
$typy = array('bron','tarcza','zbroja','helm','buty','pusty','pierscien','amulet');


//jeżeli nie wybrano typu to ustawiamy domyślny typ przedmiotów do kupienia na broń
if(empty($_GET['typ'])) $_GET['typ'] = 'bron';

//sprawdzamy czy gracz wybrał dozwolony typ przedmiotów, jeżeli nie, to pokaż listę broni
if(!in_array($_GET['typ'],$typy)) $_GET['typ'] = 'bron';
//więcej o in_array możesz poczytać na http://php.net/manual/pl/function.in-array.php

//sprawdzamy czy przypadkiem nie wybrał kupna jakiegoś przedmiotu
if(!empty($_GET['kup'])){
    //w zmiennej kup przechowuje się tylko numer kupowanego przedmiotu, zatem wykonajmy rzutowanie typu na liczbę całkowitą, zabezpieczając tym samym skrypt przed niechcianymi danymi
    $_GET['kup'] = (int)$_GET['kup'];

    //pobierzmy dane kupowanego przedmiotu
    $item = mysql_fetch_array(mysql_query("select * from przedmioty where przedmiot = ".$_GET['kup']." and typ='".$_GET['typ']."' order by level desc"));

    if(empty($item)){
        //jeżeli taki przedmiot nie istnieje, np bo gracz kombinował w adresie strony wpisując samemu jakieś nieistniejące dane
        echo "No items to sell in the store.<hr/>";
    } elseif($item['cena_kup'] > $uzytkownik['zloto']) {
        //przedmiot jest, ale gracz nie ma tyle złota
        echo "You do not have enough gold.<hr/>";
    } else {
	
if($uzytkownik['bendicion2_type'] == 2){
$ipbt = 0.75;
} else {
$ipbt = 1;
}

if($uzytkownik['bendicion2_type'] == 3){
$ipbt = 0.85;
} else {
$ipbt = 1;
}

$item['cena_kup'] = (int)($item['cena_kup'] * $ipbt);
	
        //wszystko ok, kup przedmiot
        mysql_query("insert into przedmioty_gracze (gracz_id, przedmiot_id) value (".$uzytkownik['gracz'].",".$_GET['kup'].")");
        
        //zabierz odpowiednią ilość złota graczowi
        mysql_query("update gracze set zloto = zloto - ".$item['cena_kup']." where gracz = ".$uzytkownik['gracz']);

        $uzytkownik['zloto'] -= $item['cena_kup'];
        echo "Bought: <i>".$item['nazwa']."</i> <hr/>";
    }
} elseif(!empty($_GET['sprzedaj'])){
    // a może wciśnięto sprzedaż przedmiotu


    $_GET['sprzedaj'] = (int)$_GET['sprzedaj'];

    //pobierzmy dane przedmiotu
    $item = mysql_fetch_array(mysql_query("select * from przedmioty_gracze inner join przedmioty on przedmiot_id = przedmiot where id = ".$_GET['sprzedaj']." and typ='".$_GET['typ']."' and gracz_id = ".$uzytkownik['gracz']));

    if(empty($item)){
        //jeżeli taki przedmiot nie istnieje, np bo gracz kombinował w adresie strony wpisując samemu jakieś nieistniejące dane
        echo "You do not have this type of object.<hr/>";
    } elseif($item['zalozony'] == 1){
        //jeżeli przedmiot jest założony to nie można go sprzedawać
        echo "You may not sell this item.<hr/>";
    }else {
        //wszystko ok, sprzedaj przedmiot
        mysql_query("delete from przedmioty_gracze where gracz_id = ".$uzytkownik['gracz']." and id= ".$_GET['sprzedaj']);
        
        //zabierz odpowiednią ilość złota graczowi
        mysql_query("update gracze set zloto = zloto + ".$item['cena_sprzedaj']." where gracz = ".$uzytkownik['gracz']);

        $uzytkownik['zloto'] += $item['cena_sprzedaj'];
        echo "Sell ​​order: <i>".$item['nazwa']."</i> <hr/>";
    }
}

// wyświetl info o stanie portfela gracza
echo "
You have ".$uzytkownik['zloto']." gold.
<hr/>
";


//pobieramy przedmioty ze sklepu, jeżeli chcesz by były pobierane wg ceny rosnąco zamień DESC na ASC

$nivel = $uzytkownik['nivel'] + 5;
$nivel2 = $uzytkownik['nivel'] - 20;
if($nivel2 < 1){
$nivel2 = 1;
} else {
$nivel2 = $uzytkownik['nivel'] - 20;
}

$sql = mysql_query("select * from przedmioty where typ='".$_GET['typ']."' and cena_kup >= 1 and level <= ".$nivel." and level >= ".$nivel2." order by level desc LIMIT 10");

//sprawdzamy ilość wyszukanych przedmiotów
if(mysql_num_rows($sql) == 0)
    echo "No objects of this type in stock.";
else {

    //wyświetlamy nagłówek tabelki z listą przedmiotów
    echo "
    <table>
    <tr align='center'>
        <th>Name</th>
        <th>Price</th>
		<th>Level</th>
        <th>Basics</th>
        <th>Stats</th>
		<th>Extras</th>
        <th></th>
    </tr>
    ";

    while($przedmiot = mysql_fetch_array($sql)){
        $opcje = "Insufficient gold.";

        //jeżeli gracz ma odpowiednią ilość złota to pokazujemy link do kupna
        if($uzytkownik['zloto'] >= $przedmiot['cena_kup']){
            $opcje = "<a href='sklep.php?typ=".$_GET['typ']."&kup=".$przedmiot['przedmiot']."'>Buy!</a>";
        } 
		
if($uzytkownik['bendicion2_type'] == 1){
$ipbt = 2;
} else {
$ipbt = 1;
}

$przedmiot['cena_kup'] = (int)($przedmiot['cena_kup'] / $ipbt);

        //dla każdego przedmiotu wyświetlamy jego dane
        echo "
        <tr align='center'>
            <td align='left'><center>".$przedmiot['nazwa']."<br><img src='items/".$przedmiot['obrazek'].".gif'></td>
            <td><center>".$przedmiot['cena_kup']."<img src='items/res2.gif'></td>
			<td><center>Level: ".$przedmiot['level']."</td>
			<td><center>Strength ".$przedmiot['sila']."
            <br><center>Ability: ".$przedmiot['zrecznosc']."
            <br><center>Agility: ".$przedmiot['wyrzymalosc']."
            <br><center>Constitution: ".$przedmiot['constitucion']."
			<br><center>Charisma: ".$przedmiot['carisma']."
            <br><center>Intelligence:".$przedmiot['inteligencja']."</td>
            <td><center>Attack: ".$przedmiot['atak']."
            <br><center>Defense: ".$przedmiot['obrona']."
            <br><center>Life: ".$przedmiot['zycie_max']."
            <br><center>Damage min: ".$przedmiot['obrazenia_min']."
            <br><center>Damage max:".$przedmiot['obrazenia_max']."</td>
			<td><center>Dodge: ".$przedmiot['mdchance']."
			<br><center>Doble~hit: ".$przedmiot['dhchance']."
			<br><center>Critical chance: ".$przedmiot['ctchance']."</td>
            <td align='right'><center>".$opcje."</td>
        </tr>
        ";
    }
    echo "
    </table>
    ";
}


//pobieramy przedmioty z ekwipunku gracza, ale tylko te, które nie są założone (zalozony = 0)
$sql = mysql_query("select * from przedmioty_gracze inner join przedmioty on przedmiot_id = przedmiot where gracz_id = ".$uzytkownik['gracz']." and zalozony = 0");

//sprawdzamy ilość wyszukanych przedmiotów
if(mysql_num_rows($sql) != 0) {
    //jeżeli gracz ma jakieś niezałożone przedmioty w ekwipunku
    //wyświetlamy nagłówek tabelki z listą przedmiotów
    echo "
    <br/><br/><b>Bag</b><hr/>
    <table>
    <tr align='center'>
    <th>Name	|<br>Image	|</th>
    <th>Price		|</th>
	<th>Level		|</th>
    <th>Basics		|</th>
    <th>Stats		|</th>
	<th>Extras		|</th>
    <th></th>
    </tr>
    </tr>
    ";

    while($przedmiot = mysql_fetch_array($sql)){

        //dla każdego przedmiotu wyświetlamy jego dane
        echo "
        <tr align='center'>
            <td align='left'><center>".$przedmiot['nazwa']."<br><img src='items/".$przedmiot['obrazek'].".gif'></td>
            <td><center>".$przedmiot['cena_sprzedaj']."<img src='items/res2.gif'></td>
			<td><center>".$przedmiot['level']."</td>
			<td><center>Strength ".$przedmiot['sila']."
            <br><center>Ability: ".$przedmiot['zrecznosc']."
            <br><center>Agility: ".$przedmiot['wyrzymalosc']."
            <br><center>Constitution: ".$przedmiot['constitucion']."
			<br><center>Charisma: ".$przedmiot['carisma']."
            <br><center>Intelligence:".$przedmiot['inteligencja']."</td>
            <td><center>Attack: ".$przedmiot['atak']."
            <br><center>Defense: ".$przedmiot['obrona']."
            <br><center>Life: ".$przedmiot['zycie_max']."
            <br><center>Damage min: ".$przedmiot['obrazenia_min']."
            <br><center>Damage max:".$przedmiot['obrazenia_max']."</td>
			<td><center>Dodge: ".$przedmiot['mdchance']."
            <br><center>Doble~hit: ".$przedmiot['dhchance']."
            <br><center>Critical chance: ".$przedmiot['ctchance']."</td>
            <td align='right'><a href='sklep.php?typ=".$przedmiot['typ']."&sprzedaj=".$przedmiot['id']."'><center>Sell!</a></td>
        </tr>
        ";
    }
    echo "
    </table><br>
    ";
}


//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?> 
