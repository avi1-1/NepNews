<?php
 include('db.php');

 $id=$_GET['del'];
 $query = mysqli_query($conn,"delete  from news where id='$id' ");
 if ($query) {
 	 echo "<script> alert('News deleted !')</script> ";
  	   echo "<script >window.location='http://localhost/nepnews/news.php' ;</script>";
 
 }else{
 	echo "Please Try again";
 }

?>