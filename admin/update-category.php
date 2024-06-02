<?php include "header.php"; 
 if($_SESSION['user_role']==0){
  header("location: post.php");
}?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">

              <?php
                      require_once "config.php";
                      $id=$_GET['category_id'];
                     
                      $sql1="SELECT * FROM category WHERE category_id={$id}";
                      $result1=mysqli_query($conn,$sql1) or die( "Query failed");
                      if(mysqli_num_rows($result1)>0){
                       while($row=mysqli_fetch_assoc($result1)){
                    
                      if(isset($_POST['sumbit'])){
                        $cat=$_POST['cat_name'];
                        $sql="UPDATE category SET category_name='{$cat}' WHERE category_id={$id} ";
                        $result=mysqli_query($conn,$sql) or die("Query failed");

                        header("location: category.php");
                      }
                    

                      
                   
              ?>
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id']; ?> "placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php 
                }
                }
                  ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
