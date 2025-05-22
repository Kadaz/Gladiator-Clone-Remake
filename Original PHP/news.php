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

mysql_query("update gracze set noticias = '0' where gracz = ".$uzytkownik['gracz']);

?><br><center>
<div class="title_box">
<div class="title_inner" style="text-align:center; font-size: large;">News</div>
</div>
<?php

$nullid = 0;

$news = mysql_query("select * from news order by date desc");
if(mysql_num_rows($news ) == 0){
    echo "No news.";
} else {
    while($r = mysql_fetch_array($news )){
	
	$image1 = $r['obrazek'];
	
     echo "
	 
					<div class='title2_box'>
        <div class='title2_inner'>
            <table>
					<tbody><tr>
                    <td valign='top'>
                    </td>

					
				<td><div class='title1_box'>
                    <div class='title1_inner' style='text-align:center; font-size: large;'>
					<span id='premium_info'><img src='img/news/icon_".$image1.".gif' style='float:left;margin-left:0px;margin-right:10px'><font size='4'>".$r['titul']."</font></div></div>
				    </p></div> 
				
				<br class='clearfloat'><div class='news_date'>
                    <font size='2'>".$r['date']."</font>                </div>
            ".$r['tekst']."<br>
			
<br><br>
".$r['autor']."</div>
                <div><a href='".$r['link']."' target='_blank' class='news_readmore'><img src='img/news/read_more.gif' style='margin-left:300px;margin-right:0px'><font size='5'> Continue reading.</font></a>
            </span>
			                    </td>
                </tr>
            </tbody></table>
        </div>
    </div>
</div>

     ";
    }
    
}

//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?> 
