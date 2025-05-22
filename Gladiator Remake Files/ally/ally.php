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

if($uzytkownik['ally_id'] > 0){
			
			$ally_id1 = mysql_query("select * from ally_miembros where usuario_id =".$uzytkownik['gracz']);
			
			while($a1 = mysql_fetch_array($ally_id1 )){
			
			$ally_id2 = $a1['ally_id'];
			
			$ally_id3 = mysql_query("select * from ally where id_ally =".$ally_id2);
			
			while($a2 = mysql_fetch_array($ally_id3 )){

?>

<hr><br><br>

<?php echo "<center> ".$a2['descripcion'] ?>

    <br><br><br><br><br><a href='edit_ally.php'><input class='button2' value='Editar Alianza' type='submit'></input></a><hr>
                <div class="title_box">
                    <div class="title_inner">Alianza</div>
                </div><center>
<?php

			
if(!empty($_GET['buy'])){
    //jeżeli gracz wcisnął trenowanie jakiegoś atrybutu, w zmiennej $_GET['buy'] przetrzymywany jest typ
    
         switch($_GET['buy']){
        case 1:
            //wybrano ally siły
            
            //ustaw koszt, każdy kolejny punkt siły kosztuje 10x aktualna wartość siły, czyli przykładowo dla siły = 1 koszt będzie 10, a dla siły 15 koszt będzie 150, kombinuj samemu coś ze wzorem na koszt
            $koszt = $a2['nivel'] * 50000 / 5; 

                 if($a2['oro'] < $koszt){
                echo "<p>No tienes oro suficiente.</p>";
            } else {
                //dodaj siłę
                $a2['nivel']++;

                //zabierz złoto
                $a2['oro'] -= $koszt;

                mysql_query("update ally set oro = ".$a2['oro'].", nivel = ".$a2['nivel']." where id_ally = ".$a2['id_ally']);

                
            }
        break;

        case 2:
            //wybrano ally zręczności
            
            //ustaw koszt, każdy kolejny punkt zręczności kosztuje 7x aktualna wartość zręczności, czyli przykładowo dla zręczności = 1 koszt będzie 7, a dla zręczności 10 koszt będzie 70, kombinuj samemu coś ze wzorem na koszt
            $koszt = $a2['banco'] * 100000 / 5; 

            if($a2['oro'] < $koszt){
                echo "<p>No tienes oro suficiente</p>";
            } else {
                //dodaj siłę
                $a2['banco']++;

                //zabierz złoto
                $a2['oro'] -= $koszt;

                mysql_query("update ally set oro = ".$a2['oro'].", banco = ".$a2['banco']." where id_ally = ".$a2['id_ally']);

                
            }
        break;

        case 3:
            //wybrano ally wytrzymałości
            
            //ustaw koszt, każdy kolejny punkt wytrzymałości kosztuje 8x aktualna wartość wytrzymałości, czyli przykładowo dla wytrzymałości = 1 koszt będzie 8, a dla wytrzymałości 10 koszt będzie 80, kombinuj samemu coś ze wzorem na koszt
            $koszt = $a2['publics'] * 5000 / 5; 

            if($a2['oro'] < $koszt){
                echo "<p>No tienes oro suficiente</p>";
            } else {
                //dodaj siłę
                $a2['publics']++;

                //zabierz złoto
                $a2['oro'] -= $koszt;

                mysql_query("update ally set oro = ".$a2['oro'].", publics = ".$a2['publics']." where id_ally = ".$a2['id_ally']);

                
            }
        break;
		
		        case 4:
            //wybrano ally wytrzymałości
            
            //ustaw koszt, każdy kolejny punkt wytrzymałości kosztuje 8x aktualna wartość wytrzymałości, czyli przykładowo dla wytrzymałości = 1 koszt będzie 8, a dla wytrzymałości 10 koszt będzie 80, kombinuj samemu coś ze wzorem na koszt
            $koszt = $a2['hospital'] * 15000 / 5;

            if($a2['oro'] < $koszt){
                echo "<p>No tienes oro suficiente</p>";
            } else {
                //dodaj siłę
                $a2['hospital']++;
				$a2['vida'] += 50;

                //zabierz złoto
                $a2['oro'] -= $koszt;

                mysql_query("update ally set oro = ".$a2['oro'].", vida = ".$a2['vida'].", hospital = ".$a2['hospital']." where id_ally = ".$a2['id_ally']);

                
            }
        break;

		
		        case 5:
            //wybrano ally wytrzymałości
            
            //ustaw koszt, każdy kolejny punkt wytrzymałości kosztuje 8x aktualna wartość wytrzymałości, czyli przykładowo dla wytrzymałości = 1 koszt będzie 8, a dla wytrzymałości 10 koszt będzie 80, kombinuj samemu coś ze wzorem na koszt
            $koszt = $a2['trops'] * 30000 / 5; 

            if($a2['oro'] < $koszt){
                echo "<p>No tienes oro suficiente</p>";
            } else {
                //dodaj siłę
                $a2['trops']++;
                $a2['damage'] += 3;
				}
				
                //zabierz złoto
                $a2['oro'] -= $koszt;

                mysql_query("update ally set oro = ".$a2['oro'].", damage = ".$a2['damage'].", trops = ".$a2['trops']." where id_ally = ".$a2['id_ally']);

        break;

		
		case 6:
            //wybrano ally inteligencji
            
            //ustaw koszt, każdy kolejny punkt inteligencji kosztuje 8x aktualna wartość inteligencji, czyli przykładowo dla inteligencji = 1 koszt będzie 8, a dla inteligencji 10 koszt będzie 80, kombinuj samemu coś ze wzorem na koszt
            $koszt = $a2['muro'] * 40000 / 5;

            if($a2['oro'] < $koszt){
                echo "<p>No tienes oro suficiente</p>";
				
            } else {
			
                //dodaj siłę
                $a2['muro']++;
				$a2['defensa'] += 3;
				
				}
				
                //zabierz złoto
                $a2['oro'] -= $koszt;

                mysql_query("update ally set oro = ".$a2['oro'].", defensa = ".$a2['defensa'].", muro = ".$a2['muro']." where id_ally = ".$a2['id_ally']);
        break;		
		
		default:
            //jeżeli wybrał typ którego nie ma (np sam coś kombinuje w adresie strony, chcąc namieszać)
            echo "<p>No hay tales habilidades.</p>";
        break;
    }

} 
?>
<?php 
if($a1['rank'] >= 2){
?>
<p>
<b>Formación</b>
<table>
<tr>
    <td>
        Alianza Nivel: <?php echo $a2['nivel']; ?>
    </td>
    <td> 
        <a href='ally.php?buy=1'>Precio: <?php echo $a2['nivel'] * 50000 / 5; ?> oro</a>
    </td>
</tr>
<tr>
    <td>
        Banco: <?php echo $a2['banco']; ?>
    </td>
    <td>
         <a href='ally.php?buy=2'>Precio: <?php echo $a2['banco'] * 100000 / 5; ?> oro </a>
    </td>
</tr>
<tr>
    <td>
        Baños Publicos: <?php echo $a2['publics']; ?>
    </td>
    <td>
        <a href='ally.php?buy=3'>Precio: <?php echo $a2['publics'] * 5000 / 5; ?> oro </a>
    </td>
	<tr>
    <td>
        Hospital: <?php echo $a2['hospital']; ?>
    </td>
    <td>
        <a href='ally.php?buy=4'>Precio: <?php echo $a2['hospital'] * 15000 / 5; ?> oro </a>
    </td>
	<tr>
    <td>
        Tropas: <?php echo $a2['trops']; ?>
    </td>
    <td>
        <a href='ally.php?buy=5'>Precio: <?php echo $a2['trops'] * 30000 / 5; ?> oro </a>
    </td>
<tr>
    <td>
        Muro: <?php echo $a2['muro']; ?>
    </td>
    <td>
        <a href='ally.php?buy=6'>Precio: <?php echo $a2['muro'] * 40000 / 5; ?> oro </a>
    </td>
	</tr>
</table>
</p>

        <ul><b>Estadísticas</b>
            <li>Ataque: <?php echo $a2['damage']; ?>
            <li>Defensa: <?php echo $a2['defensa']; ?>
			<li>Inteligencia: <?php echo $a2['muro']; ?>
            <li>Vida: <?php echo $a2['vida']; ?>
            <li>Daño: <?php echo $a2['damage']; ?>
        </ul>
        <br/>
        <ul><b>Información</b>
            <li>Oro: <?php echo $a2['oro']; ?>
            <li>Bodega: <?php 
			
			$pp = $a2['banco'] * 10 / 100; 
			echo "$pp%"; ?>
            <li>Victorias: <?php echo $a2['victorias']; ?>
        </ul>

<?php 
} else {
?>

<p>
<b>Formación</b>
<table>
<tr>
    <td>
        Alianza Nivel: <?php echo $a2['nivel']; ?>
    </td>
</tr>
<tr>
    <td>
        Banco: <?php echo $a2['banco']; ?>
    </td>
</tr>
<tr>
    <td>
        Baños Publicos: <?php echo $a2['publics']; ?>
    </td>
	<tr>
    <td>
        Hospital: <?php echo $a2['hospital']; ?>
    </td>
	<tr>
    <td>
        Tropas: <?php echo $a2['trops']; ?>
    </td>
<tr>
    <td>
        Muro: <?php echo $a2['muro']; ?>
    </td>
	</tr>
</table>
</p>

        <ul><b>Estadísticas</b>
            <li>Ataque: <?php echo $a2['damage']; ?>
            <li>Defensa: <?php echo $a2['defensa']; ?>
			<li>Inteligencia: <?php echo $a2['muro']; ?>
            <li>Vida: <?php echo $a2['vida']; ?>
            <li>Daño: <?php echo $a2['damage']; ?>
        </ul>
        <br/>
        <ul><b>Información</b>
            <li>Oro: <?php echo $a2['oro']; ?>
            <li>Bodega: <?php 
			
			$pp = $a2['banco'] * 10 / 100; 
			echo "$pp%"; ?>
            <li>Victorias: <?php echo $a2['victorias']; ?>
        </ul>
		
			
	<?php	

	
			}
			
			}
			
			}
			
			} else {
			
			echo "No tienes alianza";
			echo "<br>";
			echo "Crea tu alianza";
			echo "<br>";
			echo "<a href='edit_ally.php'><input class='button2' value='Editar Alianza' type='submit'></input></a>";
			
			}

//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?> 
