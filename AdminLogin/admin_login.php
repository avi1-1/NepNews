<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your DB password
$dbname = "nepnews"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create `adminlogin` table if it doesn't exist
$sql_create_table = "
    CREATE TABLE IF NOT EXISTS adminlogin (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    );
";
$conn->query($sql_create_table);

// Predefined Admin credentials (only insert if adminlogin table is empty)
$adminEmail = "admin@gmail.com";
$adminPassword = "Admin@123"; // Default admin password
$hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

// Check if admin exists
$sql_check_admin = "SELECT * FROM adminlogin WHERE email = ?";
$stmt = $conn->prepare($sql_check_admin);
$stmt->bind_param("s", $adminEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $sql_insert_admin = "INSERT INTO adminlogin (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql_insert_admin);
    $stmt->bind_param("ss", $adminEmail, $hashedPassword);
    $stmt->execute();
}

// Handle AJAX login request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
    $email = $_POST['admin-email'];
    $password = $_POST['admin-password'];

    // Fetch admin details
    $sql = "SELECT * FROM adminlogin WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_email'] = $email;
            echo json_encode(["status" => "success", "message" => "Login successful! Redirecting..."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Incorrect password. Please try again."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Email not found. Please check and try again."]);
    }
    exit();
}

$conn->close();
?>