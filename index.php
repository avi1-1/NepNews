<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get article details
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    // Insert article into the database
    $sql = "INSERT INTO articles (title, content, author) VALUES ('$title', '$content', '$author')";
    if ($conn->query($sql) === TRUE) {
        echo "New article added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all articles
$sql = "SELECT * FROM articles ORDER BY date_added DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Editor Dashboard</h1>

        <!-- Article Submission Form -->
        <form action="index.php" method="POST">
            <input type="text" name="title" placeholder="Article Title" required><br>
            <textarea name="content" placeholder="Article Content" required></textarea><br>
            <input type="text" name="author" placeholder="Author Name" required><br>
            <button type="submit">Submit Article</button>
        </form>

        <h2>Articles</h2>
        <div class="articles">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='article'>";
                    echo "<h3>" . $row['title'] . "</h3>";
                    echo "<p><strong>By:</strong> " . $row['author'] . "</p>";
                    echo "<p>" . $row['content'] . "</p>";
                    echo "<p><i>Added on: " . $row['date_added'] . "</i></p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No articles found!</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
