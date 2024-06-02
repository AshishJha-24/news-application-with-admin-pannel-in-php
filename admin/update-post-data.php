<?php
require_once "config.php";
    if(!empty($_FILES['new-image']['name'])){
        $error=array();
        $file_name=$_FILES['new-image']['name'];
        $file_size=$_FILES['new-image']['size'];
        $file_temp=$_FILES['new-image']['tmp_name'];
        $file_type=$_FILES['new-image']['type'];
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
            $img=$file_name;
        }
        else{
            print_r($error) or die;
        }
    
    }
    else{
        $img=$_POST['old-image'];
    }
 
  
    $post_id=$_POST['post_id'];
    $title= mysqli_real_escape_string($conn, $_POST['post_title']);
$postDesc=mysqli_real_escape_string($conn, $_POST['postdesc']);
$post_cat=mysqli_real_escape_string($conn, $_POST['category']);


$sql="UPDATE post SET title='{$title}' , description='{$postDesc}', category={$post_cat} , post_img='{$img}' WHERE post_id={$post_id}";

 if(mysqli_query($conn,$sql)){
    header("location: post.php");
 }
 else{
    echo"Query failed";
 }


  
?>