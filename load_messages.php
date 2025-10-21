<?php
session_start();
include 'connection.php';

$result = $conn->query("SELECT m.message, u.username 
                        FROM messages m 
                        JOIN users u ON m.user_id = u.id 
                        ORDER BY m.id ASC");

while($row = $result->fetch_assoc()) {
    $username = htmlspecialchars($row['username']);
    $message = htmlspecialchars($row['message']);
    echo "<div class='message other-message'><strong>$username:</strong> $message</div>";
}
$conn->close();
?>
