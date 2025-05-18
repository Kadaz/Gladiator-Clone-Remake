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

mysql_query("update gracze set mensajes = '0' where gracz = ".$uzytkownik['gracz']);

?><br><center>

<p><b>Message<br>
<a href='send_mensajes.php' style='color:#fff;'><img src="img/b_edit.gif"/>Send Message</a></b></p><hr/>

<?php

if(!empty($_GET['usun'])){
    //zabezpiecz zmienne
    $_GET['usun'] = (int)$_GET['usun'];
    mysql_query("delete from mensajes where id_msj = ".$_GET['usun']." and id_user_r = ".$uzytkownik['gracz']);
    if(mysql_affected_rows() > 0) echo "Deleted<hr/>";
    else "No messages<hr/>";
}


if(!empty($_GET['report'])){
    //zabezpiecz zmienne
    $_GET['report'] = (int)$_GET['report'];
	$report = 1;	
    mysql_query("update mensajes set report = ".$report." where id_msj = ".$_GET['report']."");
    if(mysql_affected_rows() > 0) echo "Reported<hr/>";
    else "No messages<hr/>";
}


//pobieramy listę raportów

$mensajes= mysql_query("select * from mensajes where id_user_r ='".$uzytkownik['login']."' order by fecha desc");
if(mysql_num_rows($mensajes ) == 0){
    echo "No messages";
} else {

	 while($r = mysql_fetch_array($mensajes )){
     echo "
                             Message from user <a href='oplayer.php?oplayer=".$r['login_user_s']."' style='color:#8fff;'>".$r['login_user_s']."</a><br>
                             <a href='mensajes.php?report=".$r['id_msj']."'>(Report)</a><br>
                             <textarea cols='35' rows='3' class='input'>".$r['mensaje']."</textarea>
                             <br><a href='send_mensajes.php?reply=".$r['login_user_s']."' style='color:#fff;'>Reply</a>
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