<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php'); // ✅ after register, go to login page
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: #f4f6f9; /* ✅ clean light gray background */
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
            background: #2f8f83; /* ✅ teal accent */
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background: #256d65; /* darker teal */
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
        <h2 class="text-center mb-4">Create Account ✨</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label><b>Username</b></label>
                <input type="text" name="username" class="form-control" placeholder="Choose a username" required>
            </div>
            <div class="form-group">
                <label><b>Password</b></label>
                <input type="password" name="password" class="form-control" placeholder="Create a password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
        <p class="mt-3 text-center">
            Already have an account? <a href="index.php">Login here</a>
        </p>
    </div>
</body>
</html>
