<?php
//wlaczamy bufor
ob_start();

//pobieramy zawartosc pliku ustawien
require_once('var/ustawienia.php');

//startujemy lub przedluzamy sesje
session_start();

//dolaczamy plik, który sprawdzi czy napewno mamy dostep do tej strony
require_once('test_zalogowanego.php');

//sprawdzamy czy gracz pracuje
if ($uzytkownik['pracuje'] > 0){
    //jezeli gracz ma ustawione, ze pracuje
    header("Location: praca.php");
}


//pobieramy naglówek strony
require_once('gora_strony2.php');
//pobieramy zawartosc menu
require_once('menu.php');
?>

<div id="popupmessage" style="display:block;filter:alpha(opacity=100);-moz-opacity:1.0;"></div>

<script type="text/javascript" src="4115/js/work.js"></script>

<p class="buildingDesc">

    <img src="img/arena.jpg" align="left" />
You smell fear and death as soon as you enter the arena. Know the legends that were born here in the sand - and how they became dust again.<br><br>

You can test yourself as a gladiator in the arena.<br><br>

To earn a higher place in the sand have to win against someone ------------------------------------ ---------------------------. ----------------------------- ------------------------.<br><br></p>

                <div class="title_box">
                    <div class="title_inner"><center>
					<?php 
					
					if($uzytkownik['arena_level'] == 2){
					
					echo 'League wrestlers Circus (Nivel 2-9)';
					
					} elseif($uzytkownik['arena_level'] == 10){
					
					echo 'League wrestlers Circus (Nivel 10-19)';
					
					} elseif($uzytkownik['arena_level'] == 20){
					
					echo 'League wrestlers Circus (Nivel 20-29)';
					
					} elseif($uzytkownik['arena_level'] == 30){
					
					echo 'League wrestlers Circus (Nivel 30-39)';
					
					} elseif($uzytkownik['arena_level'] == 40){
					
					echo 'League wrestlers Circus (Nivel 40-49)';
					
					} elseif($uzytkownik['arena_level'] == 50){
					
					echo 'League wrestlers Circus (Nivel 50-59)';
					
					} elseif($uzytkownik['arena_level'] == 60){
					
					echo 'League wrestlers Circus (Nivel 60-69)';
					
					} elseif($uzytkownik['arena_level'] == 70){
					
					echo 'League wrestlers Circus (Nivel 70-79)';
					
					} elseif($uzytkownik['arena_level'] == 80){
					
					echo 'League wrestlers Circus (Nivel 80-89)';
					
					} elseif($uzytkownik['arena_level'] == 90){
					
					echo 'League wrestlers Circus (Nivel 90-99)';
					
					} elseif($uzytkownik['arena_level'] == 100){
					
					echo 'League wrestlers Circus (Nivel 100-109)';
					
					}
					
					?>
					</div>
                </div><center>
<?php

