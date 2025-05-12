<?php
// Set headers
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nepnews";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Fetch published sports news
$sql = "SELECT id, title, description, date, category, thumbnail, admin, status 
        FROM news 
        WHERE status = 'published' AND category = 'Entertainment' 
        ORDER BY id DESC";

$result = $conn->query($sql);
$newsData = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $newsData[] = $row;
    }

    // Put latest news on top
    $latestNews = array_shift($newsData);
    shuffle($newsData);
    array_unshift($newsData, $latestNews);
}

// Output data
echo json_encode($newsData);

$conn->close();
?>
