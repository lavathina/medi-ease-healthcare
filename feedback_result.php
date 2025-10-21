<?php
include 'connection.php';

$sql = "SELECT * FROM feedbacks ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<h2>Feedback Results</h2>

<?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div style='border:1px solid #ccc; padding:10px; margin:10px 0;'>";
        echo "<strong>" . htmlspecialchars($row['username']) . "</strong><br>";
        echo nl2br(htmlspecialchars($row['comment'])) . "<br>";
        echo "⭐ Rating: " . htmlspecialchars($row['rating']) . "<br>";
        echo "👍 Helpful: " . $row['helpful'] . " | 👎 Not Helpful: " . $row['not_helpful'] . "<br>";
        echo "<small>Submitted on " . $row['created_at'] . "</small>";
        echo "</div>";
    }
} else {
    echo "<p>No feedbacks yet.</p>";
}
?>

<a href="feedback.php">⬅️ Go Back to Feedback Form</a>
