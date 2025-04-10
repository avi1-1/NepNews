<?php
include('db.php');

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    // Toggle status between published and draft
    $new_status = ($status == 'published') ? 'draft' : 'published';

    $query = mysqli_query($conn, "UPDATE news SET status='$new_status' WHERE id='$id'");

    if ($query) {
        header("Location: editor.php");
    } else {
        echo "<script>alert('Failed to update status. Try again!')</script>";
    }
}
?>
