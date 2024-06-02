<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->

        <?php
         require_once "config.php";
         $post_id=$_GET['post_id'];

         $sql="SELECT * FROM post WHERE post_id={$post_id}";
         $result=mysqli_query($conn,$sql) or die("Query failed");
         if(mysqli_num_rows($result)>0){
        ?>
        <form action="update-post-data.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            
         <?php
         while($row=mysqli_fetch_assoc($result)){
       $id=$row['category'];
         ?>

            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id']; ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5"><?php echo $row['description']; ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>

                <?php
        
                     $sql1="SELECT * FROM category";
                     $result1=mysqli_query($conn,$sql1) or die( "Query failed");
                     if(mysqli_num_rows($result1)>0){
                      echo'<select class="form-control" name="category">'; 
               
               
                while($row1=mysqli_fetch_assoc($result1)){

                    if($row1['category_id']==$row['category']){
                        $select="selected";
                    }
                    else{
                        $select="";
                    }
           
                  echo "<option {$select} value='{$row1['category_id']}'>{$row1['category_name']}</option>";
           
                }
                echo"  </select>";
            }
                ?>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $row['post_img']; ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $row['post_img']; ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
            <?php
              }
            ?>
        </form>
        <?php
             }
             else{
                echo"No records found";
             }
         
        ?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
