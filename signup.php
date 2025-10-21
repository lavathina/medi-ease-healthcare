<?php
// signup.php

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "medi EASE");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Email already registered.";
        } else {
            // Hash the password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Insert into database using correct column name
            $stmt_insert = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
            $stmt_insert->bind_param("sss", $username, $email, $password_hash);

            if ($stmt_insert->execute()) {
                $success = "Registration successful! You can now <a href='login.php'>login</a>.";
            } else {
                $error = "Error: Could not register. Please try again.";
            }
            $stmt_insert->close();
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Signup - Medi EASE</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background: #f0f8ff;
    padding: 40px;
    display: flex;
    justify-content: center;
  }
  .signup-container {
    background: white;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    max-width: 400px;
    width: 100%;
  }
  h2 {
    color: #007acc;
    margin-bottom: 20px;
    text-align: center;
  }
  input[type="text"], input[type="email"], input[type="password"] {
    width: 100%;
    padding: 12px 10px;
    margin: 12px 0 20px 0;
    border: 2px solid #007acc;
    border-radius: 8px;
    font-size: 1rem;
  }
  button {
    width: 100%;
    padding: 12px;
    background-color: #007acc;
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
  }
  button:hover {
    background-color: #005fa3;
  }
  .error {
    color: red;
    margin-bottom: 15px;
    text-align: center;
  }
  .success {
    color: green;
    margin-bottom: 15px;
    text-align: center;
  }
  .login-link {
    text-align: center;
    margin-top: 15px;
  }
  .login-link a {
    color: #007acc;
    text-decoration: none;
  }
  .login-link a:hover {
    text-decoration: underline;
  }
</style>
</head>
<body>

<div class="signup-container">
  <h2>Create Account</h2>

  <?php if ($error): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  <?php if ($success): ?>
    <div class="success"><?= $success ?></div>
  <?php endif; ?>

  <form method="post" action="">
    <input type="text" name="username" placeholder="Username" required />
    <input type="email" name="email" placeholder="Email address" required />
    <input type="password" name="password" placeholder="Password" required />
    <input type="password" name="confirm_password" placeholder="Confirm Password" required />
    <button type="submit">Sign Up</button>
  </form>

  <div class="login-link">
    Already have an account? <a href="login.php">Login here</a>
      <div class="back-home-link" style="text-align: center; margin-top: 10px;">
    <a href="header.php" style="color: #007acc; text-decoration: none; font-weight: bold;">← Back to Home</a>
  </div>
    

 

  </div>
</div>

</body>
</html>
