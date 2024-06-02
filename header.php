<?php

require_once "config.php";
$page=basename($_SERVER['PHP_SELF']);
switch($page){
     case "single.php":
        if(isset($_GET['post_id'])){
            $post_id=$_GET['post_id'];
            $sql_title="SELECT * FROM post where post_id ={$post_id}";
            $result_title=mysqli_query($conn, $sql_title) or die("Title query failed");
            $row_title=mysqli_fetch_assoc($result_title);
           $page_title= $row_title['title'];
        }else{
            $page_title="No post post Found";
        }
        break;
     case "category.php":
         if(isset($_GET['cat_id'])){
            $cat_id=$_GET['cat_id'];
            $sql_cat="SELECT * FROM category where category_id ={$cat_id}";
            $result_cat=mysqli_query($conn, $sql_cat) or die("category query failed");
            $row_cat=mysqli_fetch_assoc($result_cat);
           $page_title= $row_cat['category_name']. " News ";
        }else{
            $page_title="No post post Found";
        }
        break;
     case "author.php":
        if(isset($_GET['username'])){
            $username=$_GET['username'];
            $sql_user="SELECT * FROM user where username ='{$username}'";
            $result_user=mysqli_query($conn, $sql_user) or die("user query failed");
            $row_user=mysqli_fetch_assoc($result_user);
           $page_title=" News By ". $row_user['username'];
        }else{
            $page_title="No post post Found";
        }
        break;
     case "search.php":
        if(isset($_GET['search'])){
           $page_title=$_GET['search'];
        }else{
            $page_title="No post post Found";
        }
        break;
   default:
   $page_title="News-site";
        break;
     
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title; ?> </title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
          
            <?php
         require_once "config.php";
         $sql="SELECT * FROM settings";
         $result=mysqli_query($conn,$sql) or die("Query failed");
         if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                if($row['logo']==""){
                    echo'<a href="index.php" id="logo"><h1>'.$row['websitename'].'</h1></a>';  

                }
                else{
                    echo'<a href="index.php" id="logo"><img src="admin/images/'.$row['logo'].'"></a>';
                }
            }
        }
        ?>

           
               
        
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            <?php
            require_once "config.php";

            if(isset($_GET['cat_id'])){
                $id=$_GET['cat_id'];
            }
            
           $sql="SELECT * FROM category WHERE post>0";
           $result=mysqli_query($conn, $sql) or die("Query failed");

           if(mysqli_num_rows($result)>0){
            echo"  <ul class='menu'>";
            echo" <li ><a  href='index.php'>HOME</a></li>";
            $active="";
            while($row=mysqli_fetch_assoc($result)){
                
            if(isset($_GET['cat_id'])){
                if($row['category_id']==$id){
                    $active= "active";
                }
                else{
                    $active="";
                }
            }
               
                      
                  echo" <li ><a  class='{$active}' href='category.php?cat_id={$row['category_id']}'> {$row['category_name']} </a></li>";
            }
         echo" </ul>";

           }
            ?>
              
             
               
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
