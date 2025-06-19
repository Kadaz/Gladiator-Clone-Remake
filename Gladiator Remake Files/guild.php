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

// Check if player is in a guild
$stmt = $conn->prepare("
    SELECT g.*, gm.role 
    FROM guild_members gm 
    JOIN guilds g ON gm.guild_id = g.id 
    WHERE gm.player_id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$guild_result = $stmt->get_result();
$player_guild = $guild_result->fetch_assoc();
$stmt->close();

// Create Guild
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_guild']) && !$player_guild) {
    $name = trim($_POST['name']);
    $tag = trim($_POST['tag']);
    $desc = trim($_POST['description']);
    $flag = $_POST['flag'] ?? '';

    if ($name && $tag) {
        $stmt = $conn->prepare("INSERT INTO guilds (name, tag, description, flag) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $tag, $desc, $flag);
        if ($stmt->execute()) {
            $guild_id = $stmt->insert_id;
            $stmt->close();

            $stmt = $conn->prepare("INSERT INTO guild_members (guild_id, player_id, role) VALUES (?, ?, 'leader')");
            $stmt->bind_param("ii", $guild_id, $player_id);
            $stmt->execute();
            header("Location: guild.php");
            exit;
        } else {
            echo "<p style='color:red;'>❌ Guild tag already in use.</p>";
        }
    } else {
        echo "<p style='color:red;'>❌ Name and tag required.</p>";
    }
}

// Update Flag (Leader only)
if (isset($_POST['update_flag']) && $player_guild && $player_guild['role'] === 'leader') {
    $new_flag = trim($_POST['flag']);
    $stmt = $conn->prepare("UPDATE guilds SET flag = ? WHERE id = ?");
    $stmt->bind_param("si", $new_flag, $player_guild['id']);
    $stmt->execute();
    $player_guild['flag'] = $new_flag;
    echo "<p style='color:green;'>✅ Guild flag updated.</p>";
}

// Leave Guild
if (isset($_POST['leave']) && $player_guild) {
    $conn->query("DELETE FROM guild_members WHERE player_id = $player_id");
    header("Location: guild.php");
    exit;
}

// Donate Item
if (isset($_POST['donate']) && $player_guild) {
    $donate_id = (int)$_POST['donate_item_id'];
    $stmt = $conn->prepare("SELECT item_id FROM player_items WHERE id = ? AND player_id = ?");
    $stmt->bind_param("ii", $donate_id, $player_id);
    $stmt->execute();
    $stmt->bind_result($item_id);
    if ($stmt->fetch()) {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO guild_storage (guild_id, item_id, added_by) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $player_guild['id'], $item_id, $player_id);
        $stmt->execute();
        $conn->query("DELETE FROM player_items WHERE id = $donate_id");
    }
    header("Location: guild.php");
    exit;
}

// Withdraw Item
if (isset($_POST['withdraw_id']) && $player_guild) {
    $storage_id = (int)$_POST['withdraw_id'];
    $stmt = $conn->prepare("SELECT item_id FROM guild_storage WHERE id = ? AND guild_id = ?");
    $stmt->bind_param("ii", $storage_id, $player_guild['id']);
    $stmt->execute();
    $stmt->bind_result($item_id);
    if ($stmt->fetch()) {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO player_items (player_id, item_id, equipped) VALUES (?, ?, 0)");
        $stmt->bind_param("ii", $player_id, $item_id);
        $stmt->execute();
        $conn->query("DELETE FROM guild_storage WHERE id = $storage_id");
    }
    header("Location: guild.php");
    exit;
}

