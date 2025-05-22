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
<div class="title_box"><div class="title_inner" style="text-align:center; font-size: large;">
Covenants
</div></div>
<div class="title2_box">
        <div class="title2_inner">
<table><tbody><tr>
<td valign="top"><div id="premium_image"><img src="img/powerups/powerup_1.gif" align="left" /></div></td>
<td><span id="premium_info">Buy Select one of the following covenants:</span>
<ul class="premium_features_list">
                            <li>Reduce the waiting time the city portal by 75%.<br><a href="p1.php?pb1=1">BUY NOW!</a></li>
							<br>
							<li>Increases life regeneration by 75%.<br><a href="p1.php?pb1=2">BUY NOW!</a></li>
							<br>
							<li>Maximum Charisma increases by 50%.<br><a href="p1.php?pb1=3">BUY NOW!</a></li>
							<br>
                            <li>You earn 200% more on everything in city portal.<br><a href="p1.php?pb1=4">BUY NOW!</a></li>
							<br>
							<li>The hit points increased by 75%.<br><a href="p1.php?pb1=5">BUY NOW!</a></li>
                        </ul>
<span id="premium_info">Any of these covenants, is priced at 15 <img src="img/rubins.gif"> for 14 days.</span>
</tr></tbody></table>
</div></div>
<div class="title2_box">
        <div class="title2_inner">
<table><tbody><tr>
<td valign="top"><div id="premium_image"><img src="img/powerups/powerup_2.gif" align="left" /></div></td>
<td><span id="premium_info">Buy Select one of the following covenants:</span>
<ul class="premium_features_list">
                            <li>Objects in rubies have a 50% discount.<br><a href="p2.php?pb2=1">BUY NOW!</a></li>
							<br>
							<li>Gold objects will have a 25% discount.<br><a href="p2.php?pb2=2">BUY NOW!</a></li>
							<br>
							<li>Rubies objects will have a 25% discount and gold objects 15%.<br><a href="p2.php?pb2=3">BUY NOW!</a></li>
							<br>
                            <li>Increases 200% payment as stable boy.<br><a href="p2.php?pb2=4">BUY NOW!</a></li>
							<br>
							<li>You earn 50% more gold per level increase.<br><a href="p2.php?pb2=5">BUY NOW!</a></li>
                        </ul>
<span id="premium_info">Any of these covenants, is priced at 15 <img src="img/rubins.gif"> for 14 days.</span>
</tr></tbody></table>
</div></div>
<div class="title2_box">
        <div class="title2_inner">
<table><tbody><tr>
<td valign="top"><div id="premium_image"><img src="img/powerups/powerup_3.gif" align="left" /></div></td>
<td><span id="premium_info">Buy Select one of the following covenants:</span>
<ul class="premium_features_list">
                            <li>Increases 25% damage you have.<br><a href="p3.php?pb3=1">BUY NOW!</a></li>
							<br>
							<li>The maximum skill increases by 50%.<br><a href="p3.php?pb3=2">BUY NOW!</a></li>
							<br>
							<li>Increases in 10 the critical chance.<br><a href="p3.php?pb3=3">BUY NOW!</a></li>
							<br>
                            <li>Increases maximum strength by 50%.<br><a href="p3.php?pb3=4">BUY NOW!</a></li>
							<br>
							<li>Decreases the value of the opponent's armor: Your level x 100. (Example: Level 10 = 100 armor).<br><a href="p3.php?pb3=5">BUY NOW!</a></li>
                        </ul>
<span id="premium_info">Any of these covenants, is priced at 15 <img src="img/rubins.gif"> for 14 days.</span>
</tr></tbody></table>
</div></div>
<div class="title2_box">
        <div class="title2_inner">
<table><tbody><tr>
<td valign="top"><div id="premium_image"><img src="img/powerups/powerup_4.gif" align="left" /></div></td>
<td><span id="premium_info">Buy Select one of the following covenants:</span>
<ul class="premium_features_list">
                            <li>Earn more than 500% of gold in the city portal.<br><a href="p4.php?pb4=1">BUY NOW!</a></li>
							<br>
							<li>Earn more than 500% of honor in the city portal.<br><a href="p4.php?pb4=2">BUY NOW!</a></li>
							<br>
							<li>Earn more than 500% of experience in the city portal.<br><a href="p4.php?pb4=3">BUY NOW!</a></li>
							<br>
                            <li>The maximum agility increases by 50%.<br><a href="p4.php?pb4=4">BUY NOW!</a></li>
							<br>
							<li>The maximum constitution increases by 50%.<br><a href="p4.php?pb4=5">BUY NOW!</a></li>
                        </ul>
<span id="premium_info">Any of these covenants, is priced at 15 <img src="img/rubins.gif"> for 14 days.</span>
</tr></tbody></table>
</div></div>

<?php
//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?> 
