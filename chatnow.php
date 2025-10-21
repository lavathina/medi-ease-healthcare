<?php
session_start();

// Redirect if user not logged in
if (!isset($_SESSION['username'])) {
    header("Location: register.php"); // your login page
    exit();
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Doctor & Patient Chat</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #3d6081a9;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    height: 100vh;
}

header {
    background-color: #2d628dea;
    color: white;
    padding: 15px;
    text-align: center;
    font-size: 20px;
    font-weight: bold;
}

.online-users {
    padding: 10px;
    background: #f1f1f1;
    text-align: center;
    font-size: 14px;
}

.chat-container {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    max-width: 700px;
    margin: auto;
    width: 100%;
    background: white;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(185, 142, 142, 0.87);
    overflow: hidden;
}

.messages {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    background-color: rgba(160, 199, 211, 1);
}

.message {
    margin: 8px 0;
    padding: 10px 15px;
    border-radius: 18px;
    max-width: 70%;
    font-size: 15px;
    word-wrap: break-word;
    display: inline-block;
    clear: both;
    position: relative;
    line-height: 1.4;
}

.message.user {
    background: linear-gradient(135deg, #276f8bff, #3ba395);
    color: white;
    float: right;
    border-bottom-right-radius: 4px;
}

.message.other {
    background: #e0e0e0;
    color: #a56fd8ff;
    float: left;
    border-bottom-left-radius: 4px;
}

.username {
    font-size: 12px;
    font-weight: bold;
    margin-bottom: 3px;
    display: block;
}

.chat-input {
    display: flex;
    border-top: 1px solid #ddd;
    background: #fff;
}

.chat-input input {
    flex: 1;
    padding: 14px;
    border: none;
    font-size: 15px;
    outline: none;
}

.chat-input button {
    background-color: #2f7392ff;
    color: white;
    border: none;
    padding: 14px 20px;
    font-size: 15px;
    cursor: pointer;
    transition: background 0.3s;
}

.chat-input button:hover {
    background-color: #446c7eff;
}

.back-home {
    text-align: center;
    margin: 20px 0;
}

.back-home a {
    display: inline-block;
    text-decoration: none;
    background: linear-gradient(135deg, #25627aff, #277086ff);
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: bold;
    transition: all 0.3s ease;
    box-shadow: 0px 3px 6px rgba(65, 196, 141, 0.9);
}

.back-home a:hover {
    background: linear-gradient(135deg, #1e515eff, #2f8f83);
    box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
    transform: translateY(-2px);
}
</style>
</head>
<body>

<header>Doctor & Patient Chat</header>

<div class="online-users">
    <strong>Online Users:</strong> <span id="users-list"></span>
</div>

<div class="chat-container">
    <div id="chat-box" class="messages"></div>
    <div class="chat-input">
        <input type="text" id="message" placeholder="Type a message...">
        <button onclick="sendMessage()">Send</button>
    </div>
</div>

<div class="back-home">
    <a href="header.php" title="Back to Home">← Back to Home</a>
</div>

<!-- Socket.IO client -->
<!-- Socket.IO client -->
<script src="https://cdn.socket.io/4.6.1/socket.io.min.js"></script>
<script>
    const username = "<?php echo htmlspecialchars($username, ENT_QUOTES); ?>";
    const socket = io("http://localhost:3000");

    function sendMessage() {
        let msg = document.getElementById("message").value.trim();
        if (msg === "") return;

        socket.emit("chat message", { username: username, text: msg });
        document.getElementById("message").value = "";
    }

    // Show incoming messages
    socket.on("chat message", function(msg) {
        let chatBox = document.getElementById("chat-box");

        let div = document.createElement("div");
        div.className = "message " + (msg.username === username ? "user" : "other");
        div.dataset.id = msg.id; // ✅ store ID

        if (msg.username !== username) {
            let uname = document.createElement("span");
            uname.className = "username";
            uname.innerText = msg.username;
            div.appendChild(uname);
        }

        let span = document.createElement("span");
        span.innerText = msg.text;
        div.appendChild(span);

        // Add delete button only for my messages
        if (msg.username === username) {
            let delBtn = document.createElement("button");
            delBtn.innerText = "🗑";
            delBtn.style.marginLeft = "10px";
            delBtn.onclick = function() {
                socket.emit("delete message", msg.id); // send ID
                div.remove();
            };
            div.appendChild(delBtn);
        }

        chatBox.appendChild(div);
        chatBox.scrollTop = chatBox.scrollHeight;
    });

    // ✅ Delete by ID everywhere
    socket.on("delete message", function(id) {
        let msgDiv = document.querySelector(`[data-id='${id}']`);
        if (msgDiv) msgDiv.remove();
    });
</script>




</body>
</html>
