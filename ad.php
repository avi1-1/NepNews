<?php

var_dump($_POST); // Debugging to show the form data

$servername = "localhost";
$username = "root";
$password = ""; // Your database password
$dbname = "nepnews"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
    // Table created or already exists
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Create User function
if (isset($_POST['create_user'])) {
    if (isset($_POST['email'], $_POST['username'], $_POST['password'], $_POST['role'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // Hash the password before storing
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Prepare and execute the SQL query to insert the data into the database
        $stmt = $conn->prepare("INSERT INTO staffLoginCredential (email, username, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $username, $hashedPassword, $role);

        if ($stmt->execute()) {
            echo "User '$username' created successfully!<br>";
        } else {
            echo "Error creating user: " . $stmt->error . "<br>";
        }

        $stmt->close();
    }
}

// Delete User function
if (isset($_POST['delete_user'])) {
    if (isset($_POST['delete-email'], $_POST['delete-role'])) {
        $email = $_POST['delete-email'];
        $role = $_POST['delete-role'];

        // Prepare and execute the SQL query to delete the data from the database
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
}

// Fetch users from the database to display in the table
$sql = "SELECT email, username, role FROM staffLoginCredential";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch all users into an array
    $users = $result->fetch_all(MYSQLI_ASSOC);
    // Return the users as JSON
    echo json_encode($users);
} else {
    echo json_encode([]); // Return an empty array if no users
}

$conn->close();
?>