// Handle join request
if (isset($_POST['submit_join_request']) && !$player_guild) {
    if (isset($_POST['submit_join_request']) && !$player_guild) {
    $target_guild_id = (int)$_POST['request_guild_id'];
    $message = trim($_POST['join_message']);

    // Έλεγχος αν έχει ήδη στείλει αίτημα
    $check = $conn->prepare("SELECT id FROM guild_join_requests WHERE player_id = ? AND guild_id = ? AND status = 'pending'");
    $check->bind_param("ii", $player_id, $target_guild_id);
    $check->execute();
    $result = $check->get_result();
    if ($result->num_rows > 0) {
        echo "<p style='color:gray;'>You already have a pending request for this guild.</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO guild_join_requests (player_id, guild_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $player_id, $target_guild_id, $message);
        if ($stmt->execute()) {
            echo "<p style='color:green;'>✅ Join request sent!</p>";
        } else {
            echo "<p style='color:red;'>❌ Failed to send request.</p>";
        }
    }
}
    $message = trim($_POST['join_message']);

    // Prevent duplicates
    $check = $conn->prepare("SELECT id FROM guild_join_requests WHERE player_id = ? AND guild_id = ? AND status = 'pending'");
    $check->bind_param("ii", $player_id, $target_guild_id);
    $check->execute();
    $exists = $check->get_result()->num_rows > 0;

    if (!$exists) {
        $stmt = $conn->prepare("INSERT INTO guild_join_requests (player_id, guild_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $player_id, $target_guild_id, $message);
        $stmt->execute();
        echo "<p style='color:green;'>✅ Request sent successfully!</p>";
    }
}

// Guild Chat
if (isset($_POST['send_guild_chat']) && $player_guild) {
    $message = trim($_POST['guild_message']);
    if ($message !== '') {
        $stmt = $conn->prepare("INSERT INTO guild_chat (guild_id, player_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $player_guild['id'], $player_id, $message);
        $stmt->execute();
    }
    header("Location: guild.php");
    exit;
}
?>

<h2>🏰 Guild System</h2>

<a href="guild_rankings.php">📈 View Guild Rankings</a>

<?php if (!$player_guild && isset($_GET['id'])): ?>
    <?php
    $guild_id = (int)$_GET['id'];

    // Check if player already has pending request
    $stmt = $conn->prepare("SELECT * FROM guild_join_requests WHERE player_id = ? AND guild_id = ? AND status = 'pending'");
    $stmt->bind_param("ii", $player_id, $guild_id);
    $stmt->execute();
    $has_request = $stmt->get_result()->num_rows > 0;

    if (!$has_request):
    ?>
        <h3>📝 Request to Join This Guild</h3>
        <form method="post">
            <textarea name="join_message" rows="3" cols="40" placeholder="Write a message..."></textarea><br>
            <input type="hidden" name="request_guild_id" value="<?= $guild_id ?>">
            <button type="submit" name="submit_join_request">Send Request</button>
        </form>
    <?php else: ?>
        <p style="color:gray;">You already have a pending request to join this guild.</p>
    <?php endif; ?>
<?php endif; ?>

<?php if ($player_guild): ?>
    <p><strong>Guild:</strong> <?= htmlspecialchars($player_guild['name']) ?> [<?= htmlspecialchars($player_guild['tag']) ?>]</p>
    <?php if (!empty($player_guild['flag'])): ?>
        <p><img src="images/guild/flags/<?= htmlspecialchars($player_guild['flag']) ?>" width="64" alt="Flag"></p>
    <?php endif; ?>
    <p><strong>Your Role:</strong> <?= $player_guild['role'] ?></p>
	
	<?php if ($player_guild['role'] === 'leader'): ?>
    <p><a href="guild_manage.php" style="color: #007bff;">⚙️ Manage Join Requests</a></p>
<?php endif; ?>

    <p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($player_guild['description'])) ?></p>

    <?php if ($player_guild['role'] === 'leader'): ?>
        <form method="post">
            <label>Change Flag:<br>
                <select name="flag" required>
                    <option value="">-- Select Flag --</option>
                    <?php
                    foreach (glob("images/guild/flags/*.png") as $flagFile) {
                        $flagName = basename($flagFile);
                        $selected = $player_guild['flag'] === $flagName ? 'selected' : '';
                        echo "<option value=\"$flagName\" $selected>$flagName</option>";
                    }
                    ?>
                </select>
            </label>
            <button type="submit" name="update_flag">Update Flag</button>
        </form>
    <?php endif; ?>

<?php
    // Check if the guild is already in an alliance
    $stmt = $conn->prepare("SELECT * FROM alliance_members WHERE guild_id = ?");
    $stmt->bind_param("i", $player_guild['id']);
    $stmt->execute();
    $is_in_alliance = $stmt->get_result()->num_rows > 0;

    if (!$is_in_alliance):
    ?>
        <p>
            <a href="alliance_create.php" style="display:inline-block; background:#007bff; color:white; padding:8px 12px; border-radius:6px; text-decoration:none;">
                🛡️ Create Alliance
            </a>
        </p>
    <?php else: ?>
        <p><em>This guild is already part of an alliance.</em></p>
    <?php endif; ?>
    <form method="post">
        <button name="leave" onclick="return confirm('Are you sure you want to leave the guild?')">Leave Guild</button>
    </form>
    <a href="alliance_list.php">📈 View Alliances List</a>
    <a href="alliance_manage.php">📈 View Alliance</a>
	
    <h3>👥 Members:</h3>
    <ul>
        <?php
        $stmt = $conn->prepare("
            SELECT g.login, gm.role 
            FROM guild_members gm 
            JOIN gracze g ON gm.player_id = g.id 
            WHERE gm.guild_id = ?");
        $stmt->bind_param("i", $player_guild['id']);
        $stmt->execute();
        $members = $stmt->get_result();
        while ($m = $members->fetch_assoc()):
        ?>
            <li><?= htmlspecialchars($m['login']) ?> - <?= $m['role'] ?></li>
        <?php endwhile; ?>
    </ul>

<?php else: ?>
    <h3>Join a Guild</h3>
<p>To join a guild, click on its name and send a request.</p>
<ul>
<?php
$result = $conn->query("SELECT id, name, tag FROM guilds ORDER BY name ASC");
while ($row = $result->fetch_assoc()):
?>
    <li>
        <a href="guild.php?id=<?= $row['id'] ?>" style="color:#007bff;">
            <?= htmlspecialchars($row['name']) ?> [<?= htmlspecialchars($row['tag']) ?>]
        </a>
    </li>
<?php endwhile; ?>
</ul>

    <h3>Create a Guild</h3>
    <form method="post">
        <label>Guild Name:<br><input type="text" name="name" maxlength="50" required></label><br><br>
        <label>Guild Tag (max 10 characters):<br><input type="text" name="tag" maxlength="10" required></label><br><br>
        <label>Description:<br><textarea name="description" rows="4" cols="40"></textarea></label><br><br>
        <label>Flag:<br>
            <select name="flag">
                <option value="">None</option>
                <?php
                foreach (glob("images/guild/flags/*.png") as $flag) {
                    $fname = basename($flag);
                    echo "<option value='$fname'>$fname</option>";
                }
                ?>
            </select>
        </label><br><br>
        <button name="create_guild">Create Guild</button>
    </form>
<?php endif; ?>

<?php if ($player_guild): ?>
<h4>💬 Guild Chat</h4>
<div style="max-height: 300px; overflow-y: scroll; border: 1px solid #ccc; background: #f9f9f9; padding: 10px; margin-bottom: 10px;">
<?php
$chat_stmt = $conn->prepare("
    SELECT gc.message, gc.created_at, g.login 
    FROM guild_chat gc 
    JOIN gracze g ON gc.player_id = g.id 
    WHERE gc.guild_id = ? 
    ORDER BY gc.created_at DESC 
    LIMIT 30");
$chat_stmt->bind_param("i", $player_guild['id']);
$chat_stmt->execute();
$messages = $chat_stmt->get_result();

while ($msg = $messages->fetch_assoc()):
    $time = date("H:i", strtotime($msg['created_at']));
    echo "<p><strong>[{$time}] " . htmlspecialchars($msg['login']) . ":</strong> " . htmlspecialchars($msg['message']) . "</p>";
endwhile;
?>
</div>

<form method="post">
    <input type="text" name="guild_message" maxlength="255" style="width: 80%;" placeholder="Type a message..." required>
    <button name="send_guild_chat">Send</button>
</form>

<h5>📦 Guild Storage</h5>
<div style="display: flex; flex-wrap: wrap; gap: 10px;">
<?php
$storage = $conn->prepare("
    SELECT gs.id AS storage_id, i.*, g.login 
    FROM guild_storage gs 
    JOIN items i ON gs.item_id = i.id 
    JOIN gracze g ON gs.added_by = g.id 
    WHERE gs.guild_id = ?
    ORDER BY gs.added_at DESC
");
$storage->bind_param("i", $player_guild['id']);
$storage->execute();
$result = $storage->get_result();

while ($item = $result->fetch_assoc()):
?>
    <div style="border:1px solid #ccc; padding:8px; text-align:center; width:120px; background:#fdfdfd;">
        <img src="items/<?= htmlspecialchars($item['image']) ?>" width="64"><br>
        <?= htmlspecialchars($item['name']) ?><br>
        From: <?= htmlspecialchars($item['login']) ?><br>
        <form method="post" style="margin-top:5px;">
            <input type="hidden" name="withdraw_id" value="<?= $item['storage_id'] ?>">
            <button type="submit">Withdraw</button>
        </form>
    </div>
<?php endwhile; ?>
</div>

<h6>Donate Item to Guild Storage</h6>
<form method="post">
    <select name="donate_item_id" required>
        <?php
        $inventory = $conn->query("
            SELECT pi.id AS player_item_id, i.name 
            FROM player_items pi 
            JOIN items i ON pi.item_id = i.id 
            WHERE pi.player_id = $player_id AND pi.equipped = 0
        ");
        while ($row = $inventory->fetch_assoc()):
        ?>
            <option value="<?= $row['player_item_id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
        <?php endwhile; ?>
    </select>
    <button type="submit" name="donate">Donate</button>
</form>
<?php endif; ?>

<br><a href="index.php">← Back to Dashboard</a>
