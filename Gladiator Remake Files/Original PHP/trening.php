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

	if($tst < 6){
	$cst = 1;
	} elseif($tst < 7){
	$cst = (int)((1 + $tst + 3) / 2);
	} elseif($tst < 8){
	$cst = (int)((1 + $tst + 1 * 2) / 2);
	} elseif($tst < 9){
	$cst = (int)((1 + $tst + 30 * 2) / 2);
	} elseif($tst < 10){
	$cst = (int)((1 + $tst + 70 * 2) / 2);
	} elseif($tst < 11){
	$cst = (int)((1 + $tst + 160 * 2) / 2);
	} elseif($tst < 12){
	$cst = (int)((1 + $tst + 330 * 3) / 2);
	} elseif($tst < 13){
	$cst = (int)((1 + $tst + 800 * 3) / 2);
	} elseif($tst < 14){
	$cst = (int)(((1 + $tst * 100 * 2.5)) / 2);
	} else {
	$cst = (int)((($tst / (0.1 / ($tst)) * 1.25) + (110 * $tst)) / 2) + 200;
	}
	if($tab < 6){
	$cab = 1;
	} elseif($tab < 7){
	$cab = (int)((1 + $tab + 1) / 2);
	} elseif($tab < 8){
	$cab = (int)((1 + $tab + 5) / 2);
	} elseif($tab < 9){
	$cab = (int)((1 + $tab + 20) / 2);
	} elseif($tab < 10){
	$cab = (int)((1 + $tab + 50 * 2) / 2);
	} elseif($tab < 11){
	$cab = (int)((1 + $tab + 120 * 2) / 2);
	} elseif($tab < 12){
	$cab = (int)((1 + $tab + 310 * 2) / 2);
	} elseif($tab < 13){
	$cab = (int)((1 + $tab + 790 * 3) / 2);
	} elseif($tab < 14){
	$cab = (int)(((1 + $tab * 80 * 2.5)) / 2);
	} else {
	$cab = (int)((($tab / (0.3 / ($tab)) * 2.25) + 88 * $tab) / 2) + 200;
	}
	if($tag < 6){
	$cag = 1;
	} elseif($tag < 7){
	$cag = (int)((1 + $tag + 5) / 2);
	} elseif($tag < 8){
	$cag = (int)((1 + $tag + 5) / 2);
	} elseif($tag < 9){
	$cag = (int)((1 + $tag + 20) / 2);
	} elseif($tag < 10){
	$cag = (int)((1 + $tag + 50 * 2) / 2);
	} elseif($tag < 11){
	$cag = (int)((1 + $tag + 120 * 2) / 2);
	} elseif($tag < 12){
	$cag = (int)((1 + $tag + 310 * 2) / 2);
	} elseif($tag < 13){
	$cag = (int)((1 + $tag + 790 * 2) / 2);
	} elseif($tag < 14){
	$cag = (int)(((1 + $tag * 80 * 2.5)) / 2);
	} else {
	$cag = (int)((($tag / (0.3 / ($tag)) * 2.25) + 88 * $tag) / 2) + 200;
	}
	if($tco < 6){
	$cco = 1;
	} elseif($tco < 7){
	$cco = (int)((1 + $tco) / 2);
	} elseif($tco < 8){
	$cco = (int)((1 + $tco + 3) / 2);
	} elseif($tco < 9){
	$cco = (int)((1 + $tco + 13) / 2);
	} elseif($tco < 10){
	$cco = (int)((1 + $tco + 30) / 2);
	} elseif($tco < 11){
	$cco = (int)((1 + $tco + 80) / 2);
	} elseif($tco < 12){
	$cco = (int)((1 + $tco + 190) / 2);
	} elseif($tco < 13){
	$cco = (int)((1 + $tco + 390) / 2);
	} elseif($tco < 14){
	$cco = (int)(((1 + $tco * 70 * 2.5)) / 2);
	} else {
	$cco = (int)((($tco / (0.4 / ($tco)) * 2.75) + 77 * $tco) / 2) + 200;
	}
	if($tch < 6){
	$cch = 1;
	} elseif($tch < 7){
	$cch = (int)((1 + $tch + 2) / 2);
	} elseif($tch < 8){
	$cch = (int)((1 + $tch + 6) / 2);
	} elseif($tch < 9){
	$cch = (int)((1 + $tch + 30) / 2);
	} elseif($tch < 10){
	$cch = (int)((1 + $tch + 70 * 2) / 2);
	} elseif($tch < 11){
	$cch = (int)((1 + $tch +  180 * 2) / 2);
	} elseif($tch < 12){
	$cch = (int)((1 + $tch +  300 * 3) / 2);
	} elseif($tch < 13){
	$cch = (int)((1 + $tch +  760 * 3) / 2);
	} elseif($tch < 14){
	$cch = (int)(((1 + $tch * 90 * 2.5)) / 2);
	} else {
	$cch = (int)((($tch / (0.2 / ($tch)) * 1.75) + 99 * $tch) / 2) + 200;
	}
	if($tin < 6){
	$cin = 1;
	} elseif($tin < 7){
	$cin = (int)((1 + $tin + 2) / 2);
	} elseif($tin < 8){
	$cin = (int)((1 + $tin + 6) / 2);
	} elseif($tin < 9){
	$cin = (int)((1 + $tin + 30) / 2);
	} elseif($tin < 10){
	$cin = (int)((1 + $tin + 70 * 2) / 2);
	} elseif($tin < 11){
	$cin = (int)((1 + $tin +  155 * 2) / 2);
	} elseif($tin < 12){
	$cin = (int)((1 + $tin +  270 * 3) / 2);
	} elseif($tin < 13){
	$cin = (int)((1 + $tin +  660 * 3) / 2);
	} elseif($tin < 14){
	$cin = (int)(((1 + $tin * 90 * 2.5)) / 2);
	} else {
	$cin = (int)((($tin / (0.2 / ($tin)) * 1.75) + 99 * $tin) / 2) + 200;
	}

