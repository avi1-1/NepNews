<?php
// Set headers
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// Database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nepnews";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// SQL query to fetch only 'published' status news
$sql = "SELECT id, title, description, date, category, thumbnail, admin, status FROM news WHERE status = 'published' ORDER BY id DESC";

$result = $conn->query($sql);

$newsData = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $newsData[] = $row;
    }

    // Separate the latest news (first item)
    $latestNews = array_shift($newsData); // removes the first item
    shuffle($newsData); // shuffle the remaining items
    array_unshift($newsData, $latestNews); // re-add latest news at the top
}

// Output as JSON
echo json_encode($newsData);

// Close connection
$conn->close();
?>
