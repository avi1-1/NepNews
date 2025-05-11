<?php
 include('db.php');
 $id=$_GET['del'];
 $query=mysqli_query($conn,"delete  from category where id='$id'");
  if ($query) {
  	 echo "<script> alert('category deleted !')</script> ";
  	   echo "<script >window.location='http://localhost/nepnews/category.php' ;</script>";

  }else{
  	echo "Please Try again";
  }


?>