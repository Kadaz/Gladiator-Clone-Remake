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

// Check battle limit
$check = $conn->prepare("SELECT COUNT(*) FROM battle_logs WHERE player_id = ? AND zone = 'dungeon' AND timestamp > NOW() - INTERVAL 1 HOUR");
$check->bind_param("i", $player_id);
$check->execute();
$check->bind_result($dungeon_count);
$check->fetch();
$check->close();

if ($dungeon_count >= 10) {
    echo "<h3 style='color:red'>⛔ Dungeon limit reached (10/hour). Try later.</h3><a href='index.php'>← Back</a>";
    exit;
}

// Load player
$stmt = $conn->prepare("SELECT * FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();
$player = $result->fetch_assoc();

// Load a random enemy from enemies table with is_boss = 0
if (!isset($_SESSION['dungeon_enemy'])) {
    $enemy_result = $conn->query("SELECT * FROM enemies WHERE is_boss = 0 ORDER BY RAND() LIMIT 1");
    $enemy = $enemy_result->fetch_assoc();
    $_SESSION['dungeon_enemy'] = $enemy;
    $_SESSION['dungeon_enemy_hp'] = rand($enemy['min_hp'], $enemy['max_hp']);
    $_SESSION['dungeon_player_hp'] = $player['zycie'];
    $_SESSION['dungeon_log'] = [];
    $_SESSION['dungeon_skill_cooldowns'] = [];
    $_SESSION['dungeon_reward'] = false;
}

$enemy = $_SESSION['dungeon_enemy'];
$enemy_hp = $_SESSION['dungeon_enemy_hp'];
$player_hp = $_SESSION['dungeon_player_hp'];
$log = [];
$now = time();
$cooldowns = $_SESSION['dungeon_skill_cooldowns'] ?? [];

// Load unlocked skills
$skills = [];
$basic_skills = [];
$advanced_skills = [];
$res = $conn->query("SELECT s.* FROM skills s JOIN skill_unlocks u ON u.skill_id = s.id WHERE u.unlock_level <= {$player['nivel']}");
while ($row = $res->fetch_assoc()) {
    $skills[$row['id']] = $row;
    if ($row['cooldown'] <= 3) {
        $basic_skills[] = $row;
    } else {
        $advanced_skills[] = $row;
    }
}

// Reset battle
if (isset($_POST['reset'])) {
    unset($_SESSION['dungeon_enemy']);
    header("Location: dungeon.php");
    exit;
}

// Handle skill/combat
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $time = date("H:i:s");
    $player_dmg = rand(10, 20) + floor($player['sila'] * 0.5);
    $enemy_dmg = rand($enemy['min_dmg'], $enemy['max_dmg']);

    if (ctype_digit($action) && isset($skills[$action])) {
        $skill = $skills[$action];
        $cd_key = "skill_" . $skill['id'];

        if (!isset($cooldowns[$cd_key]) || $now >= $cooldowns[$cd_key]) {
            $player_dmg = $skill['damage'] + floor($player['sila'] * 0.5);
            $player_hp += $skill['healing'];
            $cooldowns[$cd_key] = $now + $skill['cooldown_seconds'];
            $log[] = "<span class='log-player-skill'>[$time] You used <strong>{$skill['name']}</strong>: +{$skill['damage']} dmg, +{$skill['healing']} HP</span>";
        } else {
            $log[] = "<span class='log-enemy-attack'>[$time] ❌ Skill on cooldown!</span>";
            $player_dmg = 0;
        }
    } elseif ($action === 'basic') {
        $log[] = "<span class='log-player-attack'>[$time] You deal $player_dmg to {$enemy['name']}.</span>";
    }

    if ($enemy_hp - $player_dmg > 0) {
        $player_hp -= $enemy_dmg;
        $log[] = "<span class='log-enemy-attack'>[$time] {$enemy['name']} hits you for $enemy_dmg.</span>";
    }

    $enemy_hp -= $player_dmg;

    $_SESSION['dungeon_player_hp'] = max(0, $player_hp);
    $_SESSION['dungeon_enemy_hp'] = max(0, $enemy_hp);
    $_SESSION['dungeon_log'] = array_merge($_SESSION['dungeon_log'] ?? [], $log);
    $_SESSION['dungeon_skill_cooldowns'] = $cooldowns;

    // Rewards
    if ($enemy_hp <= 0 && $player_hp > 0 && empty($_SESSION['dungeon_reward'])) {
        $xp = $enemy['xp_reward'];
        $gold = $enemy['gold_reward'];
        $new_exp = $player['exp'] + $xp;
        $new_lvl = $player['nivel'];
        $new_hp = $player['zycie'];
        $new_str = $player['sila'];
        $leveled = false;

        while ($new_exp >= $new_lvl * 100) {
            $new_exp -= $new_lvl * 100;
            $new_lvl++;
            $new_hp += 10;
            $new_str += 2;
            $leveled = true;
            $log[] = "<span class='log-reward level-up'>🎉 Level Up! Now level $new_lvl</span>";
        }

        $stmt = $conn->prepare("UPDATE gracze SET exp = ?, nivel = ?, zloto = zloto + ?, zycie = ?, sila = ? WHERE id = ?");
        $stmt->bind_param("iiiiii", $new_exp, $new_lvl, $gold, $new_hp, $new_str, $player_id);
        $stmt->execute();

        $_SESSION['dungeon_log'][] = "<span class='log-reward'>🏆 You earned $xp XP and $gold gold!</span>";
        $_SESSION['dungeon_reward'] = true;

        $conn->query("INSERT INTO battle_logs (player_id, timestamp, zone) VALUES ($player_id, NOW(), 'dungeon')");
    }

    header("Location: dungeon.php");
    exit;
}

