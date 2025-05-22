<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = mysqli_connect("localhost", "root", "3227", "gladiatus");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!empty($_POST['login']) && !empty($_POST['haslo'])) {
    $login = mysqli_real_escape_string($conn, $_POST['login']);
    $haslo = md5($_POST['haslo']);

    $query = "SELECT id, login FROM gracze WHERE login = '$login' AND haslo = '$haslo' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['zalogowany'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['login'] = $user['login'];

        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid login or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login to Gladiatus</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="logowanie.php" method="post">
        <label>Login:</label><br>
        <input type="text" name="login" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="haslo" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>