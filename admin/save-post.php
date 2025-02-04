<?php
require_once "config.php";
if(isset($_FILES['fileToUpload'])){
    $error=array();
    $file_name=$_FILES['fileToUpload']['name'];
    $file_size=$_FILES['fileToUpload']['size'];
    $file_temp=$_FILES['fileToUpload']['tmp_name'];
    $file_type=$_FILES['fileToUpload']['type'];
    $file_ext=strtolower(end(explode('.',$file_name)));
    $extensions=array("jpeg","jpg","png");

    if(in_array($file_ext, $extensions)===false){
        $error[]="This extension file not allowed, Please choose a JPG or PNG file";             
    }
    if($file_size>2097152){
        $error[]="File size must be 2mb or lower.";
    }
    if(empty($error)==true){
        move_uploaded_file($file_temp, "upload/".$file_name);
    }
    else{
        print_r($error) or die;
    }

}

session_start();
$title= mysqli_real_escape_string($conn, $_POST['post_title']);
$postDesc=mysqli_real_escape_string($conn, $_POST['postdesc']);
$post_cat=mysqli_real_escape_string($conn, $_POST['category']);
$date= date("d M, Y");
$author=$_SESSION['user_id'];

$sql="INSERT INTO post(title,description,category,post_date,author,post_img)VALUES('{$title}','{$postDesc}',{$post_cat},'{$date}',{$author},'{$file_name}');";
$sql .= "UPDATE category SET post= post +1 WHERE category_id={$post_cat}";

if(mysqli_multi_query($conn,$sql)){
    header("location: post.php");
}
else{
    echo"<div class='alert alert-danger'> Query failed</div>";
}

?>