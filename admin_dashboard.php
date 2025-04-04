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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>NepNews | Admin Dashboard</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      margin: 0;
      display: flex;
      height: 100vh;
      overflow: auto;
      background-color: #f4f6f9;
    }

    .sidebar {
      width: 240px;
      background-color: #2c3e50;
      color: white;
      padding: 20px;
      transition: width 0.3s ease;
      overflow-x: hidden;
    }

    .sidebar.collapsed {
      width: 0;
      padding: 0;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .sidebar ul li {
      margin: 20px 0;
    }

    .sidebar ul li a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      display: block;
      padding: 10px;
      border-radius: 5px;
      transition: background-color 0.3s, transform 0.2s;
    }

    .sidebar ul li a:hover,
    .sidebar ul li a.active {
      background-color: #45a049; /* Green color when active */
      color: #fff;
      transform: translateX(10px); /* Slide effect */
    }

    .content {
      flex-grow: 1;
      padding: 30px;
      transition: margin-left 0.3s ease;
      width: 100%;
      overflow-y: auto; /* Allow vertical scrolling for content */

    }

    .hamburger {
      font-size: 24px;
      position: inline;
      top: 20px;
      left: 20px;
      cursor: pointer;
      background-color: #2c3e50;
      color: white;
      padding: 10px 15px;
      border-radius: 5px;
      z-index: 1000;
    }

    .form-container,
    .table-container {
      background: #fff;
      border-radius: 8px;
      padding: 20px;
      margin-top: 30px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: box-shadow 0.3s ease;
    }

    .form-container:hover,
    .table-container:hover {
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .form-container h2,
    .table-container h2 {
      margin-bottom: 15px;
      color: #2c3e50;
    }

    form {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
    }

    .form-field {
      width: 100%;
      max-width: 300px;
      display: flex;
      flex-direction: column;
    }

    label {
      font-size: 14px;
      margin-bottom: 5px;
      color: #2c3e50;
      font-weight: 600;
    }

    input, select, button {
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 14px;
      width: 100%;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    button {
      background-color: #27ae60;
      color: white;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #46d0da;
    }

    input:focus, select:focus, button:focus {
      border-color: #45a049; /* Green border when focused */
      box-shadow: 0 0 10px rgba(72, 187, 120, 0.6); /* Light green glow effect */
    }

    .eye-icon {
      position: absolute;
      right: 5px;
      top: 27%;
      cursor: pointer;
      font-size: 18px;
      padding: 10px;
      color: #848484; /* Darker color for the visibility icon */
    }

    .password-field {
      position: relative;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      text-align: left;
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f9fafb;
    }

    tr:hover {
      background-color: #f1f1f1; /* Row highlight on hover */
    }

    .delete-btn {
      background-color: #e74c3c;
      color: white;
      padding: 5px 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .delete-btn:hover {
      background-color: #c0392b;
    }

    .error {
      color: red;
      font-size: 12px;
    }

    @media screen and (max-width: 768px) {
      .content {
        padding: 20px;
      }

      .form-container,
      .table-container {
        padding: 15px;
      }
    }

    /* Hover effect for input fields */
    input:hover, select:hover {
      border-color: #2ecc71; /* Green color on hover */
      box-shadow: 0 0 8px rgba(46, 204, 113, 0.6); /* Light green glow effect */
    }
  </style>
</head>
<body>
  <div class="hamburger" id="hamburger">&#9776;</div>
  
  <div class="sidebar" id="sidebar">
    <h2>NepNews Admin</h2>
    <ul>
      <li><a href="#" id="menu-create">Create User</a></li>
      <li><a href="#" id="menu-delete">Delete User</a></li>
    </ul>
  </div>
  
  <div class="content" id="main-content">
    <h1>Welcome, Admin</h1>
    
    <!-- Create New User Section -->
    <div class="form-container" id="section-create">
      <h2>Create New User</h2>
      <form id="create-user-form" method="POST" action="admin_dashboard.php">
        <div class="form-field">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Email Address" required>
        </div>
      
        <div class="form-field">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Username" required>
        </div>
      
        <div class="form-field password-field">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Password" required>
          <i class="eye-icon fas fa-eye" id="eye-icon" onclick="togglePassword()"></i>
        </div>
      
        <div class="form-field">
          <label for="role">Role</label>
          <select id="role" name="role" required>
            <option value="" disabled selected>Select Role</option>
            <option value="editor">Editor</option>
            <option value="writer">Writer</option>
            <option value="ads-manager">Ads Manager</option>
          </select>
        </div>
      
        <button type="submit">Create User</button>
      </form>

      
    </div>
    
    <!-- Delete User Section -->
    <div class="form-container" id="section-delete" style="display:none;">
      <h2>Delete User</h2>
      <form id="delete-user-form">
        <div class="form-field">
          <label for="delete-email">Email</label>
          <input type="email" id="delete-email" placeholder="Email Address to delete" required>
        </div>
        <div class="form-field">
          <label for="delete-role">Role</label>
          <select id="delete-role" required>
            <option value="" disabled selected>Select Role</option>
            <option value="editor">Editor</option>
            <option value="writer">Writer</option>
            <option value="ads-manager">Ads Manager</option>
          </select>
        </div>
        <button type="submit">Delete User</button>
      </form>
    </div>
    
    <!-- User Table -->
    <div class="table-container">
      <h2>User Table</h2>
      <table id="user-table">
        <thead>
          <tr>
            <th>Email</th>
            <th>Username</th>
            <th>Role</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>

  <script>
    const hamburger = document.getElementById("hamburger");
    const sidebar = document.getElementById("sidebar");
    
    hamburger.addEventListener("click", function () {
      sidebar.classList.toggle("collapsed");
    });
    
    document.getElementById("menu-create").addEventListener("click", function () {
      document.getElementById("section-create").style.display = "block";
      document.getElementById("section-delete").style.display = "none";
    });
    
    document.getElementById("menu-delete").addEventListener("click", function () {
      document.getElementById("section-create").style.display = "none";
      document.getElementById("section-delete").style.display = "block";
    });
    
    function togglePassword() {
      const passwordInput = document.getElementById("password");
      const eyeIcon = document.getElementById("eye-icon");
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
      } else {
        passwordInput.type = "password";
        eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
      }
    }
    
    document.getElementById("create-user-form").addEventListener("submit", function (e) {
      e.preventDefault();
      
      const email = document.getElementById("email").value;
      const username = document.getElementById("username").value;
      const role = document.getElementById("role").value;
      
      const tbody = document.getElementById("user-table").getElementsByTagName("tbody")[0];
      const rows = tbody.getElementsByTagName("tr");
      
      for (let row of rows) {
        if (row.cells[0].textContent === email) {
          alert("This email is already registered.");
          return;
        }
      }
      
      const row = tbody.insertRow();
      row.innerHTML = `<td>${email}</td><td>${username}</td><td>${role}</td>`;
      
      document.getElementById("create-user-form").reset();
      alert(`User Created Successfully! ${username} is now a ${role}.`);
    });
    
    document.getElementById("delete-user-form").addEventListener("submit", function (e) {
      e.preventDefault();
      
      const deleteEmail = document.getElementById("delete-email").value;
      const deleteRole = document.getElementById("delete-role").value;
      const tbody = document.getElementById("user-table").getElementsByTagName("tbody")[0];
      
      let userDeleted = false;
      for (let i = 0; i < tbody.rows.length; i++) {
        let row = tbody.rows[i];
        if (row.cells[0].textContent === deleteEmail && row.cells[2].textContent === deleteRole) {
          if (confirm(`Are you sure you want to delete ${deleteEmail}?`)) {
            row.remove();
            userDeleted = true;
          }
          break;
        }
      }
      
      if (userDeleted) {
        alert("User deleted successfully.");
      } else {
        alert("User not found.");
      }
      
      document.getElementById("delete-user-form").reset();
    });
  </script>
</body>
</html>