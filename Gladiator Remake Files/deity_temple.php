<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$player_id = $_SESSION['id'];

/* ------------------------------------------------------------------
   1. Load full player data (deity + last_deity_change)
------------------------------------------------------------------ */
$stmt = $conn->prepare(
    "SELECT deity_id, last_deity_change
     FROM gracze
     WHERE id = ?"
);
$stmt->bind_param("i", $player_id);
$stmt->execute();
$stmt->bind_result($current_deity_id, $last_change_date);
$stmt->fetch();
$stmt->close();

/* ------------------------------------------------------------------
   2. 7-day cooldown calculation
------------------------------------------------------------------ */
$today          = new DateTime();                     // today
$can_change     = true;                               // default: can
$days_remaining = 0;

if ($current_deity_id) {
    if ($last_change_date) {
        $last   = new DateTime($last_change_date);
        $diff   = $today->diff($last)->days;
        if ($diff < 7) {
            $can_change     = false;
            $days_remaining = 7 - $diff;
        }
    }
}

/* ------------------------------------------------------------------
   3. If reset is pressed (and allowed) we reset deity_id
------------------------------------------------------------------ */
if (isset($_POST['reset_deity']) && $can_change) {
    $stmt = $conn->prepare(
        "UPDATE gracze
         SET deity_id = NULL
         WHERE id = ?"
    );
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    header("Location: deity_temple.php");
    exit;
}

/* ------------------------------------------------------------------
   4. If he chose a new deity (only if he hasn't already)
------------------------------------------------------------------ */
if (isset($_POST['choose']) && !$current_deity_id) {
    $chosen_id = (int)$_POST['deity_id'];

    // verify deity exists
    $verify = $conn->prepare("SELECT id FROM deities WHERE id = ?");
    $verify->bind_param("i", $chosen_id);
    $verify->execute();
    if ($verify->get_result()->num_rows) {
        $stmt = $conn->prepare(
            "UPDATE gracze
             SET deity_id = ?, last_deity_change = CURDATE()
             WHERE id = ?"
        );
        $stmt->bind_param("ii", $chosen_id, $player_id);
        $stmt->execute();
        header("Location: deity_temple.php");
        exit;
    }
}

/* ------------------------------------------------------------------
   5. If it already has a deity, show it + cooldown info / change button
------------------------------------------------------------------ */
if ($current_deity_id) {
    $d = $conn->query(
        "SELECT name, description, bonus_type, bonus_value, image
         FROM deities
         WHERE id = $current_deity_id"
    )->fetch_assoc();

    echo "<h2>Your Deity</h2>";
    echo "<p style='font-size:32px'>"
       . html_entity_decode($d['image'])
       . " <strong>{$d['name']}</strong></p>";
    echo "<p>{$d['description']}</p>";
    echo "<p><strong>Bonus:</strong> {$d['bonus_type']} +{$d['bonus_value']}%</p>";

    if ($can_change) {
        echo "<form method='post' style='margin-top:15px;'>
                <button type='submit' name='reset_deity'>
                    🔄 Change Deity (7‑day cooldown)
                </button>
              </form>";
    } else {
        echo "<p style='color:red; margin-top:15px;'>
                ⏳ You can change deity again in {$days_remaining} day(s).
              </p>";
    }

    echo "<br><a href='index.php'>← Back to Dashboard</a>";
    exit;
}

/* ------------------------------------------------------------------
   6. He has no deity – show all available ones
------------------------------------------------------------------ */
echo "<h2>⛪ Choose Your Deity</h2>";
echo "<p>You may choose one divine power. After that you can change it once every 7 days.</p>";

$deities = $conn->query("SELECT * FROM deities");
while ($row = $deities->fetch_assoc()) {
    echo "<div style='border:1px solid #ccc; padding:10px; margin:10px; border-radius:8px; background:#f9f9f9'>";
    echo "<p style='font-size:28px'>"
       . html_entity_decode($row['image'])
       . " <strong>{$row['name']}</strong></p>";
    echo "<p>{$row['description']}</p>";
    echo "<p><strong>Bonus:</strong> {$row['bonus_type']} +{$row['bonus_value']}%</p>";
    echo "<form method='post'>
            <input type='hidden' name='deity_id' value='{$row['id']}'>
            <button type='submit' name='choose'>🙏 Devote to {$row['name']}</button>
          </form>";
    echo "</div>";
}

echo "<br><a href='index.php'>← Back to Dashboard</a>";
?>
