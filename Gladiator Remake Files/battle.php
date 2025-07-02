<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

// Load Player early
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$player_id = $_SESSION['id'];

// ✅ Notification System (auto-delete after showing)
$player_id = $_SESSION['id'];
$notifications = [];

$noti_stmt = $conn->prepare("SELECT id, message FROM notifications WHERE player_id = ? ORDER BY created_at DESC LIMIT 5");
$noti_stmt->bind_param("i", $player_id);
$noti_stmt->execute();
$res = $noti_stmt->get_result();
while ($row = $res->fetch_assoc()) {
    $notifications[] = $row;
}
$noti_stmt->close();
if (!empty($notifications)) {
    $ids = implode(",", array_column($notifications, 'id'));
    $conn->query("DELETE FROM notifications WHERE id IN ($ids)");
}


// 🔒 Battle Limit (10 per hour)
$limit_check = $conn->prepare("SELECT COUNT(*) FROM battle_logs WHERE player_id = ? AND timestamp > NOW() - INTERVAL 1 HOUR");
$limit_check->bind_param("i", $player_id);
$limit_check->execute();
$limit_check->bind_result($battles_last_hour);
$limit_check->fetch();
$limit_check->close();

if ($battles_last_hour >= 10) {
    die("<h3 style='color:red'>⛔ You have reached your battle limit (10 per hour). Try again later.</h3><a href='index.php'>← Back</a>");
}

