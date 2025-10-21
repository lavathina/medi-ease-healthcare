<?php
session_start();

// Example session username (replace with your login system)
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = "Guest_" . rand(100,999);
}

$host = "localhost";
$user = "root";
$pass = "";
$db   = "medi EASE";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("DB Connection failed: " . $conn->connect_error);

// Insert feedback
if (isset($_POST['submit_feedback'])) {
    $username = $_SESSION['username'];
    $comment  = $_POST['comment'] ?? '';
    $rating   = $_POST['rating'] ?? 0;

    $sql = "INSERT INTO feedbacks (username, comment, rating) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $comment, $rating);
    $stmt->execute();
    $stmt->close();
}

// Delete feedback (only if owner)
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $check = $conn->query("SELECT username FROM feedbacks WHERE id=$id");
    if ($check && $row = $check->fetch_assoc()) {
        if ($row['username'] === $_SESSION['username']) {
            $conn->query("DELETE FROM feedbacks WHERE id=$id");
        }
    }
}

// Simple Survey Handling (store in file for demo)
if (isset($_POST['submit_survey'])) {
    $answers = "";
    foreach ($_POST as $key => $val) {
        if ($key !== "submit_survey") {
            $answers .= ucfirst($key) . ": " . $val . " | ";
        }
    }
    file_put_contents("survey_results.txt", $_SESSION['username'] . " - " . $answers . "\n", FILE_APPEND);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Cute Feedback & Advice</title>
<style>
    body {
      font-family: "Comic Sans MS", cursive, sans-serif;
      background: #d199b1ff;
      margin: 0; padding: 0;
      text-align: center;
    }
    .container {
      width: 70%; margin: 30px auto;
    }
    form, .feedback-list, .survey-box {
      background: #ffe2feb9; padding: 20px;
      border-radius: 20px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    textarea, select {
      width: 100%; padding: 10px; margin: 10px 0;
      border-radius: 12px; border: 1px solid #ddd;
    }
    button {
      padding: 10px 20px; border: none;
      border-radius: 15px; cursor: pointer;
      transition: 0.3s;
    }
    .btn-submit { background: #ff80bf; color: #fff; }
    .btn-submit:hover { background: #ff4da6; }
    .feedback-item { border-bottom: 1px solid #eee; padding: 10px 0; }
    .stars { color: gold; font-size: 18px; }
    .delete-btn { color: red; margin-left: 10px; text-decoration:none; font-size:14px; }
    .footer-back { text-align: center; margin: 30px 0; }
    .footer-back a {
      background: #ff80bf; color:#fff; padding: 12px 20px;
      border-radius: 30px; text-decoration: none;
    }
    .footer-back a:hover { background: #ff4da6; }

    /* Floating button */
    .floating-btn {
      position: fixed; bottom: 20px; right: 20px;
      background: #ff80bf; color: white;
      border: none; padding: 14px;
      border-radius: 50%; font-size: 20px;
      cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      transition: 0.3s;
    }
    .floating-btn:hover { background: #ff4da6; }

    /* Modal */
    .modal {
      display: none; position: fixed;
      top: 0; left: 0; width: 100%; height: 100%;
      background: rgba(0,0,0,0.4);
      display: flex; justify-content: center; align-items: center;
    }
    .modal-content {
      background: white; padding: 20px;
      border-radius: 20px; width: 90%;
      max-width: 400px; text-align: center;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .stars { font-size: 22px; color: gold; }

    /* Cute advice box */
    .advice-box {
      position: fixed; top: 10px; left: 50%;
      transform: translateX(-50%);
      background: #ffe6f2;
      padding: 12px 20px; border-radius: 20px;
      box-shadow: 0 4px 10px rgba(255, 203, 203, 0.7);
      font-size: 14px; font-weight: bold; color: #d63384;
      animation: fadeSlide 1s ease;
    }
    @keyframes fadeSlide {
      from {opacity: 0; transform: translate(-50%, -10px);}
      to {opacity: 1; transform: translate(-50%, 0);}
    }
</style>
</head>
<body>

<!-- Advice Box -->
<div id="adviceBox" class="advice-box">🌟 Loading advice...</div>

<div class="container">
<h2 style="text-align: left; margin-left: 20px;">Leave Your Feedback 💬</h2>

    <form method="post">
        <textarea name="comment" placeholder="Write your feedback..." required></textarea>
        <label>Rate Us:</label>
        <select name="rating">
            <option value="0">Select...</option>
            <option value="1">⭐</option>
            <option value="2">⭐⭐</option>
            <option value="3">⭐⭐⭐</option>
            <option value="4">⭐⭐⭐⭐</option>
            <option value="5">⭐⭐⭐⭐⭐</option>
        </select>
        <button type="submit" name="submit_feedback" class="btn-submit">Submit</button>
    </form>

    <div class="feedback-list">
        <h3>Feedback Results ⭐</h3>
        <?php
        $result = $conn->query("SELECT * FROM feedbacks ORDER BY created_at DESC");
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $stars = str_repeat("⭐", intval($row['rating']));
                echo "<div class='feedback-item'>
                        <b>{$row['username']}</b> <br>
                        {$row['comment']} <br>
                        <span class='stars'>{$stars}</span>";
                if ($row['username'] === $_SESSION['username']) {
                    echo " <a class='delete-btn' href='?delete={$row['id']}' onclick=\"return confirm('Delete your feedback?');\">Delete</a>";
                }
                echo "</div>";
            }
        } else {
            echo "<p>No feedback yet.</p>";
        }
        ?>
    </div>

    <div class="survey-box">
        <h3>Quick Survey 📋</h3>
        <form method="post">
            <label>Would you recommend us?</label><br>
            <input type="radio" name="recommend" value="Yes"> Yes 😊
            <input type="radio" name="recommend" value="No"> No 😔
            <br><br>
            <label>How easy to use?</label><br>
            <input type="radio" name="ease" value="Very Easy"> Very Easy 🌟
            <input type="radio" name="ease" value="Average"> Average 🙂
            <input type="radio" name="ease" value="Hard"> Hard 😓
            <br><br>
            <label>Favorite Feature?</label><br>
            <input type="radio" name="feature" value="Chat"> Chat 💬
            <input type="radio" name="feature" value="Booking"> Booking 📅
            <input type="radio" name="feature" value="Tips"> Tips 💡
            <br><br>
            <button type="submit" name="submit_survey" class="btn-submit">Submit Survey</button>
        </form>
    </div>

    <div class="footer-back">
        <a href="header.php">🏠 Back to Home</a>
    </div>
</div>

<!-- Floating Results Button -->
<button class="floating-btn" onclick="openModal()">📊</button>

<!-- Modal -->
<div class="modal" id="resultsModal">
  <div class="modal-content">
    <h3>✨ Feedback Graph ✨</h3>
    <canvas id="feedbackChart"></canvas>
    <br>
    <button onclick="closeModal()" class="btn-submit">Close</button>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Modal functions
function openModal(){ document.getElementById("resultsModal").style.display="flex"; }
function closeModal(){ document.getElementById("resultsModal").style.display="none"; }

// Chart data
<?php
$stats = $conn->query("SELECT rating, COUNT(*) as total FROM feedbacks GROUP BY rating");
$ratings = []; $counts = [];
while ($row = $stats->fetch_assoc()) {
    $ratings[] = $row['rating']."⭐";
    $counts[] = $row['total'];
}
?>
const ctx = document.getElementById("feedbackChart").getContext("2d");
new Chart(ctx, {
    type: "pie",
    data: {
        labels: <?= json_encode($ratings) ?>,
        datasets: [{
            data: <?= json_encode($counts) ?>,
            backgroundColor: ['#ffb3ba','#ffdfba','#ffffba','#baffc9','#bae1ff']
        }]
    }
});

// Advice rotator
const advices = [
    "🌸 Stay positive today!",
    "🍀 Believe in yourself!",
    "🌞 Smile, it's contagious!",
    "💡 Small steps = Big success!",
    "🌈 Good things are coming!"
];
let index=0;
function showAdvice(){
    document.getElementById("adviceBox").innerHTML = advices[index];
    index=(index+1)%advices.length;
}
showAdvice();
setInterval(showAdvice,4000);
</script>
</body>
</html>
