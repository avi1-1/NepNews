<?php

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

// Check if email exists function
function checkEmailExists($email, $conn) {
    $stmt = $conn->prepare("SELECT email FROM staffLoginCredential WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Create User function
if (isset($_POST['create_user'])) {
    if (isset($_POST['email'], $_POST['username'], $_POST['password'], $_POST['role'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // Check if email already exists
        if (checkEmailExists($email, $conn)) {
            echo json_encode(["status" => "error", "message" => "Email is already used."]);
            exit;
        }

        // Hash the password before storing
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Prepare and execute the SQL query to insert the data into the database
        $stmt = $conn->prepare("INSERT INTO staffLoginCredential (email, username, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $username, $hashedPassword, $role);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "$role $username created successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error creating user: " . $stmt->error]);
        }

        $stmt->close();
    }
}

// Delete User function
if (isset($_POST['delete_user'])) {
    if (isset($_POST['delete-email'], $_POST['delete-role'])) {
        $email = $_POST['delete-email'];
        $role = $_POST['delete-role'];

        // Check if the user exists
        if (!checkEmailExists($email, $conn)) {
            echo json_encode(["status" => "error", "message" => "User with this email does not exist."]);
            exit;
        }

        // Prepare and execute the SQL query to delete the data from the database
        $stmt = $conn->prepare("DELETE FROM staffLoginCredential WHERE email = ? AND role = ?");
        $stmt->bind_param("ss", $email, $role);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(["status" => "success", "message" => "$role $email deleted successfully."]);
            } else {
                echo json_encode(["status" => "error", "message" => "No matching user found to delete."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Error deleting user: " . $stmt->error]);
        }

        $stmt->close();
    }
}

// Fetch users from the database to display in the table
$sql = "SELECT email, username, role FROM staffLoginCredential";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($users);
} else {
    echo json_encode([]);
}

$conn->close();
?>
