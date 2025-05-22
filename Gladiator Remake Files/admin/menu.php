<?php

if($uzytkownik['rank'] > 2){

         if(empty($_SESSION['user'])){
             //menu niezalogowanego
             echo '             
              <td valign="top" id="mainmenu">              
                 <a class = "menuitem_aktive" href="index.php" title="Home" target="_self">Home</a>
                 <a class = "menuitem_aktive" href="logowanie.php" title="Login" target="_self">Login</a>
                 <a class = "menuitem_aktive" href="forum/" title="Forum" target="_self">Forum</a>
             ';
         } else {
             //menu zalogowanego
             echo '                 
                 <td valign="top" id="mainmenu">
                 <a class = "menuitem_aktive" href="konto.php">Home</a>
                 <a class = "menuitem_aktive" href="news.php">Create new</a>
                 <a class = "menuitem_aktive" href="items.php">Create item</a>
				 <a class = "menuitem_aktive" href="mobs.php">Create mob</a>
				 <a class = "menuitem_aktive" href="users.php">Edit user</a>
				 <a class = "menuitem_aktive" href="ranks.php">Edit rank</a>
				 <a class = "menuitem_aktive" href="vips.php">Give VIP</a>
				 <a class = "menuitem_aktive" href="mensajes.php">Messages Reports</a>
				 <a class = "menuitem_aktive" href="ranking.php">Users</a>
                 <a class = "menuitem_aktive" href="/konto.php">Back</a>
				 
			 ';
         }
		 
		 } else {
		 
		 echo "No tienes rango suficiente para este menu";
		 
		 }
		 
        ?>
        
          	<div id="menufooter"></div>
				</td>
				<td id="contentBox" valign="top">
					<table cellspacing="0" cellpadding="0" height="100%" width="100%" border="0">
						<tr style="height:30px;">
							<td id="corner1"></td>

							<td><div class="tab_aktive" ><span>GladClone GMPanel</span></div>
							<div class="tab_empty" style="background-image:url(img/interface/reiter_c2.jpg);"></div>
							<div class="tab_empty" style="background-image:url(img/interface/reiter_c3.jpg);"></div>
						      <div class="tab_empty" style="background-image:url(img/interface/reiter_c4.jpg);"></div></td>
							<td id="corner2"></td>
						</tr>
						<tr style="height:100%;">
							<td class="border_left"></td>
							<td id="content">
