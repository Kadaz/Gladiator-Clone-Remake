<?php
         if(empty($_SESSION['user'])){
             //menu niezalogowanego
             echo '             
              <td valign="top" id="mainmenu">              
                 <a class = "menuitem_aktive" href="index.php" title="Home" target="_self">Home</a>
                 <a class = "menuitem_aktive" href="rejestracja.php" title="Join" target="_self">Join</a>
                 <a class = "menuitem_aktive" href="logowanie.php" title="Login" target="_self">Login</a>
                 <a class = "menuitem_aktive" href="screenshot.php" title="Screenshots" target="_self">Screenshots</a>
                 <a class = "menuitem_aktive" href="" title="Forum" target="_self">Forum</a>
                 <a class = "menuitem_aktive" href="" title="Events" target="_self">Events</a>
                 <a class = "menuitem_aktive" href="ranking2.php" title="Ranking" target="_self">Ranking</a>
             ';
         } else {
             //menu zalogowanego
             echo '<td valign="top" id="mainmenu">';
			 echo '
			 <a class = "menuitem_aktive" href="konto.php">Overview</a>
				 <a class = "menuitem_aktive" title="Lv1" href="l_forest.php?map=forest">Forest</a>
				 ';
				 if($uzytkownik['nivel'] >= 5){
				 echo '
                 <a class = "menuitem_aktive" title="Lv5" href="l_pirate.php?map=pirate">Pirates</a>
				 ';
				 }else{
				 echo '
                 <a class = "menuitem_aktive" title="Lv5">Need Lv5</a>
				 ';
				 }
				 if($uzytkownik['nivel'] >= 10){
				 echo '  
                 <a class = "menuitem_aktive" title="Lv10" href="l_mountains.php?map=mountains">Mountains</a>
				 ';
				 }else{
				 echo '
                 <a class = "menuitem_aktive" title="Lv10">Need Lv10</a>
				 ';
				 }
				 if($uzytkownik['nivel'] >= 20){
				 echo '
                 <a class = "menuitem_aktive" title="Lv20" href="l_cave.php?map=cave">Cave</a>
				 ';
				 }else{
				 echo '
                 <a class = "menuitem_aktive" title="Lv20">Need Lv20</a>
				 ';
				 }
				 if($uzytkownik['nivel'] >= 30){
				 echo '  
                 <a class = "menuitem_aktive" title="Lv30" href="l_temple.php?map=temple">Temple</a>
				 ';
				 }else{
				 echo '
                 <a class = "menuitem_aktive" title="Lv30">Need Lv30</a>
				 ';
				 }
				 if($uzytkownik['nivel'] >= 40){
				 echo '
                 <a class = "menuitem_aktive" title="Lv40" href="l_barbary.php?map=barbary">Barbary</a>
				 ';
				 }else{
				 echo '
                 <a class = "menuitem_aktive" title="Lv40">Need Lv40</a>
				 ';
				 }
				 if($uzytkownik['nivel'] >= 60){
				 echo '
                 <a class = "menuitem_aktive" title="Lv60" href="l_campment.php?map=campment">Campment</a>
				 ';
				 }else{
				 echo '
                 <a class = "menuitem_aktive" title="Lv60">Need Lv60</a>
				 ';
				 }
				 echo '
                 <a class = "menuitem_aktive" href="city.php">City</a>
                 <a class = "menuitem_aktive" href="wyloguj.php">Logout</a>
			 ';
         }
        ?>
        
          	<div id="menufooter"></div>
				</td>
				<td id="contentBox" valign="top">
					<table cellspacing="0" cellpadding="0" height="100%" width="100%" border="0">
						<tr style="height:30px;">
							<td id="corner1"></td>

							<td><div class="tab_aktive" ><span>GladClone</span></div>
							<div class="tab_empty" style="background-image:url(img/interface/reiter_c2.jpg);"></div>
							<div class="tab_empty" style="background-image:url(img/interface/reiter_c3.jpg);"></div>
						      <div class="tab_empty" style="background-image:url(img/interface/reiter_c4.jpg);"></div></td>
							<td id="corner2"></td>
						</tr>
						<tr style="height:100%;">
							<td class="border_left"></td>
							<td id="content">
