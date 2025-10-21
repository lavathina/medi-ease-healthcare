<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Medi EASE: Health Care</title>

  <!-- Google Fonts + Font Awesome -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: url('background.jpeg') no-repeat center center fixed;
      background-size: cover;
      color: #333;
      transition: background 0.5s, color 0.5s;
    }

    .dark {
      background-color: #121212;
      color: #e0e0e0;
    }

    .navbar {
      background-color: #1976d2;
      color: #fff;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .navbar h1 {
      font-size: 28px;
      font-weight: 700;
      margin: 0;
    }

    .auth-buttons {
      display: flex;
      align-items: center;
    }

    .auth-buttons a, .auth-buttons span {
      color: #fff;
      text-decoration: none;
      margin-left: 15px;
      padding: 8px 14px;
      border: 1px solid #fff;
      border-radius: 6px;
      font-weight: 500;
      transition: background 0.3s;
      display: inline-block;
    }

    .auth-buttons span {
      border: none;
      padding: 0;
      margin-right: 10px;
      font-weight: 600;
      color: #fff;
    }

    .auth-buttons a:hover {
      background-color: #fff;
      color: #1976d2;
    }

    .toggle-btn {
      background: none;
      border: none;
      color: #fff;
      font-size: 20px;
      cursor: pointer;
    }

    .hero {
      text-align: center;
      padding: 50px 20px;
      background-color: rgba(255, 255, 255, 0.92);
      border-radius: 12px;
      margin: 40px auto 20px;
      max-width: 900px;
      animation: fadeIn 1s ease;
    }

    .hero h2 {
      font-size: 34px;
      color: #1976d2;
      margin-bottom: 10px;
    }

    .hero p {
      font-size: 18px;
      color: #555;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }

    .container {
      max-width: 1100px;
      margin: auto;
      background: rgba(255, 255, 255, 0.96);
      padding: 30px;
      border-radius: 14px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }

    .container h2 {
      text-align: center;
      font-size: 28px;
      color: #1976d2;
      margin-bottom: 30px;
    }

    .feature-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
    }

    .feature-card {
      background-color: #e3f2fd;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      transition: transform 0.3s, background 0.3s;
    }

    .feature-card:hover {
      background-color: #bbdefb;
      transform: translateY(-5px);
    }

    .feature-card i {
      font-size: 30px;
      margin-bottom: 10px;
      color: #0d47a1;
    }

    .feature-card a {
      text-decoration: none;
      font-weight: 600;
      font-size: 16px;
      color: #0d47a1;
      display: block;
    }

    .chat-btn {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #1976d2;
      color: white;
      padding: 12px 20px;
      border-radius: 30px;
      text-decoration: none;
      font-weight: bold;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      z-index: 999;
    }

    .footer {
      text-align: center;
      padding: 20px;
      font-size: 14px;
      color: #666;
    }
  </style>
</head>

<body>

  <!-- Navigation -->
  <div class="navbar">
    <h1>Medi EASE: Health Care</h1>
    <div class="auth-buttons">
      <button class="toggle-btn" onclick="toggleMode()">🌓</button>
      <?php
        if (isset($_SESSION['username'])) {
          echo "<span>Welcome, " . htmlspecialchars($_SESSION['username']) . "</span>";
          echo "<a href='logout.php'>Logout</a>";
        } else {
          echo "<span style='font-weight:600; margin-right:15px;'>Welcome! Please sign up or login to access all features.</span>";
          echo "<a href='login.php'>Login</a>";
          echo "<a href='signup.php'>Sign Up</a>";
          echo "<a href='forgot_password.php'>Forgot Password</a>";
        }
      ?>
    </div>
  </div>

  
<!-- Hero Section -->
  <div class="hero">
    <h2>Your Wellness, Our Priority</h2>
    <p>Empowering you with trusted tools and expert advice to take charge of your health journey.</p>
  </div>

  <!-- Feature Section -->
  <div class="container">
    <h2>Explore Our Healthcare Services</h2>
    <div class="feature-grid">
      <div class="feature-card"><i class="fas fa-heartbeat"></i><a href="health_tips.php">Health Tips</a></div>
      <div class="feature-card"><i class="fas fa-notes-medical"></i><a href="symptom_checker.php">Symptoms Checker</a></div>
      <div class="feature-card"><i class="fas fa-calendar-check"></i><a href="appointments.php">Book Appointment</a></div>
      <div class="feature-card"><i class="fas fa-newspaper"></i><a href="health_news.php">Health News</a></div>
      <div class="feature-card"><i class="fas fa-robot"></i><a href="chatbot.php">AI Chatbot</a></div>
      <div class="feature-card"><i class="fas fa-hand-holding-heart"></i><a href="donate.php">Organ / Blood Donation</a></div>
      <div class="feature-card"><i class="fas fa-info-circle"></i><a href="about_us.php">About Us</a></div>
      <div class="feature-card"><i class="fas fa-question-circle"></i><a href="help_desk.php">Help Desk</a></div>
      <div class="feature-card"><i class="fas fa-user-shield"></i><a href="privacy_policy.php">Privacy Policy</a></div>
      <div class="feature-card"><i class="fas fa-comment-dots"></i><a href="feedback.php">Feedback</a></div>

    </div>
  </div>

  <!-- Floating Chatbot Button -->
  <a href="chatbot.php" class="chat-btn">💬 Chat Now</a>
  
  <!-- Floating Chat Now Button -->

  <a href="chatnow.php" class="chat-btn">💬 Chat Now</a>

  <!-- Footer -->
  <div class="footer">
    &copy; <?php echo date("Y"); ?> Medi EASE. All rights reserved.
  </div>

  <!-- Dark Mode Toggle Script -->
  <script>
    function toggleMode() {
      document.body.classList.toggle('dark');
    }

    

  </script>

</body>
</html>
