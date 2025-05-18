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
if($uzytkownik['rank'] > 4){
?>
<br><center>
<p><b>Give VIP</b></p><hr/>
<?php

    if(isset($_POST['edit'])){

        $gracz = $_POST['gracz'];
		$days = $_POST['days'];
		$koniec = time() + (24 * $days) * 3600;
		
		$mysql = "update gracze set centurion_time = '".$koniec."', rank = 2 where gracz = ".$gracz."";
		$query = mysql_query($mysql);
		if($query){
		echo 'Ready!';
		}
		}
		{
			 
    echo "<p><form action='vips.php' method='post'>

				<center>Player ID to give VIP:
				
				<center><input name='gracz' size='10' maxlength='10' class='input' tabindex='2' value='' type='text'>
    
				
				<center>Time to give:

				<center>
				<select name='days'>
				<option value='1'>1 Day</option>
				<option value='2'>2 Days</option>
				<option value='4'>4 Days</option>
				<option value='7'>7 Days</option>
				<option value='14'>14 Days</option>
				</select>


				<center><br><input name='edit' value='Give' class='button3' type='submit'>
				<align='absmiddle' border='0'>
    </form></p>";
	
	}
} else { echo "<h2>You do not have enough rank to this product.</h2>"; }


//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?>