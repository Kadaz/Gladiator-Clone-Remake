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
<p><b>Send Message</b></p><hr/>
<?php

if(!empty($_GET['sended'])){
    //zabezpiecz zmienne
	$_GET['sended'] = $_GET['sended'];
	
	if(isset($_POST['send'])){

        $id_user_r = $_POST['id_user_r'];
        $mensaje = $_POST['mensaje'];		
		$login_user_s = $uzytkownik['login'];
		$id_user_s = $uzytkownik['gracz'];
		
		$mysql = "INSERT INTO mensajes set id_user_r = '".$id_user_r."', mensaje = '".$mensaje."', id_user_s = '".$id_user_s."', login_user_s = '".$login_user_s."'";
		mysql_query("update gracze set mensajes = '1' where login = '".$id_user_r."'");
		$query = mysql_query($mysql);
		if($query){
		echo 'Message sended';
		}
		}
		{
		
		$id_user_r = $_GET['sended'];
	
	    echo "<p><form action='send_mensajes.php' method='post'>
            <div style='background-image:url(img/msgnew.gif);width:527px;height:493px;overflow:hidden'>
			<br><br><br><br><br>
                <center>Sender: ".$uzytkownik['login']."
                
            
            
                <center>Username the player to send:
            
            
                <center><input name='id_user_r' size='30' maxlength='30' class='input' tabindex='2' value='$id_user_r' type='text'>
                
            
            
                <center>Text (Max 4000 characters)
            
            
                <center><textarea name='mensaje' class='input' tabindex='3' style='width:50%;height:150px'></textarea>
            
            
                <center><br><input name='send' value='Send' class='button3' type='submit'>
				<align='absmiddle' border='0'></div>
    </form></p>";
	
	}
	}else

if(!empty($_GET['reply'])){
    //zabezpiecz zmienne
	$_GET['reply'] = $_GET['reply'];
	
	if(isset($_POST['send'])){

        $id_user_r = $_POST['id_user_r'];
        $mensaje = $_POST['mensaje'];		
		$login_user_s = $uzytkownik['login'];
		$id_user_s = $uzytkownik['gracz'];
		
		$mysql = "INSERT INTO mensajes set id_user_r = '".$id_user_r."', mensaje = '".$mensaje."', id_user_s = '".$id_user_s."', login_user_s = '".$login_user_s."'";
		mysql_query("update gracze set mensajes = '1' where login = '".$id_user_r."'");
		$query = mysql_query($mysql);
		if($query){
		echo 'Message sended';
		}
		}
		{
		
		$id_user_r = $_GET['reply'];
	
	    echo "<p><form action='send_mensajes.php' method='post'>
            <div style='background-image:url(img/msgnew.gif);width:527px;height:493px;overflow:hidden'>
			<br><br><br><br><br>
                <center>Sender: ".$uzytkownik['login']."
                
            
            
                <center>Username the player to send:
            
            
                <center><input name='id_user_r' size='30' maxlength='30' class='input' tabindex='2' value='$id_user_r' type='text'>
                
            
            
                <center>Text (Max 4000 characters)
            
            
                <center><textarea name='mensaje' class='input' tabindex='3' style='width:50%;height:150px'></textarea>
            
            
                <center><br><input name='send' value='Send' class='button3' type='submit'>
				<align='absmiddle' border='0'></div>
    </form></p>";
	
	}
	}else{
    
    if(isset($_POST['send'])){

        $id_user_r = $_POST['id_user_r'];
        $mensaje = $_POST['mensaje'];		
		$login_user_s = $uzytkownik['login'];
		$id_user_s = $uzytkownik['gracz'];
		
		$mysql = "INSERT INTO mensajes set id_user_r = '".$id_user_r."', mensaje = '".$mensaje."', id_user_s = '".$id_user_s."', login_user_s = '".$login_user_s."'";
		mysql_query("update gracze set mensajes = '1' where login = '".$id_user_r."'");
		$query = mysql_query($mysql);
		if($query){
		echo 'Message sended';
		}
		}
		{
			 
    echo "<p><form action='send_mensajes.php' method='post'>
            <div style='background-image:url(img/msgnew.gif);width:527px;height:493px;overflow:hidden'>
			<br><br><br><br><br>
                <center>Sender: ".$uzytkownik['login']."
                
            
            
                <center>Username the player to send:
            
            
                <center><input name='id_user_r' size='30' maxlength='30' class='input' tabindex='2' value='' type='text'>
                
            
            
                <center>Text (Max 4000 characters)
            
            
                <center><textarea name='mensaje' class='input' tabindex='3' style='width:50%;height:150px'></textarea>
            
            
                <center><br><input name='send' value='Send' class='button3' type='submit'>
				<align='absmiddle' border='0'></div>
    </form></p>";
	
	}
	}



//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?>