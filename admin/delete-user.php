<?php
session_start();
if($_SESSION['user_role']==0){
    header("location: post.php");
 }
 require_once "config.php";
 $user_id=$_GET['user_id'];

 $sql="DELETE FROM user WHERE user_id={$user_id}";
 $result=mysqli_query($conn, $sql) or die("Query failed");
 header("location: users.php");
 mysqli_close($result);

?>