<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "medi EASE");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $consent = isset($_POST['consent']) ? 1 : 0;

    $sql = "INSERT INTO privacy_consent (name, email, consent_given) VALUES ('$name', '$email', $consent)";

    if ($conn->query($sql) === TRUE) {
        $message = "✅ Thank you for accepting our Privacy Policy.";
    } else {
        $message = "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Privacy Policy | Medi EASE</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #dbeeff, #f0faff);
            margin: 0;
            padding: 40px 0;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            padding: 30px 40px;
        }
        h2 {
            text-align: center;
            color: #007acc;
            margin-bottom: 20px;
        }
        .policy-box {
            background: #f4fbff;
            border-left: 6px solid #007acc;
            padding: 20px;
            margin-bottom: 30px;
            max-height: 250px;
            overflow-y: auto;
            line-height: 1.6;
            border-radius: 6px;
        }
        label {
            font-weight: bold;
            margin-top: 20px;
            display: block;
            color: #333;
        }
        input[type="text"], input[type="email"] {
            padding: 10px;
            width: 100%;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
        }
        input[type="checkbox"] {
            margin-right: 8px;
        }
        .checkbox-label {
            display: flex;
            align-items: center;
            margin-top: 15px;
        }
        button {
            background-color: #007acc;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 25px;
            width: 100%;
            transition: background 0.3s ease;
        }
        button:hover {
            background-color: #005b9a;
        }
        .message {
            margin-top: 20px;
            font-weight: bold;
            color: green;
            text-align: center;
        }
        .home-link {
            display: block;
            text-align: center;
            margin-top: 30px;
            text-decoration: none;
            padding: 12px 30px;
            background: #e0e0e0;
            color: #333;
            border-radius: 8px;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
            font-weight: bold;
            transition: background 0.3s;
        }
        .home-link:hover {
            background: #ccc;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Privacy Policy & Consent</h2>

    <div class="policy-box">
        <p><strong>📌 Data Collection:</strong> We collect your personal information only for medical and communication purposes within our healthcare services.</p>
        <p><strong>🔐 Security:</strong> We use encrypted and secured systems to store and manage your data safely.</p>
        <p><strong>🚫 No Third Party Sharing:</strong> We do not sell or share your information with third parties unless required by law.</p>
        <p><strong>📧 Your Rights:</strong> You can request your data deletion or modification by contacting our support team.</p>
        <p><strong>🔁 Updates:</strong> We may update this policy from time to time. Continued use implies acceptance of updates.</p>
    </div>

    <form method="POST" action="">
        <label for="name">Full Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" required>

        <div class="checkbox-label">
            <input type="checkbox" name="consent" id="consent" required>
            <label for="consent">I have read and agree to the Privacy Policy.</label>
        </div>

        <button type="submit">✔ Submit Consent</button>
    </form>

    <?php if ($message): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <a href="header.php" class="home-link">← Back to Home</a>
</div>

</body>
</html>
