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
require_once('menu.php');


require_once('menu.php');

?>
	
	
	<div style="position: relative;">
<img src="img/area/city_1.jpg" usemap="#city" width="532" height="400" style="border:none;" />
<p style="margin:20px">The city provides the possibility to acquire weapons and equipment items which will upgrade your chances in battles against your enemies. You can also find work here to earn some gold. Click on a building to enter it.</p>

<map name="city">
	<area shape="rect" coords="96,8,304,80" title="Work" alt="Work" href="praca.php"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Work</td></tr></table>')" />
	<area shape="rect" coords="383,0,532,51" title="Arena" alt="Arena" href="coloseum.php"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Arena</td></tr></table>')" />
	<area shape="rect" coords="0,175,129,241" title="Training" alt="Training" href="trening.php"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Training</td></tr></table>')" />
	<area shape="rect" coords="90,113,175,165" title="Weapon smith" alt="Weapon smith" href="sklep.php"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Weapon smith</td></tr></table>')" />
	<area shape="rect" coords="328,61,396,112" title="Armour smith" alt="Armour smith" href="sklep.php"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Armour smith</td></tr></table>')" />

	<area shape="rect" coords="229,83,310,133" title="General goods" alt="General goods" href="sklep.php"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>General goods</td></tr></table>')" />
	<area shape="rect" coords="380,210,532,295" title="Alchemist" alt="Alchemist" href="premium.php"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Alchemist</td></tr></table>')" />
	<area shape="rect" coords="416,85,532,168" title="Auction house" alt="Auction house" href="sklep.php"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Auction house</td></tr></table>')" />
	<area shape="rect" coords="270,140,389,230" title="Market" alt="Market" href="sklep.php"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Market</td></tr></table>')" />
	<area shape="rect" coords="180,160,260,240" title="Jeweller" alt="Jeweller" href="premium.php"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>Jeweller</td></tr></table>')" />
	<area shape="rect" coords="310,295,450,400" title="City gate" alt="City gate" href="land.php"  onMouseOver="return escape('<table cellspacing=2 cellpadding=2 valign=middle class=\'tooltipBox\'><tr><td style=\'color:white; font-weight: bold; font-size:9pt\' colspan=\'2\' nowrap=\'nowrap\'>City gate</td></tr></table>')" />
</map>

</div>
	
	
<?php

//pobieramy stopke
require_once('dol_strony.php');

//wylaczamy bufor
ob_end_flush();
?> 

