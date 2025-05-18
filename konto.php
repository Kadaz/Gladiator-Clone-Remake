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

if($uzytkownik['plec'] == 0){

if(isset($_POST['select'])){

		$plec = $_POST['plec'];
		
		$query = mysql_query("update gracze set plec = '".$plec."' where gracz = ".$uzytkownik['gracz']);
		if($query){
		echo "<br><center>Ready! <a href='konto.php'> Click here to reload the page.";
		}
		} else {

echo " <p><form action='konto.php' method='post'><br>
<center><img src='img/faces/1_1.gif' align='absmiddle' border='0' style='float:center;margin-right:30px'><img src='img/faces/2_1.gif' align='absmiddle' border='0' style='float:center;margin-right:0px'>
<center><br><input type='checkbox' name='plec' value='1' style='float:center;margin-right:200px' /> <input type='checkbox' name='plec' value='2' />
<br>
<center><br><input name='select' value='Select' class='button3' type='submit'>
<p>
";

}

} else {

?><br>         <div style="width:200px;text-align:center">
			<center><div style="background-image:url(img/faces/spieler_name_bg.png);width:168px;height:60px;overflow:hidden"> <span style=color:#FFFF00><font size=4><b><?php echo $uzytkownik['login']; ?><br><font size=2><?php echo $uzytkownik['titulo']; ?></font></span></b></font> <align="absmiddle" border="0"></div></center>
			<img src="img/faces/<?php echo $uzytkownik['plec']; ?>_<?php echo $uzytkownik['avatar']; ?>.gif" align="absmiddle" border="0">
                <div id="charstats" style="width:173px">
    <div style="background-image:url(img/char_status_kopf.jpg);width:173px;height:5px;overflow:hidden"></div>
    <div class="charstats_bg" id="char_panzer_tt">
        <span class="charstats_value21">Level</span>

        <span id="char_level" class="charstats_value22"><?php echo $uzytkownik['nivel']; ?></span>
    </div>
    <div class="charstats_bg" id="char_leben_tt" onmouseover="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Puntos de vida:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'><?php echo $uzytkownik['zycie']; ?> / <?php echo $uzytkownik['zycie_max']; ?></td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Vida al nivel <?php echo $uzytkownik['nivel']; ?>: </td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'><?php $ll = $uzytkownik['nivel'] - 1 * 25 + 100; echo $ll; ?></td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Mediante objetos:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>+644</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Por alza:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Bonificación mediante Constitución:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>+2025</td></tr><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>Regeneración:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>470 por hora</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Por Constitución:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>+166</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Por nivel:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>+62</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Por gremio:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>+14</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Por pacto:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#00B712;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Por disfraces:</td><td style=\'padding-left:20px;text-align:right;color:#00B712;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>+228</td></tr></table>')">
        <span class="charstats_text">Life points</span>
        <div class="charstats_balken">
            <div class="charstats_balken_leben" id="char_leben_balken" style="width:<?php echo $plife; ?>%"></div>
        </div>
        <span id="char_leben" class="charstats_value"><?php echo $uzytkownik['zycie']; ?></span>

    </div>
        <div class="charstats_bg" id="char_exp_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Experience:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>1 / 10</td></tr><tr><td style=\'text-align:left;color:#DDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Required until level 2:</td><td style=\'padding-left:20px;text-align:right;color:#DDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>9</td></tr></table>')">
        <span class="charstats_text">Experience</span>
        <div class="charstats_balken">
            <div class="charstats_balken_xp" style="width:<?php echo $pexp; ?>%"></div>
        </div>
        <span id="char_exp" class="charstats_value"><?php echo $uzytkownik['exp']; ?></span>
    </div>

    
            <div class="charstats_bg" id="char_f0_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Strength:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Basic:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maximum:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>13</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 from 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Increases damage made on opponent and the chance of blocking opposing hits.</div></td></tr></table>')">
            <span class="charstats_text">Strength</span>
            <div class="charstats_balken">
                <div class="charstats_balken_misc" id="charbalken_f0" style="width:<?php echo $pst; ?>%"></div>
            </div>
            <span id="char_f0" class="charstats_value"><?php echo $uzytkownik['sila']; ?></span>
        </div>
            <div class="charstats_bg" id="char_f1_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Skill:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>6</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Basic:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>6</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maximum:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>10</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 from 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Increases chance of hitting as well as the chance of critically hitting your opponent.</div></td></tr></table>')">

            <span class="charstats_text">Skill</span>
            <div class="charstats_balken">
                <div class="charstats_balken_misc" id="charbalken_f1" style="width:<?php echo $pab; ?>%"></div>
            </div>
            <span id="char_f1" class="charstats_value"><?php echo $uzytkownik['zrecznosc']; ?></span>
        </div>
            <div class="charstats_bg" id="char_f2_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>wyrzymalosc:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Basic:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maximum:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 from 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Decreases opponent`s chance of hitting and his chance of critically hitting.</div></td></tr></table>')">
            <span class="charstats_text">Agility</span>

            <div class="charstats_balken">
                <div class="charstats_balken_misc" id="charbalken_f2" style="width:<?php echo $pag; ?>%"></div>
            </div>
            <span id="char_f2" class="charstats_value"><?php echo $uzytkownik['wyrzymalosc']; ?></span>
        </div>
            <div class="charstats_bg" id="char_f3_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Constitution:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Basic:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maximum:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 from 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Increases maximum life points and regeneration.</div></td></tr></table>')">
            <span class="charstats_text">Constitution</span>
            <div class="charstats_balken">

                <div class="charstats_balken_misc" id="charbalken_f3" style="width:<?php echo $pco; ?>%"></div>
            </div>
            <span id="char_f3" class="charstats_value"><?php echo $uzytkownik['constitucion']; ?></span>
        </div>
            <div class="charstats_bg" id="char_f4_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Charisma:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Basic:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maximum:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 from 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Increases the chance of a double hit, in addition it increases your presence in dungeon battles.</div></td></tr></table>')">
            <span class="charstats_text">Charisma</span>
            <div class="charstats_balken">
                <div class="charstats_balken_misc" id="charbalken_f4" style="width:<?php echo $pch; ?>%"></div>

            </div>
            <span id="char_f4" class="charstats_value"><?php echo $uzytkownik['carisma']; ?></span>
        </div>
            <div class="charstats_bg" id="char_f5_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Intelligence:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Basic:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maximum:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 from 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Increases expedition opponent learning chance. <br />Increases healing in dungeon battles and the chance of critical healing. <br />Increases healing value through nutrition.</div></td></tr></table>')">
            <span class="charstats_text">Intelligence</span>
            <div class="charstats_balken">
                <div class="charstats_balken_misc" id="charbalken_f5" style="width:<?php echo $pin; ?>%"></div>
            </div>

            <span id="char_f5" class="charstats_value"><?php echo $uzytkownik['inteligencja']; ?></span>
        </div>
    
    <div class="charstats_bg" id="char_panzer_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Armour:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Absorbs damage:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 - 0</td></tr><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>Resilience:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through wyrzymalosc:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Chance of avoiding critical hits:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 %</td></tr><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>Blocking value:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through Strength:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Chance to block a hit:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 %</td></tr></table>')">
        <span class="charstats_value21">Armour</span>
        <span id="char_panzer" class="charstats_value22"><?php echo $uzytkownik['obrona']; ?></span>
    </div>
    <div class="charstats_bg" id="char_schaden_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Damage:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>2 - 2</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Basic:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>2 - 2</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through Strength:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through reinforcement:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>Critical damage:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through dexterity:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Chance for critical damage:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 %</td></tr></table>')">

        <span class="charstats_value21">Damage</span>
        <span id="char_schaden" class="charstats_value22"><?php echo $uzytkownik['obrazenia_min']; ?>-<?php echo $uzytkownik['obrazenia_max']; ?></span>
    </div>
    <div style="background-image:url(img/char_status_abschluss.jpg);width:173px;height:5px;overflow:hidden"></div>
</div>      
</div>
<br><center>
<?php
//wyświetlimy nagłówek 
echo "<p><b>Bag</b><hr/></p>";



//sprawdzamy czy przypadkiem nie wybrał zakładania jakiegoś przedmiotu
if(!empty($_GET['zaloz'])){
    $_GET['zaloz'] = (int)$_GET['zaloz'];
    
    //pobierzmy dane przedmiotu
    $item = mysql_fetch_array(mysql_query("select * from przedmioty_gracze inner join przedmioty on przedmiot_id = przedmiot where id = ".$_GET['zaloz']." and gracz_id = ".$uzytkownik['gracz']));
    
    if(empty($item)){
    //jeżeli taki przedmiot nie istnieje, np bo gracz kombinował w adresie strony wpisując samemu jakieś nieistniejące dane
    echo "You have no items.<hr/>";
    } elseif($item['zalozony'] == 1){
    //jeżeli przedmiot jest założony 
    echo "The object is not found.<hr/>";
    }else {
    
        //sprawdź czy już jakiś przedmiot tego typu jest założony
        $zalozony = mysql_fetch_array(mysql_query("select * from przedmioty_gracze inner join przedmioty on przedmiot_id = przedmiot where typ = '".$item['typ']."' and zalozony = 1 and gracz_id = ".$uzytkownik['gracz']));

        if(!empty($zalozony)){
            //jeżeli znalazło założony przedmiot
            echo "You are using a different object, remove it first before proceeding.<hr/>";
        } else {
		
		
	
	$original['sila'] = $uzytkownik['sila'] + $item['sila'];
	
	if($original['sila'] > $uzytkownik['sila_max']){
	$sila_in = $original['sila'] - $uzytkownik['sila_max'];
	$original_item['sila'] = $item['sila'] - $sila_in;
	$da1 = (int)($original_item['sila'] / 10);
	} else {
	$da1 = (int)($item['sila'] / 10);
	}
	
	$original['constitucion'] = $uzytkownik['constitucion'] + $item['constitucion'];
	
	if($original['constitucion'] > $uzytkownik['constitucion_max']){
	$constitucion_in = $original['constitucion'] - $uzytkownik['constitucion_max'];
	$original_item['constitucion'] = $item['constitucion'] - $constitucion_in;
	$la1 = (int)($original_item['constitucion'] / 10);
	} else {
	$la1 = (int)($item['constitucion'] / 10);
	}
		
            //załóż
            mysql_query("update przedmioty_gracze set zalozony = 1 where gracz_id = ".$uzytkownik['gracz']." and id= ".$_GET['zaloz']);
            
            //zmień statystyki gracza
            mysql_query("update gracze set 
			atak = atak + ".$item['atak'].", 
			obrona = obrona + ".$item['obrona'].", 
			zycie_max = zycie_max + ".$item['zycie_max']." + ".$la1.", 
			obrazenia_min = obrazenia_min + ".$item['obrazenia_min']." + ".$da1.", 
			obrazenia_max = obrazenia_max + ".$item['obrazenia_max']." + ".$da1.", 
			sila_i = sila_i + ".$item['sila'].", 
			zrecznosc_i = zrecznosc_i + ".$item['zrecznosc'].", 
			wyrzymalosc_i = wyrzymalosc_i + ".$item['wyrzymalosc'].", 
			constitucion_i = constitucion_i + ".$item['constitucion'].", 
			carisma_i = carisma_i + ".$item['carisma'].", 
			inteligencja_i = inteligencja_i + ".$item['inteligencja'].", 
			mdchance = mdchance + ".$item['mdchance'].", 
			dhchance = dhchance + ".$item['dhchance'].", 
			ctchance = ctchance + ".$item['ctchance']." 
			where gracz = ".$uzytkownik['gracz']);

            echo "Equip item: <i>".$item['nazwa']."</i> <hr/>";
        }
    }
    
} elseif(!empty($_GET['zdejmij'])){
    // a może wciśnięto zdejmowanie przedmiotu


    $_GET['zdejmij'] = (int)$_GET['zdejmij'];

    //pobierzmy dane przedmiotu
    $item = mysql_fetch_array(mysql_query("select * from przedmioty_gracze inner join przedmioty on przedmiot_id = przedmiot where id = ".$_GET['zdejmij']." and gracz_id = ".$uzytkownik['gracz']));

    if(empty($item)){
    //jeżeli taki przedmiot nie istnieje, np bo gracz kombinował w adresie strony wpisując samemu jakieś nieistniejące dane
    echo "You have no items.<hr/>";
    } elseif($item['zalozony'] == 0){
    //jeżeli przedmiot nie jest założony 
    echo "Object not found.<hr/>";
    }else {
	
	$original['sila'] = $uzytkownik['sila'] + $item['sila'];
	
	if($original['sila'] > $uzytkownik['sila_max']){
	$sila_in = $original['sila'] - $uzytkownik['sila_max'];
	$original_item['sila'] = $item['sila'] - $sila_in;
	$da1 = (int)($original_item['sila'] / 10);
	} else {
	$da1 = (int)($item['sila'] / 10);
	}
	
	$item['obrazenia_min'] = $item['obrazenia_min'] + $da1;
	$item['obrazenia_max'] = $item['obrazenia_max'] + $da1;
	
	$original['constitucion'] = $uzytkownik['constitucion'] + $item['constitucion'];
	
	if($original['constitucion'] > $uzytkownik['constitucion_max']){
	$constitucion_in = $original['constitucion'] - $uzytkownik['constitucion_max'];
	$original_item['constitucion'] = $item['constitucion'] - $constitucion_in;
	$la1 = (int)($original_item['constitucion'] / 10);
	} else {
	$la1 = (int)($item['constitucion'] / 10);
	}
	
	$item['zycie_max'] = $item['zycie_max'] + $la1;
	
    //wszystko ok, zdejmij przedmiot
    mysql_query("update przedmioty_gracze set zalozony = 0 where gracz_id = ".$uzytkownik['gracz']." and id= ".$_GET['zdejmij']);
    
    //zmień statystyki gracza
    mysql_query("update gracze set 
	atak = atak - ".$item['atak'].", 
	obrona = obrona - ".$item['obrona'].", 
	zycie_max = zycie_max - ".$item['zycie_max'].", 
	obrazenia_min = obrazenia_min - ".$item['obrazenia_min'].", 
	obrazenia_max = obrazenia_max - ".$item['obrazenia_max'].", 
	sila_i = sila_i - ".$item['sila'].", 
	zrecznosc_i = zrecznosc_i - ".$item['zrecznosc'].", 
	wyrzymalosc_i = wyrzymalosc_i - ".$item['wyrzymalosc'].", 
	constitucion_i = constitucion_i - ".$item['constitucion'].", 
	carisma_i = carisma_i - ".$item['carisma'].", 
	inteligencja_i = inteligencja_i - ".$item['inteligencja'].", 
	mdchance = mdchance - ".$item['mdchance'].", 
	dhchance = dhchance - ".$item['dhchance'].", 
	ctchance = ctchance - ".$item['ctchance']." 
	where gracz = ".$uzytkownik['gracz']);

        //jeżeli gracz po zdjęciu przedmiotu ma więcej życia niż maksimum to popraw dane
        if($uzytkownik['zycie'] > $uzytkownik['zycie_max']){
            $uzytkownik['zycie'] = $uzytkownik['zycie_max'];
            mysql_query("update gracze set zycie = zycie_max where gracz = ".$uzytkownik['gracz']);
        }
    echo "Equip item: <i>".$item['nazwa']."</i> <hr/>";
    }
}

//pobieramy przedmioty z ekwipunku gracza, ale najpierw te zalozone
$sql = mysql_query("select * from przedmioty_gracze inner join przedmioty on przedmiot_id = przedmiot where gracz_id = ".$uzytkownik['gracz']." order by zalozony desc");

//sprawdzamy ilość wyszukanych przedmiotów
if(mysql_num_rows($sql) != 0) {
    //wyświetlamy nagłówek tabelki z listą przedmiotów
    echo "
    <table>
    <tr align='center'>
    <th>Name	|<br>Image	|</th>
	<th>Level		|</th>
    <th>Basics		|</th>
    <th>Stats		|</th>
	<th>Extras		|</th>
    <th></th>
    </tr>
    ";

    while($przedmiot = mysql_fetch_array($sql)){
        
        if($przedmiot['zalozony'] == 0) {
            //jeżeli dany przedmiot nie jest założony
            $opcje = "<a href='konto.php?zaloz=".$przedmiot['id']."'>Equip</a>";
        } else {
            //założony
            $opcje = "<a href='konto.php?zdejmij=".$przedmiot['id']."'>Remove</a>";
        }
         //dla każdego przedmiotu wyświetlamy jego dane
        echo "
        <tr align='center'>
            <td align='left'><center>".$przedmiot['nazwa']."<br><img src='items/".$przedmiot['obrazek'].".gif'></td>
			<td><center>".$przedmiot['level']."</td>
			<td><center>Strength: ".$przedmiot['sila']."
            <br><center>Ability: ".$przedmiot['zrecznosc']."
            <br><center>Agility: ".$przedmiot['wyrzymalosc']."
            <br><center>Constitution: ".$przedmiot['constitucion']."
			<br><center>Charisma: ".$przedmiot['carisma']."
            <br><center>Intelligence:".$przedmiot['inteligencja']."</td>
            <td><center>Attack: ".$przedmiot['atak']."
            <br><center>Defense: ".$przedmiot['obrona']."
            <br><center>Life: ".$przedmiot['zycie_max']."
            <br><center>Damage min: ".$przedmiot['obrazenia_min']."
            <br><center>Damage max:".$przedmiot['obrazenia_max']."</td>
			<td><center>Dodge: ".$przedmiot['mdchance']."
            <br><center>Doble~hit: ".$przedmiot['dhchance']."
            <br><center>Critical chance:".$przedmiot['ctchance']."</td>
            <td align='right'><center>".$opcje."</td>
        </tr>
        ";
    }
    echo "
    </table>
    ";
}

echo "
</div>
        </td>";

		}
//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?> 