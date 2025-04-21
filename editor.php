<?php
session_start();
if ($_SESSION['email'] == true) {
    // code...
} else {
    header('location:login.php');
}

$page = 'editor';
include('editorheader.php');
?>

<style>
/* General Styling */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
    color: #495057;
}

.container {
    width: 85%;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    margin: 30px auto;
}

h1 {
    text-align: center;
    color: #333;
}

h4 {
    color: #007bff;
}

/* News Card Layout */
.card {
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
}

.card-header {
    font-weight: bold;
    font-size: 1.2em;
    color: #333;
}

.card-body {
    padding-top: 10px;
}

.card-footer {
    text-align: right;
}

/* Buttons */
.btn {
    padding: 8px 16px;
    border-radius: 5px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.btn-success {
    background-color: #28a745;
    color: white;
    border: none;
}

.btn-success:hover {
    background-color: #218838;
}

.btn-warning {
    background-color: #ffc107;
    color: white;
    border: none;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.btn-info {
    background-color: #17a2b8;
    color: white;
    border: none;
}

.btn-info:hover {
    background-color: #138496;
}

.btn-danger {
    background-color: #dc3545;
    color: white;
    border: none;
}

.btn-danger:hover {
    background-color: #c82333;
}

/* Table Styling */
.table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
    font-size: 14px;
}

th {
    background-color: #f8f9fa;
    color: #495057;
}

tr:hover {
    background-color: #f1f1f1;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    list-style: none;
    padding: 10px 0;
}

.pagination li {
    margin: 5px;
}

.pagination .page-link {
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    text-decoration: none;
    color: #007bff;
    transition: 0.3s;
}

.pagination .page-link:hover {
    background-color: #007bff;
    color: white;
}

.pagination .page-item.disabled .page-link {
    color: gray;
    pointer-events: none;
}

.pagination .page-item.active .page-link {
    background-color: #007bff;
    color: white;
}

.pagination .page-item.active .page-link:hover {
    background-color: #0056b3;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        width: 95%;
    }

    .pagination {
        flex-wrap: wrap;
    }
}
</style>

<div class="container">
    <h1>Editor Portal</h1>
    <hr>

    <!-- Display count of published posts -->
    <h4>Total Published News: 
        <?php
        include('db.php');
        // Query to count the number of published posts
        $count_published = mysqli_query($conn, "SELECT COUNT(*) FROM news WHERE status='published'");
        $row = mysqli_fetch_row($count_published);
        echo $row[0]; // Display the count of published news
        ?>
    </h4>

    <!-- Loop through the fetched news items and display them in cards -->
    <?php
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Use ternary operator to check if page is set
  if ($page == "" || $page == 1) {
      $page1 = 0;
  } else {
      $page1 = ($page * 3) - 3;
  }

    $query = mysqli_query($conn, "SELECT * FROM news LIMIT $page1,3");
    while ($row = mysqli_fetch_array($query)) {
    ?>
        <div class="card">
            <div class="card-header">
                <?php echo $row['title']; ?>
            </div>
            <div class="card-body">
                <p><?php echo substr($row['description'], 0, 100); ?>...</p>
                <p><strong>Category:</strong> <?php echo $row['category']; ?></p>
                <p><strong>Status:</strong> <?php echo ucfirst($row['status']); ?></p>
                <p><strong>Admin:</strong> <?php echo $row['admin']; ?></p>
                <img src="images/<?php echo $row['thumbnail']; ?>" alt="" class="img-thumbnail" width="150">
            </div>
            <div class="card-footer">
                <a href="update_status.php?id=<?php echo $row['id']; ?>&status=<?php echo $row['status'] == 'published' ? 'draft' : 'published'; ?>" class="btn <?php echo $row['status'] == 'published' ? 'btn-warning' : 'btn-success'; ?>">
                    <?php echo $row['status'] == 'published' ? 'Set to Draft' : 'Publish'; ?>
                </a>
                <a href="editoredit.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                <a href="editordelete.php?del=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
            </div>
        </div>
    <?php } ?>

    <!-- Pagination -->
    <ul class="pagination">
        <li class="page-item disabled">
            <a href="#" class="page-link">Previous</a>
        </li>
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM news");
        $count = mysqli_num_rows($sql);
        $a = ceil($count / 3);
        for ($b = 1; $b <= $a; $b++) {
        ?>
            <li class="page-item <?php echo ($b == $page) ? 'active' : ''; ?>"><a class="page-link" href="editor.php?page=<?php echo $b; ?>"><?php echo $b; ?></a></li>
        <?php } ?>
        <li class="page-item disabled">
            <a href="#" class="page-link">Next</a>
        </li>
    </ul>

</div>

<?php
include('footer.php');
?>
