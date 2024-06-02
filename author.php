<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                <?php
                   require_once "config.php";
                   $username=$_GET['username'];
                   $limit=3;
                   if(isset($_GET['page'])){
                    $page=$_GET['page'];
                   }else{
                    $page=1;
                   }
                   $offset=($page-1)*$limit;
                  
                   $sql1="SELECT  * FROM user WHERE username='{$username}'";
                  $result1=mysqli_query($conn,$sql1) or die("Category command");
                    $row1=mysqli_fetch_assoc($result1)
                 
                ?>
                  <h2 class="page-heading"><?php echo $row1['username']?></h2>

                  <?php
                    
                    $sql="SELECT  post.title, post.description, post.post_date,category.category_name,category.category_id, user.username ,post.post_img, post.post_date, post.post_id FROM post 
                    LEFT JOIN category ON post.category=category.category_id 
                    LEFT JOIN user ON post.author=user.user_id WHERE user.username='{$username}' ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";

                    $result=mysqli_query($conn,$sql) or die("Query failed");
                
                    if(mysqli_num_rows($result)>0){

                  while($row=mysqli_fetch_assoc($result)){
                  
                  ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?post_id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href="single.php?post_id=<?php echo $row['post_id']; ?>"><?php echo $row['title']; ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href="category.php?cat_id=<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?username=<?php echo $row['username']; ?>'><?php echo $row['username']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date']; ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr( $row['description'],0,130)."....."; ?>
                                    </p>
                                    <a class='read-more pull-right' href="single.php?post_id=<?php echo $row['post_id']; ?>">read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                     }
                    }
                    else{
                        echo"No records Found";
                    }

                    $sql2="SELECT  post.title, post.description, post.post_date,category.category_name, user.username ,post.post_img, post.post_date, post.post_id FROM post 
                    LEFT JOIN category ON post.category=category.category_id 
                    LEFT JOIN user ON post.author=user.user_id WHERE user.username='{$username}' ";
                    $result2=mysqli_query($conn, $sql2) or die("pagination command");
                    if(mysqli_num_rows($result2)>0){
                        $total_records=mysqli_num_rows($result2);
                        $total_page=ceil($total_records/$limit);
                  if($total_page>1){
                   echo"<ul class='pagination'>"; 
                   if($page>1){
                   echo'<li><a href="author.php?page='.($page-1).'&username='.$username.'">Prev</a></li>';
                   }
                   for($i=1;$i<=$total_page;$i++){
                    if($i==$page){
                        $active="active";
                    }
                    else{
                          
                    $active="";
                    }
                    echo"<li class={$active}><a href='author.php?page=$i&username=$username'>$i</a></li>";
                   }
                   if($page!=$total_page){
                   echo'<li><a href="author.php?page='.($page+1).'&username='.$username.'">Next</a></li>';
                   }
                   echo"  </ul>";
                }               
                
                   }
                    ?>
                    
                    
                       
                     
                  
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
