<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "medi EASE");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getBotReply($msg) {
    $msg = strtolower($msg);
    $answers = [
        "i have a headache" => "Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.",
        "what to do for fever?" => "Take fluids, rest, and monitor your temperature. See a doctor if it worsens.",
        "how to book an appointment?" => "You can book an appointment on the 'Appointment' page of Medi EASE.",
        "i feel dizzy" => "Lie down, drink water, and rest. Seek help if dizziness continues.",
        "i have sore throat" => "Drink warm fluids and avoid cold drinks. Gargle with salt water.",
        "how to donate blood?" => "You can donate blood by registering on our 'Blood & Organ Donation' page.",
        "organ donation info" => "Visit our Organ Donation page and fill out the form. Thank you for saving lives!",
        "covid-19 symptoms" => "For COVID-19, isolate yourself and monitor symptoms. Contact your doctor if severe.",
        "what to do for flu?" => "Flu symptoms include fever, cough, sore throat. Rest and hydrate well.",
        "how to consult a doctor?" => "You can consult a doctor via our 'Live Chat' or 'Appointment' feature on Medi EASE.",
        "reset my password" => "To reset your password, go to the Login page and click 'Forgot Password'. Follow the instructions sent to your registered email.",
        "what is medi ease?" => "Medi EASE is your friendly healthcare assistant website to book appointments, get health tips, and consult doctors.",
        "how to register?" => "Click on the Signup button on the homepage and fill in your details to register.",
        "opening hours?" => "Our clinic hours are Monday to Friday, 9 AM to 6 PM.",
        "emergency contact?" => "Call 123-456-7890 for emergency medical assistance anytime.",
        "symptoms checker?" => "Use the Symptoms Checker feature to get possible conditions based on your symptoms.",
        "blood donation eligibility?" => "You must be between 18 and 65 years, healthy, and weigh over 50 kg to donate blood."
    ];

    // Find exact match or fallback
    foreach ($answers as $q => $a) {
        if (strpos($msg, $q) !== false) {
            return $a;
        }
    }
    return "🤖 Sorry, only the provided questions can be asked here. Please use the 'Chat Now' button to talk directly with a doctor.";
}

// Initialize chat history if not set
if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [];
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $userMsg = trim($_POST['message']);
    if ($userMsg !== '') {
        $botReply = getBotReply($userMsg);

        // Save conversation in session
        $_SESSION['chat_history'][] = [
            'user' => $userMsg,
            'bot' => $botReply
        ];

        // Save to DB
        $stmt = $conn->prepare("INSERT INTO chatbot_logs (user_message, bot_reply) VALUES (?, ?)");
        $stmt->bind_param("ss", $userMsg, $botReply);
        $stmt->execute();
        $stmt->close();
    }
}