if($uzytkownik['atak'] <= 0){

echo '<h2>You have no attack, buy weaponry to confront opponents.</h2><hr>';

} elseif($uzytkownik['obrona'] <= 0){

echo '<h2>You have no defense, buy weaponry to confront opponents.</h2><hr>';

} else {

if(isset($_GET['walka'])){
    //jezeli wcisnieto walke z wybranym graczem
    
    // w linku podaje sie ID gracza z którym mamy walczyc, wiec zabezpieczymy sobie ta zmienna
    $_GET['walka'] = (int)$_GET['walka'];
	
	$przeciwnik = mysql_fetch_array(mysql_query("select * from gracze where gracz !=".$uzytkownik['gracz']." and gracz = ".$_GET['walka']));    

if($uzytkownik['rank'] > 2){
$dvdr = 4;
} elseif($uzytkownik['rank'] > 1) {
$dvdr = 2;
} else {
$dvdr = 1;
}
	
    $pozostalo = (int)(($uzytkownik['ostatnia_walka_pvp'] + 180) / $dvdr) - time();
    if($uzytkownik['zycie'] < 5){
        echo "You do not have enough life to fight.<hr/>";
    } elseif($pozostalo > 0){
        echo "You just fight. You need to rest.<hr/>";
		} elseif($przeciwnik['zycie'] < 5){
		echo "You enemy not have enough life to fight.<hr/>";
    } else {

        //pobieramy dane
        
        
        if(empty($przeciwnik)){
            //jezeli nie pobrano przeciwnika
            echo "No players.<hr/>";
        } else {
            //wszystkiedane przeciwnika mamy w zmiennej $przeciwnik
            $elife = $przeciwnik['zycie'] * 100 / $przeciwnik['zycie_max'];
			if($przeciwnik['exp'] <= 0){
            $eexp = 0;
            } else {
            $eexp = $przeciwnik['exp'] * 100 / $przeciwnik['exp_max'];
            }
            $est = $przeciwnik['sila'] * 100 / $przeciwnik['sila_max'];
            $eab = $przeciwnik['zrecznosc'] * 100 / $przeciwnik['zrecznosc_max'];
            $eag = $przeciwnik['wyrzymalosc'] * 100 / $przeciwnik['wyrzymalosc_max'];
            $eco = $przeciwnik['constitucion'] * 100 / $przeciwnik['constitucion_max'];
            $ech = $przeciwnik['carisma'] * 100 / $przeciwnik['carisma_max'];
            $ein = $przeciwnik['inteligencja'] * 100 / $przeciwnik['inteligencja_max'];
			
			if($uzytkownik['bendicion3_type'] == 5){
$przeciwnik['obrona'] = $uzytkownik['nivel'] * 100;
} else {
$przeciwnik['obrona'] = $przeciwnik['obrona'];
}
			
			
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
			<center><div style='background-image:url(img/faces/spieler_name_bg.png);width:168px;height:60px;overflow:hidden'> <span style=color:#FFFF00><font size=4><b>".$przeciwnik['login']."<br><font size=2>".$przeciwnik['titulo']."</font></span></b></font> <align='absmiddle' border='0'></div></center>
			<img src='img/faces/".$przeciwnik['plec']."_".$przeciwnik['avatar'].".gif' align='absmiddle' border='0'>
                <div id='charstats' style='width:173px'>
    <div style='background-image:url(img/char_status_kopf.jpg);width:173px;height:5px;overflow:hidden'></div>
    <div class='charstats_bg' id='char_panzer_tt'>
        <span class='charstats_value21'>Level</span>

        <span id='char_level' class='charstats_value22'>".$przeciwnik['nivel']."</span>
    </div>
    <div class='charstats_bg' id='char_leben_tt'>
        <span class='charstats_text'>Life points</span>
        <div class='charstats_balken'>
            <div class='charstats_balken_leben' id='char_leben_balken' style='width:".$elife."%'></div>
        </div>
        <span id='char_leben' class='charstats_value'>".$przeciwnik['zycie']."</span>

    </div>
        <div class='charstats_bg' id='char_exp_tt'>
        <span class='charstats_text'>Experience</span>
        <div class='charstats_balken'>
            <div class='charstats_balken_xp' style='width:".$eexp."%'></div>
        </div>
        <span id='char_exp' class='charstats_value'>".$przeciwnik['exp']."</span>
    </div>

    
            <div class='charstats_bg' id='char_f0_tt'>
            <span class='charstats_text'>Strength</span>
            <div class='charstats_balken'>
                <div class='charstats_balken_misc' id='charbalken_f0' style='width:".$est."%'></div>
            </div>
            <span id='char_f0' class='charstats_value'>".$przeciwnik['sila']."</span>
        </div>
            <div class='charstats_bg' id='char_f1_tt'>

            <span class='charstats_text'>Skill</span>
            <div class='charstats_balken'>
                <div class='charstats_balken_misc' id='charbalken_f1' style='width:".$eab."%'></div>
            </div>
            <span id='char_f1' class='charstats_value'>".$przeciwnik['zrecznosc']."</span>
        </div>
            <div class='charstats_bg' id='char_f2_tt'>
            <span class='charstats_text'>Agility</span>

            <div class='charstats_balken'>
                <div class='charstats_balken_misc' id='charbalken_f2' style='width:".$eag."%'></div>
            </div>
            <span id='char_f2' class='charstats_value'>".$przeciwnik['wyrzymalosc']."</span>
        </div>
            <div class='charstats_bg' id='char_f3_tt'>
            <span class='charstats_text'>Constitution</span>
            <div class='charstats_balken'>

                <div class='charstats_balken_misc' id='charbalken_f3' style='width:".$eco."%'></div>
            </div>
            <span id='char_f3' class='charstats_value'>".$przeciwnik['constitucion']."</span>
        </div>
            <div class='charstats_bg' id='char_f4_tt'>
            <span class='charstats_text'>Charisma</span>
            <div class='charstats_balken'>
                <div class='charstats_balken_misc' id='charbalken_f4' style='width:".$ech."%'></div>

            </div>
            <span id='char_f4' class='charstats_value'>".$przeciwnik['carisma']."</span>
        </div>
            <div class='charstats_bg' id='char_f5_tt'>
            <span class='charstats_text'>Intelligence</span>
            <div class='charstats_balken'>
                <div class='charstats_balken_misc' id='charbalken_f5' style='width:".$ein."%'></div>
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
				}

            if($uzytkownik['zycie'] > 0){
                //gracz wygral walke
				
				if($uzytkownik['rank'] > 1) {
				$double = 2;
				} else {
				$double = 1;
				}
				
				if($przeciwnik['rank'] > 2) {
				$double2 = $double / 2;
				} else { 
				$double2 = $double;
				}
				
				$zloto = (int)$przeciwnik['zloto'] * 0.10 * $double * $double2;
				$exp1 = 1;
				$exp2 = 3;
				$exp = rand($exp1,$exp2) * $double;
				$honor1 = 1;
				$honor2 = 50 * $uzytkownik['nivel'] * 0.25;
				$honor = (int)rand($honor1,$honor2) * $double;
				$usl = $uzytkownik['login'];
				$opl = $przeciwnik['login'];
				
                echo "You win the battle, you manage to get 5 points, ".$exp." of experience, ".$honor." honor and ".(int)$zloto." gold";
				
				mysql_query("INSERT INTO report_fight set user_id_d = '".$przeciwnik['gracz']."', user_d = '".$przeciwnik['login']."', titul = 'Fight in the arena', text = 'Attack from ".$usl." VS ".$opl.", Winner: ".$usl." obtain 5 points, ".$exp." experience, ".$honor." honor and ".$zloto." gold.', user_id_a = '".$uzytkownik['gracz']."', user_a = '".$uzytkownik['login']."', user_g = '".$uzytkownik['login']."'");

                mysql_query("update gracze set ostatnia_walka_pvp = ".time().", punkty = punkty + 5, zloto = zloto + ".$zloto.", exp = exp + ".$exp.", victorias = victorias + 1, honor = honor + ".$honor.", zycie = ".$uzytkownik['zycie']." where gracz = ".$uzytkownik['gracz']);

				mysql_query("update gracze set punkty = punkty + 1, zloto = zloto - ".$zloto.", perdidas = perdidas + 1, reportes = '1', zycie = ".$przeciwnik['zycie']." where gracz = ".$przeciwnik['gracz']);

				} else {
                //przegrales
				
				if($przeciwnik['rank'] > 1) {
				$double = 2;
				} else {
				$double = 1;
				}
				
				$exp1 = 1;
				$exp2 = 3;
				$exp = rand($exp1,$exp2) * $double;
				$honor1 = 1;
				$honor2 = (int)50 * $przeciwnik['nivel'] * 0.25;
				$honor = rand($honor1,$honor2) * $double;
				$usl = $uzytkownik['login'];
				$opl = $przeciwnik['login'];

                echo "Lose the battle, you get 1 point.";

				mysql_query("INSERT INTO report_fight set user_id_d = '".$przeciwnik['gracz']."', user_d = '".$przeciwnik['login']."', titul = 'Fight in the arena', text = 'Attack from ".$usl." VS ".$opl.", Winner: ".$opl." obtain 5 points, ".$exp." experience and ".$honor." honor', user_id_a = '".$uzytkownik['gracz']."', user_a = '".$uzytkownik['login']."', user_g = '".$uzytkownik['login']."'");
				
                mysql_query("update gracze set punkty = punkty + 5, honor = honor + ".$honor.", victorias = victorias + 1, exp = exp + ".$exp.", reportes = '1', zycie = ".$przeciwnik['zycie']." where gracz = ".$przeciwnik['gracz']);

				mysql_query("update gracze set ostatnia_walka_pvp = ".time().", perdidas = perdidas + 1, punkty = punkty + 1, zycie = ".$uzytkownik['zycie']." where gracz = ".$uzytkownik['gracz']);

			}
            
            $uzytkownik['ostatnia_walka_pvp'] = time();
            echo "<hr/>";
			}
        }

if($uzytkownik['rank'] > 2){
$dvdr = 4;
} elseif($uzytkownik['rank'] > 1) {
$dvdr = 2;
} else {
$dvdr = 1;
}
		
$pozostalo = (int)(($uzytkownik['ostatnia_walka_pvp'] + 180) / $dvdr) - time();
if($uzytkownik['zycie'] < 5){
    echo "You do not have enough life to fight.";
} elseif($pozostalo > 0){
    
    //gracz niedawno prowadzil walke

    //dodajemy funkcje liczaca czas
    ?>
    <script type='text/javascript'>        
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
    Timeout to fight again: <span id='zegar'></span>
    <?php
    echo "<script type='text/javascript'>liczCzas(".$pozostalo.")</script>";
} else {
    //pobieramy liste potworów
	
	if($uzytkownik['nivel'] <= 1){
	
	echo "<h2>You're not the level needed to enter this arena! You need to get to level 2 to fight!</h2>";
	
	} else {
	
	$arena_level = $uzytkownik['arena_level'];
	$gracz = $uzytkownik['gracz'];
	
	$gracze = mysql_query("select * from gracze where arena_level = ".$arena_level." and gracz !=".$gracz." order by honor desc");
    if(mysql_num_rows($gracze) == 0){
        echo "No players";
    } else {
       echo "
        <table>
        <tr>
        <th align='center'>Player</th>
		<th><center>Level</th>
        <th><center>Action</th>
        </tr>

        ";
        while($g = mysql_fetch_array($gracze)){

		
		    echo "
            <tr>
                <td><center><a href='oplayer.php?oplayer=".$g['login']."' style='color:#8fff;'>".$g['login']."</a></td>
				<td><center>".$g['nivel']."</td>
                 <td><center><a href='coloseum.php?walka=".$g['gracz']."'>Fight!</a></td>
            </tr>";
        }
        echo " </table>";
    }
	}
	}
	}
//pobieramy stopke
require_once('dol_strony.php');

//wylaczamy bufor
ob_end_flush();
?> 
