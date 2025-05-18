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
 if($uzytkownik['rank'] > 2){
?>
<br><center>
<p><b>Create Weapons/Armours</b></p><hr/>
<?php
    
    if(isset($_POST['create'])){

        $nazwa = $_POST['nazwa'];
        $typ = $_POST['typ'];
		$cena_kup = $_POST['cena_kup'];
		$cena_sprzedaj = $_POST['cena_sprzedaj'];
		$rubies = $_POST['rubies'];
		$atak = $_POST['atak'];
		$obrona = $_POST['obrona'];
		$sila_i = $_POST['sila_i'];
		$zrecznosc_i = $_POST['zrecznosc_i'];
		$wyrzymalosc_i = $_POST['wyrzymalosc_i'];
		$constitucion_i = $_POST['constitucion_i'];
		$carisma_i = $_POST['carisma_i'];
		$inteligencja_i = $_POST['inteligencja_i'];
		$mdchance_i = $_POST['mdchance_i'];
		$dhchance_i = $_POST['dhchance_i'];
		$ctchance_i = $_POST['ctchance_i'];
		$zycie_max = $_POST['zycie_max'];
		$obrazenia_min = $_POST['obrazenia_min'];
		$obrazenia_max = $_POST['obrazenia_max'];
		$obrazek = $_POST['obrazek'];
		$level = $_POST['level'];
		
		$mysql = "INSERT INTO przedmioty set 
		sila = ".$sila_i.", 
		zrecznosc = ".$zrecznosc_i.", 
		wyrzymalosc = ".$wyrzymalosc_i.", 
		constitucion = ".$constitucion_i.", 
		carisma = ".$carisma_i.", 
		inteligencja = ".$inteligencja_i.", 
		mdchance = ".$mdchance_i.", 
		dhchance = ".$dhchance_i.", 
		ctchance = ".$ctchance_i.", 
		nazwa = '".$nazwa."', 
		typ = '".$typ."', 
		cena_kup = '".$cena_kup."', 
		cena_sprzedaj = '".$cena_sprzedaj."', 
		rubies = '".$rubies."', 
		atak = '".$atak."', 
		obrona = '".$obrona."', 
		zycie_max = '".$zycie_max."', 
		obrazenia_min = '".$obrazenia_min."', 
		obrazenia_max = '".$obrazenia_max."', 
		obrazek = '".$obrazek."', 
		level = '".$level."'";
		$query = mysql_query($mysql);
		if($query){
		echo 'Ready!';
		}
		}
		{
			 
    echo "<p><form action='items.php' method='post'>
            
			
			
				<center>Name
            
                <center><input name='nazwa' size='30' maxlength='30' class='input' tabindex='2' value='' type='text'>
                
				<center>Type<br>
				<select name='typ'>
				<option value='bron'>Weapon</option>
				<option value='tarcza'>Shell</option>
				<option value='zbroja'>Chest</option>
				<option value='helm'>Helm</option>
				<option value='buty'>Boots</option>
				<option value='pusty'>Gloves</option>
				<option value='pierscien'>Ring</option>
				<option value='amulet'>Amulet</option>
				</select>
				
				<center>Purchase price
            
                <center><input name='cena_kup' size='10' maxlength='10' class='input' tabindex='2' value='' type='text'>
				
				<center>Purchase rubies
            
                <center><input name='rubies' size='10' maxlength='10' class='input' tabindex='2' value='' type='text'>
				
				
				<center>Resale price
            
                <center><input name='cena_sprzedaj' size='10' maxlength='10' class='input' tabindex='2' value='' type='text'>
				
				
                <center>Attack
            
                <center><input name='atak' size='9' maxlength='9' class='input' tabindex='2' value='' type='text'>				
				
				
				<center>Defense
            
                <center><input name='obrona' size='9' maxlength='9' class='input' tabindex='2' value='' type='text'>
				
				<center>Strength
            
                <center><input name='sila_i' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>				
				
				<center>Ability
            
                <center><input name='zrecznosc_i' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>				
				
				<center>Agility
            
                <center><input name='wyrzymalosc_i' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>				
				
				<center>Constitution
            
                <center><input name='constitucion_i' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>				
				
				<center>Charisma
            
                <center><input name='carisma_i' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>				
				
				<center>Intelligence
            
                <center><input name='inteligencja_i' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>				
				
				<center>Dodge
            
                <center><input name='mdchance_i' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>				
				
				<center>Doble~hit
            
                <center><input name='dhchance_i' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>				
				
				<center>Critical chance
            
                <center><input name='ctchance_i' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>				
				
				
				<center>Life
            
                <center><input name='zycie_max' size='7' maxlength='7' class='input' tabindex='2' value='' type='text'>
				
				
				<center>Damage min - Damage max
            
                <center><input name='obrazenia_min' size='8' maxlength='3' class='input' tabindex='2' value='' type='text'>
				
				<input name='obrazenia_max' size='8' maxlength='3' class='input' tabindex='2' value='' type='text'>
				
				
				<center>Image
            
                <center><input name='obrazek' size='5' maxlength='5' class='input' tabindex='2' value='' type='text'>
				
				
				<center>Level
            
                <center><input name='level' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>
            
            
                <center><br><input name='create' value='Create' class='button3' type='submit'>
				
    </form></p>";
	
	}

} else {

echo 'You do not have enough rank to this product.';

}

//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?>