// Reset battle manually (Start New Battle)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset'])) {
    $enemy = $enemy_pool[array_rand($enemy_pool)];
    $_SESSION['enemy'] = $enemy;
    $_SESSION['battle_enemy_hp'] = $enemy['hp'];
    $_SESSION['battle_player_hp'] = $player['zycie'];
    $_SESSION['reward_given'] = false;
    $_SESSION['battle_log'] = [];
    $_SESSION['skill_cooldowns'] = [];
    header("Location: battle.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();
$player = $result->fetch_assoc();
if (!$player) die("Player not found.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'basic';

    if ($action === 'use_item' && isset($_POST['item_id'])) {
        $item_id = (int)$_POST['item_id'];
        $stmt = $conn->prepare("SELECT pi.id, i.name, i.effect_type, i.target_attr, i.effect_value, i.duration FROM player_items pi JOIN items i ON pi.item_id = i.id WHERE pi.player_id = ? AND pi.id = ? AND i.type = 'potion' LIMIT 1");
        $stmt->bind_param("ii", $player_id, $item_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $potion = $res->fetch_assoc();
        $stmt->close();

        if ($potion) {
            if ($potion['effect_type'] === 'instant' && $potion['target_attr'] === 'hp') {
                $heal = max(0, (int)$potion['effect_value']);
                $max_hp = (int)$player['zycie'];
                $current_hp = (int)$_SESSION['battle_player_hp'];
                $restored = min($heal, $max_hp - $current_hp);
                $_SESSION['battle_player_hp'] = min($max_hp, $current_hp + $heal);
                $_SESSION['battle_log'][] = "<span class='log-heal'>🧪 You used {$potion['name']} and restored {$restored} HP!</span>";
            } else {
                if (!isset($_SESSION['active_effects'])) {
                    $_SESSION['active_effects'] = [];
                }
                $_SESSION['active_effects'][] = [
                    'name' => $potion['name'],
                    'type' => $potion['effect_type'],
                    'attr' => $potion['target_attr'],
                    'value' => (int)$potion['effect_value'],
                    'turns' => (int)$potion['duration'],
                ];
                $_SESSION['battle_log'][] = "<span class='log-heal'>🧪 You used {$potion['name']}! Effect: +{$potion['effect_value']} {$potion['target_attr']} ({$potion['duration']} turns)</span>";
            }
            $conn->query("DELETE FROM player_items WHERE id = $item_id");
            header("Location: battle.php");
            exit;
        }
    }
}

// Load player
$stmt = $conn->prepare("SELECT * FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();
$player = $result->fetch_assoc();
if (!$player) die("Player not found.");

$enemy_pool = [
    ['name' => 'Training Dummy', 'hp' => 50, 'min_dmg' => 0, 'max_dmg' => 5],
    ['name' => 'Fire Imp', 'hp' => 55, 'min_dmg' => 3, 'max_dmg' => 8],
    ['name' => 'Skeleton Warrior', 'hp' => 70, 'min_dmg' => 5, 'max_dmg' => 12],
    ['name' => 'Goblin Raider', 'hp' => 60, 'min_dmg' => 4, 'max_dmg' => 10],
    ['name' => 'Dark Sorcerer', 'hp' => 45, 'min_dmg' => 7, 'max_dmg' => 15],
];

if (!isset($_SESSION['enemy']) || !isset($_SESSION['battle_enemy_hp'])) {
    $enemy = $enemy_pool[array_rand($enemy_pool)];
    $_SESSION['enemy'] = $enemy;
    $_SESSION['battle_enemy_hp'] = $enemy['hp'];
    $_SESSION['battle_player_hp'] = $player['zycie'];
    $_SESSION['reward_given'] = false;
    $_SESSION['battle_log'] = [];
    $_SESSION['skill_cooldowns'] = [];
} else {
    $enemy = $_SESSION['enemy'];
}

$player_hp = $_SESSION['battle_player_hp'];
$enemy_hp = $_SESSION['battle_enemy_hp'];
// 📦 APPLY BUFFS BEFORE ATTACK
    $bonus_sila = 0;
    $enemy_stunned = false;

    if (isset($_SESSION['active_effects'])) {
        foreach ($_SESSION['active_effects'] as $index => &$effect) {
            if ($effect['type'] === 'buff' && $effect['attr'] === 'sila') {
                $bonus_sila += $effect['value'];
            }
            if ($effect['type'] === 'debuff' && $effect['attr'] === 'stun') {
                $enemy_stunned = true;
            }

            $effect['turns']--;
            if ($effect['turns'] <= 0) unset($_SESSION['active_effects'][$index]);
        }
    }
$log = [];
$cooldowns = $_SESSION['skill_cooldowns'] ?? [];
$now = time();

// Skill definitions from DB
$skills = [];
$basic_skills = [];
$advanced_skills = [];
$unlocked = $conn->query("SELECT s.* FROM skills s JOIN skill_unlocks u ON u.skill_id = s.id WHERE u.unlock_level <= {$player['nivel']}");
while ($row = $unlocked->fetch_assoc()) {
    $skills[$row['id']] = $row;
    if ($row['cooldown'] <= 3) {
        $basic_skills[] = $row;
    } else {
        $advanced_skills[] = $row;
    }
}

// Process Battle Turn
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'basic';
    $time = date("H:i:s");

    $player_damage = rand(10, 20) + floor(($player['sila'] + $bonus_sila) * 0.5);
    $enemy_damage = rand($enemy['min_dmg'], $enemy['max_dmg']);
    $sound = 'attack';

    if (ctype_digit($action) && isset($skills[$action])) {
        $skill = $skills[$action];
        $skill_id = $skill['id'];
        $cd_key = 'skill_' . $skill_id;

        if (!isset($cooldowns[$cd_key]) || $now >= $cooldowns[$cd_key]) {
            $player_damage = $skill['damage'] + floor($player['sila'] * 0.5);
            $player_hp += $skill['healing'];
            $cooldowns[$cd_key] = $now + $skill['cooldown_seconds'];
            $log[] = "<span class='log-player-skill' data-sound='power_strike'>[$time] You used <strong>{$skill['name']}</strong>: +{$skill['damage']} dmg, +{$skill['healing']} HP</span>";
            $sound = $skill['healing'] ? 'heal' : 'power_strike';
        } else {
            $log[] = "<span class='log-enemy-attack'>[$time] Skill on cooldown!</span>";
            $player_damage = 0;
        }
    } elseif ($action === 'basic') {
        $log[] = "<span class='log-player-attack' data-sound='attack'>[$time] You hit {$enemy['name']} for $player_damage!</span>";
    }

    // Enemy hits back
    if ($enemy_hp - $player_damage > 0 && !$enemy_stunned) {
		// Use $bonus_sila in damage calculation:
    $player_damage = rand(10, 20) + floor(($player['sila'] + $bonus_sila) * 0.5);

    // Apply enemy damage only if not stunned
    if (!$enemy_stunned && $enemy_hp - $player_damage > 0) {
        $player_hp -= $enemy_dmg;
    } elseif ($enemy_stunned) {
        $_SESSION['battle_log'][] = "<span class='log-heal'>💫 Enemy stunned and skips turn!</span>";
    }
    $player_hp -= $enemy_damage;
} elseif ($enemy_stunned) {
    $_SESSION['battle_log'][] = "<span class='log-heal'>💫 Enemy stunned and skips turn!</span>";
}

// Apply enemy damage only if not stunned
if (!$enemy_stunned && $enemy_hp - $player_damage > 0) {
    $player_hp -= $enemy_damage;
} elseif ($enemy_stunned) {
    $_SESSION['battle_log'][] = "<span class='log-heal'>💫 Enemy stunned and skips turn!</span>";
}

    $enemy_hp -= $player_damage;

    // Update session
    $_SESSION['battle_player_hp'] = max(0, $player_hp);
    $_SESSION['battle_enemy_hp'] = max(0, $enemy_hp);
    $_SESSION['battle_log'] = array_merge($_SESSION['battle_log'] ?? [], $log);
    $_SESSION['skill_cooldowns'] = $cooldowns;

        // Victory & Rewards
    if ($enemy_hp <= 0 && $player_hp > 0 && !$_SESSION['reward_given']) {
        $xp = rand(10, 25);
        $gold = rand(5, 15);
        $new_exp = $player['exp'] + $xp;
        $new_lvl = $player['nivel'];
        $new_hp = $player['zycie'];
        $new_str = $player['sila'];
        $leveled_up = false;
        $msg = "You defeated {$enemy['name']} and earned $xp XP and $gold gold.";
        $notify = $conn->prepare("INSERT INTO notifications (player_id, message) VALUES (?, ?)");
        $notify->bind_param("is", $player_id, $msg);
        $notify->execute();
		
        while ($new_exp >= $new_lvl * 100) {
        $new_exp -= $new_lvl * 100;
        $new_lvl++;
        $new_hp += 10;
        $new_str += 2;
        $leveled_up = true;
        $log[] = "<span class='log-reward level-up' data-sound='levelup'>🎉 Level up! Now level $new_lvl. +10 HP, +2 Strength!</span>";
        }
        $new_exp_max = $new_lvl * 100;

        $stmt = $conn->prepare("UPDATE gracze SET exp = ?, nivel = ?, exp_max = ?, zloto = zloto + ?, zycie = ?, sila = ? WHERE id = ?");
        $stmt->bind_param("iiiiiii", $new_exp, $new_lvl, $new_exp_max, $gold, $new_hp, $new_str, $player_id);
        $stmt->execute();
        $_SESSION['reward_given'] = true;
		// 🔓 Check for new achievements after rewards
        require_once 'achievements_check.php';
        check_achievements_for_player($player_id);

        // Victory message (added to log, not session directly)
        $log[] = "<span class='log-reward' data-sound='victory'>🏆 Victory! +$xp XP, +$gold gold.</span>";

        // Save the battle log
        $_SESSION['battle_log'] = array_merge($_SESSION['battle_log'] ?? [], $log);

        // Log battle in DB
        $conn->query("INSERT INTO battle_logs (player_id, timestamp) VALUES ($player_id, NOW())");
    }

    header("Location: battle.php");
    exit;
}

$battle_log = $_SESSION['battle_log'] ?? [];
$cooldowns = $_SESSION['skill_cooldowns'] ?? [];
$now = time();
?>

<style>
    .log-player-attack { color: green; }
    .log-player-skill { color: blue; animation: shake 0.3s; }
    .log-heal { color: darkred; animation: glow-green 1s; }
    .log-enemy-attack { color: red; animation: flash-red 0.3s; }
    .log-reward { color: purple; font-weight: bold; }
    .level-up { color: darkgold; animation: glow-yellow 2s infinite; }
    @keyframes flash-red {
        0% { background-color: #ffcccc; }
        100% { background-color: transparent; }
    }
    @keyframes glow-green {
        0% { box-shadow: 0 0 10px lime; }
        100% { box-shadow: none; }
    }
    @keyframes glow-yellow {
        0% { text-shadow: 0 0 5px gold; }
        100% { text-shadow: 0 0 20px orange; }
    }
    @keyframes shake {
        0% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        50% { transform: translateX(5px); }
        100% { transform: translateX(0); }
    }
</style>>

<?php if (!empty($notifications)): ?>
    <div style="background: #fffbcc; border: 1px solid #d6c900; padding: 10px; margin: 10px; border-radius: 5px;">
        <?php foreach ($notifications as $n): ?>
            <div><?= htmlspecialchars($n['message']) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


<!-- Combat View -->
<h2>⚔️ Battle: You vs <?= $enemy['name'] ?></h2>
<p><strong>Your HP:</strong> <?= $player_hp ?> | <strong><?= $enemy['name'] ?> HP:</strong> <?= $enemy_hp ?></p>
<p><strong>Level:</strong> <?= $player['nivel'] ?> | <strong>XP:</strong> <?= $player['exp'] ?>/<?= $player['nivel'] * 100 ?></p>

<?php if ($player_hp > 0 && $enemy_hp > 0): ?>
    <form method="post">
        <button type="submit" name="action" value="basic">Basic Attack</button>
    </form>

    <button onclick="showTab('basic')">Basic Skills</button>
    <button onclick="showTab('advanced')">Advanced Skills</button>

    <div id="skills-basic" style="display:none">
        <form method="post">
        <?php foreach ($basic_skills as $skill): ?>
            <button type="submit" name="action" value="<?= $skill['id'] ?>" <?= isset($cooldowns['skill_' . $skill['id']]) && $cooldowns['skill_' . $skill['id']] > $now ? 'disabled' : '' ?>>
                <?= $skill['name'] ?> (<?= $skill['description'] ?>)
            </button>
        <?php endforeach; ?>
        </form>
    </div>

    <div id="skills-advanced" style="display:none">
        <form method="post">
        <?php foreach ($advanced_skills as $skill): ?>
            <button type="submit" name="action" value="<?= $skill['id'] ?>" <?= isset($cooldowns['skill_' . $skill['id']]) && $cooldowns['skill_' . $skill['id']] > $now ? 'disabled' : '' ?>>
                <?= $skill['name'] ?> (<?= $skill['description'] ?>)
            </button>
        <?php endforeach; ?>
        </form>
    </div>
<?php elseif ($enemy_hp <= 0): ?>
    <h3>🎉 You defeated the <?= $enemy['name'] ?>!</h3>
    <form method="post"><button name="reset">Start New Battle</button></form>
    <a href="index.php">← Back</a>
<?php else: ?>
    <h3>💀 You were defeated.</h3>
    <form method="post"><button name="reset">Try Again</button></form>
    <a href="index.php">← Back</a>
<?php endif; ?>
<?php
$potion_query = $conn->query("SELECT pi.id, i.name, i.image FROM player_items pi JOIN items i ON pi.item_id = i.id WHERE pi.player_id = $player_id AND i.type = 'potion'");
?>

<?php if ($potion_query->num_rows > 0): ?>
    <h4>🧪 Potions</h4>
    <form method="post">
        <?php while ($row = $potion_query->fetch_assoc()): ?>
    <form method="post" style="display: inline-block; margin: 4px;">
        <input type="hidden" name="item_id" value="<?= $row['id'] ?>">
        <button type="submit" name="action" value="use_item">
            <img src="items/<?= htmlspecialchars($row['image']) ?>" width="24"> <?= htmlspecialchars($row['name']) ?>
        </button>
    </form>
    <?php endwhile; ?>
    </form>
<?php endif; ?>

<h3>📜 Battle Log</h3>
<ul id="battle-log">
    <?php foreach (array_reverse($battle_log) as $entry): ?>
        <li><?= $entry ?></li>
    <?php endforeach; ?>
</ul>

// ✅ Add to bottom of combat display (HTML):
<?php if (!empty($_SESSION['active_effects'])): ?>
    <h4>🧪 Active Effects:</h4>
    <ul>
        <?php foreach ($_SESSION['active_effects'] as $effect): ?>
            <li><?= htmlspecialchars($effect['name']) ?> - <?= $effect['value'] ?> <?= $effect['attr'] ?> (<?= $effect['turns'] ?> turns left)</li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<script>
function showTab(tab) {
    document.getElementById('skills-basic').style.display = (tab === 'basic') ? 'block' : 'none';
    document.getElementById('skills-advanced').style.display = (tab === 'advanced') ? 'block' : 'none';
}

const sounds = {
    attack: new Audio("sounds/attack.mp3"),
    power_strike: new Audio("sounds/power_strike.mp3"),
    heal: new Audio("sounds/heal.mp3"),
    victory: new Audio("sounds/victory.mp3"),
    defeat: new Audio("sounds/defeat.mp3"),
    levelup: new Audio("sounds/levelup.mp3")
};

window.addEventListener("load", () => {
    document.querySelectorAll("#battle-log span[data-sound]").forEach(el => {
        const sound = el.dataset.sound;
        if (sounds[sound]) {
            sounds[sound].play().catch(() => {
                // Autoplay blocked — user interaction required.
            });
        }
    });
});
</script>
<br><a href="index.php">← Back to Dashboard</a>