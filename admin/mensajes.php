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
?><br><center>

<p><b>Message<br></b></p><hr/>

<?php

//pobieramy listę raportów

$mensajes= mysql_query("select * from mensajes where report >='1' order by fecha desc");
if(mysql_num_rows($mensajes ) == 0){
    echo "No messages";
} else {

	 while($r = mysql_fetch_array($mensajes )){
     echo "
                             Message from user ".$r['login_user_s']."</a><br>
                             <textarea cols='35' rows='3' class='input'>".$r['mensaje']."</textarea>
							 <br>".$r['fecha']."
     <br><hr>";
    }
    
}
?>
<?php
//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?> 