<?php
session_start();
if ($_SESSION['email'] == true) {
    // code...
} else {
    header('location:login.php');
}
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
    text-decoration: none;  /* Removes the underline from the links */
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
    color: #333; /* Optional: Change color for active item */
}
</style>

<?php
include('db.php');

$id=$_GET['edit'];
$query=mysqli_query($conn,"select * from news where id ='$id' ");
 while ($row=mysqli_fetch_array($query)) {
    $id=$row['id'];
     $title=$row['title'];
      $description=$row['description'];
       $date=$row['date'];
        $thumbnail=$row['thumbnail'];
         $category=$row['category'];


     # code...
 }
?>

<div class="container">
    <div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item active"><a href="news.php">Home</a></li>
            <li class="breadcrumb-item active"><a href="news.php">News</a></li>
            <li class="breadcrumb-item active">Add News</li>
        </ul>
    </div>
    <h1>Update News</h1>
    <hr>
    <form action="news_edit.php" method="post" enctype="multipart/form-data" name="categoryform" onsubmit="return validateform()">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="form-group">
            <label for="category">Title:</label>
            <input type="text" value="<?php echo $title; ?>" placeholder="Enter Title Name" name="title" class="form-control" id="category">
        </div>
        <div class="form-group">
            <label for="comment">Description:</label>
            <textarea class="form-control"  placeholder="Description......." cols="10" rows="10" name="description" id="comment"><?php echo $description; ?></textarea>
        </div>
		<div class="form-group">
            <label for="category">Date:</label>
            <input type="date"  name="date" value="<?php echo $date?>" class="form-control" id="category">
        </div>
		<div class="form-group">
            <label for="category">Thumbnail:</label>
            <input type="file"  name="thumbnail" value="<?php echo $thumbnail?>" class="form-control img-thumbnail" id="email">
            <img class="img img-thumbnail" src="images/<?php echo $thumbnail; ?>" alt="" width="300" >
        </div>
		<div class="form-group">
    <label for="category">Category:</label>
    <select class="form-control" name="category">
        <?php
        include('db.php'); // Ensure this file contains a valid database connection

        $query = mysqli_query($conn, "SELECT * FROM category"); // Execute the query

        while ($row = mysqli_fetch_array($query)) {
            $category = $row['category_name']; // Fetch category name correctly
        ?>
            <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
        <?php } ?>
    </select>
</div>

        <input type="submit" name="submit" class="btn btn-primary" value="Update">
    </form>
    <script>
         function validateform(){
         var x = document.forms['categoryform']['title'].value;
         var y = document.forms['categoryform']['description'].value;
         var z = document.forms['categoryform']['date'].value;
         var w = document.forms['categoryform']['category'].value;
         if (x=="") {
          	alert('Title Must Be Filled Out !');
          	return false;
          }
          if (y=="") {
          	alert('Description Must Be Filled Out !');
          	return false;
          }
           if (y.length<10) {
          	alert('Description Atleast 100 character !');
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

include('db.php');
if (isset($_POST['submit'])) {
	$id=$_POST['id'];
	$title=$_POST['title'];
	$description=$_POST['description'];
		$date=$_POST['date'];
			$thumbnail=$_FILES['thumbnail']['name'];
			$tmp_thumbnail=$_FILES['thumbnail']['tmp_name'];
				$category=$_POST['category'];

			move_uploaded_file($tmp_thumbnail,"images/$thumbnail");

	$sql= mysqli_query($conn,"update news set title='$title', description='$description' , date='$date' , thumbnail='$thumbnail' , category='$category' where id='$id' ");
	if ($sql) {
		 echo "<script>alert('News update Successfully !!')</script>  ";
		 echo "<script >window.location='http://localhost/nepnews/news.php' ;</script>";
	} else{
		echo "<script>alert('Please try again !!')</script>  ";
	}
			

}


?>