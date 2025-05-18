<?php
         if(empty($_SESSION['user'])){
             //menu niezalogowanego
             echo '             
              <td valign="top" id="mainmenu">              
                 <a class = "menuitem_aktive" href="index.php" title="Inicio" target="_self">Inicio</a>
                 <a class = "menuitem_aktive" href="rejestracja.php" title="Unirse" target="_self">Unirse</a>
                 <a class = "menuitem_aktive" href="logowanie.php" title="Ingresar" target="_self">Ingresar</a>
                 <a class = "menuitem_aktive" href="screenshot.php" title="Fotos del servidor" target="_self">Fotos del servidor</a>
                 <a class = "menuitem_aktive" href="" title="Foro" target="_self">Foro</a>
                 <a class = "menuitem_aktive" href="" title="Eventos" target="_self">Eventos</a>
                 <a class = "menuitem_aktive" href="ranking2.php" title="Clasficación" target="_self">Clasficación</a>
             ';
         } else {
             //menu zalogowanego
             echo '';
			 
				 if($uzytkownik['rank'] > 2){
				 echo '
				 <td valign="top" id="mainmenu">
                 <a class = "menuitem_aktive" href="admin/">Administración</a>
				 ';
				 }				 				 
			 
			 echo '                 
                 <a class = "menuitem_aktive" href="konto.php">Usuario</a>
                 <a class = "menuitem_aktive" href="mensajes.php">Mensajes</a>
				 ';
				 if($uzytkownik['nivel'] >= 3){
				 echo '
                 <a class = "menuitem_aktive" href="praca.php">Trabajo</a>
				 ';
				 }
				 echo '
                 <a class = "menuitem_aktive" href="arena.php">Portal de la Ciudad</a>
				 ';
				 if($uzytkownik['nivel'] >= 2){
				 echo '
                 <a class = "menuitem_aktive" href="coloseum.php">Arena</a>
				 ';
				 }
				 echo '
                 <a class = "menuitem_aktive" href="medyk.php">Médico</a>
				 ';
				 if($uzytkownik['nivel'] >= 5){
				 echo '
                 <a class = "menuitem_aktive" href="skarbiec.php">Tesorería</a>
				 <a class = "menuitem_aktive" href="ally.php">Alianza</a>
				 ';
				 }
				 echo '
                 <a class = "menuitem_aktive" href="trening.php">Entrenar</a>
                 <a class = "menuitem_aktive" href="sklep.php">Tienda</a>
				 ';
				 if($uzytkownik['nivel'] >= 2){
				 echo '
                 <a class = "menuitem_aktive" href="reportes.php">Reportes</a>
				 ';
				 }
				 echo '
                 <a class = "menuitem_aktive" href="ekwipunek.php">Equipamento</a>
                 <a class = "menuitem_aktive" href="ranking.php">Clasificación</a>
                 <a class = "menuitem_aktive" href="wyloguj.php">Desconectar</a>
				 
			 ';
         }
        ?>
        
          	<div id="menufooter"></div>
				</td>
				<td id="contentBox" valign="top">
					<table cellspacing="0" cellpadding="0" height="100%" width="100%" border="0">
						<tr style="height:30px;">
							<td id="corner1"></td>

							<td><div class="tab_aktive" ><span>Gladiatus</span></div>
							<div class="tab_empty" style="background-image:url(img/interface/reiter_c2.jpg);"></div>
							<div class="tab_empty" style="background-image:url(img/interface/reiter_c3.jpg);"></div>
						      <div class="tab_empty" style="background-image:url(img/interface/reiter_c4.jpg);"></div></td>
							<td id="corner2"></td>
						</tr>
						<tr style="height:100%;">
							<td class="border_left"></td>
							<td id="content">
