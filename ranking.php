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
<?php
//pobieramy listę graczy

$gracze = mysql_query("select * from gracze where rank <= 2 order by honor desc");
if(mysql_num_rows($gracze) == 0){
    echo "No players.";
} else {
    echo '
    <div style="position:relative;text-align:center;padding:10px">

	<h1>Ranking</h1>

	</div>

<div class="title_box" style="margin:10px;">

	<div class="title_inner"  style="padding: 0px;">

	<div id="highscore_table">

	<table cellpadding="4" cellspacing="0">

					<tr>


        <th>Position</th>
        <th>Name</th>
		<th>Level</th>
        <th>Honor</th>
        <th>Points</th>
        <th>Victories</th>
        <th>Missed</th>


    </tr>
    ';
		$i=0;
    while($g = mysql_fetch_array($gracze)){
        if($g['avatar'] == 0){
            $av = "<img src='avatar/noavatar.jpg' style='max-width:75px; max-height:75px' alt=''/>";
        } else {
            $av = "<img src='avatar/".$g['gracz'].".jpg' style='max-width:75px; max-height:75px' alt=''/>";
        }
        echo "
         <tr class='alt'>
            <td><center>".++$i."</td>
            <td><a href='oplayer.php?oplayer=".$g['login']."' style='color:#8fff;'><center>".$g['login']."</a></td>
			<td><center>".$g['nivel']."</td>
            <td><center>".$g['honor']."</td>
            <td><center>".$g['punkty']."</td>
            <td><center>".$g['victorias']."</td>
            <td><center>".$g['perdidas']."</td>

        </tr>
        ";
    }
    echo "</table>";

}

//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?>
