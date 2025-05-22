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
<p><b>Edit user</b></p><hr/>
<?php

if($uzytkownik['rank'] > 2){
    
    if(isset($_POST['edit'])){

        $gracz = $_POST['gracz'];
        $zloto = $_POST['zloto'];
		$rubies = $_POST['rubies'];
		$exp = $_POST['exp'];
		
		$mysql = "update gracze set zloto = zloto + ".$zloto.", rubies = rubies + ".$rubies.", exp = exp + ".$exp." where gracz = ".$gracz."";
		$query = mysql_query($mysql);
		if($query){
		echo 'Ready!';
		}
		}
		{
			 
    echo "<p><form action='users.php' method='post'>
	
	
				<center>Player ID to edit:
				
				<center><input name='gracz' size='10' maxlength='10' class='input' tabindex='2' value='' type='text'>
    
				
				<center>Gold:
				
				<center><input name='zloto' size='10' maxlength='10' class='input' tabindex='2' value='' type='text'>
				
				
				<center>Rubies:

				<center><input name='rubies' size='10' maxlength='10' class='input' tabindex='2' value='' type='text'>
    


				<center>Exp:

				<center><input name='exp' size='10' class='input' maxlength='10' tabindex='2' value='' type='text'></input>



				<center><br><input name='edit' value='Edit' class='button3' type='submit'>
				<align='absmiddle' border='0'>
    </form></p>";
	
	}
} else { echo "You do not have enough rank to this product."; }


//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?>