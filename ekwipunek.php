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

?>
<h><center><p><b>¡Hello <?php echo $uzytkownik['login']; ?>!<br> ¡Or should I call it: <?php echo $uzytkownik['titulo']; ?>!</b><hr/></p>
<table>
<tr class="alt">
    <td>
        <ul><b>Attributes</b>
            <li>Strength: <?php echo $uzytkownik['sila']; ?>
            <li>Ability: <?php echo $uzytkownik['zrecznosc']; ?>
            <li>Agility: <?php echo $uzytkownik['wyrzymalosc']; ?>
			<li>Constitution: <?php echo $uzytkownik['constitucion']; ?>
			<li>Charisma: <?php echo $uzytkownik['carisma']; ?>
			<li>Intelligence: <?php echo $uzytkownik['inteligencja']; ?>
        </ul>
    </td>

    <td>
        <ul><b>Statistics</b>
          
				<li>Level: <?php echo $uzytkownik['nivel']; ?>
				<li>Experience: <?php echo $uzytkownik['exp']; ?>
				
				<?php
				
				$nnivel = $uzytkownik['nivel'] + 1;
				
				?>
				
				<li>Experience for next level: <?php echo $uzytkownik['exp_max']; ?>
              <li>Attack: <?php echo $uzytkownik['atak']; ?>
             <li>Defense: <?php echo $uzytkownik['obrona']; ?>
            <li>Life: <?php echo $uzytkownik['zycie']." / ".$uzytkownik['zycie_max']; ?>
            <li>Damage: <?php echo $uzytkownik['obrazenia_min']." / ".$uzytkownik['obrazenia_max']; ?>
        </ul>
    </td>

    <td>
        <ul><b>Information</b>
		     <li>ID: <?php echo $uzytkownik['gracz']; ?>
		     <li>Gender: <?php echo $uzytkownik['plec']; ?>
            <li>Gold: <?php echo $uzytkownik['zloto']; ?>
            <li>Bank: <?php echo $uzytkownik['zloto_skarbiec']; ?>
            <li>Points: <?php echo $uzytkownik['punkty']; ?>
			<li>Honor: <?php echo $uzytkownik['honor']; ?>
			<li>Fama: <?php echo $uzytkownik['fama']; ?>
			<li>Victories: <?php echo $uzytkownik['victorias']; ?>
			<li>Missed: <?php echo $uzytkownik['perdidas']; ?>
			<li>Rubies: <?php echo $uzytkownik['rubies']; ?>
        </ul>
    </td>
</tr>
</table>
<?php

//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?> 
