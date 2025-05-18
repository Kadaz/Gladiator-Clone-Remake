<?php
//wlaczamy bufor
ob_start();

//pobieramy zawartosc pliku ustawien
require_once('var/ustawienia.php');

//startujemy lub przedluzamy sesje
session_start();

//dolaczamy plik, który sprawdzi czy napewno mamy dostep do tej strony
require_once('test_zalogowanego.php');


//pobieramy naglówek strony
require_once('gora_strony2.php');


//pobieramy zawartosc menu
require_once('menu_m.php');


if($uzytkownik['bendicion1_type'] == 1){
$dvdrt = 0.25;
} else {
$dvdrt = 1;
}
if($uzytkownik['bendicion1_type'] == 4){
$ctt = 2;
} else {
$ctt = 0;
}
if($uzytkownik['bendicion4_type'] == 1){
$egqt = 6;
} else {
$egqt = 1;
}
if($uzytkownik['bendicion4_type'] == 2){
$ehqt = 6;
} else {
$ehqt = 1;
}
if($uzytkownik['bendicion4_type'] == 3){
$eeqt = 6;
} else {
$eeqt = 1;
}

if($uzytkownik['nivel'] < 20){

echo "<h2>You're not the level needed to enter this map! You need to get to level 20 to fight!</h2>";

} else {

echo "<center>";

if($uzytkownik['atak'] <= 0){

echo '<h2>You have no attack, buy weaponry to confront opponents.</h2><hr>';

} elseif($uzytkownik['obrona'] <= 0){

echo '<h2>You have no defense, buy weaponry to confront opponents.</h2><hr>';

} else {

if(isset($_GET['walka'])){
    //jezeli wcisnieto walke z wybranym potworem
    
    // w linku podaje sie ID potwora z którym mamy walczyc, wiec zabezpieczymy sobie ta zmienna
    $_GET['walka'] = (int)$_GET['walka'];
    

    $pozostalo = $uzytkownik['ostatnia_walka_pvc'] + 60 - time();
    if($uzytkownik['zycie'] < 5){
        echo "Your life is not enough to fight.<hr/>";
    } elseif($pozostalo > 0){
        echo "You recently had a fight.<hr/>";
    } else {

        //pobieramy dane
        $przeciwnik = mysql_fetch_array(mysql_query("select * from potwory where potwor = ".$_GET['walka']));    
        
        if(empty($przeciwnik)){
            //jezeli nie pobrano przeciwnika 
            echo "No monsters.<hr/>";
        } else {
		
			 $przeciwnik['sila'] = rand($przeciwnik['sila'],$przeciwnik['sila_max']);
			 $przeciwnik['zrecznosc'] = rand($przeciwnik['zrecznosc'],$przeciwnik['zrecznosc_max']);
			 $przeciwnik['wyrzymalosc'] = rand($przeciwnik['wyrzymalosc'],$przeciwnik['wyrzymalosc_max']);
			 $przeciwnik['constitucion'] = rand($przeciwnik['constitucion'],$przeciwnik['constitucion_max']);
			 $przeciwnik['carisma'] = rand($przeciwnik['carisma'],$przeciwnik['carisma_max']);
			 $przeciwnik['inteligencja'] = rand($przeciwnik['inteligencja'],$przeciwnik['inteligencja_max']);
			 $przeciwnik['zycie'] = rand($przeciwnik['zycie'],$przeciwnik['zycie_max']);
			 $przeciwnik['obrazenia_min'] = rand($przeciwnik['obrazenia_min'],$przeciwnik['obrazenia_min_max']);
			 $przeciwnik['obrazenia_max'] = rand($przeciwnik['obrazenia_max'],$przeciwnik['obrazenia_max_max']);
			 $przeciwnik['atak'] = rand($przeciwnik['atak'],$przeciwnik['atak_max']);
			 $przeciwnik['obrona'] = rand($przeciwnik['obrona'],$przeciwnik['obrona_max']);
			 $le1 = (int)($przeciwnik['constitucion'] / 7);
			 $le = $le1 * 100;
			 $przeciwnik['constitucion'];			 
			 $de = (int)($przeciwnik['sila'] / 10);
			 $przeciwnik['obrazenia_min'] = $przeciwnik['obrazenia_min'] + $de;
			 $przeciwnik['obrazenia_max'] = $przeciwnik['obrazenia_max'] + $de;
			 $przeciwnik['mdchance'] = rand($przeciwnik['mdchance'],$przeciwnik['mdchance_max']);
			 $przeciwnik['dhchance'] = rand($przeciwnik['dhchance'],$przeciwnik['dhchance_max']);
			 $przeciwnik['ctchance'] = rand($przeciwnik['ctchance'],$przeciwnik['ctchance_max']);
			 
			 if($uzytkownik['bendicion3_type'] == 5){
$przeciwnik['obrona'] = $uzytkownik['nivel'] * 100;
} else {
$przeciwnik['obrona'] = $przeciwnik['obrona'];
}
		
		
            //wszystkiedane potwora mamy w zmiennej $przeciwnik
            echo "<b><h1>The battle begins.</h1></b><br><br>";
	
			echo "

    <table>
	<tr align='center'>
    <th><br><div style='width:200px;text-align:center'>
			<center><div style='background-image:url(img/faces/spieler_name_bg.png);width:168px;height:60px;overflow:hidden'> <span style=color:#FFFF00><font size=4><b>".$uzytkownik['login']."<br><font size=2>".$uzytkownik['titulo']."</font></span></b></font> <align='absmiddle' border='0'></div></center>
			<img src='img/faces/".$uzytkownik['plec']."_".$uzytkownik['avatar'].".gif' align='absmiddle' border='0'>
                <div id='charstats' style='width:173px'>
    <div style='background-image:url(img/char_status_kopf.jpg);width:173px;height:5px;overflow:hidden'></div>
    <div class='charstats_bg' id='char_panzer_tt'>
        <span class='charstats_value21'>Level</span>

        <span id='char_level' class='charstats_value22'>".$uzytkownik['nivel']."</span>
    </div>
    <div class='charstats_bg' id='char_leben_tt'>
        <span class='charstats_text'>Life points</span>
        <div class='charstats_balken'>
            <div class='charstats_balken_leben' id='char_leben_balken' style='width:".$plife."%'></div>
        </div>
        <span id='char_leben' class='charstats_value'>".$uzytkownik['zycie']."</span>

    </div>
        <div class='charstats_bg' id='char_exp_tt'>
        <span class='charstats_text'>Experience</span>
        <div class='charstats_balken'>
            <div class='charstats_balken_xp' style='width:".$pexp."%'></div>
        </div>
        <span id='char_exp' class='charstats_value'>".$uzytkownik['exp']."</span>
    </div>

    
            <div class='charstats_bg' id='char_f0_tt'>
            <span class='charstats_text'>Strength</span>
            <div class='charstats_balken'>
                <div class='charstats_balken_misc' id='charbalken_f0' style='width:".$pst."%'></div>
            </div>
            <span id='char_f0' class='charstats_value'>".$uzytkownik['sila']."</span>
        </div>
            <div class='charstats_bg' id='char_f1_tt'>

            <span class='charstats_text'>Skill</span>
            <div class='charstats_balken'>
                <div class='charstats_balken_misc' id='charbalken_f1' style='width:".$pab."%'></div>
            </div>
            <span id='char_f1' class='charstats_value'>".$uzytkownik['zrecznosc']."</span>
        </div>
            <div class='charstats_bg' id='char_f2_tt'>
            <span class='charstats_text'>Agility</span>

            <div class='charstats_balken'>
                <div class='charstats_balken_misc' id='charbalken_f2' style='width:".$pag."%'></div>
            </div>
            <span id='char_f2' class='charstats_value'>".$uzytkownik['wyrzymalosc']."</span>
        </div>
            <div class='charstats_bg' id='char_f3_tt'>
            <span class='charstats_text'>Constitution</span>
            <div class='charstats_balken'>

                <div class='charstats_balken_misc' id='charbalken_f3' style='width:".$pco."%'></div>
            </div>
            <span id='char_f3' class='charstats_value'>".$uzytkownik['constitucion']."</span>
        </div>
            <div class='charstats_bg' id='char_f4_tt'>
            <span class='charstats_text'>Charisma</span>
            <div class='charstats_balken'>
                <div class='charstats_balken_misc' id='charbalken_f4' style='width:".$pch."%'></div>

            </div>
            <span id='char_f4' class='charstats_value'>".$uzytkownik['carisma']."</span>
        </div>
            <div class='charstats_bg' id='char_f5_tt'>
            <span class='charstats_text'>Intelligence</span>
            <div class='charstats_balken'>
                <div class='charstats_balken_misc' id='charbalken_f5' style='width:".$pin."%'></div>
            </div>

            <span id='char_f5' class='charstats_value'>".$uzytkownik['inteligencja']."</span>
        </div>
    
    <div class='charstats_bg' id='char_panzer_tt'>
        <span class='charstats_value21'>Armour</span>
        <span id='char_panzer' class='charstats_value22'>".$uzytkownik['obrona']."</span>
    </div>
    <div class='charstats_bg' id='char_schaden_tt'>

        <span class='charstats_value21'>Damage</span>
        <span id='char_schaden' class='charstats_value22'>".$uzytkownik['obrazenia_min']."-".$uzytkownik['obrazenia_max']."</span>
    </div>
    <div style='background-image:url(img/char_status_abschluss.jpg);width:173px;height:5px;overflow:hidden'></div>
</div>      
</div></th>


    <th><br>         <div style='width:200px;text-align:center'>
			<center><div style='background-image:url(img/faces/spieler_name_bg.png);width:168px;height:60px;overflow:hidden'> <span style=color:#FFFF00><font size=4><b>".$przeciwnik['nazwa']."</span></b></font> <align='absmiddle' border='0'></div></center>
			<img src='npc/".$przeciwnik['obrazek'].".jpg' align='absmiddle' border='0'>
                <div id='charstats' style='width:173px'>
    <div style='background-image:url(img/char_status_kopf.jpg);width:173px;height:5px;overflow:hidden'></div>
    <div class='charstats_bg' id='char_panzer_tt'>
        <span class='charstats_value21'>Level</span>

        <span id='char_level' class='charstats_value22'>".$przeciwnik['level']."</span>
    </div>
    <div class='charstats_bg' id='char_leben_tt'>
        <span class='charstats_text'>Life points</span>
        <div class='charstats_balken'>
            <div class='charstats_balken_leben' id='char_leben_balken' style='width:100%'></div>
        </div>
        <span id='char_leben' class='charstats_value'>".$przeciwnik['zycie']."</span>

    </div>
        <div class='charstats_bg' id='char_exp_tt'>
        <span class='charstats_text'>Experience</span>
        <div class='charstats_balken'>
            <div class='charstats_balken_xp' style='width:0%'></div>
        </div>
        <span id='char_exp' class='charstats_value'>0</span>
    </div>

    
            <div class='charstats_bg' id='char_f0_tt'>
            <span class='charstats_text'>Strength</span>
            <div class='charstats_balken'>
                <div class='charstats_balken_misc' id='charbalken_f0' style='width:100%'></div>
            </div>
            <span id='char_f0' class='charstats_value'>".$przeciwnik['sila']."</span>
        </div>
            <div class='charstats_bg' id='char_f1_tt'>

            <span class='charstats_text'>Skill</span>
            <div class='charstats_balken'>
                <div class='charstats_balken_misc' id='charbalken_f1' style='width:100%'></div>
            </div>
            <span id='char_f1' class='charstats_value'>".$przeciwnik['zrecznosc']."</span>
        </div>
            <div class='charstats_bg' id='char_f2_tt'>
            <span class='charstats_text'>Agility</span>

            <div class='charstats_balken'>
                <div class='charstats_balken_misc' id='charbalken_f2' style='width:100%'></div>
            </div>
            <span id='char_f2' class='charstats_value'>".$przeciwnik['wyrzymalosc']."</span>
        </div>
            <div class='charstats_bg' id='char_f3_tt'>
            <span class='charstats_text'>Constitution</span>
            <div class='charstats_balken'>

                <div class='charstats_balken_misc' id='charbalken_f3' style='width:100%'></div>
            </div>
            <span id='char_f3' class='charstats_value'>".$przeciwnik['constitucion']."</span>
        </div>
            <div class='charstats_bg' id='char_f4_tt'>
            <span class='charstats_text'>Charisma</span>
            <div class='charstats_balken'>
                <div class='charstats_balken_misc' id='charbalken_f4' style='width:100%'></div>

            </div>
            <span id='char_f4' class='charstats_value'>".$przeciwnik['carisma']."</span>
        </div>
            <div class='charstats_bg' id='char_f5_tt'>
            <span class='charstats_text'>Intelligence</span>
            <div class='charstats_balken'>
                <div class='charstats_balken_misc' id='charbalken_f5' style='width:100%'></div>
            </div>

            <span id='char_f5' class='charstats_value'>".$przeciwnik['inteligencja']."</span>
        </div>
    
    <div class='charstats_bg' id='char_panzer_tt'>
        <span class='charstats_value21'>Armour</span>
        <span id='char_panzer' class='charstats_value22'>".$przeciwnik['obrona']."</span>
    </div>
    <div class='charstats_bg' id='char_schaden_tt'>

        <span class='charstats_value21'>Damage</span>
        <span id='char_schaden' class='charstats_value22'>".$przeciwnik['obrazenia_min']."-".$przeciwnik['obrazenia_max']."</span>
    </div>
    <div style='background-image:url(img/char_status_abschluss.jpg);width:173px;height:5px;overflow:hidden'></div>
</div>      
</div></th>
    </tr>
	</table>
			";

            //walka ma trwac dopóki gracz i przeciwnik maja minimum 1 punkt zycia
            while(($uzytkownik['zycie'] > 0) && ($przeciwnik['zycie'] > 0)){
                //losujemy ile obrazen zada gracz potworowi
			 $dho1 = (int)(($uzytkownik['carisma'] - $przeciwnik['carisma']) + ($przeciwnik['dhchance']));
			 if($dho1 > 0){
			 $dho2 = rand(1,50);
			 $dho = $dho1 + $dho2;
			 } else {
			 $dho = 1;
			 }
			 $do = (int)(($przeciwnik['wyrzymalosc'] - $uzytkownik['zrecznosc']) + $przeciwnik['mdchance']);
			 if($do > 0){
			 $pdo1 = (int)(($do + 50) / 2);
			 $pdo2 = (int)($do - 50);
			 $pdo3 = $pdo2 - $pdo1;
			 $pdo4 = rand(1,50);
			 $pdo5 = $pdo3 + $pdo4;
			 $pdo = $pdo5;
			 } else {
			 $pdo = 1;
			 }
			 
			 
			 
			 $obrazenia = rand($uzytkownik['obrazenia_min'],$uzytkownik['obrazenia_max']);
                
                $mod = $uzytkownik['atak'] / $przeciwnik['obrona'];
                if($mod < 0.5) $mod = 1;
                
                $obrazenia = floor($obrazenia * $mod);
                if($obrazenia < 1) $obrazenia = 1;     
                if($obrazenia > $przeciwnik['zycie']) $obrazenia = $przeciwnik['zycie'];
						 
						 if($pdo > 75){
						 
						 echo "Missed!<br/>";
						 
						 } else {
										
						 if($dho > 75){
						 
						 
			 $ctu1 = (int)(($uzytkownik['zrecznosc'] / 10) + ($uzytkownik['ctchance']));
			 $ctu2 = rand(1,50);
			 $ctu3 = $ctu1 + $ctu2;
			 if($ctu3 > 75){
			 $ctu = 2;
			 } else {
			 $ctu = 1;
			 }


                $przeciwnik['zycie'] -= $obrazenia * $ctu;
                echo "You hit ".$obrazenia." damage to your opponent!<br/>";
				
			 $ctu1 = (int)(($uzytkownik['zrecznosc'] / 10) + ($uzytkownik['ctchance']));
			 $ctu2 = rand(1,50);
			 $ctu3 = $ctu1 + $ctu2;
			 if($ctu3 > 75){
			 $ctu = 2;
			 } else {
			 $ctu = 1;
			 }
				
				$przeciwnik['zycie'] -= $obrazenia * $ctu;
                echo "You hit ".$obrazenia." damage to your opponent!<br/>";
				
				} else {
				
			 $ctu1 = (int)(($uzytkownik['zrecznosc'] / 10) + ($uzytkownik['ctchance']));
			 $ctu2 = rand(1,50);
			 $ctu3 = $ctu1 + $ctu2;
			 if($ctu3 > 75){
			 $ctu = 2;
			 } else {
			 $ctu = 1;
			 }
				
				$przeciwnik['zycie'] -= $obrazenia * $ctu;
                echo "You hit ".$obrazenia." damage to your opponent!<br/>";
				
				}
				
				}

		
		if($przeciwnik['zycie'] < 1){
                    //potwór nie zyje
                    echo "<br/>You gived blow and kill ".$przeciwnik['login']."<br/>";
        $przeciwnik['zycie'] = 0;

                } else {
				
			 $dhu1 = (int)(($przeciwnik['carisma'] - $uzytkownik['carisma']) + ($uzytkownik['dhchance']));
			 if($dhu1 > 0){
			 $dhu2 = rand(1,50);
			 $dhu = $dhu1 + $dhu2;
			 } else {
			 $dhu = 1;
			 }
			 $du = (int)(($uzytkownik['wyrzymalosc'] - $przeciwnik['zrecznosc']) + ($uzytkownik['mdchance']));
			 if($du > 0){
			 $pdu1 = (int)(($du) / 2);
			 $pdu2 = rand(1,50);
			 $pdu = $pdu1 + $pdu2;
			 } else {
			 $pdu = 1;
			 }
					
                    $obrazenia = rand($przeciwnik['obrazenia_min'],$przeciwnik['obrazenia_max']);


                    $mod = $przeciwnik['atak'] / $uzytkownik['obrona'];
                    if($mod < 0.5) $mod = 0.5;					
					$obrazenia = floor($obrazenia * $mod);
                    if($obrazenia < 1) $obrazenia = 1;
                    if($obrazenia > $uzytkownik['zycie']) $obrazenia = $uzytkownik['zycie'];
					
                		 if($pdu < 75){
						 if($dhu < 75){
						 
			 $cto1 = (int)(($przeciwnik['zrecznosc'] / 10) + ($przeciwnik['ctchance']));
			 $cto2 = rand(1,50);
			 $cto3 = $cto1 + $cto2;
			 if($cto3 > 75){
			 $cto = 2;
			 } else {
			 $cto = 1;
			 }

                $uzytkownik['zycie'] -= $obrazenia * $cto;
                echo "Enemy hit ".$obrazenia." damage to you!<br/>";
				
				} else {
				
			 $cto1 = (int)(($przeciwnik['zrecznosc'] / 10) + ($przeciwnik['ctchance']));
			 $cto2 = rand(1,50);
			 $cto3 = $cto1 + $cto2;
			 if($cto3 > 75){
			 $cto = 2;
			 } else {
			 $cto = 1;
			 }
				
				$uzytkownik['zycie'] -= $obrazenia * $cto;
                echo "Enemy hit ".$obrazenia." damage to you!<br/>";
				
			 $cto1 = (int)(($przeciwnik['zrecznosc'] / 10) + ($przeciwnik['ctchance']));
			 $cto2 = rand(1,50);
			 $cto3 = $cto1 + $cto2;
			 if($cto3 > 75){
			 $cto = 2;
			 } else {
			 $cto = 1;
			 }
				
				$uzytkownik['zycie'] -= $obrazenia * $cto;
                echo "Enemy hit ".$obrazenia." damage to you!<br/>";
				
				}
				
				} else {
				echo "Missed!<br/>";
				}
				}
                echo "<br/>";
            }

            if($uzytkownik['zycie'] > 0){
			
			$przeciwnik['zloto'] = rand($przeciwnik['oro_min'],$przeciwnik['oro_max']);
			
                //gracz wygral walke
				
				if($uzytkownik['rank'] > 1) {
				$double = 2;
				} else {
				$double = 1;
				}
				
				$zloto1 = $przeciwnik['oro_min'];
				$zloto2 = $przeciwnik['oro_max'];
				$zloto3 = rand($zloto1,$zloto2) * $double;
				$zloto = (int)($zloto3 + (int)($zloto3 * $ctt) * $egqt);
				$exp1 = $przeciwnik['exp'];
				$exp2 = $przeciwnik['exp_max'];
				$exp3 = rand($exp1,$exp2) * $double;
				$exp = (int)($exp3 + (int)($exp3 * $ctt) * $eeqt);
				$honor1 = 1;
				$honor2 = 50 * $uzytkownik['nivel'] * 0.25;
				$honor3 = rand($honor1,$honor2) * $double;
				$honor = (int)($honor3 * (int)($honor3 * $ctt) * $ehqt);
				$przeciwnik['punkty'] = rand(1,3);
				$przeciwnik['punkty'] = $przeciwnik['punkty'] * $double;
				$przeciwnik['punkty'] = $przeciwnik['punkty'] * ($przeciwnik['punkty'] * $ctt);
				
                echo "You win the battle and you get ".$przeciwnik['punkty']." points, ".$honor." honor, ".$exp." experience and ".$zloto." gold!";

                mysql_query("update gracze set ostatnia_walka_pvc = ".time().", victorias = victorias + 1, exp = exp + ".$exp.", honor = honor + ".$honor.", punkty = punkty + ".$przeciwnik['punkty'].", zloto = zloto + ".$zloto.", zycie = ".$uzytkownik['zycie']." where gracz = ".$uzytkownik['gracz']);

            } else {
                //przegrales

                echo "You lost the battle!";

                mysql_query("update gracze set ostatnia_walka_pvc = ".time().", perdidas = perdidas + 1, zycie = ".$uzytkownik['zycie']." where gracz = ".$uzytkownik['gracz']);
            }
            
            $uzytkownik['ostatnia_walka_pvc'] = time();
            echo "<hr/>";
        }
    }
}
}

if($uzytkownik['rank'] > 2){
$dvdr = 4;
} elseif($uzytkownik['rank'] > 1) {
$dvdr = 2;
} else {
$dvdr = 1;
}

$pozostalo = (int)($uzytkownik['ostatnia_walka_pvc'] + 60 / $dvdr) - time() * ($dvdrt);
if($uzytkownik['zycie'] < 5){
    echo "You do not have enough life to fight.";
} elseif($pozostalo > 0){
    
    //gracz niedawno prowadzil walke

    //dodajemy funkcje liczaca czas
    ?>
    <script mape='text/javascript'>        
        function liczCzas(ile) {
            godzin = Math.floor(ile / 3600);
            minut = Math.floor((ile - godzin * 3600) / 60);
            sekund = ile - minut * 60 - godzin * 3600;
            if (godzin < 10){ godzin = "0"+ godzin; }
            if (minut < 10){ minut = "0" + minut; }
            if (sekund < 10){ sekund = "0" + sekund; }
            if (ile > 0) {
                ile--;
                document.getElementById("zegar").innerHTML = godzin + ':' + minut + ':' + sekund;
                setTimeout("liczCzas("+ile+")", 1000);
            } else {
                document.getElementById("zegar").innerHTML = "[Terminado]";
            }
        }
    </script>
    Tiempo de espera para volver a luchar: <span id='zegar'></span> 
    <?php 
	
	echo "<script mape='text/javascript'>liczCzas(".$pozostalo.")</script>"; 
} else {

?>

<div style="position: relative;">
<img src="img/area/city_0.jpg" usemap="#city" width="532" height="400" style="border:none;" />

<map name="city">
	<area shape="rect" coords="70,85,140,210" title="Hermit" alt="Hermit" href="l_event.php?map=event"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Hermit</td></tr></table>')" />
	<area shape="rect" coords="0,0,180,65" title="City" alt="City" href="city.php"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>City</td></tr></table>')" />
	<area shape="rect" coords="0,320,280,400" title="Grimwood" alt="Grimwood" href="l_forest.php?map=forest"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Grimwood</td></tr></table>')" />
	<area shape="rect" coords="350,290,520,520" title="Pirates" alt="Pirates" href="l_pirate.php?map=pirate"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Mountain</td></tr></table>')" />
	<area shape="rect" coords="160,150,270,255" title="Mountain" alt="Mountain" href="l_mountains.php?map=mountains"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Mountain</td></tr></table>')" />
	<area shape="rect" coords="280,20,380,145" title="Temple" alt="Temple" href="l_temple.php?map=temple"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Mountain</td></tr></table>')" />
	<area shape="rect" coords="450,135,530,210" title="Cave" alt="Cave" href="l_cave.php?map=cave"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Mountain</td></tr></table>')" />
	<area shape="rect" coords="410,0,530,80" title="Barbary" alt="Barbary" href="l_barbary.php?map=barbary"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Mountain</td></tr></table>')" />
	<area shape="rect" coords="15,220,95,285" title="Campment" alt="Campment" href="l_campment.php?map=campment"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Mountain</td></tr></table>')" />
</map>

</div>

<center>

<?php

	if(empty($_GET['map'])) $_GET['map'] = '0';

    //pobieramy liste potworów	
    $potwory = mysql_query("select * from potwory where map='".$_GET['map']."'");
    if(mysql_num_rows($potwory) == 0){
	
	$map = array('cave');


//jezeli nie wybrano mapu to ustawiamy domyslny map przedmiotów do kupienia na bron
if(empty($_GET['map'])) $_GET['map'] = 'cave';

//sprawdzamy czy gracz wybral dozwolony map przedmiotów, jezeli nie, to pokaz liste broni
if(!in_array($_GET['map'],$map)) $_GET['map'] = 'cave';
//wiecej o in_array mozesz poczytac na http://php.net/manual/pl/function.in-array.php
		
    } else {
	
	$item = mysql_fetch_array(mysql_query("select * from potwory where map='".$_GET['map']."' order by typ desc"));
	
		echo "<table width='100%'>";
		
        while($potwor = mysql_fetch_array($potwory)){
            echo "
			<tr>
			".$potwor['nazwa']."<br>
            <img src='npc/".$potwor['obrazek'].".jpg' witdh='123px' height='142px'><br>
            <a href='l_".$potwor['map'].".php?walka=".$potwor['potwor']."'><input class='button2' value='Fight!' type='submit'></input></a>
			<br>
			
			";
        }
        echo "</table>";
    }

}
?>

<?php
}
//pobieramy stopke
require_once('dol_strony.php');

//wylaczamy bufor
ob_end_flush();
?> 