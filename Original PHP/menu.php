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
			 
				 if($uzytkownik['rank'] > 2){
				 echo '
                 <a class = "menuitem_aktive" href="admin/">GM PANEL</a>
				 ';
				 }				 				 
			 
			 echo '
                 <a class = "menuitem_aktive" href="konto.php">Overview</a>
				 <a class = "menuitem_aktive" href="premium.php">Premium</a>
				 <a class = "menuitem_aktive" href="premium_shop.php">Premium Shop</a>
				 <a class = "menuitem_aktive" href="bendiciones.php">Covenants</a>
                 <a class = "menuitem_aktive" href="mensajes.php">Messages</a>
				 ';
				 if($uzytkownik['nivel'] >= 3){
				 echo '
                 <a class = "menuitem_aktive" href="praca.php">Job</a>
				 ';
				 }
				 echo '
                 <a class = "menuitem_aktive" href="land.php">City Portal</a>
				 <a class = "menuitem_aktive" href="city.php">City</a>
				 ';
				 if($uzytkownik['nivel'] >= 2){
				 echo '
                 <a class = "menuitem_aktive" href="coloseum.php">Arena</a>
				 ';
				 }
				 echo '
                 <a class = "menuitem_aktive" href="medyk.php">Hospital</a>
				 ';
				 if($uzytkownik['nivel'] >= 5){
				 echo '
                 <a class = "menuitem_aktive" href="skarbiec.php">Bank</a>
				 ';
				 }
				 echo '
                 <a class = "menuitem_aktive" href="trening.php">Training</a>
                 <a class = "menuitem_aktive" href="sklep.php">Shop</a>
				 ';
				 if($uzytkownik['nivel'] >= 2){
				 echo '
                 <a class = "menuitem_aktive" href="reportes.php">Reports</a>
				 ';
				 }
				 echo '
                 <a class = "menuitem_aktive" href="ekwipunek.php">My info.</a>
                 <a class = "menuitem_aktive" href="ranking.php">Ranking</a>
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
