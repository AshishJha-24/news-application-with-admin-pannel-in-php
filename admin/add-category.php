<?php include "header.php";
 if($_SESSION['user_role']==0){
    header("location: post.php");
 }
?>
<?php
require_once "config.php";
if(isset($_POST['save'])){
    $cat=$_POST['cat'];
    $sql="SELECT * FROM category WHERE category_name='{$cat}'";
    $result=mysqli_query($conn,$sql) or die("Query failed");
    if(mysqli_num_rows($result)>0){
        echo "<p style='color:red; text-align:center; margin:10px 0;'>Category name is already exists";
    }
    
        else{
            $sql1="INSERT INTO category(category_name) VALUES('{$cat}')";
            if(mysqli_query($conn,$sql1)){
                header("location: category.php");
        }
        else{
          echo" query failed";  
        }
    }
}


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
