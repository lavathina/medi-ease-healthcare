<?php
$conn = new mysqli("localhost", "root", "", "medi EASE");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM about_us LIMIT 1";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us | Medi EASE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset & Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #eaf6ff, #f2fcff);
            padding: 40px 20px;
            color: #333;
        }

        /* Container */
        .container {
            max-width: 1000px;
            margin: auto;
            background: #ffffff;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            animation: fadeIn 1s ease-in-out;
        }

        /* Headings */
        .title {
            text-align: center;
            font-size: 36px;
            color: #007acc;
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 24px;
            margin-bottom: 10px;
            color: #006699;
            border-left: 5px solid #007acc;
            padding-left: 15px;
        }

        /* Paragraphs */
        p {
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 25px;
            color: #444;
        }

        /* Button */
        .home-link {
            display: inline-block;
            text-align: center;
            margin-top: 40px;
            padding: 14px 35px;
            background: #007acc;
            color: white;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,122,204,0.3);
        }
        .home-link:hover {
            background: #005f99;
            transform: scale(1.05);
        }

        /* Section Styling */
        .section {
            margin-bottom: 40px;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 30px 20px;
            }
            .title {
                font-size: 28px;
            }
            .section-title {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="title"><?= htmlspecialchars($data['heading']) ?></h1>

    <div class="section">
        <h2 class="section-title">About Us</h2>
        <p><?= nl2br(htmlspecialchars($data['content'])) ?></p>
    </div>

    <div class="section">
        <h2 class="section-title">Our Mission</h2>
        <p><?= nl2br(htmlspecialchars($data['mission'])) ?></p>
    </div>

    <div class="section">
        <h2 class="section-title">Our Vision</h2>
        <p><?= nl2br(htmlspecialchars($data['vision'])) ?></p>
    </div>

    <div class="section">
        <h2 class="section-title">Our Team</h2>
        <p><?= nl2br(htmlspecialchars($data['team'])) ?></p>
    </div>

    <div style="text-align: center;">
        <a href="header.php" class="home-link">← Back to Home</a>
    </div>
</div>

</body>
</html>
