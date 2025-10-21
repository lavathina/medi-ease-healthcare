<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment | Medi EASE</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #d4f0ff, #e0f7fa);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
        }
        .card {
            background: #fff;
            max-width: 600px;
            width: 100%;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.6s ease-in-out;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(30px);}
            to {opacity: 1; transform: translateY(0);}
        }
        h2 {
            text-align: center;
            color: #007acc;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
        }
        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 16px;
        }
        textarea {
            resize: vertical;
        }
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            margin-right: 10px;
        }
        .submit-btn {
            background-color: #007acc;
            color: white;
        }
        .submit-btn:hover {
            background-color: #005c99;
        }
        .home-btn {
            background-color: #ccc;
            color: #333;
        }
        .home-btn:hover {
            background-color: #999;
        }
        .status-message {
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
            font-size: 15px;
        }
        .success {
            background-color: #e6ffed;
            border: 1px solid #a1e6b4;
            color: #006600;
        }
        .error {
            background-color: #ffe5e5;
            border: 1px solid #ff9999;
            color: #cc0000;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Book an Appointment</h2>
    <form method="post">
        <div class="form-group">
            <label>Full Name:</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Preferred Date:</label>
            <input type="date" name="date" required>
        </div>
        <div class="form-group">
            <label>Available Time Slots:</label>
            <select name="time" required>
                <option value="">-- Select Time Slot --</option>
                <option>09:00 AM - 09:30 AM</option>
                <option>10:00 AM - 10:30 AM</option>
                <option>11:00 AM - 11:30 AM</option>
                <option>02:00 PM - 02:30 PM</option>
                <option>04:00 PM - 04:30 PM</option>
            </select>
        </div>
        <div class="form-group">
            <label>Reason for Appointment:</label>
            <textarea name="reason" required></textarea>
        </div>

        <button class="btn submit-btn" type="submit">Confirm Booking</button>
        <a href="header.php"><button type="button" class="btn home-btn">Back to Home</button></a>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        $date = $_POST['date'];
        $time = $_POST['time'];
        $reason = htmlspecialchars($_POST['reason']);

        // Check if selected day is Sunday
        $day = date("l", strtotime($date));
        if ($day == "Sunday") {
            echo "<div class='status-message error'>❌ Appointments cannot be booked on Sundays. Please choose another date.</div>";
        } elseif (!empty($name) && !empty($date) && !empty($time) && !empty($reason)) {
            // Dummy proof of appointment
            $bookingID = strtoupper(substr(md5($name.$date.$time), 0, 8));
            echo "<div class='status-message success'>
                ✅ <strong>Appointment Confirmed!</strong><br><br>
                <strong>Name:</strong> $name<br>
                <strong>Date:</strong> $date (" . date("l", strtotime($date)) . ")<br>
                <strong>Time:</strong> $time<br>
                <strong>Reason:</strong> $reason<br><br>
                <strong>Booking ID:</strong> #$bookingID<br>
                Please save this ID as proof of your booking.
            </div>";
        } else {
            echo "<div class='status-message error'>❌ Please complete all fields.</div>";
        }
    }
    ?>
</div>

</body>
</html>
