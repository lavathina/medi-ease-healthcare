const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const axios = require('axios');
const app = express();
const PORT = 3000;

// Replace with your Telegram Bot Token
const TELEGRAM_TOKEN = '8391775934:AAH4rmbLF1NpAMa4PC23MgCM3QFjXzZbEd0';

// Replace with your latest Telegram user ID (you can store dynamically too)
let latestChatId = 1140058358;

// Middleware
app.use(bodyParser.json());
app.use(express.static('public'));

// MySQL connection
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',      // or your DB password
    database: 'medi EASE'
});

db.connect(err => {
    if (err) throw err;
    console.log('MySQL Connected');
});

// Create messages table if not exists
const createTableQuery = `
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id VARCHAR(100),
    sender_name VARCHAR(100),
    message TEXT,
    from_who VARCHAR(10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)`;
db.query(createTableQuery, err => {
    if (err) throw err;
});

// 1. Telegram Webhook Receiver
app.post('/webhook', (req, res) => {
    const msg = req.body.message;
    if (!msg) return res.sendStatus(200);

    const chatId = msg.chat.id;
    const name = msg.chat.first_name || 'User';
    const messageText = msg.text;

    latestChatId = chatId;

    const sql = 'INSERT INTO messages (sender_id, sender_name, message, from_who) VALUES (?, ?, ?, ?)';
    db.query(sql, [chatId, name, messageText, 'user'], err => {
        if (err) console.error(err);
        else console.log('Message saved from Telegram');
    });

    res.sendStatus(200);
});

// 2. Return all chat messages
app.get('/messages', (req, res) => {
    db.query('SELECT * FROM messages ORDER BY created_at ASC', (err, results) => {
        if (err) return res.status(500).send(err);
        res.json(results);
    });
});

// 3. Receive message from website and send to Telegram
app.post('/send', (req, res) => {
    const message = req.body.message;

    if (!latestChatId) return res.status(400).send('No Telegram user yet');

    const telegramURL = https://api.telegram.org/bot${8391775934:AAH4rmbLF1NpAMa4PC23MgCM3QFjXzZbEd0}/sendMessage;
    axios.post(telegramURL, {
        chat_id: latestChatId,
        text: message
    }).then(() => {
        const sql = 'INSERT INTO messages (sender_id, sender_name, message, from_who) VALUES (?, ?, ?, ?)';
        db.query(sql, [latestChatId, 'Admin', message, 'admin']);
        res.sendStatus(200);
    }).catch(err => {
        console.error(err);
        res.status(500).send('Failed to send');
    });
});

app.listen(PORT, () => console.log(Server running on http://localhost:${PORT}));