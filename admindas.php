<?php
// Database connection
include 'db_connection.php'; // Include your database connection file

// Function to validate password strength
function validatePassword($password) {
    return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password); // At least one uppercase, one digit, one special char, and 8 chars
}

// Create New User
if (isset($_POST['create'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: create_user.php?error=email_exists");
        exit();
    } else {
        // Validate password
        if (!validatePassword($password)) {
            header("Location: create_user.php?error=invalid_password");
            exit();
        } else {
            // Hash password and insert new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

            if ($stmt->execute()) {
                header("Location: create_user.php?success=user_created");
                exit();
            } else {
                header("Location: create_user.php?error=general_error");
                exit();
            }
        }
    }
}

// Delete User
if (isset($_POST['delete'])) {
    $email_to_delete = $_POST['delete-email'];
    $role_to_delete = $_POST['delete-role'];

    // Delete user from the database
    $sql = "DELETE FROM users WHERE email = ? AND role = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email_to_delete, $role_to_delete);

    if ($stmt->execute()) {
        header("Location: delete_user.php?success=user_deleted");
        exit();
    } else {
        header("Location: delete_user.php?error=general_error");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #ad71c7, #cc746a);
            margin: 0;
        }

        /* Main Container */
        .container {
            width: 350px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        /* Heading */
        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        /* Input Fields & Select Dropdown */
        input, select {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
        }

        /* Hover Effects */
        input:hover, select:hover {
            border-color: #8e44ad;
            box-shadow: 0 0 8px rgba(142, 68, 173, 0.3);
        }

        /* Select Dropdown */
        select {
            background: white;
            cursor: pointer;
        }

        /* Button Styles */
        button {
            width: 100%;
            padding: 12px;
            background: #8e44ad;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        /* Button Hover */
        button:hover {
            background: #732d91;
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(142, 68, 173, 0.4);
        }
    </style>
</head>
<body>

<!-- Create New User Section -->
<div class="container" id="section-create">
    <h2>Create New User</h2>
    <form method="POST" id="create-user-form">
        <input type="text" name="username" placeholder="Username (at least 5 characters)" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password (8 characters, 1 uppercase, 1 special char)" required>
        <div>
            <label for="show-password">
                <input type="checkbox" id="show-password" onclick="togglePassword()"> Show Password
            </label>
        </div>
        <select name="role" required>
            <option value="" disabled selected>Select Role</option>
            <option value="editor">Editor</option>
            <option value="writer">Writer</option>
            <option value="ads-manager">Ads Manager</option>
        </select>
        <button type="submit" name="create">Create User</button>
    </form>
</div>

<!-- Delete User Section -->
<div class="container" id="section-delete" style="display:none;">
    <h2>Delete User</h2>
    <form method="POST" id="delete-user-form">
        <input type="email" name="delete-email" placeholder="Email to delete" required>
        <select name="delete-role" required>
            <option value="" disabled selected>Select Role</option>
            <option value="editor">Editor</option>
            <option value="writer">Writer</option>
            <option value="ads-manager">Ads Manager</option>
        </select>
        <button type="submit" name="delete">Delete User</button>
    </form>
</div>

<script>
    function togglePassword() {
        var passwordField = document.querySelector('input[name="password"]');
        var checkBox = document.getElementById("show-password");
        if (checkBox.checked) {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>

</body>
</html>
