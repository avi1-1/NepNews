<?php
// Set headers
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // Allow access from any origin

// Database connection variables
$servername = "localhost";
$username = "root";
$password = ""; // Update if needed
$dbname = "nepnews";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// SQL query to fetch all news titles
$sql = "SELECT id, title FROM news ORDER BY id DESC";

$result = $conn->query($sql);

$titles = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $titles[] = $row;
    }
}

// Output as JSON
echo json_encode($titles);

// Close connection
$conn->close();
?>
