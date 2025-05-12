<?php
session_start();
if ( $_SESSION['email']==true) {
  # code...
}else
header('location:role-login.php');
$page='category';
include('header.php');
?>

<style>
/* General Styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 50%;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 5% auto;
}

h1 {
    text-align: center;
    color: #333;
}

/* Form Styling */
form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    color: #555;
}

input[type="text"], textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

textarea {
    resize: none;
}

/* Button Styling */
.btn-primary {
    background: #28a745;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: 0.3s;
    width: 100%;
    text-align: center;
}

.btn-primary:hover {
    background: #218838;
}
</style>

<div class="container">
    <h1>Add Categories</h1>
    <hr>
    <form action="addcategory.php" method="post" name="categoryform" onsubmit="return validateform()">
        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" placeholder="Enter Category Name" name="category" class="form-control" id="category">
        </div>
        <div class="form-group">
            <label for="comment">Description:</label>
            <textarea class="form-control" placeholder="Enter Category Description" rows="4" name="des" id="comment"></textarea>
        </div>
        <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
    </form>
    <script>
        function validateform(){
            var x = document.forms['categoryform']['category'].value;
            if (x == "") {
                alert('Category Must Be Filled Out!');
                return false;
            }
        }
    </script>
</div>

<?php
include('footer.php');
?>

<?php
include('db.php');

if (isset($_POST['submit'])) {
    $category_name = $_POST['category'];
    $des = $_POST['des'];

    $cheak = mysqli_query($conn, "SELECT * FROM category WHERE category_name='$category_name'");

    if (mysqli_num_rows($cheak) > 0) {
        echo "<script> alert('Category Name Already Taken!')</script>";
        exit();
    }

    $query = mysqli_query($conn, "INSERT INTO category(category_name, des) VALUES ('$category_name', '$des')");

    if ($query) {
        echo "<script> alert('Category Added Successfully')</script>";
    } else {
        echo "<script> alert('Please try Again')</script>";
    }
}
?>