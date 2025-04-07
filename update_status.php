<?php
include('db.php');

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = (int)$_GET['id'];
    $status = $_GET['status'];

    if ($status === 'published' || $status === 'draft') {
        $update = mysqli_query($conn, "UPDATE news SET status='$status' WHERE id=$id");
    }
}

header("Location: editor.php");
exit();
