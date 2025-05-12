<?php
include_once("../db.php"); // Corrected path to DB connection
header("Access-Control-Allow-Origin: http://localhost:5173"); // Your React dev server
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json");

$sql = "SELECT * FROM ads WHERE NOW() BETWEEN start_time AND end_time";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$ads = [];
while ($row = $result->fetch_assoc()) {
    $ads[] = $row;
}

echo json_encode($ads);
?>
