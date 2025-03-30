<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'writer') {
    header('Location: login.php');
    exit;
}

$author = $_SESSION['username'];
$message = "";

// Handle article submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    // Sanitize inputs
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $date_added = !empty($_POST['date_added']) ? $_POST['date_added'] : date("Y-m-d H:i:s");

    // Image upload processing
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Get file info
        $filename = basename($_FILES['image']['name']);
        $targetDir = "uploads/";
        $targetFile = $targetDir . time() . "_" . $filename; // Prefix with time() for uniqueness
        
        // Validate file type (e.g., images only)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            // Move the uploaded file to the uploads folder
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $image = $conn->real_escape_string($targetFile); // Store the relative path in the database
            } else {
                $message = "Error uploading image.";
            }
        } else {
            $message = "Invalid image type. Only JPG, PNG, or GIF allowed.";
        }
    }

    // Insert article into the database
    $sql = "INSERT INTO articles (title, content, image, author, date_added) VALUES ('$title', '$content', '$image', '$author', '$date_added')";
    if ($conn->query($sql) === TRUE) {
        $message = "New article added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Fetch articles by the logged-in writer
$sql = "SELECT * FROM articles WHERE author='$author' ORDER BY date_added DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Writer Dashboard</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    /* Inline styles for demo purposes - move to style.css in production */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f5f5f5;
    }
    .dashboard-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #0d6efd;
      padding: 1rem 2rem;
      color: #fff;
    }
    .dashboard-header h1 {
      margin: 0;
      font-size: 1.5rem;
    }
    .btn {
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .primary-btn {
      background-color: #28a745;
      color: #fff;
    }
    .dashboard-container {
      padding: 2rem;
    }
    .search-filter-bar {
      display: flex;
      justify-content: space-between;
      margin-bottom: 1.5rem;
    }
    .search-input {
      flex: 1;
      padding: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-right: 1rem;
    }
    .filter-btn {
      background-color: #6c757d;
      color: #fff;
    }
    .tabs {
      display: flex;
      border-bottom: 1px solid #ccc;
      margin-bottom: 1.5rem;
    }
    .tab {
      padding: 0.75rem 1.5rem;
      background: none;
      border: none;
      cursor: pointer;
      font-size: 1rem;
      color: #333;
    }
    .tab.active {
      border-bottom: 3px solid #0d6efd;
      font-weight: bold;
      color: #0d6efd;
    }
    /* Article form */
    .article-form {
      background: #fff;
      padding: 1.5rem;
      border-radius: 8px;
      margin-bottom: 2rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      display: none; /* hidden by default */
    }
    .article-form input[type="text"],
    .article-form textarea,
    .article-form input[type="date"],
    .article-form input[type="file"] {
      width: 100%;
      padding: 0.75rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    /* Articles grid */
    .articles-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 1.5rem;
    }
    .article-card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
      overflow: hidden;
    }
    .card-header, .card-footer {
      padding: 1rem;
      background: #f8f9fa;
    }
    .card-header h2 {
      margin: 0 0 0.5rem 0;
      font-size: 1.25rem;
      color: #333;
    }
    .date {
      font-size: 0.85rem;
      color: #888;
    }
    .card-body {
      padding: 1rem;
      flex: 1;
    }
    .card-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .card-actions button {
      margin-left: 0.5rem;
      background: none;
      border: none;
      color: #0d6efd;
      cursor: pointer;
      font-size: 0.9rem;
    }
    /* Message styling */
    .message {
      margin-bottom: 1rem;
      padding: 0.5rem;
      border: 1px solid #28a745;
      background-color: #d4edda;
      color: #155724;
      border-radius: 4px;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header class="dashboard-header">
    <h1>Writer Portal</h1>
    <button class="btn primary-btn" id="toggleFormBtn">Create New Article</button>
  </header>

  <!-- Main Container -->
  <main class="dashboard-container">
    <!-- Optional Search and Filter Section -->
    <div class="search-filter-bar">
      <input type="text" class="search-input" placeholder="Search articles..." />
      <button class="btn filter-btn">Filter</button>
    </div>

    <!-- Article Submission Form -->
    <section id="articleForm" class="article-form">
      <?php
      if (!empty($message)) {
          echo "<div class='message'>$message</div>";
      }
      ?>
      <form action="writer_dashboard.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Article Title" required>
        <textarea name="content" placeholder="Article Description" rows="5" required></textarea>
        <input type="file" name="image" accept="image/*">
        <input type="date" name="date_added" value="<?php echo date('Y-m-d'); ?>" required>
        <input type="hidden" name="action" value="add">
        <button type="submit" class="btn primary-btn">Submit Article</button>
      </form>
    </section>

    <!-- Articles Grid -->
    <section class="articles-grid">
      <?php
      if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<article class='article-card'>";
              echo "<header class='card-header'>";
              echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
              echo "<span class='date'>Added on: " . htmlspecialchars($row['date_added']) . "</span>";
              echo "</header>";
              echo "<div class='card-body'>";
              echo "<p>" . htmlspecialchars($row['content']) . "</p>";
              // Display image if available
              if (!empty($row['image'])) {
                  echo "<img src='uploads/" . htmlspecialchars($row['image']) . "' alt='Article Image' style='max-width:100%; height:auto; margin-top:1rem;'/>";
              }
              echo "</div>";
              echo "<footer class='card-footer'>";
              // For simplicity, the status is hardcoded as "Published"
              echo "<span>Published</span>";
              echo "<div class='card-actions'>";
              echo "<button>Edit</button>";
              echo "<button>Delete</button>";
              echo "</div>";
              echo "</footer>";
              echo "</article>";
          }
      } else {
          echo "<p>No articles found.</p>";
      }
      ?>
    </section>
  </main>

  <script>
    // Toggle Article Form Visibility
    const toggleFormBtn = document.getElementById('toggleFormBtn');
    const articleForm = document.getElementById('articleForm');
    toggleFormBtn.addEventListener('click', function () {
      articleForm.style.display = articleForm.style.display === 'none' || articleForm.style.display === '' ? 'block' : 'none';
    });
  </script>
</body>
</html>
