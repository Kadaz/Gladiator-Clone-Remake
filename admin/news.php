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
if($uzytkownik['rank'] > 3){

echo '<br><center>'
?>
<br><center>
<p><b>Create news</b></p><hr/>
<?php

if($uzytkownik['rank'] > 3){
    
    if(isset($_POST['public'])){

        $titul = $_POST['titul'];
        $tekst = $_POST['tekst'];
		$autor = $uzytkownik['login'];
		$link = $_POST['link'];
		$obrazek = $_POST['image'];
		
		$mysql = "INSERT INTO news set titul = '".$titul."', tekst = '".$tekst."', autor = '".$autor."', link = '".$link."', obrazek = '".$obrazek."'";
		mysql_query("update gracze set noticias = '1'");
		$query = mysql_query($mysql);
		if($query){
		echo 'Ready!';
		}
		}
		{
			 
    echo "<p><form action='news.php' method='post'>

                <center>Autor:<br>
				
				<select name='autor'>
				<option value='".$uzytkownik['login']."'>".$uzytkownik['login']."</option>
				<option value='Team GladClone'>GladClone</option>
                </select>
				
				<center>Type:<br>
				
				<select name='image'>
				<option value='1'>Edit</option>
				<option value='2'>Information</option>
				<option value='3'>Warn</option>
				<option value='4'>Forum</option>
				<option value='5'>Event</option>
				<option value='6'>New</option>
				<option value='7'>Notice</option>
				</select>
				
                <center>Title:
            
            
                <center><input name='titul' size='30' maxlength='30' class='input' tabindex='2' value='' type='text'>
                
            
            
                <center>Text (Max 4000 letters)
            
            
                <center><textarea name='tekst' class='input' maxlength='4000' tabindex='3' style='width:50%;height:150px'></textarea>
				
				
				<center>Link:
            
            
                <center><input name='link' size='30' maxlength='9999' class='input' tabindex='2' value='' type='text'>
            
            
                <center><br><input name='public' value='Post' class='button3' type='submit'>
				<align='absmiddle' border='0'>
    </form></p>";
	
	}
} else { echo "<h2>You do not have enough rank to this product.</h2>"; }

} else {

echo '<h2>You do not have enough rank to this product.</h2>';

}
//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?>