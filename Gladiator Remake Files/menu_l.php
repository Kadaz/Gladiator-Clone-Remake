<?php
         if(empty($_SESSION['user'])){
             //menu niezalogowanego
             echo '             
              <td valign="top" id="mainmenu">
                <a class = "menuitem_aktive" href="admin_panel.php" title="Index" target="_self">Admin</a>              
                 <a class = "menuitem_aktive" href="index.php" title="Index" target="_self">Index</a>
                 <a class = "menuitem_aktive" href="rejestracja.php" title="Register" target="_self">Register</a>
                 <a class = "menuitem_aktive" href="logowanie.php" title="Login" target="_self">Login</a>
                 <a class = "menuitem_aktive" href="screenshot.php" title="Screenshots" target="_self">Screenshots</a>
				 <a class = "menuitem_aktive" href="chatbox.php" title="Live Chat" target="_self">Live Chat</a>
				 <a class = "menuitem_aktive" href="guild.php" title="Guild" target="_self">Guild</a>
                 <a class = "menuitem_aktive" href="forum.php" title="Forum" target="_self">Forum</a>
                 <a class = "menuitem_aktive" href="event_portal.php" title="Events" target="_self">Events</a>
				 <a class = "menuitem_aktive" href="achievements.php" title="Αchievements" target="_self">Αchievements</a>
                 <a class = "menuitem_aktive" href="ranking2.php" title="Ranking" target="_self">Ranking</a>
             ';
         } else {
             //menu zalogowanego
             echo '              <td valign="top" id="mainmenu">              
                 <a class = "menuitem_aktive" href="konto.php" title="User" target="_self">User</a>
				 
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
