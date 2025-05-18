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

if($uzytkownik['ally_id'] > 0){
			
			$ally_id1 = mysql_query("select * from ally_miembros where usuario_id =".$uzytkownik['gracz']);
			
			while($a1 = mysql_fetch_array($ally_id1 )){
			
			$ally_id2 = $a1['ally_id'];
			
			$ally_id3 = mysql_query("select * from ally where id_ally =".$ally_id2);
			
			while($a2 = mysql_fetch_array($ally_id3 )){

?>
<br><center>
<p><b>Editar Alianza</b></p><hr/>
<?php

if($a1['rank'] > 2){
    
    if(isset($_POST['edit'])){

		$descripcion = $_POST['descripcion'];
		
		$mysql = "update ally set descripcion = ".$descripcion." where id_ally = ".$a2['id_ally']."";
		$query = mysql_query($mysql);
		if($query){
		echo 'Usuario editado';
		}
		}
		{
			 
			 if($a1['rank'] > 2){
			 
    echo "<p><form action='users.php' method='post'>

			<br><br><br><br>
				<center>ID de la Alianza: ".$a2['id_ally']."
				
				<center>Nombre de la Alianza: ".$a2['nombre']."<br><br>
				
				<center>Descripción (Maximo 4000 Caracteres)            
            
                <center><textarea name='descripcion' class='input' maxlength='4000' tabindex='3' style='width:50%;height:150px'></textarea>

				<center><br><input name='edit' value='Editar' class='button3' type='submit'>
				
    </form></p>";
	
} else { 

echo "No tienes rank suficiente para esta pagina"; }

}

} else {

echo "Tu rank no es suficiente para editar algo en esta Alianza";

echo "<br>";

echo "<p><form action='users.php' method='post'>

			<br><br><br><br>
				<center>ID de la Alianza: ".$a2['id_ally']."
				
				<center>Nombre de la Alianza: ".$a2['nombre']."<br><br>
				
				</form></p>";

		}
		}
		}
		} else {
		}


//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?>