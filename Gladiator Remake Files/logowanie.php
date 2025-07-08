<?php
session_start();
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');
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

    $query = "SELECT id, login, is_admin FROM gracze WHERE login = '$login' AND haslo = '$haslo' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['zalogowany'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['is_admin'] = $user['is_admin'];
		
		// Night login tracker
       date_default_timezone_set('Europe/Athens');
       $current_hour = date('H');

      if ($current_hour >= 0 && $current_hour < 5) {
          $player_id = $user['id'];
          $stmt = $conn->prepare("UPDATE gracze SET night_logins = night_logins + 1 WHERE id = ?");
          $stmt->bind_param("i", $player_id);
          $stmt->execute();
          $stmt->close();
      }
// 🎁 DAILY LOGIN REWARD
date_default_timezone_set('Europe/Athens');
$date_today = date('Y-m-d');
$player_id = $user['id'];

$result = $conn->query("SELECT daily_login_streak, last_login_date, is_premium FROM gracze WHERE id = $player_id");
if (!$result) {
    die("SELECT failed: " . $conn->error);
}
$row = $result->fetch_assoc();
$streak = $row['daily_login_streak'];
$last_login = $row['last_login_date'];
$is_premium = $row['is_premium'];

if ($last_login === $date_today) {
    echo "Already logged in today<br>";
} else {
    if ($last_login === date('Y-m-d', strtotime('-1 day'))) {
        $new_streak = min($streak + 1, 7);
    } else {
        $new_streak = 1;
    }

    $reward_coins = [0, 100, 150, 200, 250, 300, 350, 500];
    $coins = $reward_coins[$new_streak];
    $premium_coins = 1;

    // ✅ Premium bonus
    $premium_bonus = 0;
    if ($is_premium) {
        $coins += 2;
        $premium_bonus = 2;
    }

    $update = $conn->query("UPDATE gracze SET coins = coins + $coins, premium_coins = premium_coins + $premium_coins, daily_login_streak = $new_streak, last_login_date = '$date_today' WHERE id = $player_id");
    if (!$update) {
        die("UPDATE failed: " . $conn->error);
    }

    $msg = "✅ Daily Login: Day $new_streak - You received $coins coins & 1 premium coin!";
    if ($premium_bonus > 0) {
        $msg .= " 👑 (+$premium_bonus bonus for Premium)";
    }

    $conn->query("INSERT INTO notifications (player_id, message) VALUES ($player_id, '$msg')");
    $_SESSION['daily_reward_msg'] = $msg;
}
if (!$result) {
    die("SELECT failed: " . $conn->error);
}
$row = $result->fetch_assoc();
$streak = $row['daily_login_streak'];
$last_login = $row['last_login_date'];

echo "DEBUG<br>Today: $date_today<br>Last Login: $last_login<br>Streak: $streak<br>";

if ($last_login === $date_today) {
    echo "Already logged in today<br>";
} else {
    if ($last_login === date('Y-m-d', strtotime('-1 day'))) {
        $new_streak = min($streak + 1, 7);
    } else {
        $new_streak = 1;
    }

    $reward_coins = [0, 100, 150, 200, 250, 300, 350, 500];
    $coins = $reward_coins[$new_streak];
    $premium_coins = 1;

    echo "Giving $coins coins and $premium_coins premium coins. New streak: $new_streak<br>";

    $update = $conn->query("UPDATE gracze SET coins = coins + $coins, premium_coins = premium_coins + $premium_coins, daily_login_streak = $new_streak, last_login_date = '$date_today' WHERE id = $player_id");
    if (!$update) {
        die("UPDATE failed: " . $conn->error);
    }

    $msg = "✅ Daily Login: Day $new_streak - You received $coins coins & 1 premium coin!";
    $conn->query("INSERT INTO notifications (player_id, message) VALUES ($player_id, '$msg')");

    $_SESSION['daily_reward_msg'] = $msg;
}
        // Redirect to index.php (must be before any output)
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid login or password.";
    }
}
?>
<!-- HTML starts here -->
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