<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['email']) || $_SESSION['email'] == false) {
    header('Location: news.php');
    exit();
}

$page = 'news';
include('header.php');
?>

<style>
    body {
    background: #f8f9fa; /* or any plain color */
    margin: 0;
    padding: 0;
}

    /* body {
        font-family: Arial, sans-serif;
        margin: 20px;
    } */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        width: 100%;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f4f4f4;
        font-weight: bold;
    }
    .btn {
        padding: 8px 12px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        color: white;
        text-transform: capitalize;
    }
    .btn-info {
        background-color: #17a2b8;
    }
    .btn-danger {
        background-color: #dc3545;
    }
    .btn-primary {
        background-color: #007bff;
        padding: 10px 15px;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 10px;
    }
    .container {
    background: none !important;
}

    body, html {
    background: none !important;
}
.main-content {
    width: 100%;
    overflow-x: hidden;
}
.clearfix::after {
    content: "";
    display: block;
    clear: both;
}
.row {
    margin-left: 0 !important;
    margin-right: 0 !important;
}


  /* Responsive Design */
  @media screen and (max-width: 768px) {
        .container {
            width: 90%;
            padding-top: 10%;
        }
        table {
            font-size: 14px;
        }
        .btn {
            padding: 5px 8px;
            font-size: 12px;
        }
    }
    .pagination {
    display: flex;
    justify-content: center;
    padding: 10px;
    list-style: none;
}

.pagination li {
    margin: 5px;
}

.pagination .page-link {
    padding: 8px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    text-decoration: none;
    color: #007bff;
    transition: 0.3s;
}

.pagination .page-link:hover {
    background-color: #007bff;
    color: white;
}

.pagination .page-item.disabled .page-link {
    color: gray;
    pointer-events: none;
}


</style>

<div style="width: 70%; margin-left: 3%; margin-top: 5%">
    <div class="text-right">
        <a class="btn btn-primary" href="Addnews.php">Add News</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Category</th>
                <th>Thumbnail</th>
                <th>Writer</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('db.php');
            $page=$_GET['page'];
           if($page=="" || $page==1){
            $page1=0;
           }
           else{
              $page1=($page*3)-3;

           }
           
      $query=mysqli_query($conn,"select * from news limit $page1,3");
       while ($row=mysqli_fetch_array($query)) {
         ?>
         <tr>
           <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['title']; ?></td>
             <td><?php echo substr($row['description'],0,100 ); ?></td>
               <td><?php echo date("F jS ,y", strtotime($row['date'])); ?></td>
                 <td><?php echo $row['category']; ?></td>
                   <td><img class="img img-thumbnail" src="images/<?php echo $row['thumbnail'];?>" alt="" width="150" height="150" ></td>
                   <td><?php echo $row['admin'];?></td>
                   <td><a class="btn btn-info btn-sm" href="news_edit.php?edit=<?php echo $row['id'];?>">edit</a></td>
                     <td><a class="btn btn-danger btn-sm" href="news_delete.php?del=<?php echo $row['id'];?>">delete</a></td>
                    
         </tr>
         
       
         
       <?php }  ?>
       </table>
             <ul class="pagination">
               <li class="page-item disabled">
                 <a href="#" class="page-link" >Pervious</a>
               </li>
              <?php

       $sql=mysqli_query($conn,"select * from news");
       $count=mysqli_num_rows($sql);
       $a=$count/3;
        ceil($a);
        for ($b=1; $b <=$a ; $b++) { 
          ?>
      
             
         <li class="page-item"><a class="page-link" href="news.php?page=<?php echo $b;?>"><?php echo $b; ?></a></li>
          
       
          <?php 
        }
       ?>
                <li class="page-item disabled">
                 <a href="#" class="page-link" >Next</a>
               </li>
       </ul>

       

  </div>

            
           ?>
      
        </tbody>
    </table>
</div>

<?php
include('footer.php');
?>