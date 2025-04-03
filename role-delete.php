<?php
// Database connection settings
$host = 'localhost'; // Change this if your MySQL server is on a different host
$username = 'root';  // Your MySQL username
$password = '';      // Your MySQL password
$dbname = 'nepnews'; // Your database name

// Create a connection to MySQL server
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $email = $_POST['user-email'];

    // Check if the email exists in the database
    $email_check = $conn->query("SELECT * FROM admin WHERE email = '$email'");

    if ($email_check->num_rows > 0) {
        // Fetch the user role and username before deleting
        $user = $email_check->fetch_assoc();
        $role = $user['role'];
        $username = $user['username'];

        // Delete the user from the database
        $delete_query = "DELETE FROM admin WHERE email = ?";
        
        if ($stmt = $conn->prepare($delete_query)) {
            // Bind the email parameter
            $stmt->bind_param("s", $email);
            
            // Execute the query
            if ($stmt->execute()) {
                $message = "$role $username has been deleted successfully.";
            } else {
                $message = "Error deleting user: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            $message = "Error: " . $conn->error;
        }
    } else {
        $message = "Error: No user found with the given email.";
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
    <title>Admin Dashboard - Delete User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="admin-dashboard">
            <h2>Admin Dashboard</h2>
            <div id="user-form-container">
                <h3>Delete User</h3>
                <!-- Form for deleting a user -->
                <form id="delete-user-form" method="POST" action="">
                    <input type="email" name="user-email" id="user-email" placeholder="Enter User Email" required>
                    <button type="submit">Delete User</button>
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