$battle_log = $_SESSION['dungeon_log'] ?? [];
?>

<h2>🕸️ Dungeon Battle: You vs <?= htmlspecialchars($enemy['name']) ?></h2>
<img src="images/enemies/<?= htmlspecialchars($enemy['image']) ?>" alt="<?= htmlspecialchars($enemy['name']) ?>" width="120"><br>
<p><strong>Your HP:</strong> <?= $player_hp ?> | <strong><?= htmlspecialchars($enemy['name']) ?> HP:</strong> <?= $enemy_hp ?></p>

<?php if ($player_hp > 0 && $enemy_hp > 0): ?>
    <form method="post">
        <button type="submit" name="action" value="basic">⚔️ Basic Attack</button>
    </form>

    <button onclick="showTab('basic')">Basic Skills</button>
    <button onclick="showTab('advanced')">Advanced Skills</button>

    <div id="skills-basic" style="display:none;">
        <form method="post">
        <?php foreach ($basic_skills as $skill): ?>
            <button type="submit" name="action" value="<?= $skill['id'] ?>">
                <?= $skill['name'] ?> (<?= $skill['description'] ?>)
            </button>
        <?php endforeach; ?>
        </form>
    </div>

    <div id="skills-advanced" style="display:none;">
        <form method="post">
        <?php foreach ($advanced_skills as $skill): ?>
            <button type="submit" name="action" value="<?= $skill['id'] ?>">
                <?= $skill['name'] ?> (<?= $skill['description'] ?>)
            </button>
        <?php endforeach; ?>
        </form>
    </div>

<?php elseif ($enemy_hp <= 0): ?>
    <h3>🎉 You defeated the <?= htmlspecialchars($enemy['name']) ?>!</h3>
    <form method="post"><button name="reset">Start New Dungeon</button></form>
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
</script>

<style>
.log-player-attack { color: green; }
.log-player-skill { color: blue; animation: shake 0.3s; }
.log-heal { color: orange; }
.log-enemy-attack { color: red; }
.log-reward { color: purple; font-weight: bold; }
.level-up { color: gold; }
</style>
