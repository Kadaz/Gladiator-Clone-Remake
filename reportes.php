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

mysql_query("update gracze set reportes = '0' where gracz = ".$uzytkownik['gracz']);

?><br><center>

<p><b>Reports</b></p><hr/>

<?php

//pobieramy listę raportów

$report_fight = mysql_query("select * from report_fight where user_id_d =".$uzytkownik['gracz']." or user_id_a =".$uzytkownik['gracz']." order by fecha desc");
if(mysql_num_rows($report_fight ) == 0){
    echo "No reports.";
} else {
    while($r = mysql_fetch_array($report_fight )){
	
	if($r['user_id_a'] == $uzytkownik['gracz']){
	
	$image1 = 'task_2_inactive';	
	
	} 
	elseif($r['user_id_d'] == $uzytkownik['gracz'])
	{
	
	$image1 = 'shield-passive';
	
	}
	
     echo "
        <div style='width:435px; background:#663300; color:#fff; padding:2px'>
		<img src='img/news/".$image1.".gif'>
		".$r['titul']."
        </div>
        <div style='width:420px; background:#D7D2D7; padding:10px'>
            ".$r['text']."
        </div>
        <div style='width:435px; background:#663300; color:#fff; padding:2px'>
		".$r['fecha']."
        </div><br>
     ";
    }
    
}

//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?> 
