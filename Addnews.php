<?php
session_start();
if ($_SESSION['email'] == true) {
    // code...
} else {
    header('location:role-login.php');
}
$page = 'product';
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
    height: fit-content;
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

.breadcrumb {
    list-style-type: none;
    padding: 0;
    margin: 0;
    display: flex;
}

.breadcrumb-item {
    display: inline;
}

.breadcrumb-item a {
    text-decoration: none;
    color: #000;
}

.breadcrumb-item a:hover {
    color: #007BFF;
}

/* Add '|' separator after each item except the last one */
.breadcrumb-item:not(:last-child)::after {
    content: ' |';
    margin-left: 10px;
}

/* Optional: Style the active item */
.breadcrumb-item.active {
    font-weight: bold;
    color: #333;
}
</style>

<div class="container">
    <div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item active"><a href="news.php">Home</a></li>
            <li class="breadcrumb-item active"><a href="news.php">News</a></li>
            <li class="breadcrumb-item active">Add News</li>
        </ul>
    </div>
    <h1>Add News</h1>
    <hr>
    <form action="Addnews.php" method="post" enctype="multipart/form-data" name="categoryform" onsubmit="return validateform()">
        <div class="form-group">
            <label for="category">Title:</label>
            <input type="text" placeholder="Enter Title Name" name="title" class="form-control" id="title">
        </div>
        <div class="form-group">
            <label for="comment">Description:</label>
            <textarea class="form-control" placeholder="Description......." rows="4" name="description" id="description"></textarea>
        </div>
        <div class="form-group">
            <label for="category">Date:</label>
            <input type="date"  name="date" class="form-control" id="date">
        </div>
        <div class="form-group">
            <label for="category">Thumbnail:</label>
            <input type="file"  name="thumbnail" class="form-control img-thumbnail" id="thumbnail">
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select class="form-control" name="category">
                <?php
                include('db.php');
                $query = mysqli_query($conn, "SELECT * FROM category");

                while ($row = mysqli_fetch_array($query)) {
                    $category = $row['category_name'];
                ?>
                    <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="admin">Admin</label>
            <input type="text" class="form-control" disabled value="<?php echo $_SESSION['email'];  ?> ">
        </div>
        <input type="submit" name="submit" class="btn btn-primary" value="Add News">
    </form>
    <script>
        function validateform() {
            var x = document.forms['categoryform']['title'].value;
            var y = document.forms['categoryform']['description'].value;
            var z = document.forms['categoryform']['date'].value;
            var w = document.forms['categoryform']['category'].value;
            if (x == "") {
                alert('Title Must Be Filled Out!');
                return false;
            }
            if (y == "") {
                alert('Description Must Be Filled Out!');
                return false;
            }
            if (y.length < 10) {
                alert('Description At least 10 characters!');
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
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $thumbnail = $_FILES['thumbnail']['name'];
    $tmp_thumbnail = $_FILES['thumbnail']['tmp_name'];
    $category = $_POST['category'];
    $admin = $_SESSION['email'];

    // Define the directory where the image will be uploaded
    $upload_dir = "images/";
    $upload_path = $upload_dir . $thumbnail;

    // Check if the file already exists in the directory
    if (file_exists($upload_path)) {
        // If the file already exists, skip uploading or show an error
        echo "<script>alert('Image already exists. Please upload a different image.');</script>";
    } else {
        // If the file does not exist, move the uploaded file to the desired directory
        if (move_uploaded_file($tmp_thumbnail, $upload_path)) {
            // Insert the news data into the database with status set to 'draft'
            $query1 = mysqli_query($conn, "INSERT INTO news(title, description, date, category, thumbnail, admin, status) VALUES ('$title', '$description', '$date', '$category', '$thumbnail', '$admin', 'draft')");

            if ($query1) {
                echo "<script>alert('News uploaded successfully!');</script>";
            } else {
                echo "<script>alert('Please try again!');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload image. Please try again!');</script>";
        }
    }
}
?>
