<?php include "header.php";
 if($_SESSION['user_role']==0){
    header("location: post.php");
 } ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
            <?php 
                    require_once "config.php";
                    if(isset($_GET['page'])){
                        $page=$_GET['page'];
                    }
                    else{
                        $page=1;
                    }
                    
                    $limit=3;
                    $offset=($page-1)*$limit;
                     $sql="SELECT * FROM category LIMIT {$offset},{$limit}";
                     $result=mysqli_query($conn,$sql) or die("Query failed");
                     if(mysqli_num_rows($result)>0){
                    ?>
                <table class="content-table">
                   
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        while($row=mysqli_fetch_assoc($result)){
                        ?>

                        <tr>
                            <td class='id'><?php echo $row['category_id']; ?> </td>
                            <td><?php echo $row['category_name']; ?></td>
                            <td><?php echo $row['post']; ?></td>
                            <td class='edit'><a href='update-category.php?category_id=<?php echo $row['category_id']; ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?category_id=<?php echo $row['category_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php
                            }
                            ?>
                       
                    </tbody>

                </table>
                <?php
                }
                else{
                       echo" NO record Found";
                }
                  $sql2="SELECT * FROM category";
                  $result2=mysqli_query($conn,$sql2) or die("Query failed");
                  if(mysqli_num_rows($result2)>0){
                    $total_records=mysqli_num_rows($result2);
                  
                    $toal_page=ceil($total_records/$limit);
                    if($toal_page!=1){

                   
                   echo" <ul class='pagination admin-pagination'>";
                   if($page>1)
                   echo'<li><a href="category.php?page='.($page-1).'">Prev</a></li> ';
                    for($i=1;$i<=$toal_page;$i++){
                        if($page==$i){
                            $active="active";

                        }
                        else{
                            $active="";
                        }
                       echo" <li class='{$active}'><a href='category.php?page={$i}'>$i</a></li> ";
                    }
                    if($page!=$toal_page)
                    echo'<li><a href="category.php?page='.($page+1).'">Next</a></li> ';
                    
                  }
                  echo"</ul>";
                }
                ?>
               
                   
                    
                   
                
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
