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
$event_type = $_GET['event'] ?? 'christmas';
$zone = "event_$event_type";

// Limit check
$check = $conn->prepare("SELECT COUNT(*) FROM battle_logs WHERE player_id = ? AND zone = ? AND timestamp > NOW() - INTERVAL 1 HOUR");
$check->bind_param("is", $player_id, $zone);
$check->execute();
$check->bind_result($count);
$check->fetch();
$check->close();

if ($count >= 10) {
    echo "<h3 style='color:red'>⛔ Event battle limit reached (10/hour).</h3><a href='index.php'>← Back</a>";
    exit;
}

// Load player
$stmt = $conn->prepare("SELECT * FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$player = $stmt->get_result()->fetch_assoc();

// Reset
if (isset($_POST['reset'])) {
    unset($_SESSION['event_enemy'], $_SESSION['event_enemy_hp'], $_SESSION['event_player_hp'], $_SESSION['event_log'], $_SESSION['event_cooldowns'], $_SESSION['event_reward']);
    header("Location: event_battle.php?event=$event_type");
    exit;
}

// Load enemy
if (!isset($_SESSION['event_enemy'])) {
    $enemy = $conn->query("SELECT * FROM enemies WHERE event_type = '$event_type' ORDER BY RAND() LIMIT 1")->fetch_assoc();
    $_SESSION['event_enemy'] = $enemy;
    $_SESSION['event_enemy_hp'] = rand($enemy['min_hp'], $enemy['max_hp']);
    $_SESSION['event_player_hp'] = $player['zycie'];
    $_SESSION['event_log'] = [];
    $_SESSION['event_cooldowns'] = [];
    $_SESSION['event_reward'] = false;
}

$enemy = $_SESSION['event_enemy'];
$player_hp = $_SESSION['event_player_hp'];
$enemy_hp = $_SESSION['event_enemy_hp'];
$log = [];
$now = time();
$cooldowns = $_SESSION['event_cooldowns'] ?? [];

// Skills
$skills = [];
$basic_skills = [];
$advanced_skills = [];
$res = $conn->query("SELECT s.* FROM skills s JOIN skill_unlocks u ON u.skill_id = s.id WHERE u.unlock_level <= {$player['nivel']}");
while ($row = $res->fetch_assoc()) {
    $skills[$row['id']] = $row;
    if ($row['cooldown'] <= 3) $basic_skills[] = $row;
    else $advanced_skills[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $time = date("H:i:s");
    $player_dmg = rand(10, 20) + floor($player['sila'] * 0.5);
    $enemy_dmg = rand($enemy['min_dmg'], $enemy['max_dmg']);

    if (ctype_digit($action) && isset($skills[$action])) {
        $skill = $skills[$action];
        $cd_key = "skill_{$skill['id']}";
        if (!isset($cooldowns[$cd_key]) || $now >= $cooldowns[$cd_key]) {
            $player_dmg = $skill['damage'] + floor($player['sila'] * 0.5);
            $player_hp += $skill['healing'];
            $cooldowns[$cd_key] = $now + $skill['cooldown_seconds'];
            $log[] = "<span class='log-player-skill'>[$time] Used {$skill['name']}</span>";
        } else {
            $log[] = "<span class='log-enemy-attack'>[$time] ❌ Skill on cooldown!</span>";
            $player_dmg = 0;
        }
    } elseif ($action === 'basic') {
        $log[] = "<span class='log-player-attack'>[$time] You hit {$enemy['name']} for $player_dmg</span>";
    }

    if ($enemy_hp - $player_dmg > 0) {
        $player_hp -= $enemy_dmg;
        $log[] = "<span class='log-enemy-attack'>[$time] {$enemy['name']} hits for $enemy_dmg</span>";
    }

    $enemy_hp -= $player_dmg;
    $_SESSION['event_player_hp'] = max(0, $player_hp);
    $_SESSION['event_enemy_hp'] = max(0, $enemy_hp);
    $_SESSION['event_log'] = array_merge($_SESSION['event_log'], $log);
    $_SESSION['event_cooldowns'] = $cooldowns;

    if ($enemy_hp <= 0 && $player_hp > 0 && empty($_SESSION['event_reward'])) {
        $xp = $enemy['xp_reward'];
        $gold = $enemy['gold_reward'];
        $new_exp = $player['exp'] + $xp;
        $new_lvl = $player['nivel'];
        $new_hp = $player['zycie'];
        $new_str = $player['sila'];

        while ($new_exp >= $new_lvl * 100) {
            $new_exp -= $new_lvl * 100;
            $new_lvl++;
            $new_hp += 10;
            $new_str += 2;
        }

        $stmt = $conn->prepare("UPDATE gracze SET exp = ?, nivel = ?, zloto = zloto + ?, zycie = ?, sila = ? WHERE id = ?");
        $stmt->bind_param("iiiiii", $new_exp, $new_lvl, $gold, $new_hp, $new_str, $player_id);
        $stmt->execute();

        $_SESSION['event_log'][] = "<span class='log-reward'>🏆 +$xp XP, +$gold Gold!</span>";
        $_SESSION['event_reward'] = true;

        $conn->query("INSERT INTO battle_logs (player_id, timestamp, zone) VALUES ($player_id, NOW(), '$zone')");

        // 🎁 DROP LOGIC STARTS HERE
        $drop_stmt = $conn->prepare("SELECT item_id, drop_chance FROM event_item_drops WHERE event_type = ?");
        $drop_stmt->bind_param("s", $event_type);
        $drop_stmt->execute();
        $drop_res = $drop_stmt->get_result();

        while ($drop = $drop_res->fetch_assoc()) {
            if (mt_rand(0, 10000) / 10000 <= $drop['drop_chance']) {
                $conn->query("INSERT INTO player_items (player_id, item_id, equipped) VALUES ($player_id, {$drop['item_id']}, 0)");
                $item = $conn->query("SELECT name FROM items WHERE id = {$drop['item_id']}")->fetch_assoc();
                $_SESSION['event_log'][] = "<span class='log-reward'>🎁 You found <strong>{$item['name']}</strong>!</span>";
            }
        }
        // 🎁 DROP LOGIC ENDS HERE
    }

    header("Location: event_battle.php?event=$event_type");
    exit;
}

$battle_log = $_SESSION['event_log'] ?? [];
$enemy_image = htmlspecialchars($enemy['image']);
?>
<style>
body {
    font-family: Arial;
    <?php if ($event_type === 'christmas'): ?>
    background-image: url('images/christmas_bg.png');
    background-size: cover;
    <?php elseif ($event_type === 'halloween'): ?>
    background-image: url('images/halloween_bg.png');
    background-color: #0b0b0b;
    color: #eee;
    <?php endif; ?>
}
.snowflake {
    position: fixed; top: -10px; z-index: 9999; color: white; font-size: 24px;
    pointer-events: none; animation: fall linear infinite;
}
@keyframes fall {
    0% { transform: translateY(0); }
    100% { transform: translateY(100vh); }
}
</style>

<h2><?= $event_type === 'halloween' ? '🎃' : '🎄' ?> Event Battle: <?= $enemy['name'] ?></h2>
<img src="images/enemies/<?= $enemy_image ?>" width="128"><br>
<p><strong>Your HP:</strong> <?= $player_hp ?> | <strong><?= $enemy['name'] ?> HP:</strong> <?= $enemy_hp ?></p>

<?php if ($enemy_hp > 0 && $player_hp > 0): ?>
    <form method="post">
        <button type="submit" name="action" value="basic">Basic Attack</button>
    </form>
    <button onclick="showTab('basic')">Basic Skills</button>
    <button onclick="showTab('advanced')">Advanced Skills</button>
    <div id="skills-basic" style="display:none;">
        <form method="post">
            <?php foreach ($basic_skills as $skill): ?>
                <button type="submit" name="action" value="<?= $skill['id'] ?>"><?= $skill['name'] ?> (<?= $skill['description'] ?>)</button>
            <?php endforeach; ?>
        </form>
    </div>
    <div id="skills-advanced" style="display:none;">
        <form method="post">
            <?php foreach ($advanced_skills as $skill): ?>
                <button type="submit" name="action" value="<?= $skill['id'] ?>"><?= $skill['name'] ?> (<?= $skill['description'] ?>)</button>
            <?php endforeach; ?>
        </form>
    </div>
<?php elseif ($enemy_hp <= 0): ?>
    <h3>🎉 You defeated <?= $enemy['name'] ?>!</h3>
    <form method="post"><button name="reset">Start New Battle</button></form>
<?php else: ?>
    <h3>💀 You were defeated.</h3>
    <form method="post"><button name="reset">Try Again</button></form>
<?php endif; ?>

<h3>📜 Battle Log</h3>
<ul>
    <?php foreach (array_reverse($battle_log) as $entry): ?>
        <li><?= $entry ?></li>
    <?php endforeach; ?>
</ul>

<script>
function showTab(tab) {
    document.getElementById('skills-basic').style.display = (tab === 'basic') ? 'block' : 'none';
    document.getElementById('skills-advanced').style.display = (tab === 'advanced') ? 'block' : 'none';
}
<?php if ($event_type === 'christmas'): ?>
for (let i = 0; i < 50; i++) {
    const snowflake = document.createElement("div");
    snowflake.className = "snowflake";
    snowflake.textContent = "❄";
    snowflake.style.left = Math.random() * 100 + "vw";
    snowflake.style.animationDuration = (5 + Math.random() * 5) + "s";
    snowflake.style.fontSize = (12 + Math.random() * 20) + "px";
    document.body.appendChild(snowflake);
}
<?php endif; ?>
</script>
