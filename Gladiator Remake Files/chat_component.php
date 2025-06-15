<?php if (!empty($_SESSION['user'])): ?>
    <style>
    /* ίδιο CSS όπως πριν */
    </style>

    <button id="chat-toggle">💬 Chat</button>

    <div id="chat-box">
        <div id="chat-messages">Φόρτωση...</div>
        <div id="chat-footer">
            <input type="text" id="chat-input" placeholder="Γράψε κάτι..." maxlength="200">
            <button id="chat-send">Send</button>
        </div>
    </div>

    <script>
    window.addEventListener('DOMContentLoaded', function () {
        const chatBox = document.getElementById("chat-box");
        const chatToggle = document.getElementById("chat-toggle");
        const chatSend = document.getElementById("chat-send");

        chatToggle.addEventListener("click", () => {
            chatBox.style.display = (chatBox.style.display === "none" || chatBox.style.display === "") ? "block" : "none";
        });

        chatSend.addEventListener("click", sendChatMessage);

        function fetchChatMessages() {
            fetch("chat_backend.php", {
                method: "POST",
                headers: {"Content-Type": "application/x-www-form-urlencoded"},
                body: "action=fetch&channel=global"
            })
            .then(res => res.json())
            .then(data => {
                const chat = document.getElementById("chat-messages");
                chat.innerHTML = "";
                data.forEach(msg => {
                    const div = document.createElement("div");
                    div.className = "message";
                    div.innerHTML = `<b>${msg.login}:</b> ${msg.message}`;
                    chat.appendChild(div);
                });
                chat.scrollTop = chat.scrollHeight;
            });
        }

        function sendChatMessage() {
            const input = document.getElementById("chat-input");
            const message = input.value.trim();
            if (message === "") return;

            fetch("chat_backend.php", {
                method: "POST",
                headers: {"Content-Type": "application/x-www-form-urlencoded"},
                body: "action=send&message=" + encodeURIComponent(message)
            }).then(() => {
                input.value = "";
                fetchChatMessages();
            });
        }

        setInterval(fetchChatMessages, 3000);
        fetchChatMessages();
    });
    </script>
<?php endif; ?>
