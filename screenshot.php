<?php
//włączamy bufor
ob_start();
//pobieramy zawartość pliku ustawień
require_once('var/ustawienia.php');
//startujemy lub przedłużamy sesję
session_start();
//pobieramy nagłówek strony
require_once('gora_strony.php');
 //pobieramy zawartość menu
require_once('menu_l.php');
?>

  <div style="margin:20px;">

	<div class="title_box"><div class="title_inner">

		Screenshots.	</div></div>

	<br />

	<table width="100%">

		<tr>

			<td>

				<a href="screen1.php" target="_blank">

					<img src="screeny/screenshot_1_klein.jpg" border="0" />

				</a>

			</td>

			<td>

				<a href="screen2.php" target="_blank">

					<img src="screeny/screenshot_2_klein.jpg" border="0" />

				</a>

			</td>

		</tr>

		<tr>

			<td>

				<a href="screen3.php" target="_blank">

					<img src="screeny/screenshot_3_klein.jpg" border="0" />

				</a>

			</td>

			<td>

				<a href="screen4.php" target="_blank">

					<img src="screeny/screenshot_4_klein.jpg" border="0" />

				</a>

			</td>

		</tr>

	</table>

</div>


<?php
//pobieramy stopkę
require_once('dol_strony.php');
//wyłączamy bufor
ob_end_flush();
?> 
