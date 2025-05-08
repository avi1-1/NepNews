<?php
// Database configuration
$host = 'localhost';
$username = 'root'; // Change if needed
$password = '';     // Change if needed
$dbname = 'nepnews';

// Create connection
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create DB if not exists
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);

// Create table if not exists
$tableSql = "CREATE TABLE IF NOT EXISTS ads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad_image VARCHAR(255),
    start_time DATETIME,
    end_time DATETIME,
    redirect_link TEXT
)";
$conn->query($tableSql);

// Handle form data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES["adImage"]) && $_FILES["adImage"]["error"] === 0) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES["adImage"]["name"]);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES["adImage"]["tmp_name"], $targetFile)) {
            $startTime = $_POST['startTime'];
            $endTime = $_POST['endTime'];
            $redirectLink = $_POST['redirectLink'];

            $stmt = $conn->prepare("INSERT INTO ads (ad_image, start_time, end_time, redirect_link) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $fileName, $startTime, $endTime, $redirectLink);

            if ($stmt->execute()) {
                echo "Advertisement posted successfully!";
            } else {
                echo "Error inserting data: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "No file uploaded or file error occurred.";
    }
}

$conn->close();
?>
