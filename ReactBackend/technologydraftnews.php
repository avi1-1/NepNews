<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nepnews";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT id, title, description, date, category, thumbnail, admin, status 
        FROM news 
        WHERE status = 'published' AND LOWER(category) = 'Technology' 
        ORDER BY id DESC";

$result = $conn->query($sql);

if (!$result) {
    die(json_encode(["error" => "Query failed: " . $conn->error]));
}

$newsData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $newsData[] = $row;
    }

    $latestNews = array_shift($newsData);
    shuffle($newsData);
    array_unshift($newsData, $latestNews);
}

echo json_encode($newsData);
$conn->close();
?>
