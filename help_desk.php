<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "medi EASE");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$feedback = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $feedback = "❌ Invalid email address.";
    } else {
        $stmt = $conn->prepare("INSERT INTO helpdesk (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        if ($stmt->execute()) {
            $feedback = "✅ Your request has been received! Our team will get back to you shortly.";
        } else {
            $feedback = "❌ Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Helpdesk | Medi EASE</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #f0f4f8);
            margin: 0; padding: 0;
        }
        .container {
            max-width: 700px;
            background: white;
            margin: 60px auto;
            padding: 35px 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        h2 {
            color: #0277bd;
            text-align: center;
            font-size: 28px;
        }
        p.description {
            text-align: center;
            color: #555;
            margin-bottom: 30px;
        }
        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
            color: #333;
        }
        input, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 6px;
            font-size: 15px;
        }
        textarea {
            resize: vertical;
        }
        button {
            width: 100%;
            padding: 14px;
            background: #0288d1;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 10px;
            margin-top: 25px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #0277bd;
        }
        .feedback {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
            color: green;
            font-size: 16px;
        }
        .home-btn {
            display: block;
            margin: 30px auto 0;
            text-align: center;
            padding: 12px 30px;
            background: #00acc1;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            width: fit-content;
            transition: background 0.3s ease;
        }
        .home-btn:hover {
            background: #00838f;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>🛟 Helpdesk Support</h2>
    <p class="description">Need assistance? Submit your issue below and our support team will contact you shortly.</p>

    <form method="POST" action="">
        <label for="name">Full Name:</label>
        <input type="text" name="name" id="name" placeholder="John Doe" required>

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" placeholder="you@example.com" required>

        <label for="subject">Subject:</label>
        <input type="text" name="subject" id="subject" placeholder="e.g. Account access issue" required>

        <label for="message">Your Message:</label>
        <textarea name="message" id="message" rows="5" placeholder="Describe your issue in detail..." required></textarea>

        <button type="submit">🚀 Submit Request</button>
    </form>

    <?php if ($feedback): ?>
        <div class="feedback"><?= htmlspecialchars($feedback) ?></div>
    <?php endif; ?>
   



    <a class="home-btn" href="header.php">← Back to Home</a>
</div>

</body>
</html>