?>

<div id="popupmessage" style="display:block;filter:alpha(opacity=100);-moz-opacity:1.0;"></div>

<script type="text/javascript" src="4115/js/work.js"></script>

<p class="buildingDesc">

    <img src="img/trening.jpg" align="left" />
              As you get into the training area you spotting several gladiators that improve their fighting skills. A veteran of the Roman legion is well and gives them advice from time to time.<br><br>

You can train your skills as a warrior.<br><br><br><br><br><br></p>
                <div class="title_box">
                    <div class="title_inner">Train</div>
                </div><center>
<?php
if(!empty($_GET['trenuj'])){
    //jeżeli gracz wcisnął trenowanie jakiegoś atrybutu, w zmiennej $_GET['trenuj'] przetrzymywany jest typ
    
         switch($_GET['trenuj']){
        case 1:
            //wybrano trening siły
            
            //ustaw koszt, każdy kolejny punkt siły kosztuje 10x aktualna wartość siły, czyli przykładowo dla siły = 1 koszt będzie 10, a dla siły 15 koszt będzie 150, kombinuj samemu coś ze wzorem na koszt

                 if($uzytkownik['zloto'] < $cst){
                echo "<p>You do not have enough gold.</p>";
            } else {
                //dodaj siłę
                $tst++;
				$uzytkownik['sila_max']++;

                //zabierz złoto
                $uzytkownik['zloto'] -= $cst;


                //sprawdz czy trzeba dodać obrażeń, wg wzoru
                if($tst % 10 == 0) {
                    $uzytkownik['obrazenia_min']++;
                    $uzytkownik['obrazenia_max']++;
                }
				if($tst % 3 == 0) {
				$uzytkownik['sila_max'] += 2;
				}

                mysql_query("update gracze set zloto = ".$uzytkownik['zloto'].", sila_max = ".$uzytkownik['sila_max'].", sila = ".$tst.", obrazenia_min = ".$uzytkownik['obrazenia_min'].", obrazenia_max = ".$uzytkownik['obrazenia_max']." where gracz = ".$uzytkownik['gracz']);

                
            }
        break;

        case 2:
            //wybrano trening zręczności
            
            //ustaw koszt, każdy kolejny punkt zręczności kosztuje 7x aktualna wartość zręczności, czyli przykładowo dla zręczności = 1 koszt będzie 7, a dla zręczności 10 koszt będzie 70, kombinuj samemu coś ze wzorem na koszt

            if($uzytkownik['zloto'] < $cab){
                echo "<p>No tienes oro suficiente</p>";
            } else {
                //dodaj siłę
                $tab++;
				$uzytkownik['zrecznosc_max']++;
				if($tab % 3 == 0) {
				$uzytkownik['zrecznosc_max'] += 2;
				}

                //zabierz złoto
                $uzytkownik['zloto'] -= $cab;

                mysql_query("update gracze set zloto = ".$uzytkownik['zloto'].", zrecznosc = ".$tab.", zrecznosc_max = ".$uzytkownik['zrecznosc_max'].", atak = ".$uzytkownik['atak']." where gracz = ".$uzytkownik['gracz']);

                
            }
        break;

        case 3:
            //wybrano trening wytrzymałości
            
            //ustaw koszt, każdy kolejny punkt wytrzymałości kosztuje 8x aktualna wartość wytrzymałości, czyli przykładowo dla wytrzymałości = 1 koszt będzie 8, a dla wytrzymałości 10 koszt będzie 80, kombinuj samemu coś ze wzorem na koszt
            

            if($uzytkownik['zloto'] < $cag){
                echo "<p>No tienes oro suficiente</p>";
            } else {
                //dodaj siłę
                $tag++;
				$uzytkownik['wyrzymalosc_max']++;
				if($tag % 3 == 0) {
				$uzytkownik['wyrzymalosc_max'] += 2;
				}

                //zabierz złoto
                $uzytkownik['zloto'] -= $cag;

                mysql_query("update gracze set zloto = ".$uzytkownik['zloto'].", obrona = ".$uzytkownik['obrona'].", wyrzymalosc = ".$tag.", wyrzymalosc_max = ".$uzytkownik['wyrzymalosc_max']." where gracz = ".$uzytkownik['gracz']);

                
            }
        break;
		
		        case 4:
            //wybrano trening wytrzymałości
            
            //ustaw koszt, każdy kolejny punkt wytrzymałości kosztuje 8x aktualna wartość wytrzymałości, czyli przykładowo dla wytrzymałości = 1 koszt będzie 8, a dla wytrzymałości 10 koszt będzie 80, kombinuj samemu coś ze wzorem na koszt
            

            if($uzytkownik['zloto'] < $cco){
                echo "<p>No tienes oro suficiente</p>";
            } else {
                //dodaj siłę
                $tco++;
				$uzytkownik['constitucion_max']++;
				if($tco % 3 == 0) {
				$uzytkownik['constitucion_max'] += 2;
				}
				if($tco % 7 == 0) {
                $uzytkownik['zycie'] += 100;
				$uzytkownik['zycie_max'] += 100;
				}

                //zabierz złoto
                $uzytkownik['zloto'] -= $cco;

                mysql_query("update gracze set zloto = ".$uzytkownik['zloto'].", zycie = ".$uzytkownik['zycie']." , zycie_max = ".$uzytkownik['zycie_max'].", constitucion = ".$tco.", constitucion_max = ".$uzytkownik['constitucion_max']." where gracz = ".$uzytkownik['gracz']);

                
            }
        break;

		
		        case 5:
            //wybrano trening wytrzymałości
            
            //ustaw koszt, każdy kolejny punkt wytrzymałości kosztuje 8x aktualna wartość wytrzymałości, czyli przykładowo dla wytrzymałości = 1 koszt będzie 8, a dla wytrzymałości 10 koszt będzie 80, kombinuj samemu coś ze wzorem na koszt
            

            if($uzytkownik['zloto'] < $cch){
                echo "<p>No tienes oro suficiente</p>";
            } else {
                //dodaj siłę
                $tch++;
				$uzytkownik['carisma_max']++;
				if($tch % 3 == 0) {
				$uzytkownik['carisma_max'] += 2;
				}
				
                //zabierz złoto
                $uzytkownik['zloto'] -= $cch;

                mysql_query("update gracze set zloto = ".$uzytkownik['zloto'].", obrona = ".$uzytkownik['obrona']." , atak = ".$uzytkownik['atak'].", carisma = ".$tch.", carisma_max = ".$uzytkownik['carisma_max']." where gracz = ".$uzytkownik['gracz']);

                
            }
        break;

		
		case 6:
            //wybrano trening inteligencji
            
            //ustaw koszt, każdy kolejny punkt inteligencji kosztuje 8x aktualna wartość inteligencji, czyli przykładowo dla inteligencji = 1 koszt będzie 8, a dla inteligencji 10 koszt będzie 80, kombinuj samemu coś ze wzorem na koszt
            

            if($uzytkownik['zloto'] < $cin){
                echo "<p>No tienes oro suficiente</p>";
            } else {
                //dodaj siłę
                $tin++;
				$uzytkownik['inteligencja_max']++;
				if($tin % 3 == 0) {
				$uzytkownik['inteligencja_max'] += 2;
				}
                //zabierz złoto
                $uzytkownik['zloto'] -= $cin;

                mysql_query("update gracze set zloto = ".$uzytkownik['zloto'].", obrona = ".$uzytkownik['obrona']." , atak = ".$uzytkownik['atak'].", inteligencja = ".$tin.", inteligencja_max = ".$uzytkownik['inteligencja_max']." where gracz = ".$uzytkownik['gracz']);
          }
        break;		
		
		default:
            //jeżeli wybrał typ którego nie ma (np sam coś kombinuje w adresie strony, chcąc namieszać)
            echo "<p>No such skills.</p>";
        break;
    }
    

}
?>
<div id="charstats" style="width:450px;margin-top:10px;margin-left:auto;margin-right:auto">
                    <div style="background-image:url(img/char_status_kopf.jpg);position:relative;width:262px;height:5px;overflow:hidden"></div>
                                            <div style="width:450px;position:relative">
                            <div class="charstats_bg2" id="char_f0_tt" onMouseover="window.status='Hi there!'; return true" />
                                <span class="charstats_text">Fuerza</span>
                                <div class="charstats_balken">



                                    <div class="charstats_balken_misc" id="charbalken_f0" title="<?php echo $tst; ?>/<?php echo $uzytkownik['sila_max']; ?>" style="width:<?php echo $pst; ?>%"></div>

                                </div>
                                <span id="char_f0" class="charstats_value"><?php echo $tst; ?></span>
                            </div>
                            <div class="training_link">
                                <?php echo $cst; ?> <img src="images/res2.gif" alt="Gold" align="absmiddle" border="0" />
                                                                <a target="_self" class="headlines" href="trening.php?trenuj=1">entrenar</a>
                                                            </div>

                        </div>
                                            <div style="width:450px;position:relative">
                            <div class="charstats_bg2" id="char_f1_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Sugebejimas:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Pagrindinis:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maksimalus:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Daiktu deka:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 iš 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Padidink smugiavimo galimybe, taip pat ir kritinio smugio šansa.</div></td></tr></table>')">
                                <span class="charstats_text">Habilidad</span>
                                <div class="charstats_balken">


                                    <div class="charstats_balken_misc" id="charbalken_f1" title="<?php echo $tab; ?>/<?php echo $uzytkownik['zrecznosc_max']; ?>" style="width:<?php echo $pab; ?>%"></div>
                                </div>
                                <span id="char_f1" class="charstats_value"><?php echo $tab; ?></span>

                            </div>
                            <div class="training_link">
                                <?php echo $cab; ?> <img src="images/res2.gif" alt="Gold" align="absmiddle" border="0" />
                                                                <a target="_self" class="headlines" href="trening.php?trenuj=2">entrenar</a>
                                                            </div>
                        </div>
                                            <div style="width:450px;position:relative">
                            <div class="charstats_bg2" id="char_f2_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Judrumas:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Pagrindinis:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maksimalus:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Daiktu deka:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 iš 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Sumažink priešininko smugiavimo šansa ir jo kritini smugi.</div></td></tr></table>')">

                                <span class="charstats_text">Agilidad</span>
                                <div class="charstats_balken">

                                    <div class="charstats_balken_misc" id="charbalken_f2" title="<?php echo $tag; ?>/<?php echo $uzytkownik['wyrzymalosc_max']; ?>" style="width:<?php echo $pag; ?>%"></div>
                                </div>
                                <span id="char_f2" class="charstats_value"><?php echo $tag; ?></span>
                            </div>
                            <div class="training_link">
                                <?php echo $cag; ?> <img src="images/res2.gif" alt="Gold" align="absmiddle" border="0" />

                                                                <a target="_self" class="headlines" href="trening.php?trenuj=3">entrenar</a>
                                                            </div>
                        </div>
                                            <div style="width:450px;position:relative">
                            <div class="charstats_bg2" id="char_f3_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Ištverme:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Pagrindinis:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maksimalus:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Daiktu deka:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 iš 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Padidink gyvybes taškus ir atsistatyma.</div></td></tr></table>')">
                                <span class="charstats_text">Constitucion</span>
                                <div class="charstats_balken">



                                    <div class="charstats_balken_misc" id="charbalken_f3" title="<?php echo $tco; ?>/<?php echo $uzytkownik['constitucion_max']; ?>" style="width:<?php echo $pco; ?>%"></div>

                                </div>
                                <span id="char_f3" class="charstats_value"><?php echo $tco; ?></span>
                            </div>
                            <div class="training_link">
                                <?php echo $cco; ?> <img src="images/res2.gif" alt="Gold" align="absmiddle" border="0" />
                                                                <a target="_self" class="headlines" href="trening.php?trenuj=4">entrenar</a>
                                                            </div>

                        </div>
                                            <div style="width:450px;position:relative">
                            <div class="charstats_bg2" id="char_f4_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Charizma:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Pagrindinis:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maksimalus:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Daiktu deka:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 iš 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Padidink dvigubo smugio šansa, be to tai didina jusu galias požemiuose.</div></td></tr></table>')">
                                <span class="charstats_text">Carisma</span>
                                <div class="charstats_balken">



                                    <div class="charstats_balken_misc" id="charbalken_f4" title="<?php echo $tch; ?>/<?php echo $uzytkownik['carisma_max']; ?>" style="width:<?php echo $pch; ?>%"></div>
                                </div>
                                <span id="char_f4" class="charstats_value"><?php echo $tch; ?></span>

                            </div>
                            <div class="training_link">
                                <?php echo $cch; ?> <img src="images/res2.gif" alt="Gold" align="absmiddle" border="0" />
                                                                <a target="_self" class="headlines" href="trening.php?trenuj=5">entrenar</a>
                                                            </div>
                        </div>
                                            <div style="width:450px;position:relative">
                            <div class="charstats_bg2" id="char_f5_tt" onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'text-align:left;color:#BA9700;font-weight:bold;font-size:9pt\' nowrap=\'nowrap\'>Sumanumas:</td><td style=\'padding-left:20px;text-align:right;color:#BA9700;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Pagrindinis:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>5</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Maksimalus:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>8</td></tr><tr><td style=\'text-align:left;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>&nbsp;&nbsp;Daiktu deka:</td><td style=\'padding-left:20px;text-align:right;color:#DDDDDD;font-weight:bold;font-size:8pt\' nowrap=\'nowrap\'>0 iš 0</td></tr><tr><td style=\'color:#808080;font-weight:bold;font-size:8pt\' colspan=\'2\'><div style=\'width:280px\'>Padidina ekspedicijos priešininko pažinimo šansa. <br/> Padidina gydyma požemiu kovose ir kritinio gydymo šansa. <br/> Didina maisto gydymo verte.</div></td></tr></table>')">

                                <span class="charstats_text">Inteligencia</span>
                                <div class="charstats_balken">



                                    <div class="charstats_balken_misc" id="charbalken_f5" title="<?php echo $tin; ?>/<?php echo $uzytkownik['inteligencja_max']; ?>" style="width:<?php echo $pin; ?>%"></div>
                                </div>

                                <span id="char_f5" class="charstats_value"><?php echo $tin; ?></span>
                            </div>
                            <div class="training_link">
                                <?php echo $cin; ?> <img src="images/res2.gif" alt="Gold" align="absmiddle" border="0" />

                                                                <a target="_self" class="headlines" href="trening.php?trenuj=6">entrenar</a>
                                                            </div>
                        </div>
                                        <div style="background-image:url(img/char_status_abschluss.jpg);width:262px;height:5px;overflow:hidden"></div>
                </div>
<?php

//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?> 
