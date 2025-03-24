<?php
session_start();

// Database connection
$host = 'localhost'; 
$username = 'root';  
$password = '';      
$dbname = 'nepnews';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Handle Login Request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Prepare and execute query
    $stmt = $conn->prepare("SELECT id, username, password, role FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password, $db_role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            if (strtolower($db_role) === strtolower($role)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $db_role;

                // Redirect based on role
                switch (strtolower($role)) {
                    case "ads manager":
                        header("Location: ads-manager-dashboard.html");
                        exit();
                    case "editor":
                        header("Location: editor-dashboard.html");
                        exit();
                    case "writer":
                        header("Location: writer-dashboard.html");
                        exit();
                    default:
                        echo "<script>alert('Invalid role selected.');</script>";
                }
            } else {
                echo "<script>alert('Role mismatch. Please select the correct role.');</script>";
            }
        } else {
            echo "<script>alert('Incorrect password. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('No account found with this email.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Sign In</h2>
            <form id="roles-login-form" method="POST" action="">
                <input type="email" name="email" id="login-email" placeholder="Email" required>
                <input type="password" name="password" id="login-password" placeholder="Password" required>

                <select name="role" id="role-selection" required>
                    <option value="" disabled selected>Select Your Role</option>
                    <option value="Ads Manager">Ads Manager</option>
                    <option value="Editor">Editor</option>
                    <option value="Writer">Writer</option>
                </select>

                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>
</body>
</html>
