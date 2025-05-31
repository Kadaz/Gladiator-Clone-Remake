 <style>
body {
  background-image: url('images/dungeon.jpg');
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
while ($row = $res->fetch_assoc()) {
    $notifications[] = $row;
}
$noti_stmt->close();
if (!empty($notifications)) {
    $ids = implode(",", array_column($notifications, 'id'));
    $conn->query("DELETE FROM notifications WHERE id IN ($ids)");
}

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

$stmt = $conn->prepare("SELECT * FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();
$player = $result->fetch_assoc();

if (!isset($_SESSION['dungeon_enemy'])) {
    $enemy_result = $conn->query("SELECT * FROM enemies WHERE is_boss = 0 ORDER BY RAND() LIMIT 1");
    $enemy = $enemy_result->fetch_assoc();
    $_SESSION['dungeon_enemy'] = $enemy;
    $_SESSION['dungeon_enemy_hp'] = rand($enemy['min_hp'], $enemy['max_hp']);
    $_SESSION['dungeon_player_hp'] = $player['zycie'];
    $_SESSION['dungeon_log'] = [];
    $_SESSION['dungeon_skill_cooldowns'] = [];
    $_SESSION['dungeon_reward'] = false;
    $_SESSION['dungeon_effects'] = [];
}

$enemy = $_SESSION['dungeon_enemy'];
$enemy_hp = $_SESSION['dungeon_enemy_hp'];
$player_hp = $_SESSION['dungeon_player_hp'];
$log = [];
$now = time();
$cooldowns = $_SESSION['dungeon_skill_cooldowns'] ?? [];

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

if (isset($_POST['reset'])) {
    unset($_SESSION['dungeon_enemy']);
    header("Location: dungeon.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    // ✅ Potion Logic with Buffs/Debuffs
    if ($action === 'use_item' && isset($_POST['item_id'])) {
        $item_id = (int)$_POST['item_id'];

        $stmt = $conn->prepare("SELECT pi.id, i.name, i.effect_type, i.target_attr, i.effect_value, i.duration FROM player_items pi JOIN items i ON pi.item_id = i.id WHERE pi.player_id = ? AND pi.id = ? AND i.type IN ('potion', 'consumable') LIMIT 1");
        $stmt->bind_param("ii", $player_id, $item_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $potion = $res->fetch_assoc();
        $stmt->close();

        if ($potion) {
            if ($potion['effect_type'] === 'instant' && $potion['target_attr'] === 'hp') {
                $heal = max(0, (int)$potion['effect_value']);
                $max_hp = (int)$player['zycie'];
                $current_hp = (int)$_SESSION['dungeon_player_hp'];
                $restored = min($heal, $max_hp - $current_hp);
                $_SESSION['dungeon_player_hp'] = min($max_hp, $current_hp + $heal);
                $_SESSION['dungeon_log'][] = "<span class='log-heal'>🧪 You used {$potion['name']} and restored {$restored} HP!</span>";
            } else {
                if (!isset($_SESSION['dungeon_effects'])) {
                    $_SESSION['dungeon_effects'] = [];
                }
                $_SESSION['dungeon_effects'][] = [
                    'name' => $potion['name'],
                    'type' => $potion['effect_type'],
                    'attr' => $potion['target_attr'],
                    'value' => (int)$potion['effect_value'],
                    'turns' => (int)$potion['duration'],
                ];
                $_SESSION['dungeon_log'][] = "<span class='log-heal'>🧪 You used {$potion['name']}! Effect: +{$potion['effect_value']} {$potion['target_attr']} ({$potion['duration']} turns)</span>";
            }
            $conn->query("DELETE FROM player_items WHERE id = $item_id LIMIT 1");
            header("Location: dungeon.php");
            exit;
        }
    }

    $bonus_sila = 0;
    $enemy_stunned = false;
    if (isset($_SESSION['dungeon_effects'])) {
        foreach ($_SESSION['dungeon_effects'] as $index => &$effect) {
            if ($effect['type'] === 'buff' && $effect['attr'] === 'sila') {
                $bonus_sila += $effect['value'];
            }
            if ($effect['type'] === 'debuff' && $effect['attr'] === 'stun') {
                $enemy_stunned = true;
            }
            $effect['turns']--;
            if ($effect['turns'] <= 0) unset($_SESSION['dungeon_effects'][$index]);
        }
    }

    $time = date("H:i:s");
    $player_dmg = rand(10, 20) + floor(($player['sila'] + $bonus_sila) * 0.5);
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

    if ($enemy_hp - $player_dmg > 0 && !$enemy_stunned) {
        $player_hp -= $enemy_dmg;
        $log[] = "<span class='log-enemy-attack'>[$time] {$enemy['name']} hits you for $enemy_dmg.</span>";
    } elseif ($enemy_stunned) {
        $log[] = "<span class='log-heal'>💫 Enemy stunned and skips turn!</span>";
    }

    $enemy_hp -= $player_dmg;

    $_SESSION['dungeon_player_hp'] = max(0, $player_hp);
    $_SESSION['dungeon_enemy_hp'] = max(0, $enemy_hp);
    $_SESSION['dungeon_log'] = array_merge($_SESSION['dungeon_log'] ?? [], $log);
    $_SESSION['dungeon_skill_cooldowns'] = $cooldowns;

    if ($enemy_hp <= 0 && $player_hp > 0 && empty($_SESSION['dungeon_reward'])) {
        $xp = $enemy['xp_reward'];
        $gold = $enemy['gold_reward'];
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
            $log[] = "<span class='log-reward level-up'>🎉 Level up! Now level $new_lvl. +10 HP, +2 Strength!</span>";
        }
        $new_exp_max = $new_lvl * 100;

        $stmt = $conn->prepare("UPDATE gracze SET exp = ?, nivel = ?, exp_max = ?, zloto = zloto + ?, zycie = ?, sila = ? WHERE id = ?");
        $stmt->bind_param("iiiiiii", $new_exp, $new_lvl, $new_exp_max, $gold, $new_hp, $new_str, $player_id);
        $stmt->execute();

        $log[] = "<span class='log-reward'>🏆 You earned $xp XP and $gold gold!</span>";
        $_SESSION['dungeon_log'] = array_merge($_SESSION['dungeon_log'] ?? [], $log);
        $_SESSION['dungeon_reward'] = true;

        $conn->query("INSERT INTO battle_logs (player_id, timestamp, zone) VALUES ($player_id, NOW(), 'dungeon')");
    }

    header("Location: dungeon.php");
    exit;
}


$battle_log = $_SESSION['dungeon_log'] ?? [];
?>

<?php if (!empty($notifications)): ?>
    <div style="background: #fffbcc; border: 1px solid #d6c900; padding: 10px; margin: 10px; border-radius: 5px;">
        <?php foreach ($notifications as $n): ?>
            <div><?= htmlspecialchars($n['message']) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<li><a href='arena_boss.php'>🕸️ Boss Fight 🕸️</a></li>
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

<?php
$potion_result = $conn->query("SELECT pi.id, i.name, i.image FROM player_items pi JOIN items i ON pi.item_id = i.id WHERE pi.player_id = $player_id AND i.type IN ('potion', 'consumable')");
?>

<?php if ($potion_result->num_rows > 0): ?>
    <h4>🧪 Potions</h4>
    <form method="post">
        <?php while ($row = $potion_result->fetch_assoc()): ?>
    <form method="post" style="display:inline-block; margin: 4px;">
        <input type="hidden" name="item_id" value="<?= $row['id'] ?>">
        <button type="submit" name="action" value="use_item">
            <img src="items/<?= htmlspecialchars($row['image']) ?>" width="24">
            <?= htmlspecialchars($row['name']) ?>
        </button>
    </form>
<?php endwhile; ?>
    </form>
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
.log-player-skill { color: blue; animation: shake 0.3s; }
.log-heal { color: orange; }
.log-enemy-attack { color: red; }
.log-reward { color: purple; font-weight: bold; }
.level-up { color: gold; }
</style>
