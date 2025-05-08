<?php
// ✅ Allow access from your React frontend
header("Access-Control-Allow-Origin: *");

// ✅ Optional: Allow specific HTTP methods (for completeness)
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// ✅ Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// ✅ Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nepnews";

// ✅ Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// ✅ Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Query to fetch only draft news
$sql = "SELECT id, title, image FROM news WHERE status = 'draft'";

$result = $conn->query($sql);

// ✅ Prepare data array
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// ✅ Set response as JSON
header('Content-Type: application/json');
echo json_encode($data);

// ✅ Close connection
$conn->close();
?>
