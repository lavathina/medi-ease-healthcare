<?php
include 'connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: chatnow.php'); // ✅ after login go to chat
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: #f4f6f9; /* Light gray background */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 30px;
            background: #fff;
            width: 100%;
            max-width: 380px;
        }
        .btn-primary {
            border-radius: 25px;
            background: #2f8f83; /* Teal accent */
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background: #256d65; /* Darker teal on hover */
        }
        h2 {
            font-weight: bold;
            color: #333;
        }
        a {
            color: #2f8f83;
            font-weight: 500;
        }
        a:hover {
            text-decoration: underline;
            color: #256d65;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2 class="text-center mb-4">Welcome Back 👋</h2>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label><b>Username</b></label>
                <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label><b>Password</b></label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <p class="mt-3 text-center">
            Don’t have an account? <a href="register.php">Register here</a>
        </p>
    </div>
</body>
</html>
