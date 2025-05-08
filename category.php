<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['email'] == false) {
    header('Location: role-login.php');
    exit();
}

$page = 'category';
include('header.php');
?>

<style>
    body {
    background: #f8f9fa; /* or any plain color */
    margin: 0;
    padding: 0;
}

    /* body {
        font-family: Arial, sans-serif;
        margin: 20px;
    } */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f4f4f4;
        font-weight: bold;
    }
    .btn {
        padding: 8px 12px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        color: white;
        text-transform: capitalize;
    }
    .btn-info {
        background-color: #17a2b8;
    }
    .btn-danger {
        background-color: #dc3545;
    }
    .btn-primary {
        background-color: #007bff;
        padding: 10px 15px;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 10px;
    }
    .container {
    background: none !important;
}

    body, html {
    background: none !important;
}
.main-content {
    width: 100%;
    overflow-x: hidden;
}
.clearfix::after {
    content: "";
    display: block;
    clear: both;
}
.row {
    margin-left: 0 !important;
    margin-right: 0 !important;
}


  /* Responsive Design */
  @media screen and (max-width: 768px) {
        .container {
            width: 90%;
            padding-top: 10%;
        }
        table {
            font-size: 14px;
        }
        .btn {
            padding: 5px 8px;
            font-size: 12px;
        }
    }
</style>

<div style="width: 70%; margin-left: 5%; margin-top: 10%">
    <div class="text-right">
        <a class="btn btn-primary" href="addcategory.php">Add Category</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('db.php');
            
            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("SELECT id, category_name, des FROM category");
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                    <td><?php echo htmlspecialchars(substr($row['des'], 0, 200)); ?><?php echo (strlen($row['des']) > 200) ? '...' : ''; ?></td>
                    <td><a href="edit.php?edit=<?php echo urlencode($row['id']); ?>" class="btn btn-info">Edit</a></td>
                    <td><a href="delete.php?del=<?php echo urlencode($row['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
include('footer.php');
?>
