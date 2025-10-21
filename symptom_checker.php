<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Symptoms Checker | Medi EASE</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #f1f9ff, #e0f7fa);
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #007acc;
            padding: 20px;
            text-align: center;
            color: white;
            font-size: 28px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .container {
            background: #fff;
            max-width: 650px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
        h2 {
            color: #007acc;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .symptom-list {
            text-align: left;
            margin-bottom: 20px;
        }
        .symptom-list label {
            display: block;
            padding: 8px 0;
            font-size: 16px;
            color: #333;
        }
        input[type="checkbox"] {
            margin-right: 10px;
            transform: scale(1.2);
        }
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            transition: 0.3s;
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
            margin-left: 10px;
        }
        .home-btn:hover {
            background-color: #999;
        }
        .result, .ai-suggest {
            margin-top: 30px;
            padding: 15px;
            border-radius: 10px;
        }
        .result {
            background-color: #e6f7ff;
            color: #007a00;
            font-weight: bold;
        }
        .ai-suggest {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }
        .ai-suggest a {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="header">Medi EASE: Symptoms Checker</div>

<div class="container">
    <h2>Select Your Symptoms</h2>

    <form method="post">
        <div class="symptom-list">
            <label><input type="checkbox" name="symptoms[]" value="fever">Fever</label>
            <label><input type="checkbox" name="symptoms[]" value="cough">Cough</label>
            <label><input type="checkbox" name="symptoms[]" value="headache">Headache</label>
            <label><input type="checkbox" name="symptoms[]" value="fatigue">Fatigue</label>
            <label><input type="checkbox" name="symptoms[]" value="nausea">Nausea</label>
            <label><input type="checkbox" name="symptoms[]" value="sore throat">Sore Throat</label>
            <label><input type="checkbox" name="symptoms[]" value="chest pain">Chest Pain</label>
        </div>

        <input type="submit" class="btn submit-btn" value="Check Symptoms">
        <a href="header.php"><button type="button" class="btn home-btn">Back to Home</button></a>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['symptoms'])) {
        $symptoms = $_POST['symptoms'];
        echo "<div class='result'>Selected: " . implode(", ", $symptoms) . "</div>";

        // Diagnosis logic
        $message = "";
        if (in_array("fever", $symptoms) && in_array("cough", $symptoms) && in_array("sore throat", $symptoms)) {
            $message = "❗ Possible Condition: Viral Infection or Flu.";
        } elseif (in_array("headache", $symptoms) && in_array("fatigue", $symptoms)) {
            $message = "❗ Possible Condition: Migraine or Dehydration.";
        } elseif (in_array("nausea", $symptoms) && in_array("fatigue", $symptoms)) {
            $message = "❗ Possible Condition: Food Poisoning or Gastric.";
        } elseif (in_array("chest pain", $symptoms)) {
            $message = "⚠️ URGENT: Chest Pain may indicate a serious condition. Consult a doctor immediately.";
        }

        if (!empty($message)) {
            echo "<div class='result'>$message</div>";
        } else {
            echo "<div class='ai-suggest'>
                🤖 No matching conditions found.<br>
                Please use our <a href='chat.now.php'><strong>Chat Now</strong></a> to consult with a doctor.
            </div>";
        }
    }
    ?>
</div>

</body>
</html>
