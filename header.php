<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Writer Dashboard</title>
  <link rel="stylesheet" href="dashboard.css">
  
</head>
<body>
  <!-- Sidebar -->
  <div class="hamburger" id="hamburger">&#9776;</div>

  <div id="sidebar" class="sidebar">
    <h2>Writer Dashboard</h2>
    <ul>
    <li class="nav-item">
                <a class="nav-link  <?php if($page=='category'){echo 'active';} ?>  " href="category.php">
                  <span data-feather="users"></span>
                  Categories
                </a>
              </li>
              <li class="nav-item active">
                <a class="nav-link <?php if($page=='news'){echo 'active';} ?> " href="news.php">
                  <span data-feather="shopping-cart"></span>
                  Add News
                </a>
      </li>
    
  </div>

  <script>
    // Sidebar toggle
    document.addEventListener("DOMContentLoaded", function () {
      const hamburger = document.getElementById("hamburger");
      const sidebar = document.getElementById("sidebar");

      hamburger.addEventListener("click", function () {
        sidebar.classList.toggle("collapsed");
        this.classList.toggle("active"); // Toggle color on click
      });
    });
  </script>
</body>
</html>
