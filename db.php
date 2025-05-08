<?php
$conn = mysqli_connect("localhost", "root", "", "nepnews");

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
