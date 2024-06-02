<?php
session_start();
if($_SESSION['user_role']==0){
    header("location: post.php");
 }
 require_once "config.php";

 $id=$_GET['category_id'];
 $sql="DELETE FROM category WHERE category_id={$id}";
 $result=mysqli_query($conn, $sql) or die("Query failed");
 mysqli_close($conn);
 header("location: category.php")
 
 ?>