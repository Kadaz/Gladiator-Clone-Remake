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
<p><b>Edit ranks</b></p><hr/>
<?php

if($uzytkownik['rank'] > 4){
    
    if(isset($_POST['edit'])){

        $gracz = $_POST['gracz'];
		$rank = $_POST['rank'];
		
		$mysql = "update gracze set rank = ".$rank." where gracz = ".$gracz."";
		$query = mysql_query($mysql);
		if($query){
		echo 'Ready!';
		}
		}
		{
			 
    echo "<p><form action='ranks.php' method='post'>

				<center>Player ID to edit rank:
				
				<center><input name='gracz' size='10' maxlength='10' class='input' tabindex='2' value='' type='text'>
    
				
				<center>Rank:

				<center>
				<select name='rank'>
				<option value='1'>User</option>
				<option value='3'>Moderator</option>
				<option value='4'>Admin</option>
				</select>


				<center><br><input name='edit' value='Edit' class='button3' type='submit'>
				<align='absmiddle' border='0'>
    </form></p>";
	
	}
} else { echo "<h2>You do not have enough rank to this product.</h2>"; }


//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?>