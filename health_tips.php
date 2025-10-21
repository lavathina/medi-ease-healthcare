<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Health Tips - Medi EASE</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: linear-gradient(to right, #e3f2fd, #ffffff);
      color: #333;
    }

    .navbar {
      background-color: #1976d2;
      color: #fff;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navbar h1 {
      font-size: 24px;
      margin: 0;
    }

    .navbar a {
      color: #fff;
      text-decoration: underline;
    }

    .container {
      max-width: 1100px;
      margin: 40px auto;
      padding: 30px;
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .tip-card {
      background: #f1f9ff;
      border-radius: 12px;
      margin-bottom: 20px;
      padding: 20px;
      transition: all 0.3s ease-in-out;
      cursor: pointer;
      border-left: 6px solid #1976d2;
    }

    .tip-card:hover {
      background: #e3f2fd;
      transform: translateY(-3px);
    }

    .tip-card h2 {
      font-size: 20px;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 10px;
      color: #1976d2;
    }

    .tip-content {
      display: none;
      margin-top: 15px;
      font-size: 15px;
      line-height: 1.6;
    }

    iframe {
      width: 100%;
      height: 315px;
      border-radius: 10px;
      margin-top: 15px;
    }

    .footer {
      text-align: center;
      padding: 20px;
      font-size: 14px;
      color: #666;
      background-color: #f0f0f0;
      margin-top: 40px;
    }

    @media (max-width: 768px) {
      iframe { height: 200px; }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <h1>💡 Health Tips</h1>
    <a href="header.php">← Back to Home</a>
  </div>

  <!-- Container -->
  <div class="container">

    <div class="tip-card" onclick="toggleTip(this)">
      <h2><i class="fas fa-carrot"></i> Nutrition & Diet</h2>
      <div class="tip-content">
        <p>Eat a colorful variety of vegetables, whole grains, and lean proteins. Avoid junk foods and sugary drinks. Your diet affects every part of your body – from your skin to your brain!</p>
        <iframe src="https://www.youtube.com/embed/3zBXzSAXzMI" title="Nutrition Basics" allowfullscreen></iframe>
      </div>
    </div>

    <div class="tip-card" onclick="toggleTip(this)">
      <h2><i class="fas fa-dumbbell"></i> Exercise & Fitness</h2>
      <div class="tip-content">
        <p>Staying active improves your heart, strengthens muscles, and helps mental clarity. Even a daily walk is powerful! Aim for 30 mins/day of moderate movement.</p>
        <iframe src="https://www.youtube.com/embed/UBMk30rjy0o" title="Home Workout" allowfullscreen></iframe>
      </div>
    </div>

    <div class="tip-card" onclick="toggleTip(this)">
      <h2><i class="fas fa-tint"></i> Hydration</h2>
      <div class="tip-content">
        <p>Drink at least 8–10 glasses of water per day. Water helps with digestion, skin clarity, and flushing toxins from the body.</p>
        <iframe src="https://www.youtube.com/embed/9iMGFqMmUFs" title="Why Water Matters" allowfullscreen></iframe>
      </div>
    </div>

    <div class="tip-card" onclick="toggleTip(this)">
      <h2><i class="fas fa-brain"></i> Mental Wellness</h2>
      <div class="tip-content">
        <p>Manage stress through breathing, meditation, or talking to loved ones. Sleep well, and take breaks from screens and overwork.</p>
        <iframe src="https://www.youtube.com/embed/z6X5oEIg6Ak" title="Simple Meditation" allowfullscreen></iframe>
      </div>
    </div>

    <div class="tip-card" onclick="toggleTip(this)">
      <h2><i class="fas fa-bed"></i> Sleep & Recovery</h2>
      <div class="tip-content">
        <p>Deep sleep is where healing happens. Maintain a regular sleep cycle, avoid screens before bed, and aim for 7–9 hours each night.</p>
        <iframe src="https://www.youtube.com/embed/_DTmGtznab4" title="Healthy Sleep Tips" allowfullscreen></iframe>
      </div>
    </div>

    <div class="tip-card" onclick="toggleTip(this)">
      <h2><i class="fas fa-cloud-sun-rain"></i> Seasonal Health</h2>
      <div class="tip-content">
        <p>Change your care routines as seasons shift. In winter, stay warm and moisturized. In summer, wear sunscreen and stay hydrated. During flu season, boost immunity with vitamin C.</p>
      </div>
    </div>

  </div>

  <!-- Footer -->
  <div class="footer">
    &copy; <?php echo date("Y"); ?> Medi EASE. Empowering your well-being.
  </div>

  <!-- Script -->
  <script>
    function toggleTip(element) {
      const content = element.querySelector('.tip-content');
      const isOpen = content.style.display === 'block';
      document.querySelectorAll('.tip-content').forEach(el => el.style.display = 'none');
      content.style.display = isOpen ? 'none' : 'block';
    }
  </script>

</body>
</html>