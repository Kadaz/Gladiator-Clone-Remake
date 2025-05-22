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

if(!empty($_GET['oplayer'])){
    //zabezpiecz zmienne
    $_GET['oplayer'] = $_GET['oplayer'];
	$oplayer = mysql_fetch_array(mysql_query("select * from gracze where login ='".$_GET['oplayer']."'"));
	}
	
	if($oplayer['nivel'] >= 80){
	$oplayer['avatar'] = 10;
	} elseif($oplayer['nivel'] >= 70){
	$oplayer['avatar'] = 9;
	} elseif($oplayer['nivel'] >= 60){
	$oplayer['avatar'] = 8;
	} elseif($oplayer['nivel'] >= 50){
	$oplayer['avatar'] = 7;
	} elseif($oplayer['nivel'] >= 40){
	$oplayer['avatar'] = 6;
	} elseif($oplayer['nivel'] >= 30){
	$oplayer['avatar'] = 5;
	} elseif($oplayer['nivel'] >= 20){
	$oplayer['avatar'] = 4;
	} elseif($oplayer['nivel'] >= 10){
	$oplayer['avatar'] = 3;
	} elseif($oplayer['nivel'] >= 5){
	$oplayer['avatar'] = 2;
	} elseif($oplayer['nivel'] >= 1){
	$oplayer['avatar'] = 1;
	}
	
	$ed = (int)($oplayer['sila_i'] / 10);
	$oplayer['obrazenia_min'] = $oplayer['obrazenia_min'] + $ed;
	$oplayer['obrazenia_max'] = $oplayer['obrazenia_max'] + $ed;
	
	$oplayer['sila'] = $oplayer['sila'] + $oplayer['sila_i'];
	$oplayer['zrecznosc'] = $oplayer['zrecznosc'] + $oplayer['zrecznosc_i'];
	$oplayer['wyrzymalosc'] = $oplayer['wyrzymalosc'] + $oplayer['wyrzymalosc_i'];
	$oplayer['constitucion'] = $oplayer['constitucion'] + $oplayer['constitucion_i'];
	$oplayer['carisma'] = $oplayer['carisma'] + $oplayer['carisma_i'];
	$oplayer['inteligencja'] = $oplayer['inteligencja'] + $oplayer['inteligencja_i'];
	
	$plife = (int)($oplayer['zycie'] * 100 / $oplayer['zycie_max']);
	$pexp = (int)($oplayer['exp'] * 100 / $oplayer['exp_max']);
	$pst = (int)($oplayer['sila'] * 100 / $oplayer['sila_max']);
	$pab = (int)($oplayer['zrecznosc'] * 100 / $oplayer['zrecznosc_max']);
	$pag = (int)($oplayer['wyrzymalosc'] * 100 / $oplayer['wyrzymalosc_max']);
	$pco = (int)($oplayer['constitucion'] * 100 / $oplayer['constitucion_max']);
	$pch = (int)($oplayer['carisma'] * 100 / $oplayer['carisma_max']);
	$pin = (int)($oplayer['inteligencja'] * 100 / $oplayer['inteligencja_max']);
	
			if($oplayer['sila'] > $oplayer['sila_max']){
			$oplayer['sila'] = $oplayer['sila_max'];
			}
            if($oplayer['zrecznosc'] > $oplayer['zrecznosc_max']){
			$oplayer['zrecznosc'] = $oplayer['zrecznosc_max'];
			}
            if($oplayer['wyrzymalosc'] > $oplayer['wyrzymalosc_max']){
			$oplayer['wyrzymalosc'] = $oplayer['wyrzymalosc_max'];
			}
			if($oplayer['constitucion'] > $oplayer['constitucion_max']){
			$oplayer['constitucion'] = $oplayer['constitucion_max'];
			}
			if($oplayer['carisma'] > $oplayer['carisma_max']){
			$oplayer['carisma'] = $oplayer['carisma_max'];
			}
			if($oplayer['inteligencja'] > $oplayer['inteligencja_max']){
			$oplayer['inteligencja'] = $oplayer['inteligencja_max'];
			}
	
