<?php
ob_start();
session_start();

require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (isset($_POST['ok'])) {
    $tnc = $_POST['tnc'];
    $name = htmlspecialchars($_POST['name']);
    $password = md5($_POST['pass']);
    $password_2 = md5($_POST['pass2']);
    $email = $_POST['email'];
    $question = $_POST['pregunta'];
    $answer = $_POST['respuesta'];

    if (!empty($name) && !empty($password) && !empty($password_2) && !empty($email) && !empty($question) && !empty($answer)) {
        if ($tnc == 1) {
            if ($password == $password_2) {
                $check_user = mysqli_query($conn, "SELECT gracz FROM gracze WHERE login = '$name'");
                if (mysqli_fetch_array($check_user)) {
                    echo "<br><center>This username already exists.</center>";
                } else {
                    $check_email = mysqli_query($conn, "SELECT gracz FROM gracze WHERE email = '$email'");
                    if (mysqli_fetch_array($check_email)) {
                        echo "<br><center>This email is already in use.</center>";
                    } else {
                        // Updated INSERT with zloto_skarbiec set to 0 (default value)
                        $query = "INSERT INTO gracze (
    login, haslo, email, plec, avatar, pregunta, respuesta, rank, nivel, exp, exp_max, honor, fama, 
    victorias, perdidas, oro_robado, oro_perdido, atak, obrona, sila, sila_i, sila_max, 
    zrecznosc, zrecznosc_i, zrecznosc_max, wyrzymalosc, wyrzymalosc_i, wyrzymalosc_max, 
    constitucion, constitucion_i, constitucion_max, carisma, carisma_i, carisma_max, 
    inteligencja, inteligencja_i, inteligencja_max, mdchance, dhchance, ctchance, 
    zycie, zycie_max, obrazenia_min, obrazenia_max, zloto, zloto_skarbiec, punkty, pracuje, 
    ostatnia_walka_pvp, ostatnia_walka_pvc, ostatnio_zregenerowano, titulo, arena_level, 
    rubies, centurion_time, reportes, mensajes, noticias, 
    bendicion1_type, bendicion1_time, bendicion2_type, bendicion2_time, 
    bendicion3_type, bendicion3_time, bendicion4_type, bendicion4_time
) VALUES (
    '$name', '$password', '$email', 0, 1, '$question', '$answer', 1, 1, 0, 10, 0, 0,
    0, 0, 0, 0, 0, 0, 5, 0, 10,
    5, 0, 10, 5, 0, 10,
    5, 0, 10, 5, 0, 10,
    5, 0, 10, 0, 0, 0,
    100, 100, 0, 2, 150, 0, 0, 0,
    0, 0, 0, 'Newbie', 0,
    0, 0, 0, 0, 0,
    0, 0, 0, 0,
    0, 0, 0, 0
)";
                        if (mysqli_query($conn, $query)) {
                            echo "<br><center>Welcome to Gladiatus, $name!<br>Your account has been created.<br><a href='logowanie.php'>Click here to login</a>.</center>";
                        } else {
                            echo "<br><center>Registration failed: " . mysqli_error($conn) . "</center>";
                        }
                    }
                }
            } else {
                echo "<br><center>Passwords do not match!</center>";
            }
        } else {
            echo "<br><center>You must accept the terms and conditions.</center>";
        }
    } else {
        echo "<br><center>Please complete all fields.</center>";
    }
}
?>

<center>
<h2>Register</h2>
<form action="rejestracja.php" method="POST">
    <table>
        <tr><td>Username:</td><td><input type="text" name="name"></td></tr>
        <tr><td>Password:</td><td><input type="password" name="pass"></td></tr>
        <tr><td>Repeat Password:</td><td><input type="password" name="pass2"></td></tr>
        <tr><td>Email:</td><td><input type="email" name="email"></td></tr>
        <tr><td>Security Question:</td><td><input type="text" name="pregunta"></td></tr>
        <tr><td>Answer:</td><td><input type="text" name="respuesta"></td></tr>
        <tr><td>Accept Terms:</td><td><input type="checkbox" name="tnc" value="1"></td></tr>
        <tr><td colspan="2"><input type="submit" name="ok" value="Register"></td></tr>
    </table>
</form>
</center>

<?php
// Only include footer if the file exists
if (file_exists('stopka.php')) {
    require_once('stopka.php');
} else {
    echo "<!-- Footer file missing (stopka.php) -->";
}
?>