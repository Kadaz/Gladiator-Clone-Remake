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

// Βρες guild_id και alliance_id
$guild_id = null;
$alliance_id = null;

$stmt = $conn->prepare("SELECT guild_id FROM guild_members WHERE player_id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $guild_id = $row['guild_id'];

    $stmt2 = $conn->prepare("SELECT alliance_id FROM alliance_members WHERE guild_id = ?");
    $stmt2->bind_param("i", $guild_id);
    $stmt2->execute();
    $res2 = $stmt2->get_result();
    if ($row2 = $res2->fetch_assoc()) {
        $alliance_id = $row2['alliance_id'];
    }
}

$available_channels = ['global'];
if ($guild_id) $available_channels[] = 'guild';
if ($alliance_id) $available_channels[] = 'alliance';
?>

<h2>💬 Chat</h2>
<label>Κανάλι:</label>
<select id="chat-channel">
<?php foreach ($available_channels as $ch): ?>
    <option value="<?= $ch ?>"><?= ucfirst($ch) ?></option>
<?php endforeach; ?>
</select>

<div id="chat-messages" style="height:300px; overflow-y:auto; border:1px solid #ccc; margin-top:10px; padding:5px;">Φόρτωση...</div>

<input type="text" id="chat-input" placeholder="Γράψε μήνυμα..." maxlength="200" style="width:75%;">
<button onclick="sendMessage()">Send</button>

<script>
let currentChannel = document.getElementById("chat-channel").value;

document.getElementById("chat-channel").addEventListener("change", function() {
    currentChannel = this.value;
    fetchMessages();
});

function fetchMessages() {
    fetch("chat_backend.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "action=fetch&channel=" + encodeURIComponent(currentChannel)
    })
    .then(res => res.json())
    .then(data => {
        const box = document.getElementById("chat-messages");
        box.innerHTML = "";
        data.forEach(msg => {
            const line = document.createElement("div");
            line.innerHTML = "<b>" + msg.login + ":</b> " + msg.message;
            box.appendChild(line);
        });
        box.scrollTop = box.scrollHeight;
    });
}

function sendMessage() {
    const input = document.getElementById("chat-input");
    const msg = input.value.trim();
    if (msg === "") return;

    fetch("chat_backend.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "action=send&message=" + encodeURIComponent(msg) + "&channel=" + encodeURIComponent(currentChannel)
    }).then(() => {
        input.value = "";
        fetchMessages();
    });
}

setInterval(fetchMessages, 3000);
fetchMessages();
</script>
