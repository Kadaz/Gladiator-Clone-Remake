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
<html><center><br><br>

<center><b><p><h1>Compra rubies por SMS via Allopass.</h1></p></b></center><hr><br>Consigue 100 Rubies por SMS via Allopass.<br><br><img src="img/br.jpg"><br><br>Elige tu pais:<br><br>
<table>
<tr>
<td><center>Perú</td>
<td></td>
<td></td>
<td></td>
<td><center>Venezuela</td>
<td></td>
<td></td>
<td></td>
<td><center>Ecuador</td>
<td></td>
<td></td>
<td></td>
<td><center>Guatemala</td>
<td></td>
<td></td>
<td></td>
<td><center>Nicaragua</td>
</tr>
<tr>
<td><center><a href="br1.php" target="_blank" title="Peru"><img src="img/br/peru.png"></td>
<td></td>
<td></td>
<td></td>
<td><center><a href='br2.php' target="_blank" title="Venezuela"><img src="img/br/vnzla.png"></td>
<td></td>
<td></td>
<td></td>
<td><center><a href='br3.php' target="_blank" title="Ecuador"><img src="img/br/ecu.png"></td>
<td></td>
<td></td>
<td></td>
<td><center><a href='br4.php' target="_blank" title="Guatemala"><img src="img/br/gua.png"></td>
<td></td>
<td></td>
<td></td>
<td><center><a href='br5.php' target="_blank" title="Nicaragua"><img src="img/br/nic.png"></td>
</tr>
</table>

</html>
<?php
//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?>