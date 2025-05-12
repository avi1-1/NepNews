<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('db.php');

if (isset($_GET['del'])) {
    $id = intval($_GET['del']); // sanitize

    // Debugging: echo the ID
    echo "Trying to delete ID: $id<br>";

    // Check if ID exists first
    $check = mysqli_query($conn, "SELECT * FROM news WHERE id = $id");
    if (mysqli_num_rows($check) == 0) {
        die("No news found with ID: $id");
    }

    // Run delete query
    $query = mysqli_query($conn, "DELETE FROM news WHERE id = $id");

    if ($query) {
        echo "Deleted successfully. <a href='editor.php'>Back</a>";
        exit;
    } else {
        die("Delete failed: " . mysqli_error($conn));
    }
} else {
    die("No ID received via GET");
}
?>