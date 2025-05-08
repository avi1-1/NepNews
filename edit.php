<?php
session_start();
error_reporting(0);
if ( $_SESSION['email']==true) {
  # code...
}else
header('location:role-login.php');
$page='category';
 include('header.php');

  ?>

  <?php
 include('db.php');
  $id=$_GET['edit'];

  $query=mysqli_query($conn,"select * from category where id='$id' ");

 while ($row=mysqli_fetch_array($query)) {
 	 $category=$row['category_name'];
  	 $des=$row['des'];

 }
 

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


  <div style=" width: 70%; margin-left: 25%; margin-top: 10%">
  	   
  	
		<form action="edit.php" method="post" name="categoryform" onsubmit=" return validateform() ">
			<h1>Update Category</h1>
			<hr>
		  <div class="form-group">
		    <label for="email"> Category:</label>
		    <input type="text" name="category" value="<?php  echo $category;  ?>" class="form-control" id="email">
		  </div>
		  <div class="form-group">
			  <label for="comment">Description:</label>

			 <textarea class="form-control" rows="5" name="des" id="comment"><?php echo $des; ?></textarea>
			</div>
			<input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>" >
		  <input type="submit" name="submit" class="btn btn-primary" value=" Update Category">
		</form>
		<script>
			
       function validateform(){
         var x = document.forms['categoryform']['category'].value;
          if (x=="") {
          	alert('Category Must Be Filled Out !');
          	return false;
          }
       }

		</script>

  </div>

  <?php
include('db.php');
if (isset($_POST['submit'])) {
	$id=$_POST['id'];
     $category =$_POST['category'];
     $des=$_POST['des'];

     $query1=mysqli_query($conn,"update category set category_name='$category' , des='$des' where id='$id' ");
     if($query1){
     	echo "<script>alert('Category Updated Successfully !')</script>";
       echo "<script >window.location='http://localhost/nepnews/category.php' ;</script>";
     	

     }else{
     	echo "Category Not Update";
     }
}


  ?>

