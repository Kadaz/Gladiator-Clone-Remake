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

// Load player data
$stmt = $conn->prepare("SELECT * FROM gracze WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();
$player = $result->fetch_assoc();

if (!$player) {
    die("Player not found.");
}

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
} else {
    $enemy = $_SESSION['enemy'];
}

if (!isset($_SESSION['battle_player_hp'])) {
    $_SESSION['battle_player_hp'] = $player['zycie'] ?? 100;
}
$player_hp = $_SESSION['battle_player_hp'];

if (!isset($_SESSION['battle_enemy_hp'])) {
    $_SESSION['battle_enemy_hp'] = $enemy['hp'] ?? 50;
}
$enemy_hp = $_SESSION['battle_enemy_hp'];

$log = [];
$cooldowns = $_SESSION['skill_cooldowns'] ?? [];
$now = time();

if (isset($_POST['reset'])) {
    $enemy = $enemy_pool[array_rand($enemy_pool)];
    $_SESSION['battle_player_hp'] = $player['zycie'] ?? 100;
    $_SESSION['battle_enemy_hp'] = $enemy['hp'];
    $_SESSION['battle_log'] = [];
    $_SESSION['skill_cooldowns'] = [];
    $_SESSION['reward_given'] = false;
    $_SESSION['enemy'] = $enemy;

    header("Location: battle.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'basic';
    $time = date("H:i:s");

    $player_damage = rand(10, 20) + floor($player['sila'] * 0.5);
    $enemy_damage = rand($enemy['min_dmg'], $enemy['max_dmg']);

    if ($action === 'power_strike' && (!isset($cooldowns['power_strike']) || $now >= $cooldowns['power_strike'])) {
        $player_damage += 10;
        $cooldowns['power_strike'] = $now + 10;
        $log[] = "<span class='log-player-skill'>[$time] You used <strong>Power Strike</strong> and dealt $player_damage damage! ({$enemy['name']} HP: " . max($enemy_hp - $player_damage, 0) . ")</span>";
    } elseif ($action === 'first_aid' && (!isset($cooldowns['first_aid']) || $now >= $cooldowns['first_aid'])) {
        $heal = 10;
        $player_hp += $heal;
        $cooldowns['first_aid'] = $now + 15;
        $log[] = "<span class='log-heal'>[$time] You used <strong>First Aid</strong> and healed $heal HP! (Your HP: $player_hp)</span>";
        $player_damage = 0;
    } else {
        if ($action !== 'first_aid') {
            $log[] = "<span class='log-player-attack'>[$time] You deal $player_damage damage to the {$enemy['name']} (HP left: " . max($enemy_hp - $player_damage, 0) . ")</span>";
        }
    }

    if ($enemy_hp - $player_damage > 0 && $action !== 'first_aid') {
        $player_hp -= $enemy_damage;
        $log[] = "<span class='log-enemy-attack'>[$time] {$enemy['name']} deals $enemy_damage damage to you (HP left: $player_hp)</span>";
    }

    $enemy_hp -= $player_damage;

    // Save HP and log back to session
    $_SESSION['battle_player_hp'] = max($player_hp, 0);
    $_SESSION['battle_enemy_hp'] = max($enemy_hp, 0);
    $_SESSION['battle_log'] = array_merge($_SESSION['battle_log'] ?? [], $log);
    $_SESSION['skill_cooldowns'] = $cooldowns;

    // === REWARDS & LEVEL-UP ===
    if ($enemy_hp <= 0 && $player_hp > 0) {
        if (!isset($_SESSION['reward_given']) || $_SESSION['reward_given'] === false) {
            $xp_reward = rand(10, 25);
            $gold_reward = rand(5, 15);

            $new_exp = $player['exp'] + $xp_reward;
            $new_gold = $player['zloto'] + $gold_reward;
            $new_level = $player['nivel'];
            $new_hp = $player['zycie'];
            $new_str = $player['sila'];
            $new_ep = $player['exp_max'];
            $leveled_up = false;

            // Level-up check loop
            while ($new_exp >= $new_level * 100) {
                $new_exp -= $new_level * 100;
                $new_level++;
                $new_hp += 10;
                $new_str += 2;
                $leveled_up = true;
                $log[] = "<span class='log-reward'>🎉 You leveled up to <strong>Level $new_level</strong>! HP +10, Strength +2!</span>";
            }

            // Update database
            $stmt = $conn->prepare("UPDATE gracze SET exp = ?, exp_max = nivel * 100, zloto = ?, nivel = ?, zycie = ?, sila = ? WHERE id = ?");
            $stmt->bind_param("iiiiii", $new_exp, $new_gold, $new_level, $new_hp, $new_str, $player_id);
            $stmt->execute();

            // Update session player data for next battle
            $player['exp'] = $new_exp;
            $player['zloto'] = $new_gold;
            $player['nivel'] = $new_level;
            $player['zycie'] = $new_hp;
            $player['sila'] = $new_str;
            $player['exp_max'] = $new_ep;
            $_SESSION['reward_given'] = true;
            $_SESSION['battle_log'][] = "<span class='log-reward'>You earned $xp_reward XP and $gold_reward gold!</span>";

            if ($leveled_up) {
                $_SESSION['battle_player_hp'] = $new_hp;
                $_SESSION['battle_log'][] = "<span class='log-heal'>Your level up to $new_level</span>";
            }
        }
    }

    header("Location: battle.php");
    exit;
}

$battle_log = $_SESSION['battle_log'] ?? [];
$cooldowns = $_SESSION['skill_cooldowns'] ?? [];
$now = time();

function cooldownText($skill, $cooldowns, $now) {
    return isset($cooldowns[$skill]) && $cooldowns[$skill] > $now
        ? " (Cooldown: " . ($cooldowns[$skill] - $now) . "s)"
        : "";
}
function isOnCooldown($skill, $cooldowns, $now) {
    return isset($cooldowns[$skill]) && $cooldowns[$skill] > $now;
}
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

<h2>⚔️ Battle: You vs <?= htmlspecialchars($enemy['name']) ?></h2>
<p>
    <strong>Your HP:</strong> <?= htmlspecialchars($_SESSION['battle_player_hp']) ?> |
    <strong><?= htmlspecialchars($enemy['name']) ?> HP:</strong> <?= htmlspecialchars($_SESSION['battle_enemy_hp']) ?><br>
    <strong>Level:</strong> <?= $player['nivel'] ?> |
    <strong>XP:</strong> <?= $player['exp'] ?>/<?= $player['nivel'] * 100 ?>
</p>

<?php if ($_SESSION['battle_enemy_hp'] > 0 && $_SESSION['battle_player_hp'] > 0): ?>
    <form method="post">
        <button type="submit" name="action" value="basic">Basic Attack</button>
        <h3>Skills</h3>
        <button type="submit" name="action" value="power_strike" <?= isOnCooldown('power_strike', $cooldowns, $now) ? 'disabled' : '' ?>>
            Power Strike<?= cooldownText('power_strike', $cooldowns, $now) ?>
        </button>
        <p>Deals extra 10 damage.</p>

        <button type="submit" name="action" value="first_aid" <?= isOnCooldown('first_aid', $cooldowns, $now) ? 'disabled' : '' ?>>
            First Aid<?= cooldownText('first_aid', $cooldowns, $now) ?>
        </button>
        <p>Heals 10 HP.</p>
    </form>
<?php elseif ($_SESSION['battle_enemy_hp'] <= 0): ?>
    <h3>🎉 You defeated the <?= htmlspecialchars($enemy['name']) ?>!</h3>
    <form method="post">
        <button type="submit" name="reset">Start New Battle</button>
    </form>
    <br><a href="index.php">← Back to Dashboard</a>
<?php elseif ($_SESSION['battle_player_hp'] <= 0): ?>
    <h3>💀 You were defeated by the <?= htmlspecialchars($enemy['name']) ?>.</h3>
    <form method="post">
        <button type="submit" name="reset">Try Again</button>
    </form>
    <br><a href="index.php">← Back to Dashboard</a>
<?php endif; ?>

<h3>📜 Battle Log</h3>
<ul>
    <?php foreach (array_reverse($battle_log) as $entry): ?>
        <li><?= $entry ?></li>
    <?php endforeach; ?>
</ul>
<br>
<a href="index.php">← Back to Dashboard</a>

<script>
const sounds = {
    attack: new Audio("sounds/attack.mp3"),
    power_strike: new Audio("sounds/power_strike.mp3"),
    heal: new Audio("sounds/heal.mp3"),
    victory: new Audio("sounds/victory.mp3"),
    defeat: new Audio("sounds/defeat.mp3"),
    levelup: new Audio("sounds/levelup.mp3")
};

window.addEventListener("load", () => {
    document.querySelectorAll("#battle-log li span[data-sound]").forEach(span => {
        const sound = span.getAttribute("data-sound");
        if (sounds[sound]) sounds[sound].play();
    });
});
</script>