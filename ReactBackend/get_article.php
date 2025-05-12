<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "nepnews");

if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed"]);
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT * FROM news WHERE id = $id LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["error" => "Article not found"]);
}
$conn->close();
?>
