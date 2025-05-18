<?php

//wlaczamy bufor
ob_start();

//pobieramy zawartosc pliku ustawien
require_once('var/ustawienia.php');

//startujemy lub przedluzamy sesje
session_start();

//dolaczamy plik, który sprawdzi czy napewno mamy dostep do tej strony
require_once('test_zalogowanego.php');


//pobieramy naglówek strony
require_once('gora_strony2.php');
 //pobieramy zawartosc menu
require_once('menu.php');
?>
<html><center><br><br>
<h1><b>Nicaragua:</h1></b>
<br>
Consigue tus 100 rubies por cada SMS que envies, con el que recibiras un codigo para conseguir tus rubies.<br>
<br>
<img src="img/br/bran.png"><br>
<br>
Que esperas consigue tus rubies.<br><br>


<?php
    
    if(isset($_POST['send'])){

        $mensaje = $_POST['mensaje'];		
		$login_user_s = $uzytkownik['login'];
		$id_user_s = $uzytkownik['gracz'];
		
		$mysql = "INSERT INTO br set code = '".$mensaje."', pais = 'Nicaragua', id_user_s = '".$id_user_s."', login_user_s = '".$login_user_s."'";
		$query = mysql_query($mysql);
		if($query){
		echo 'Code sended';
		}
		}
		{
			 
    echo "<p><form action='br4.php' method='post'>
            <div style='background-image:url(img/msgnew.gif);width:527px;height:493px;overflow:hidden'>
			<br><br><br><br><br>
                <center>Sender: ".$uzytkownik['login']."
                
            
				<center>Code:
            
            
                <center><textarea name='mensaje' class='input' tabindex='3' style='width:30%;height:25px'></textarea>
            
            
                <center><br><input name='send' value='Send' class='button3' type='submit'>
				<align='absmiddle' border='0'></div>
    </form></p>";
	
	}
?>
<?php
//pobieramy stopke
require_once('dol_strony.php');

//wylaczamy bufor
ob_end_flush();
?>