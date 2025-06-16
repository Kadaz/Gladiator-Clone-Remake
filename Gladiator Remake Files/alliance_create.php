<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    header("Location: logowanie.php");
    exit;
}

$player_id = $_SESSION['id'];

// Find The Leader's Guild
$stmt = $conn->prepare("
    SELECT gm.guild_id 
    FROM guild_members gm 
    WHERE gm.player_id = ? AND gm.role = 'leader'
");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p>You must be the guild leader to create alliance.</p>";
    exit;
}

$guild = $result->fetch_assoc();
$guild_id = $guild['guild_id'];

// Find If You Are Already On An Alliance
$stmt = $conn->prepare("
    SELECT * FROM alliance_members WHERE guild_id = ?
");
$stmt->bind_param("i", $guild_id);
$stmt->execute();
$already_in_alliance = $stmt->get_result()->num_rows > 0;

if ($already_in_alliance) {
    echo "<p>The guild already has alliance.</p>";
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $tag = strtoupper(trim($_POST['tag']));
    $description = trim($_POST['description']);
    $flag = $_POST['flag'];

    if ($name === '' || $tag === '' || $flag === '') {
        $message = "All fields are required..";
    } else {
        // Create alliance
        $stmt = $conn->prepare("INSERT INTO alliances (name, tag, description, flag) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $tag, $description, $flag);
        $stmt->execute();
        $alliance_id = $stmt->insert_id;

        // Connect guild with alliance
        $stmt = $conn->prepare("INSERT INTO alliance_members (alliance_id, guild_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $alliance_id, $guild_id);
        $stmt->execute();

        header("Location: alliance_view.php?id=" . $alliance_id);
        exit;
    }
}

// Load Flags
$flag_images = glob("images/alliances/*.png");
?>

<h2>🏛 Create Alliance</h2>

<?php if ($message): ?>
    <p style="color:red;"><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<form method="post">
    <label>Alliance Name:</label><br>
    <input type="text" name="name" maxlength="50"><br><br>

    <label>Tag (3-5 letters):</label><br>
    <input type="text" name="tag" maxlength="10"><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="4" cols="40"></textarea><br><br>

    <label>Choose Flag:</label><br>
    <select name="flag">
        <option value="">-- Choose --</option>
        <?php foreach ($flag_images as $img): 
            $file = basename($img);
        ?>
            <option value="<?php echo $file; ?>"><?php echo $file; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">🔥 Create Alliance</button>
</form>