?>
<h><center><p><b><a href="send_mensajes.php?sended=<?php echo "".$oplayer['login'].""; ?>" style="color:#8fff;">Send message</a><br></b><hr/></p>
<?php if($oplayer['nivel'] > 1){ ?><h><center><p><b><a href="coloseum.php?walka=<?php echo "".$oplayer['gracz'].""; ?>" style="color:#8fff;">Attack!</a><br></b><hr/></p><?php } ?>
<div style="width:200px;text-align:center">
			<center><div style="background-image:url(img/faces/spieler_name_bg.png);width:168px;height:60px;overflow:hidden"> <span style=color:#FFFF00><font size=4><b><?php echo $oplayer['login']; ?><br><font size=2><?php echo $oplayer['titulo']; ?></font></span></b></font> <align="absmiddle" border="0"></div></center>
			<img src="img/faces/<?php echo $oplayer['plec']; ?>_<?php echo $oplayer['avatar']; ?>.gif" align="absmiddle" border="0">
                <div id="charstats" style="width:173px">
    <div style="background-image:url(img/char_status_kopf.jpg);width:173px;height:5px;overflow:hidden"></div>
    <div class="charstats_bg" id="char_panzer_tt">
        <span class="charstats_value21">Level</span>

        <span id="char_level" class="charstats_value22"><?php echo $oplayer['nivel']; ?></span>
    </div>
    <div class="charstats_bg" id="char_leben_tt" onmouseover="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Puntos de vida:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'><?php echo $oplayer['zycie']; ?> / <?php echo $oplayer['zycie_max']; ?></td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Vida al nivel <?php echo $oplayer['nivel']; ?>: </td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'><?php $ll = $oplayer['nivel'] - 1 * 25 + 100; echo $ll; ?></td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Mediante objetos:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>+644</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Por alza:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Bonificación mediante Constitución:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>+2025</td></tr><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>Regeneración:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>470 por hora</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Por Constitución:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>+166</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Por nivel:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>+62</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Por gremio:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>+14</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Por pacto:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#00B712;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Por disfraces:</td><td style=\'padding-left:20px;text-align:right;color:#00B712;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>+228</td></tr></table>')">
        <span class="charstats_text">Life points</span>
        <div class="charstats_balken">
            <div class="charstats_balken_leben" id="char_leben_balken" style="width:<?php echo $plife; ?>%"></div>
        </div>
        <span id="char_leben" class="charstats_value"><?php echo $oplayer['zycie']; ?></span>

    </div>
        <div class="charstats_bg" id="char_exp_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Experience:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>1 / 10</td></tr><tr><td style=\'text-align:left;color:#DDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Required until level 2:</td><td style=\'padding-left:20px;text-align:right;color:#DDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>9</td></tr></table>')">
        <span class="charstats_text">Experience</span>
        <div class="charstats_balken">
            <div class="charstats_balken_xp" style="width:<?php echo $pexp; ?>%"></div>
        </div>
        <span id="char_exp" class="charstats_value"><?php echo $oplayer['exp']; ?></span>
    </div>

    
            <div class="charstats_bg" id="char_f0_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Strength:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Basic:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maximum:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>13</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 from 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Increases damage made on opponent and the chance of blocking opposing hits.</div></td></tr></table>')">
            <span class="charstats_text">Strength</span>
            <div class="charstats_balken">
                <div class="charstats_balken_misc" id="charbalken_f0" style="width:<?php echo $pst; ?>%"></div>
            </div>
            <span id="char_f0" class="charstats_value"><?php echo $oplayer['sila']; ?></span>
        </div>
            <div class="charstats_bg" id="char_f1_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Skill:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>6</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Basic:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>6</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maximum:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>10</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 from 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Increases chance of hitting as well as the chance of critically hitting your opponent.</div></td></tr></table>')">

            <span class="charstats_text">Skill</span>
            <div class="charstats_balken">
                <div class="charstats_balken_misc" id="charbalken_f1" style="width:<?php echo $pab; ?>%"></div>
            </div>
            <span id="char_f1" class="charstats_value"><?php echo $oplayer['zrecznosc']; ?></span>
        </div>
            <div class="charstats_bg" id="char_f2_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>wyrzymalosc:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Basic:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maximum:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 from 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Decreases opponent`s chance of hitting and his chance of critically hitting.</div></td></tr></table>')">
            <span class="charstats_text">Agility</span>

            <div class="charstats_balken">
                <div class="charstats_balken_misc" id="charbalken_f2" style="width:<?php echo $pag; ?>%"></div>
            </div>
            <span id="char_f2" class="charstats_value"><?php echo $oplayer['wyrzymalosc']; ?></span>
        </div>
            <div class="charstats_bg" id="char_f3_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Constitution:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Basic:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maximum:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 from 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Increases maximum life points and regeneration.</div></td></tr></table>')">
            <span class="charstats_text">Constitution</span>
            <div class="charstats_balken">

                <div class="charstats_balken_misc" id="charbalken_f3" style="width:<?php echo $pco; ?>%"></div>
            </div>
            <span id="char_f3" class="charstats_value"><?php echo $oplayer['constitucion']; ?></span>
        </div>
            <div class="charstats_bg" id="char_f4_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Charisma:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Basic:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maximum:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 from 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Increases the chance of a double hit, in addition it increases your presence in dungeon battles.</div></td></tr></table>')">
            <span class="charstats_text">Charisma</span>
            <div class="charstats_balken">
                <div class="charstats_balken_misc" id="charbalken_f4" style="width:<?php echo $pch; ?>%"></div>

            </div>
            <span id="char_f4" class="charstats_value"><?php echo $oplayer['carisma']; ?></span>
        </div>
            <div class="charstats_bg" id="char_f5_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Intelligence:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Basic:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maximum:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 from 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Increases expedition opponent learning chance. <br />Increases healing in dungeon battles and the chance of critical healing. <br />Increases healing value through nutrition.</div></td></tr></table>')">
            <span class="charstats_text">Intelligence</span>
            <div class="charstats_balken">
                <div class="charstats_balken_misc" id="charbalken_f5" style="width:<?php echo $pin; ?>%"></div>
            </div>

            <span id="char_f5" class="charstats_value"><?php echo $oplayer['inteligencja']; ?></span>
        </div>
    
    <div class="charstats_bg" id="char_panzer_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Armour:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Absorbs damage:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 - 0</td></tr><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>Resilience:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through wyrzymalosc:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Chance of avoiding critical hits:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 %</td></tr><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>Blocking value:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through Strength:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Chance to block a hit:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 %</td></tr></table>')">
        <span class="charstats_value21">Armour</span>
        <span id="char_panzer" class="charstats_value22"><?php echo $oplayer['obrona']; ?></span>
    </div>
    <div class="charstats_bg" id="char_schaden_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Damage:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>2 - 2</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Basic:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>2 - 2</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through Strength:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through reinforcement:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>Critical damage:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through items:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Through dexterity:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Chance for critical damage:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 %</td></tr></table>')">

        <span class="charstats_value21">Damage</span>
        <span id="char_schaden" class="charstats_value22"><?php echo $oplayer['obrazenia_min']; ?>-<?php echo $oplayer['obrazenia_max']; ?></span>
    </div>
    <div style="background-image:url(img/char_status_abschluss.jpg);width:173px;height:5px;overflow:hidden"></div>
