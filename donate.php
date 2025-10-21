<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "medi EASE"); // change DB name if needed

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$show_proof = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $donation_type = $conn->real_escape_string($_POST['donation_type']);
    $blood_type = $conn->real_escape_string($_POST['blood_type']);
    $phone = $conn->real_escape_string($_POST['phone']);

    // Insert donor data
    $sql = "INSERT INTO donors (name, email, donation_type, blood_type, phone) VALUES ('$name', '$email', '$donation_type', '$blood_type', '$phone')";

    if ($conn->query($sql) === TRUE) {
        $message = "✅ Registration successful! Please book an appointment to meet the doctor for your checkup.";
        $show_proof = true;
        // You can generate a simple proof number or ID here
        $proof = "DONOR-" . $conn->insert_id;
    } else {
        $message = "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Organ & Blood Donation Registration | Medi EASE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef7fb;
            padding: 30px;
        }
        .container {
            max-width: 600px;
            background: #fff;
            margin: auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        h2 {
            color: #007acc;
            text-align: center;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 20px;
            padding: 12px;
            background: #007acc;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .message-box {
            background: #d0e8ff;
            border-left: 5px solid #007acc;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.5;
            color: #005b8c;
        }
        .success-message {
            color: green;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }
        .proof {
            background: #e0f7e9;
            border: 2px dashed green;
            padding: 15px;
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            color: #2a7f34;
        }
        .home-link {
            display: block;
            text-align: center;
            margin-top: 30px;
            text-decoration: none;
            padding: 12px 25px;
            background: #ccc;
            color: #000;
            border-radius: 8px;
            width: 150px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Organ & Blood Donation Registration</h2>

    <div class="message-box">
        ⚠️ You can only register here. After registration, you will receive a proof message.  
        You must meet the doctor to ensure the condition of your blood and organ.  
        A checkup with the doctor is mandatory. After registration, please book an appointment and meet the doctor.
    </div>

    <form method="POST" action="">
        <label for="name">Full Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" required>

        <label for="donation_type">Donation Type:</label>
        <select name="donation_type" id="donation_type" required>
            <option value="">-- Select Type --</option>
            <option value="Blood">Blood</option>
            <option value="Organ">Organ</option>
        </select>

        <label for="blood_type">Blood Type:</label>
        <select name="blood_type" id="blood_type" required>
            <option value="">-- Select Blood Type --</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
        </select>

        <label for="phone">Phone Number:</label>
        <input type="tel" name="phone" id="phone" required pattern="[0-9]{10,15}" placeholder="e.g. 0123456789">

        <button type="submit">Register</button>
    </form>

    <?php if ($message): ?>
        <p class="success-message"><?= htmlspecialchars($message) ?></p>
        <?php if ($show_proof): ?>
            <div class="proof">
                Your Registration Proof ID: <?= htmlspecialchars($proof) ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <a href="header.php" class="home-link">← Back to Home</a>
</div>

</body>
</html>
