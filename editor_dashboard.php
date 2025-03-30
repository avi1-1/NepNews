<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'editor') {
    header('Location: login.php');
    exit;
}

// Handle article deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];
    $sql = "DELETE FROM articles WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Article deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
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

        <h2>All Articles</h2>
        <div class="articles">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='article'>";
                    echo "<h3>" . $row['title'] . "</h3>";
                    echo "<p><strong>By:</strong> " . $row['author'] . "</p>";
                    echo "<p>" . $row['content'] . "</p>";
                    echo "<p><i>Added on: " . $row['date_added'] . "</i></p>";
                    echo "<form action='editor_dashboard.php' method='POST' style='display:inline;'>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<input type='hidden' name='action' value='delete'>";
                    echo "<button type='submit' onclick='return confirm(\"Are you sure you want to delete this article?\")'>Delete</button>";
                    echo "</form>";
                    echo "<form action='edit.php' method='GET' style='display:inline;'>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<button type='submit'>Edit</button>";
                    echo "</form>";
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
