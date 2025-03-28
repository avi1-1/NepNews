<?php
$servername = "localhost";
$username = "root";
$password = ""; // replace with your DB password
$dbname = "nepnews"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to the database.<br>";

// Create table if it doesn't exist
$sql_create_table = "
    CREATE TABLE IF NOT EXISTS staffLoginCredential (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(100) NOT NULL,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('Editor', 'Writer', 'Ads Manager') NOT NULL
    );
";
if ($conn->query($sql_create_table) === TRUE) {
    echo "Table created successfully or already exists.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Function to create a user
function createUser($email, $username, $password, $role) {
    global $conn;

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO staffLoginCredential (email, username, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $username, $hashedPassword, $role);

    if ($stmt->execute()) {
        echo "User '$username' created successfully!<br>";
    } else {
        echo "Error creating user: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

// Function to delete a user
function deleteUser($email, $role) {
    global $conn;

    $stmt = $conn->prepare("DELETE FROM staffLoginCredential WHERE email = ? AND role = ?");
    $stmt->bind_param("ss", $email, $role);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "User with email '$email' and role '$role' deleted successfully!<br>";
        } else {
            echo "No matching user found to delete.<br>";
        }
    } else {
        echo "Error deleting user: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

// Handle form submissions for create or delete
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'create' && isset($_POST['email'], $_POST['username'], $_POST['password'], $_POST['role'])) {
            // Create user example
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            echo "Attempting to create user...<br>";
            createUser($email, $username, $password, $role);
        } elseif ($_POST['action'] == 'delete' && isset($_POST['delete-email'], $_POST['delete-role'])) {
            // Delete user example
            $email = $_POST['delete-email'];
            $role = $_POST['delete-role'];
            echo "Attempting to delete user...<br>";
            deleteUser($email, $role);
        } else {
            echo "Invalid form submission.<br>";
        }
    } else {
        echo "Action not specified.<br>";
    }
}

$conn->close();
?>
