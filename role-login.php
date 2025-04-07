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
    $stmt = $conn->prepare("SELECT id, username, password, role FROM stafflogincredential WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password, $db_role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            if (strtolower($db_role) === strtolower($role)) {
                // ✅ Set required session variables
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $db_role;
                $_SESSION['email'] = $email; // ✅ This fixes the redirect issue

                // Redirect based on role
                switch (strtolower($role)) {
                    case "ads manager":
                        header("Location: ../nepnews/AdsManager/ads.html");
                        exit();
                    case "editor":
                        header("Location: editor.php");
                        exit();
                    case "writer":
                        header("Location: category.php");
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
    <link rel="stylesheet" href="styles.css"> <!-- Link your CSS file if any -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 400px;
            margin: 10% auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        input, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            border: none;
            color: #fff;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Staff Sign In</h2>
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
