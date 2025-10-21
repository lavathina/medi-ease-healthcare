<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "medi EASE");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $new_password = $confirm_password = "";
$success = $error = "";

// Form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $new_password = trim($_POST["new_password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // Basic validation
    if (empty($email) || empty($new_password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check if email exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        if (!$stmt) {
            $error = "Failed to prepare SELECT statement.";
        } else {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update password_hash in the database
                $update_stmt = $conn->prepare("UPDATE users SET password_hash = ? WHERE email = ?");
                if (!$update_stmt) {
                    $error = "Failed to prepare UPDATE statement.";
                } else {
                    $update_stmt->bind_param("ss", $hashed_password, $email);
                    if ($update_stmt->execute()) {
                        $success = "Password reset successfully. <a href='login.php'>Login now</a>.";
                    } else {
                        $error = "Failed to update password.";
                    }
                    $update_stmt->close();
                }
            } else {
                $error = "Email not found.";
            }
            $stmt->close();
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - Medi EASE</title>
    <style>
        body {
            font-family: Arial; background: #f0f8ff; display: flex;
            justify-content: center; padding: 40px;
        }
        .box {
            background: white; padding: 30px; border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            max-width: 400px; width: 100%;
        }
        h2 {
            text-align: center; color: #007acc;
        }
        input[type="email"], input[type="password"] {
            width: 100%; padding: 12px; margin: 10px 0;
            border-radius: 8px; border: 2px solid #007acc;
        }
        button {
            width: 100%; padding: 12px; background-color: #007acc;
            color: white; border: none; border-radius: 8px;
            font-weight: bold; cursor: pointer;
        }
        button:hover {
            background-color: #005fa3;
        }
        .error {
            color: red; text-align: center; margin-bottom: 10px;
        }
        .success {
            color: green; text-align: center; margin-bottom: 10px;
        }
        .back-link {
            display: block; text-align: center; margin-top: 15px;
        }
        .back-link a {
            color: #007acc; text-decoration: none;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="box">
    <h2>Reset Your Password</h2>

    <?php if ($error) echo "<div class='error'>$error</div>"; ?>
    <?php if ($success) echo "<div class='success'>$success</div>"; ?>

    <form method="post" action="">
        <input type="email" name="email" placeholder="Enter your registered email" required />
        <input type="password" name="new_password" placeholder="New Password" required />
        <input type="password" name="confirm_password" placeholder="Confirm New Password" required />
        <button type="submit">Reset Password</button>
    </form>

    <div class="back-link">
        <a href="header.php">← Back to Home</a>
    </div>
</div>
</body>
</html>
