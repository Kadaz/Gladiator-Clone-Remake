<style>
body {
  background-image: url('images/boss.jpg');
}
</style>  
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
$notifications = [];
$noti_stmt = $conn->prepare("SELECT id, message FROM notifications WHERE player_id = ? ORDER BY created_at DESC LIMIT 5");
$noti_stmt->bind_param("i", $player_id);
$noti_stmt->execute();
$res = $noti_stmt->get_result();
while ($row = $res->fetch_assoc()) $notifications[] = $row;
$noti_stmt->close();
if (!empty($notifications)) {
    $ids = implode(",", array_column($notifications, 'id'));
    $conn->query("DELETE FROM notifications WHERE id IN ($ids)");
}

$check = $conn->prepare("SELECT COUNT(*) FROM battle_logs WHERE player_id = ? AND zone = 'arena_boss' AND timestamp > NOW() - INTERVAL 1 HOUR");
$check->bind_param("i", $player_id);
$check->execute();
$check->bind_result($count);
$check->fetch();
$check->close();

if ($count >= 10) die("<h3 style='color:red'>⛔ Arena Boss limit (10/hour) reached.</h3><a href='index.php'>← Back</a>");

$stmt = $conn->prepare("SELECT *, is_premium FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$player = $stmt->get_result()->fetch_assoc();
$bonus_dmg = 0;
$bonus_def = 0;
$bonus_xp = 0;
$bonus_gold = 0;
$bonus_crit = 0;

$deity = $conn->query("
    SELECT bonus_type, bonus_value 
    FROM deities d 
    JOIN gracze g ON g.deity_id = d.id 
    WHERE g.id = $player_id
")->fetch_assoc();

if ($deity) {
    switch ($deity['bonus_type']) {
        case 'damage': $bonus_dmg = (int)$deity['bonus_value']; break;
        case 'defense': $bonus_def = (int)$deity['bonus_value']; break;
        case 'xp': $bonus_xp = (int)$deity['bonus_value']; break;
        case 'gold': $bonus_gold = (int)$deity['bonus_value']; break;
        case 'crit_chance': $bonus_crit = (int)$deity['bonus_value']; break;
    }
}

// 🟨 Load deity bonus
$deity = null;
if (!empty($player['deity_id'])) {
    $res = $conn->query("SELECT bonus_type, bonus_value FROM deities WHERE id = {$player['deity_id']} LIMIT 1");
    $deity = $res->fetch_assoc();
}

if (isset($_POST['reset'])) {
    unset($_SESSION['boss_enemy'], $_SESSION['boss_enemy_hp'], $_SESSION['boss_player_hp'], $_SESSION['boss_log'], $_SESSION['boss_cooldowns'], $_SESSION['boss_reward'], $_SESSION['boss_effects']);
    header("Location: arena_boss.php");
    exit;
}

if (!isset($_SESSION['boss_enemy'])) {
    $enemy = $conn->query("SELECT * FROM enemies WHERE is_boss = 1 ORDER BY RAND() LIMIT 1")->fetch_assoc();
    $_SESSION['boss_enemy'] = $enemy;
    $_SESSION['boss_enemy_hp'] = rand($enemy['min_hp'], $enemy['max_hp']);
    $_SESSION['boss_player_hp'] = $player['zycie'];
    $_SESSION['boss_log'] = [];
    $_SESSION['boss_cooldowns'] = [];
    $_SESSION['boss_reward'] = false;
    $_SESSION['boss_effects'] = [];
}

$enemy = $_SESSION['boss_enemy'];
$enemy_hp = $_SESSION['boss_enemy_hp'];
$player_hp = $_SESSION['boss_player_hp'];
$log = [];
$now = time();
$cooldowns = $_SESSION['boss_cooldowns'] ?? [];

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

    // ✅ Potions
    if ($action === 'use_item' && isset($_POST['item_id'])) {
        $item_id = (int)$_POST['item_id'];
        $stmt = $conn->prepare("SELECT pi.id, i.name, i.effect_type, i.target_attr, i.effect_value, i.duration FROM player_items pi JOIN items i ON pi.item_id = i.id WHERE pi.player_id = ? AND pi.id = ? LIMIT 1");
        $stmt->bind_param("ii", $player_id, $item_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();
        $stmt->close();

        if ($item) {
            if ($item['effect_type'] === 'instant' && $item['target_attr'] === 'hp') {
                $heal = max(0, (int)$item['effect_value']);
                $max_hp = $player['zycie'];
                $current_hp = $_SESSION['boss_player_hp'];
                $restored = min($heal, $max_hp - $current_hp);
                $_SESSION['boss_player_hp'] = min($max_hp, $current_hp + $heal);
                $_SESSION['boss_log'][] = "<span class='log-heal'>🧪 You used {$item['name']} and restored {$restored} HP!</span>";
            } else {
                if (!isset($_SESSION['boss_effects'])) $_SESSION['boss_effects'] = [];
                $_SESSION['boss_effects'][] = [
                    'name' => $item['name'],
                    'type' => $item['effect_type'],
                    'attr' => $item['target_attr'],
                    'value' => (int)$item['effect_value'],
                    'turns' => (int)$item['duration'],
                ];
                $_SESSION['boss_log'][] = "<span class='log-heal'>🧪 You used {$item['name']}! Effect: +{$item['effect_value']} {$item['target_attr']} ({$item['duration']} turns)</span>";
            }
            $conn->query("DELETE FROM player_items WHERE id = $item_id");
        }
        header("Location: arena_boss.php");
        exit;
    }

    $bonus_sila = 0;
    $enemy_stunned = false;
	$deity_bonus_sila = 0;
$deity_bonus_msg = '';
if ($deity && $deity['bonus_type'] === 'damage') {
    $deity_bonus_sila = (int)$deity['bonus_value'];
    $deity_bonus_msg = "⚡ Deity Bonus +{$deity_bonus_sila} STR";
}
    if (!empty($_SESSION['boss_effects'])) {
        foreach ($_SESSION['boss_effects'] as $index => &$effect) {
            if ($effect['type'] === 'buff' && $effect['attr'] === 'sila') $bonus_sila += $effect['value'];
            if ($effect['type'] === 'debuff' && $effect['attr'] === 'stun') $enemy_stunned = true;
            $effect['turns']--;
            if ($effect['turns'] <= 0) unset($_SESSION['boss_effects'][$index]);
        }
    }

    $base_sila = $player['sila'] + $bonus_sila + $bonus_dmg;

$player_dmg = rand(10, 20) + floor($base_sila * 0.5);

// 💥 Ares crit
if ($bonus_crit > 0 && rand(1, 100) <= $bonus_crit) {
    $player_dmg *= 2;
    $log[] = "<span class='log-player-skill' style='color:red;'>💥 Ares Critical Hit!</span>";
}
    $enemy_dmg = rand($enemy['min_dmg'], $enemy['max_dmg']);

    if (ctype_digit($action) && isset($skills[$action])) {
        $skill = $skills[$action];
        $cd_key = 'skill_' . $skill['id'];
        if (!isset($cooldowns[$cd_key]) || $now >= $cooldowns[$cd_key]) {
            $player_dmg = $skill['damage'] + floor($player['sila'] * 0.5);
            $player_hp += $skill['healing'];
            $cooldowns[$cd_key] = $now + $skill['cooldown_seconds'];
            $log[] = "<span class='log-player-skill'>[$time] You used <strong>{$skill['name']}</strong> (+{$skill['damage']} dmg, +{$skill['healing']} HP)</span>";
        } else {
            $log[] = "<span class='log-enemy-attack'>[$time] ❌ Skill on cooldown!</span>";
            $player_dmg = 0;
        }
    } elseif ($action === 'basic') {
    $log[] = "<span class='log-player-attack'>[$time] You hit {$enemy['name']} for $player_dmg</span>";

    // ✅ Show Deity bonus message (if exists)
    if (!empty($deity_bonus_msg)) {
        $log[] = "<span class='log-heal' style='color:gold;'>$deity_bonus_msg</span>";
    }
}

    if ($enemy_hp - $player_dmg > 0 && !$enemy_stunned) {
        if ($bonus_def > 0) {
    $reduction = floor($enemy_dmg * ($bonus_def / 100));
    $enemy_dmg -= $reduction;
    $log[] = "<span class='log-heal'>💧 Poseidon reduced damage by $reduction</span>";
}
$player_hp -= $enemy_dmg;
        $log[] = "<span class='log-enemy-attack'>[$time] {$enemy['name']} hits for $enemy_dmg</span>";
    } elseif ($enemy_stunned) {
        $log[] = "<span class='log-heal'>💫 Enemy stunned and skips turn!</span>";
    }

    $enemy_hp -= $player_dmg;

    $_SESSION['boss_player_hp'] = max(0, $player_hp);
    $_SESSION['boss_enemy_hp'] = max(0, $enemy_hp);
    $_SESSION['boss_log'] = array_merge($_SESSION['boss_log'], $log);
    $_SESSION['boss_cooldowns'] = $cooldowns;

    // ✅ Reward
    if ($enemy_hp <= 0 && $player_hp > 0 && empty($_SESSION['boss_reward'])) {
        $xp = $enemy['xp_reward'];
$gold = $enemy['gold_reward'];

if (!empty($player['is_premium'])) {
    $xp = floor($xp * 1.25);
    $log[] = "<span class='log-reward' style='color:gold;'>👑 Premium Bonus: +25% XP</span>";
}

if ($bonus_xp > 0) {
    $xp = floor($xp * (1 + $bonus_xp / 100));
    $log[] = "<span class='log-reward'>📘 Athena Bonus: +$bonus_xp% XP</span>";
}

if ($bonus_gold > 0) {
    $gold = floor($gold * (1 + $bonus_gold / 100));
    $log[] = "<span class='log-reward'>💰 Hades Bonus: +$bonus_gold% gold</span>";
}
		if (!empty($player['is_premium'])) {
           $xp = floor($xp * 1.25); // +25% XP
           $log[] = "<span class='log-reward' style='color:gold;'>👑 Premium Bonus applied: +25% XP</span>";
        }
        $new_exp = $player['exp'] + $xp;
        $new_lvl = $player['nivel'];
        $new_hp = $player['zycie'];
        $new_str = $player['sila'];
        $leveled = false;
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

        $log[] = "<span class='log-reward'>🏆 You earned $xp XP and $gold gold!</span>";
        $_SESSION['boss_log'] = array_merge($_SESSION['boss_log'] ?? [], $log);
        $_SESSION['boss_reward'] = true;

        $conn->query("INSERT INTO battle_logs (player_id, timestamp, zone) VALUES ($player_id, NOW(), 'boss')");

        // INSERT DROP
        $drop_result = $conn->query("SELECT item_id, drop_chance FROM enemy_item_drops WHERE enemy_id = {$enemy['id']}");
        while ($drop = $drop_result->fetch_assoc()) {
            if (rand(1, 10000) <= $drop['drop_chance'] * 100) {
                $item_id = $drop['item_id'];
                $conn->query("INSERT INTO player_items (player_id, item_id, equipped) VALUES ($player_id, $item_id, 0)");
                $_SESSION['boss_log'][] = "<span class='log-reward'>🎁 You found a dropped item!</span>";
            }
        }

        $conn->query("INSERT INTO battle_logs (player_id, timestamp, zone) VALUES ($player_id, NOW(), 'arena_boss')");
    }
	// ✅ Boss defeated counter
    $stmt = $conn->prepare("UPDATE gracze SET boss_defeated = boss_defeated + 1 WHERE id = ?");
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $stmt->close();

    header("Location: arena_boss.php");
    exit;
}

$battle_log = $_SESSION['boss_log'] ?? [];
?>

<?php if (!empty($notifications)): ?>
    <div style="background: #fffbcc; border: 1px solid #d6c900; padding: 10px; margin: 10px; border-radius: 5px;">
        <?php foreach ($notifications as $n): ?>
            <div><?= htmlspecialchars($n['message']) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<h2>🏟️ Arena Boss: <?= htmlspecialchars($enemy['name']) ?></h2>
<img src="images/enemies/<?= htmlspecialchars($enemy['image']) ?>" width="128"><br>
<p><strong>Your HP:</strong> <?= $player_hp ?> | <strong><?= $enemy['name'] ?> HP:</strong> <?= $enemy_hp ?></p>

<?php if ($enemy_hp > 0 && $player_hp > 0): ?>
    <form method="post"><button type="submit" name="action" value="basic">Basic Attack</button></form>

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

    <?php
$potion_query = $conn->query("SELECT pi.id, i.name, i.image FROM player_items pi JOIN items i ON pi.item_id = i.id WHERE pi.player_id = $player_id AND i.type = 'potion'");
if ($potion_query->num_rows > 0): ?>
    <h4>🧪 Potions</h4>
    <?php while ($row = $potion_query->fetch_assoc()): ?>
        <form method="post" style="display: inline-block; margin: 4px;">
            <input type="hidden" name="item_id" value="<?= $row['id'] ?>">
            <button type="submit" name="action" value="use_item">
                <img src="items/<?= htmlspecialchars($row['image']) ?>" width="24"> <?= htmlspecialchars($row['name']) ?>
            </button>
        </form>
    <?php endwhile; ?>
<?php endif; ?>
	
<?php elseif ($enemy_hp <= 0): ?>
    <h3>🎉 You defeated <?= $enemy['name'] ?>!</h3>
    <form method="post"><button name="reset">Start New Boss</button></form>
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

<style>
.log-player-attack { color: green; }
.log-player-skill { color: blue; }
.log-enemy-attack { color: red; }
.log-reward { color: purple; font-weight: bold; }
.level-up { color: gold; font-weight: bold; }
</style>
<br><a href="index.php">← Back to Dashboard</a>