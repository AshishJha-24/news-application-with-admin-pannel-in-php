<?php
require_once "config.php";
    if(!empty($_FILES['logo']['name'])){
        $error=array();
        $file_name=$_FILES['logo']['name'];
        $file_size=$_FILES['logo']['size'];
        $file_temp=$_FILES['logo']['tmp_name'];
        $file_type=$_FILES['logo']['type'];
         $exp= explode('.',$file_name);
        $file_ext=end($exp);
        $extensions=array("jpeg","jpg","png");
    
        if(in_array($file_ext, $extensions)===false){
            $error[]="This extension file not allowed, Please choose a JPG or PNG file";             
        }
        if($file_size>2097152){
            $error[]="File size must be 2mb or lower.";
        }
        if(empty($error)==true){
            move_uploaded_file($file_temp, "images/".$file_name);
            $img=$file_name;
        }
        else{
            print_r($error) or die();
        }
    
    }
    else{
        $img=$_POST['old_logo'];
    }
 
  
  
    $websitename= mysqli_real_escape_string($conn, $_POST['website_name']);
$footerdesc=mysqli_real_escape_string($conn, $_POST['footer_desc']);


$sql="UPDATE settings SET websitename='{$websitename}' , logo='{$img}' , footerdesc='{$footerdesc}' ";

 if(mysqli_query($conn,$sql)){
    header("location: settings.php");
 }
 else{
    echo"Query failed";
 }


  
?>