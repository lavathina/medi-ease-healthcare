<?php
session_start();

// Database connection
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "medi EASE";  // Make sure the space is correct or remove it in your DB

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $password = "";
$email_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // If no errors, check credentials
    if (empty($email_err) && empty($password_err)) {
        $sql = "SELECT id, username, email, password_hash FROM users WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $username, $emailDB, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                // Password is correct
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;

                header("Location: header.php");
                exit;
            } else {
                $login_err = "Invalid email or password.";
            }
        } else {
            $login_err = "Invalid email or password.";
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
    <title>Login - Medi EASE</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; }
        .container { max-width: 400px; margin: 50px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 8px #ccc; }
        h2 { text-align: center; color: #007acc; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 6px; font-weight: bold; }
        input[type="email"], input[type="password"] {
            width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;
            font-size: 1rem;
        }
        .error { color: #e74c3c; font-size: 0.9rem; margin-top: 4px; }
        .login-error { background: #f8d7da; color: #842029; padding: 10px; margin-bottom: 15px; border-radius: 6px; }
        button {
            width: 100%; padding: 12px; background: #007acc; border: none; border-radius: 6px;
            color: white; font-size: 1rem; cursor: pointer;
        }
        button:hover { background: #005fa3; }
        a { color: #007acc; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <?php if (!empty($login_err)) echo '<div class="login-error">' . $login_err . '</div>'; ?>

        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" novalidate>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>" required />
                <?php if ($email_err) echo "<p class='error'>$email_err</p>"; ?>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required />
                <?php if ($password_err) echo "<p class='error'>$password_err</p>"; ?>
            </div>

            <button type="submit">Login</button>
        </form>

        <p style="text-align:center; margin-top: 15px;">
            Don't have an account? <a href="signup.php">Sign up here</a>
        </p>
    </div>
     

  <div class="back-home-link" style="text-align: center; margin-top: 10px;">
    <a href="header.php" style="color: #007acc; text-decoration: none; font-weight: bold;">← Back to Home</a>
  </div>

</body>
</html>
