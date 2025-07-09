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

        // 🎁 Daily Login Reward
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

        if (trim($last_login) == $date_today) {
            // Already claimed today
        } else {
            if (trim($last_login) == date('Y-m-d', strtotime('-1 day'))) {
                $new_streak = min($streak + 1, 7);
            } else {
                $new_streak = 1;
            }

            $reward_coins = [0, 100, 150, 200, 250, 300, 350, 500];
            $coins = $reward_coins[$new_streak];
            $premium_coins = 1;

            $premium_bonus = 0;
            if (!empty($is_premium)) {
                $coins += 2;
                $premium_bonus = 2;
            }

            $update = $conn->query("UPDATE gracze SET coins = coins + $coins, premium_coins = premium_coins + $premium_coins, daily_login_streak = $new_streak, last_login_date = '$date_today' WHERE id = $player_id");
            if (!$update) {
                die("UPDATE failed: " . $conn->error);
            }

            // Format reward message
            $msg = "✅ Daily Login: Day $new_streak\n+ $coins coins\n+ 1 premium coin";
            if ($premium_bonus > 0) {
                $msg .= "\n👑 Premium Bonus: +$premium_bonus coins!";
            }

            $conn->query("INSERT INTO notifications (player_id, message) VALUES ($player_id, '$msg')");
            $_SESSION['daily_reward_msg'] = $msg;
        }
		
		// 🎁 DAILY PREMIUM ITEM REWARD
if (!empty($is_premium)) {
    $item_check = $conn->query("SELECT premium_item_last_date FROM gracze WHERE id = $player_id");
    $item_row = $item_check->fetch_assoc();
    $last_item_date = $item_row['premium_item_last_date'];
    $today = date('Y-m-d');

    if ($last_item_date !== $today) {
        // Get a random potion or buff/debuff item
        $result = $conn->query("SELECT id FROM items WHERE type IN ('potion', 'buff', 'debuff') ORDER BY RAND() LIMIT 1");
        if ($result && $result->num_rows > 0) {
            $item = $result->fetch_assoc();
            $item_id = $item['id'];

            // Insert into player's inventory
            $conn->query("INSERT INTO player_items (player_id, item_id, equipped) VALUES ($player_id, $item_id, 0)");

            // Update last given date
            $conn->query("UPDATE gracze SET premium_item_last_date = '$today' WHERE id = $player_id");

            // Optional: Notification
            $msg = "👑 Daily Premium Item delivered to your inventory!";
            $conn->query("INSERT INTO notifications (player_id, message) VALUES ($player_id, '$msg')");
        }
    }
}

        // Redirect after everything
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
