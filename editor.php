<?php
session_start();
// if ($_SESSION['email'] == true) {
// } else {
//     header('Location: ../role-login.php');
//     exit();
// }

$page = 'editor';
include('editorheader.php');
include('db.php');

// Get filter
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$pageNum = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page1 = ($pageNum > 1) ? ($pageNum * 3) - 3 : 0;
?>

<style>
/* --- YOUR EXISTING CSS (unchanged) --- */
/* Paste your full CSS code here exactly as you did above */
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
.filter-btn {
    color: white;
    background-color: #6c757d; /* default gray background */
    border: none;
}
.filter-btn:hover {
    opacity: 0.9;
}

.active-filter {
    background-color: #ffc107 !important; /* yellow background */
    color: black !important;
}
/* Filter Buttons Styling */
.filter-btn {
    color: white;
    background-color: #6c757d;
    border: none;
    margin: 0 10px;
    text-decoration: none;
}
.filter-btn:hover {
    opacity: 0.9;
}

.active-filter {
    background-color: #ffc107 !important;
    color: black !important;
}

/* Centering filter buttons */
.filter-container {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

</style>

<div class="container">
    <h1>Editor Portal</h1>
    <hr>

    <h4>Total Published News:
        <?php
        $count_published = mysqli_query($conn, "SELECT COUNT(*) FROM news WHERE status='published'");
        $row = mysqli_fetch_row($count_published);
        echo $row[0];
        ?>
    </h4>

    <!-- Filter Buttons -->
     
    <!-- Filter Buttons -->
<div class="filter-container">
    <a href="editor.php?filter=all" class="btn filter-btn <?php echo $filter == 'all' ? 'active-filter' : ''; ?>">All News</a>
    <a href="editor.php?filter=draft" class="btn filter-btn <?php echo $filter == 'draft' ? 'active-filter' : ''; ?>">Draft News</a>
    <a href="editor.php?filter=published" class="btn filter-btn <?php echo $filter == 'published' ? 'active-filter' : ''; ?>">Published News</a>
</div>



    <?php
    // Build filtered query
    if ($filter == 'draft') {
        $sql = "SELECT * FROM news WHERE status='draft'";
    } elseif ($filter == 'published') {
        $sql = "SELECT * FROM news WHERE status='published'";
    } else {
        $sql = "SELECT * FROM news";
    }

    // Fetch data for current page
    $query = mysqli_query($conn, $sql . " ORDER BY id DESC LIMIT $page1, 3");
    $count_all = mysqli_query($conn, $sql);
    $total = mysqli_num_rows($count_all);

    if (mysqli_num_rows($query) == 0) {
        echo "<p>No news found.</p>";
    }

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
        <?php
        $total_pages = ceil($total / 3);
        for ($i = 1; $i <= $total_pages; $i++) {
            $active = ($i == $pageNum) ? 'active' : '';
            echo "<li class='page-item $active'><a class='page-link' href='editor.php?filter=$filter&page=$i'>$i</a></li>";
        }
        ?>
    </ul>
</div>

<?php include('footer.php'); ?>
