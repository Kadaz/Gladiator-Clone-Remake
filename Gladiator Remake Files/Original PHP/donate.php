<?php

ob_start();


require_once('GameEngine/constable.php');


session_start();


require_once('logged.php');



require_once('group_site-2.php');


require_once('menu.php');
?>
<html>
<center><br><br>
Donar para Gladiatus Clone (Por primera vez):<br>


<?php
if($user['fdfr'] >= 1){
echo "<p>Ya donaste por primera vez.<br>Si vuelves a donar no se te daran los Rubies.</p>";
}
else {

echo "Esta es la primera donacion que haras?<br>Pues si es asi, recibiras de 100k de Rubies (por $5USD).<br><br>" ?>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="DAM9XPZH8U9G8">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The

safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
</form>
</html>



<?php

if(!empty($_GET['v5MoFIzzkZygyDw'])){
    //if a player hit a train attribute in the variable $ _GET ['train'] is the typee held

         switch($_GET['v5MoFIzzkZygyDw']){

        case 1:

            if($user['fdfr'] >= 1){
                echo "<p>Ya donaste por primera vez.<br>Estas abusando</p>";

            } else {

                echo "<p>Recarga la pagina para completar la donacion (solo puedes recargarla una vez).</p>";

                $user['rubins'] += 100000;
                $user['fdfr']++;

                }

                mysql_query("update accounts set rubins = ".$user['rubins'].", fdfr = ".$user['fdfr']." where id = ".$user['id']);


            }

        break;
}
}

?>

<?php
require_once('down_page.php');


ob_end_flush();
?>