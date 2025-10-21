<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "not_logged_in";
    exit;
}

if (isset($_POST['message'])) {
    $msg = trim($_POST['message']);
    $user_id = intval($_SESSION['user_id']);

    if ($msg !== "") {
        $stmt = $conn->prepare("INSERT INTO messages (user_id, message, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("is", $user_id, $msg);

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "db_error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "empty_message";
    }
}
?>
