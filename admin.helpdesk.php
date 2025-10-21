<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "medi EASE");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$feedback = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize input
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO helpdesk (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        $feedback = "✅ Your request has been received! We'll get back to you shortly.";

        // Email notification to admin
        $to = "lavathina14@gmail.com";  // <-- Replace with your actual email
        $subject_mail = "New Helpdesk Request: " . $subject;
        $body = "You have received a new helpdesk request:\n\n"
              . "Name: $name\n"
              . "Email: $email\n"
              . "Subject: $subject\n"
              . "Message:\n$message\n";
        $headers = "From: no-reply@yourdomain.com";

        // Send the email
        mail($to, $subject_mail, $body, $headers);

    } else {
        $feedback = "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
