<?php
// Database connection settings
$host = 'localhost'; // Change this if your MySQL server is on a different host
$username = 'root';  // Your MySQL username
$password = '';      // Your MySQL password

// Create a connection to MySQL server
$conn = new mysqli($host, $username, $password);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it doesn't exist
$dbname = 'nepnews';

// Check if the database exists 
$db_check = $conn->query("SHOW DATABASES LIKE '$dbname'");
if ($db_check->num_rows == 0) {
    // If the database doesn't exist, create it
    if ($conn->query("CREATE DATABASE $dbname")) {
        $message = "Database '$dbname' created successfully.";
    } else {
        $message = "Error creating database: " . $conn->error;
    }
}

// Select the database to work with
$conn->select_db($dbname);

// Create the 'admin' table if it doesn't exist
$table_check = $conn->query("SHOW TABLES LIKE 'admin'");
if ($table_check->num_rows == 0) {
    // If the table doesn't exist, create it
    $create_table_query = "
    CREATE TABLE admin (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL, 
        role VARCHAR(50) NOT NULL
    )";

    if ($conn->query($create_table_query)) {
        $message = "Table 'admin' created successfully.";
    } else {
        $message = "Error creating table: " . $conn->error;
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $username = $_POST['username'];
    $email = $_POST['user-email'];
    $password = $_POST['user-password'];
    $role = $_POST['user-role'];

    // Password validation (At least 1 uppercase, 1 special char, 1 number, and 8 chars minimum)
    if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
        $message = "Error: Password must contain at least one uppercase letter, one special character, one number, and be at least 8 characters long.";
    } else {
        // Check if the email already exists
        $email_check = $conn->query("SELECT * FROM admin WHERE email = '$email'");
        if ($email_check->num_rows > 0) {
            $message = "Error: The email address is already registered.";
        } else {
            // Hash the password before storing it in the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare the SQL query to insert the data into the admin table
            $sql = "INSERT INTO admin (username, email, password, role) VALUES (?, ?, ?, ?)";

            // Prepare the statement
            if ($stmt = $conn->prepare($sql)) {
                // Bind the parameters to the SQL query
                $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

                // Execute the query
                if ($stmt->execute()) {
                    // Message format: Role and Username
                    $message = "$role $username has been created successfully!";
                } else {
                    $message = "Error: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                $message = "Error: " . $conn->error;
            }
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Users</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function validatePassword() {
            var password = document.getElementById("user-password").value;
            var message = document.getElementById("password-message");

            // Regex pattern for password validation
            var pattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

            if (!pattern.test(password)) {
                message.innerHTML = "Password must contain at least 1 uppercase letter, at least 1 special character, at least 1 number, and be at least 8 characters long.";
                message.style.color = "red";
                return false;
            } else {
                message.innerHTML = "";
                return true;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="admin-dashboard">
            <h2>Admin Dashboard</h2>
            <div id="user-form-container">
                <h3>Create New User</h3>
                <!-- Form for creating a new user -->
                <form id="create-user-form" method="POST" action="" onsubmit="return validatePassword()">
                    <input type="text" name="username" id="username" placeholder="Username" required>
                    <input type="email" name="user-email" id="user-email" placeholder="User Email" required>
                    <input type="password" name="user-password" id="user-password" placeholder="Password" required onkeyup="validatePassword()">
                    <p id="password-message"></p>
                    <select name="user-role" id="user-role" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="Editor">Editor</option>
                        <option value="Writer">Writer</option>
                        <option value="Ads Manager">Ads Manager</option>
                    </select>
                    <button type="submit">Create User</button>
                </form>
                <div class="message" id="message">
                    <?php
                    // Display success or error message after form submission
                    if (isset($message)) {
                        echo "<script>alert('$message');</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
