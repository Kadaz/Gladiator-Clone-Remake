<?php
session_start();
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');
if (!isset($_SESSION['id'])) {
    echo "<p style='color:red;'>⚠️ Not Connect. Plz login to chat.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <title>Public Chat</title>
  <style>
    body {
      background: #f4f4f4;
      font-family: Arial, sans-serif;
    }

    #chatbox {
      border: 2px solid #333;
      width: 400px;
      margin: 20px auto;
      padding: 10px;
      background: #fff;
      color: #000;
      box-shadow: 0 0 10px #aaa;
      border-radius: 8px;
    }

    #messages {
      height: 200px;
      overflow-y: auto;
      background: #f0f0f0;
      padding: 10px;
      margin-bottom: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
    }

    #chat_input {
      width: calc(100% - 70px);
      padding: 5px;
      font-size: 14px;
    }

    #send_btn {
      width: 60px;
      padding: 5px;
      background-color: #007bff;
      color: white;
      border: none;
      cursor: pointer;
    }

    #send_btn:hover {
      background-color: #0056b3;
    }

    .message {
      margin-bottom: 5px;
    }

    .message b {
      color: #007bff;
    }
  </style>
</head>
<body>

<div id="chatbox">
  <div id="messages">Loading messages...</div>
  <input type="text" id="chat_input" placeholder="Write..." maxlength="200">
  <button id="send_btn">Send</button>
</div>

<script>
function fetchMessages() {
  fetch('chat_backend.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: 'action=fetch&channel=global'
  })
  .then(res => res.json())
  .then(data => {
    const box = document.getElementById('messages');
    box.innerHTML = '';
    data.forEach(msg => {
      const div = document.createElement('div');
      div.className = 'message';
      div.innerHTML = `<b>${msg.login}:</b> ${msg.message}`;
      box.appendChild(div);
    });
    box.scrollTop = box.scrollHeight;
  })
  .catch(err => {
    document.getElementById('messages').innerText = '⚠️ Error Loading chat.';
    console.error(err);
  });
}

function sendMessage() {
  const input = document.getElementById('chat_input');
  const message = input.value.trim();
  if (message.length === 0) return;

  fetch('chat_backend.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: 'action=send&message=' + encodeURIComponent(message)
  })
  .then(() => {
    input.value = '';
    fetchMessages();
  })
  .catch(err => {
    alert("⚠️ Error Send message.");
    console.error(err);
  });
}

document.getElementById('send_btn').addEventListener('click', sendMessage);
setInterval(fetchMessages, 3000);
fetchMessages();
</script>

</body>
</html>
