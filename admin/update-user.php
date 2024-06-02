<?php include "header.php"; 
 if($_SESSION['user_role']==0){
  header("location: post.php");
}?>

<?php
require_once "config.php";
$user_id=$_GET['user_id'];
$sql="SELECT * FROM user WHERE user_id={$user_id}";
$result=mysqli_query($conn,$sql) or die("Query failed");
if(isset($_POST['submit'])){
    
    $fname=mysqli_real_escape_string($conn,$_POST['f_name']);
    $lname=mysqli_real_escape_string($conn,$_POST['l_name']);
    $user=mysqli_real_escape_string($conn,$_POST['username']);
    $role=mysqli_real_escape_string($conn,$_POST['role']);
  
  // $sql1="SELECT username FROM user WHERE username='{$user}'";
  // $result1=mysqli_query($conn,$sql1);
  // if(mysqli_num_rows($result1)>0){
  //   echo"<p style='color: red; text-align:center; margin:10px 0;'> Username already exists.</p>";
  // }
  
      $sql2="UPDATE user SET first_name='{$fname}', last_name='{$lname}', username='{$user}', role='{$role}' WHERE user_id={$user_id}";
   if(mysqli_query($conn,$sql2)){
    header("location: users.php");
   }
  }
  
    


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <?php
                  if(mysqli_num_rows($result)>0){
                  ?>
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                     <?php
                     while($row=mysqli_fetch_assoc($result)){

                    
                     ?>
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id']; ?> " placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="">

                          <?php
                                  if($row['role']==1){
                                    $select="selected";
                                  }
                                  else{
                                    $select="";
                                  }
                                  if($row['role']==0){
                                    $selected="selected";
                                  }
                                  else{
                                    $selected="";
                                  }
                             echo"<option {$selected} value='0'>normal User</option>";
                            echo"<option {$select} value='1'>Admin</option>";
                              ?>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                      <?php
                       }
                      ?>
                  </form>
                  <!-- /Form -->

                  <?php
                     }
                     else{
                        echo"record NOt Found";
                     }
                     mysqli_close($conn);
                  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
