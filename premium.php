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


<div id="content">
                                            <script type="text/javascript" src="js/payment.js"></script>
        <div id="paymentScreen" class="payment_screen">
            <iframe id="iframe" src="" class="payment_frame" frameborder="0" height="650px" width="820px"></iframe>
            <div class="popup_buttons">
                <input class="button1" value="Cerrado" onclick="javascript:window.location='index.php?mod=premium&amp;submod=centurio&amp;sh=9746130fd103bd3e8c215ce8c79c751a';" type="button">
            </div>
        </div>
        <div id="centurio">
    <div class="title_box">
        <div class="title_inner" style="text-align:center; font-size: large;">Become Centurion now!</div>
    </div>

    
    <div class="title2_box">
        <div class="title2_inner">
            <table>
                <tbody><tr>
                    <td valign="top">
                        <div id="premium_image"><img src="img/centurio.jpg" align="left" />
                                                    </div>
                    </td>
                    <td>
                        <span id="premium_info">What advantages does the Centurion?</span>
                        <ul class="premium_features_list">
                            <li>You get much more of the daily wage of a stable boy.</li>
							<li>It reduces the time the wages of a stable boy.</li>
							<li>The duration of the sand is reduced to half.</li>
                            <li>You gain more points in the arena.</li>
                            <li>You gain more experience in the arena.</li>
                            <li>You gain more honor in the arena.</li>
							<li>You gain more gold in the arena.</li>
							<li>You lose less gold in the arena.</li>
                            <li>The duration of the gate of the city is reduced to half.</li>
                            <li>You gain more points in the city portal.</li>
                            <li>You gain more experience in the city portal.</li>
                            <li>You gain more honor in the town portal.</li>
							<li>You gain more gold in the city portal.</li>
							<li>You get your life twice as fast.</li>
                        </ul>
                        <p style="font-weight:bold;font-size:14pt;color:orangered;text-decoration:underline;text-align:center">
                            <a target="_self" class="headlines" href="bc.php">14 days for only 15 rubies.</a>
                        </p>
                    </td>
                </tr>
            </tbody></table>
        </div>
    </div>
</div>

    <center><div style='background-image:url(img/rubin_gross.jpg);width:492px;height:150px;overflow:hidden'><center><br><DIV style='margin-right:-200px' width='0px' height='0px'>Rubies are "gems of life and love".  <br>These gems supposedly empower their  <br>owners, courage and dignity. <br>At least you can replace them <br>with items that make it all possible.</div>
                    <a href="br.php"><font size=6><DIV style='margin-right:-200px' width='0px' height='0px'>Rubies Buy Now!</div></font></a>
            </div>

</div>
<?php
//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?> 
