<?php
session_start();
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Either 'writer' or 'editor'

    // Hash the password before storing it for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if username already exists
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $error = "Username already exists!";
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', '$role')";
        if ($conn->query($sql) === TRUE) {
            $success = "Registration successful! You can now log in.";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>User Registration</h1>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <select name="role" required>
                <option value="writer">Writer</option>
                <option value="editor">Editor</option>
            </select><br>
            <button type="submit">Register</button>
        </form>
        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
        <?php if (isset($success)) { echo "<p style='color:green;'>$success</p>"; } ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
