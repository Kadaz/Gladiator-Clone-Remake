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
?>
<br><center>
<p><b>Create Monsters</b></p><hr/>
<?php

 if($uzytkownik['rank'] > 2){
    
    if(isset($_POST['create'])){

        $nazwa = $_POST['nazwa'];
		$obrazek = $_POST['obrazek'];
        $atak = $_POST['atak'];
		$atak_max = $_POST['atak_max'];
		$obrona = $_POST['obrona'];
		$obrona_max = $_POST['obrona_max'];
		$sila = $_POST['sila'];
		$sila_max = $_POST['sila_max'];
		$zrecznosc = $_POST['zrecznosc'];
		$zrecznosc_max = $_POST['zrecznosc_max'];
		$wyrzymalosc = $_POST['wyrzymalosc'];
		$wyrzymalosc_max = $_POST['wyrzymalosc_max'];
		$constitucion = $_POST['constitucion'];
		$constitucion_max = $_POST['constitucion_max'];
		$carisma = $_POST['carisma'];
		$carisma_max = $_POST['carisma_max'];
		$inteligencja = $_POST['inteligencja'];
		$inteligencja_max = $_POST['inteligencja_max'];
		$mdchance = $_POST['mdchance'];
		$mdchance_max = $_POST['mdchance_max'];
		$dhchance = $_POST['dhchance'];
		$dhchance_max = $_POST['dhchance_max'];
		$ctchance = $_POST['ctchance'];
		$ctchance_max = $_POST['ctchance_max'];
		$zycie = $_POST['zycie'];
		$zycie_max = $_POST['zycie_max'];
		$obrazenia_min = $_POST['obrazenia_min'];
		$obrazenia_min_max = $_POST['obrazenia_min_max'];
		$obrazenia_max = $_POST['obrazenia_max'];
		$obrazenia_max_max = $_POST['obrazenia_max_max'];
		$exp = $_POST['exp'];
		$exp_max = $_POST['exp_max'];
		$oro_min = $_POST['oro_min'];
		$oro_max = $_POST['oro_max'];
		$level = $_POST['level'];
		$map = $_POST['map'];
		$typ = $_POST['typ'];
		
		$mysql = "INSERT INTO potwory set 
		nazwa = '".$nazwa."', 
		obrazek = '".$obrazek."', 
		atak = '".$atak."', 
		atak_max = '".$atak_max."', 
		obrona = '".$obrona."', 
		obrona_max = '".$obrona_max."', 
		sila = '".$sila."', 
		sila_max = '".$sila_max."', 
		zrecznosc = '".$zrecznosc."', 
		zrecznosc_max = '".$zrecznosc_max."', 
		wyrzymalosc = '".$wyrzymalosc."', 
		wyrzymalosc_max = '".$wyrzymalosc_max."', 
		constitucion = '".$constitucion."', 
		constitucion_max = '".$constitucion_max."', 
		carisma = '".$carisma."', 
		carisma_max = '".$carisma_max."', 
		inteligencja = '".$inteligencja."', 
		inteligencja_max = '".$inteligencja_max."', 
		mdchance = '".$mdchance."', 
		mdchance_max = '".$mdchance_max."', 
		dhchance = '".$dhchance."', 
		dhchance_max = '".$dhchance_max."', 
		ctchance = '".$ctchance."', 
		ctchance_max = '".$ctchance_max."', 
		zycie = '".$zycie."', 
		zycie_max = '".$zycie_max."', 
		obrazenia_min = '".$obrazenia_min."', 
		obrazenia_min_max = '".$obrazenia_min_max."', 
		obrazenia_max = '".$obrazenia_max."', 
		obrazenia_max_max = '".$obrazenia_max_max."', 
		exp = '".$exp."', 
		exp_max = '".$exp_max."', 
		oro_min = '".$oro_min."', 
		oro_max = '".$oro_max."', 
		level = '".$level."', 
		map = '".$map."', 
		typ = '".$typ."'";
		$query = mysql_query($mysql);
		if($query){
		echo 'Ready!';
		}
		}
		{
			 
    echo "<p><form action='mobs.php' method='post'>
			
			
				<center>Name
            
                <center><input name='nazwa' size='30' maxlength='30' class='input' tabindex='2' value='' type='text'>
				
				<center>Type<br>
				<select name='typ'>
				<option value='1'>Easy Monster</option>
				<option value='2'>Normal Monster</option>
				<option value='3'>Hard Monster</option>
				<option value='4'>Boss Monster</option>
				<option value='5'>Event Monster</option>
				</select>
				
				
				<center>Image
            
                <center><input name='obrazek' size='5' maxlength='5' class='input' tabindex='2' value='' type='text'>
				
				<center>Attack min - Attack max
            
                <center><input name='atak' size='9' maxlength='9' class='input' tabindex='2' value='' type='text'>				
				<input name='atak_max' size='9' maxlength='9' class='input' tabindex='2' value='' type='text'>				
				
				
				<center>Defense min - Defense max
            
                <center><input name='obrona' size='9' maxlength='9' class='input' tabindex='2' value='' type='text'>
				<input name='obrona_max' size='9' maxlength='9' class='input' tabindex='2' value='' type='text'>
				
				
				<center>Strength min - Strength max
            
                <center><input name='sila' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>
				<input name='sila_max' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>
				
				<center>Ability min - Ability max
            
                <center><input name='zrecznosc' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>
				<input name='zrecznosc_max' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>
				
				<center>Agility min - Agility max
            
                <center><input name='wyrzymalosc' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>
				<input name='wyrzymalosc_max' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>
				
				<center>Constitution min - Constitution max
            
                <center><input name='constitucion' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>
				<input name='constitucion_max' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>
				
				<center>Charisma min - Charisma max
            
                <center><input name='carisma' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>
				<input name='carisma_max' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>
				
				<center>Intelligence min - Intelligence max
            
                <center><input name='inteligencja' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>
				<input name='inteligencja_max' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>
				
				
				<center>Dodge min - Dodge max
            
                <center><input name='mdchance' size='7' maxlength='7' class='input' tabindex='2' value='' type='text'>
				<input name='mdchance_max' size='7' maxlength='7' class='input' tabindex='2' value='' type='text'>
				
				<center>Doble~Hit min - Doble~Hit max
            
                <center><input name='dhchance' size='7' maxlength='7' class='input' tabindex='2' value='' type='text'>
				<input name='dhchance_max' size='7' maxlength='7' class='input' tabindex='2' value='' type='text'>
				
				<center>Critical chance min - Critical chance max
            
                <center><input name='ctchance' size='7' maxlength='7' class='input' tabindex='2' value='' type='text'>
				<input name='ctchance_max' size='7' maxlength='7' class='input' tabindex='2' value='' type='text'>
				
				
				<center>Life min - Life max
            
                <center><input name='zycie' size='7' maxlength='7' class='input' tabindex='2' value='' type='text'>
				<input name='zycie_max' size='7' maxlength='7' class='input' tabindex='2' value='' type='text'>
				
				
				<center>Damage min - Damage max
            
                <center><input name='obrazenia_min' size='8' maxlength='3' class='input' tabindex='2' value='' type='text'>

				<input name='obrazenia_max' size='8' maxlength='3' class='input' tabindex='2' value='' type='text'>
				
				<center>Damage min max - Damage max max
            
                <center><input name='obrazenia_min_max' size='8' maxlength='3' class='input' tabindex='2' value='' type='text'>

				<input name='obrazenia_max_max' size='8' maxlength='3' class='input' tabindex='2' value='' type='text'>
				
				
				<center>Exp min - Exp max
            
                <center><input name='exp' size='6' maxlength='10' class='input' tabindex='2' value='' type='text'>		
            
                <input name='exp_max' size='6' maxlength='10' class='input' tabindex='2' value='' type='text'>
                
				
				<center>Gold min - Gold max
            
                <center><input name='oro_min' size='7' maxlength='10' class='input' tabindex='2' value='' type='text'>				
				
				<input name='oro_max' size='7' maxlength='10' class='input' tabindex='2' value='' type='text'>
				
				
				<center>Level
            
                <center><input name='level' size='3' maxlength='3' class='input' tabindex='2' value='' type='text'>
				
				<center>Map<br>
				<select name='map'>
				<option value='forest'>Forest</option>
				<option value='pirate'>Pirates</option>
				<option value='mountains'>Mountains</option>
				<option value='cave'>Cave</option>
				<option value='temple'>Temple</option>
				<option value='barbary'>Barbary</option>
				<option value='campment'>Campament</option>
				<option value='event'>Event</option>
				</select>
            
            
                <center><br><input name='create' value='Create' class='button3' type='submit'>
				
    </form></p>";
	
	}

} else {
echo "<h2>You do not have enough rank to this product.</h2>";

}

//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?>