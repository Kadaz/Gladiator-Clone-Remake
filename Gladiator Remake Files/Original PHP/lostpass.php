<?php
//włączamy bufor
ob_start();

//pobieramy zawartość pliku ustawień
require_once('var/ustawienia.php');

//startujemy lub przedłużamy sesję
session_start();

//pobieramy nagłówek strony
require_once('gora_strony.php');
//pobieramy zawartość menu
require_once('menu_l.php');

  if($_POST['ok']){
  $name = htmlspecialchars($_POST['name']);
  $password = md5($_POST['pass']);
  $password_2 = md5($_POST['pass2']);
  $email = $_POST['email'];
  $pregunta = $_POST['pregunta'];
  $respuesta = $_POST['respuesta'];
  if(!empty($name) && !empty($password) && !empty($password_2) && !empty($email) && !empty($pregunta) && !empty($respuesta)){

  if($password == $password_2){
  $luser = mysql_fetch_array(mysql_query("select * from gracze where login = '".$name."'"));
  if($luser['login'] = $name){
  if($luser['email'] = $email){
  if($luser['pregunta'] == $pregunta){
  if($luser['respuesta'] == $respuesta){
  
  $query = mysql_query("update gracze set haslo = '".$password."' where gracz = ".$luser['gracz']."");
  if($query){
		echo "<br><center>Ready! <a href='logowanie.php'> Click here to go login page.";
		}
  
  } else {
  echo "<br><center>The secret answer does not match!";
  }
  } else {
  echo "<br><center>The secret question does not match!";
  }
  } else {
  echo "<br><center>The email does not match the user!";
  }
  } else {
  echo "<br><center>Username no exist!";
  }
  } else {
  echo "<br><center>Passwords are different!";
  }
  }
  }  else {
  ?>
  <form action='lostpass.php' method='post'>
  
    <div id="krieger">
	<h1 style="position:relative; top: 20px;">Recovery password</h1>
	<div class="signup_form">
		<table width="100%" cellpadding="0" cellspacing="2" border="0" align="center">
		<tr class="alt">
		
  <td>Username:</td></tr>

  <tr><td><input type='text' name='name' /></td></tr>

  <tr class="alt">
		
  <td>Please choose a new password:</td></tr>

  <tr><td><input type='password' name='pass' /></td></tr>

  <tr class="alt">

  <td>Please repeat the new password:</td></tr>

  <tr><td><input type='password' name='pass2' /></td></tr>
  
  <tr class="alt">

  <td>E-mail:</td></tr>

  <tr><td><input type='text' name='email' /></td></tr>

  <tr class="alt">

  <td>Secret Question:</td></tr>

  <tr><td><input type='text' name='pregunta' /></td></tr>
  
  <td>Secret Answer:</td></tr>

  <tr><td><input type='text' name='respuesta' /></td></tr>
  
    <tr>
                </tr>

  <tr><td style="padding-left:20px">

                        <br />

                        <input type="submit" name='ok' value="JOIN!" class="button1">

                    </td>
</tr>
   </table></form>
  <?php
  }
//pobieramy stopkę
require_once('dol_strony.php');

//wyłączamy bufor
ob_end_flush();
?>