</div>
</div>
<br><center>
<?php

//pobieramy przedmioty z ekwipunku gracza, ale najpierw te zalozone
$sql = mysql_query("select * from przedmioty_gracze inner join przedmioty on przedmiot_id = przedmiot where gracz_id = ".$oplayer['gracz']." and zalozony > 0 order by zalozony desc");

//sprawdzamy ilość wyszukanych przedmiotów
if(mysql_num_rows($sql) != 0) {
    //wyświetlamy nagłówek tabelki z listą przedmiotów
    echo "
    <br/><br/><b>Items</b><hr/>
    <table>
    <tr align='center'>
    <th>Name	|<br>Image	|</th>
    <th>Level		|</th>
    <th>Basics		|</th>
    <th>Stats		|</th>
    </tr>
    ";

    while($przedmiot = mysql_fetch_array($sql)){
        
         //dla każdego przedmiotu wyświetlamy jego dane
        echo "
        <tr align='center'>
            <td align='left'><center>".$przedmiot['nazwa']."<br><img src='items/".$przedmiot['obrazek'].".gif'></td>
            <td><center>".$przedmiot['level']."</td>
			<td><center>Strength ".$przedmiot['sila']."
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





//jeżeli gracz nie ma wgranego avatara to wyświetl domyślny

//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?> 