// Clear chat history
if (isset($_POST['clear_chat'])) {
    $_SESSION['chat_history'] = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Medi EASE | AI Chatbot</title>
<style>
  body {
    background: #eef6fb;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0; padding: 20px;
    display: flex; justify-content: center; 
  }
  .chat-wrapper {
    background: white;
    max-width: 700px;
    width: 100%;
    border-radius: 20px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.1);
    padding: 30px 40px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    min-height: 600px;
  }
  h1 {
    text-align: center;
    color: #007acc;
    margin-bottom: 25px;
  }
  /* FAQ buttons */
  .faq-buttons {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 15px;
    margin-bottom: 30px;
  }
  .faq-buttons button {
    background: #d0eaff;
    border: none;
    border-radius: 12px;
    padding: 10px 15px;
    font-weight: 600;
    color: #004a87;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0, 76, 143, 0.2);
    transition: background-color 0.3s ease;
    user-select: none;
  }
  .faq-buttons button:hover {
    background: #007acc;
    color: white;
  }
  /* Chat messages */
  .chat-box {
    flex: 1 1 auto;
    overflow-y: auto;
    padding: 15px;
    border: 2px solid #007acc;
    border-radius: 15px;
    background: #f0faff;
    margin-bottom: 25px;
  }
  .message {
    max-width: 70%;
    margin-bottom: 15px;
    padding: 14px 20px;
    border-radius: 20px;
    line-height: 1.4;
  }
  .user-msg {
    background: #007acc;
    color: white;
    align-self: flex-end;
    border-bottom-right-radius: 5px;
    box-shadow: 0 4px 10px rgba(0, 122, 204, 0.4);
  }
  .bot-msg {
    background: #d0eaff;
    color: #004a87;
    align-self: flex-start;
    border-bottom-left-radius: 5px;
    box-shadow: inset 0 0 10px rgba(0, 74, 135, 0.2);
  }
  /* Form input and buttons */
  form {
    display: flex;
    gap: 10px;
  }
  input[type="text"] {
    flex: 1 1 auto;
    padding: 14px 20px;
    font-size: 1rem;
    border: 2px solid #007acc;
    border-radius: 25px;
    outline: none;
    transition: border-color 0.3s ease;
  }
  input[type="text"]:focus {
    border-color: #005fa3;
  }
  button[type="submit"], button.clear-chat {
    background: #007acc;
    border: none;
    color: white;
    font-weight: 700;
    padding: 14px 25px;
    border-radius: 25px;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0, 122, 204, 0.6);
    transition: background-color 0.3s ease;
  }
  button[type="submit"]:hover, button.clear-chat:hover {
    background-color: #005fa3;
  }
  /* Clear chat button */
  .clear-chat {
    background: #e53935;
    box-shadow: 0 4px 10px rgba(229, 57, 53, 0.6);
    margin-left: 10px;
  }
  .clear-chat:hover {
    background-color: #b71c1c;
  }
  /* Back to home */
  .back-home {
    margin-top: 20px;
    text-align: left;
  }
  .back-home a {
    color: #007acc;
    font-weight: 700;
    text-decoration: none;
    font-size: 1.1rem;
    user-select: none;
  }
  .back-home a:hover {
    text-decoration: underline;
  }
</style>
<script>
  // Fill input and submit form on FAQ click
  function sendFAQ(question) {
    const input = document.getElementById('messageInput');
    input.value = question;
    document.getElementById('chatForm').submit();
  }
</script>
</head>
<body>

<div class="chat-wrapper">
  <h1>🤖 Medi EASE AI Chatbot</h1>

  <div class="faq-buttons" aria-label="Frequently Asked Questions">
    <?php 
      $questions = [
        "I have a headache",
        "What to do for fever?",
        "How to book an appointment?",
        "I feel dizzy",
        "I have sore throat",
        "How to donate blood?",
        "Organ donation info",
        "COVID-19 symptoms",
        "What to do for flu?",
        "How to consult a doctor?",
        "Reset my password",
        "What is Medi EASE?",
        "How to register?",
        "Opening hours?",
        "Emergency contact?",
        "Symptoms checker?",
        "Blood donation eligibility?"
      ];

      foreach ($questions as $q) {
        echo "<button type='button' onclick=\"sendFAQ('".htmlspecialchars($q, ENT_QUOTES)."')\">$q</button>";
      }
    ?>
  </div>

  <div class="chat-box" aria-live="polite" aria-relevant="additions" aria-atomic="false" role="log" tabindex="0">
    <?php if (!empty($_SESSION['chat_history'])): ?>
      <?php foreach ($_SESSION['chat_history'] as $chat): ?>
        <div class="message user-msg"><?= htmlspecialchars($chat['user']) ?></div>
        <div class="message bot-msg"><?= nl2br(htmlspecialchars($chat['bot'])) ?></div>
      <?php endforeach; ?>
    <?php else: ?>
      <p style="text-align:center; color:#007acc;">No conversation yet. Try clicking a question or type your own!</p>
    <?php endif; ?>
  </div>

  <form id="chatForm" method="post" action="" aria-label="Chat form">
    <input 
      type="text" 
      id="messageInput" 
      
      name="message" 
      placeholder="Type your question here..." 
      autocomplete="off" 
      required 
      aria-required="true"
      aria-label="Enter your question"
    />
    <button type="submit" aria-label="Send message">Send</button>
    <button type="submit" name="clear_chat" class="clear-chat" aria-label="Clear chat history" formnovalidate>Clear</button>
  </form>

  <div class="back-home">
    <a href="header.php" title="Back to Home">← Back to Home</a>
  </div>
</div>

</body>
</html>
