<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "No session found";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message'])) {
    $user_id = $_SESSION['user_id'];
    $message = trim($_POST['message']);

    $stmt = $conn->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $message);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
