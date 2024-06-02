<?php
require_once "config.php";
$post_id=$_GET['post_id'];
$post_cat=$_GET['catid'];

$sql1 = "SELECT * FROM post WHERE post_id={$post_id}";

$result=mysqli_query($conn,$sql1) or die("Query failed: SELECT ");

$row=mysqli_fetch_assoc($result);
unlink("upload/".$row['post_img']);
$sql = "DELETE FROM post WHERE post_id={$post_id};";
$sql.="UPDATE category SET post= post-1 WHERE category_id={$post_cat}";
if(mysqli_multi_query($conn, $sql)){
    header("location: post.php");
}
else{
    echo"Query failed";
}

?>