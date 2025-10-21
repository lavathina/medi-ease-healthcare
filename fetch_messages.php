<?php
session_start();
include 'connection.php';

// Fetch messages with user info
$result = $conn->query("
    SELECT m.message, m.created_at, u.username 
    FROM messages m
    JOIN users u ON m.user_id = u.id
    ORDER BY m.created_at ASC
");

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

header('Content-Type: application/json');
echo json_encode($messages);
?>
