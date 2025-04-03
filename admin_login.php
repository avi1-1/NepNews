<?php
// Start session to store logged-in status
session_start();

// Database connection details
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

// Create adminlogin table if it doesn't exist
$sql_create_table = "
    CREATE TABLE IF NOT EXISTS adminlogin (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL
    );
";
$conn->query($sql_create_table);

// Predefined Admin credentials (only insert if adminlogin table is empty)
$adminEmail = "admin@gmail.com";
$adminPassword = "Admin@123"; // Plain text password
$hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT); // Hash the password

// Check if the admin credentials already exist in the database
$sql_check_admin = "SELECT * FROM adminlogin WHERE email = '$adminEmail'";
$result = $conn->query($sql_check_admin);

if ($result->num_rows == 0) {
    // Insert the admin credentials if they don't exist
    $sql_insert_admin = "INSERT INTO adminlogin (email, password) VALUES ('$adminEmail', '$hashedPassword')";
    if ($conn->query($sql_insert_admin) === TRUE) {
        //  echo "Admin credentials saved successfully.<br>";
    } else {
        echo "Error: " . $conn->error . "<br>";
    }
}

// Check if form is submitted via AJAX
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
    // Get the email and password from the form
    $email = $_POST['admin-email'];
    $password = $_POST['admin-password'];

    // Prepare SQL query to fetch the admin details from the database
    $sql = "SELECT * FROM adminlogin WHERE email = '$email' LIMIT 1";
    $result = $conn->query($sql);

    // If admin found, check the password
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Store session or set login status
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_email'] = $email;
            echo "success"; // Return success to JavaScript
        } else {
            // Invalid password
            echo "Invalid Admin Credentials.";
        }
    } else {
        // Admin email not found
        echo "Invalid Admin Credentials.";
    }
    exit(); // Terminate script here to avoid further processing
}

// Close connection
$conn->close();
?>

<!-- HTML Form for Admin Login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
    <script>
    $(document).ready(function() {
        // Handle form submission via AJAX
        $("#admin-login-form").on("submit", function(e) {
            e.preventDefault(); // Prevent normal form submission

            // Send form data via AJAX
            $.ajax({
                url: "admin_login.php", // PHP script to handle the request
                type: "POST",
                data: $(this).serialize() + '&ajax=true', // Include 'ajax=true' flag to detect AJAX requests
                success: function(response) {
                    if (response === "success") {
                        window.location.href = "admin_dashboard.php"; // Redirect to dashboard on success
                    } else {
                        alert(response); // Show the error message in an alert
                        // Reload the page after alert is dismissed
                        window.location.reload(); // This will reload the current page
                    }
                }
            });
        });
    });
</script>

</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Admin Sign In</h2>
            <form id="admin-login-form" method="POST">
                <input type="email" name="admin-email" placeholder="Admin Email" required>
                <input type="password" name="admin-password" placeholder="Admin Password" required>
                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>
</body>
</html>
