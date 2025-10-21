<?php
session_start();

// Dummy login (remove this in production)
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1; // Example logged-in user ID
}
$current_user = $_SESSION['user_id'];

// Database Connection
$conn = new mysqli("localhost", "root", "", "medi EASE");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$edit_mode = false;
$edit_data = null;

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM health_news WHERE id = $id AND user_id = $current_user");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle edit request
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $edit_id = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM health_news WHERE id = $edit_id AND user_id = $current_user");
    if ($result->num_rows > 0) {
        $edit_data = $result->fetch_assoc();
    } else {
        $edit_mode = false;
    }
}

// Handle post or update form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $image_url = $conn->real_escape_string($_POST['image_url']);

    if (isset($_POST['edit_id'])) {
        $id = (int)$_POST['edit_id'];
        $conn->query("UPDATE health_news SET title='$title', content='$content', image_url='$image_url' WHERE id = $id AND user_id = $current_user");
        $message = "✅ News updated successfully!";
    } else {
        $conn->query("INSERT INTO health_news (title, content, image_url, user_id) VALUES ('$title', '$content', '$image_url', $current_user)");
        $message = "✅ News posted successfully!";
    }
}

$news_result = $conn->query("SELECT * FROM health_news ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Health News | Medi EASE</title>
    <style>
        body { font-family: Arial; background: #eef7fb; margin: 0; padding: 30px; }
        h2 { color: #007acc; text-align: center; }
        .form-box, .news-card {
            background: white; max-width: 800px; margin: 30px auto; padding: 25px;
            border-radius: 10px; box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        input, textarea {
            width: 100%; padding: 10px; margin-top: 10px; border-radius: 6px; border: 1px solid #ccc;
        }
        button {
            margin-top: 15px; padding: 10px 20px; background: #007acc; color: white;
            border: none; border-radius: 6px; cursor: pointer;
        }
        .news-card img {
            width: 100%; max-height: 250px; object-fit: cover; border-radius: 10px; margin-bottom: 10px;
        }
        h3 { color: #005b8c; }
        .date { font-size: 13px; color: gray; }
        .message { color: green; text-align: center; }
        .home-link {
            text-align: center; display: block; margin: 20px auto;
            text-decoration: none; padding: 10px 20px; background: #ccc;
            color: #000; border-radius: 8px; width: 160px;
        }
        .actions a {
            margin-right: 10px; color: #007acc; text-decoration: none;
        }
    </style>
</head>
<body>

<h2>🩺 Post & View Health News</h2>

<!-- Post or Edit News Form -->
<div class="form-box">
    <form method="POST">
        <?php if ($edit_mode && $edit_data): ?>
            <input type="hidden" name="edit_id" value="<?= $edit_data['id'] ?>">
        <?php endif; ?>

        <label><strong>News Title</strong></label>
        <input type="text" name="title" required value="<?= $edit_data['title'] ?? '' ?>">

        <label><strong>News Content</strong></label>
        <textarea name="content" required><?= $edit_data['content'] ?? '' ?></textarea>

        <label><strong>Image URL (optional)</strong></label>
        <input type="text" name="image_url" placeholder="https://..." value="<?= $edit_data['image_url'] ?? '' ?>">

        <button type="submit"><?= $edit_mode ? 'Update News' : 'Publish News' ?></button>
        <?php if ($message): ?>
            <p class="message"><?= $message ?></p>
        <?php endif; ?>
    </form>
</div>

<!-- Display News -->
<?php while ($row = $news_result->fetch_assoc()): ?>
    <div class="news-card">
        <?php if ($row['image_url']): ?>
            <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="News Image">
        <?php endif; ?>
        <h3><?= htmlspecialchars($row['title']) ?></h3>
        <p class="date">🕒 <?= date("F j, Y, g:i a", strtotime($row['created_at'])) ?></p>
        <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
        <?php if ($row['user_id'] == $current_user): ?>
            <div class="actions">
                <a href="?edit=<?= $row['id'] ?>">🖊️ Edit</a>
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?');">🗑️ Delete</a>
            </div>
        <?php endif; ?>
    </div>
<?php endwhile; ?>

<!-- Back Button -->
<a href="header.php" class="home-link">← Back to Home</a>

</body>
</html>
