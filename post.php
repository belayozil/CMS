<?php include("includes/header.php"); ?>
<?php include("includes/db.php"); ?>

    <!-- Navigation -->
 <?php include("includes/navbar.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">


            <?php 

                if(isset($_GET['p_id'])){
                    $p_id = $_GET['p_id'];

                $query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = {$p_id}";
                $update_post_view_count = mysqli_query($connect, $query);

                if(!$update_post_view_count){
                    die("query failed".mysqli_error($connect));
                }

                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin'){ 
                   $query = "SELECT * FROM posts WHERE post_id = {$p_id}";
                }else{
                    $query = "SELECT * FROM posts WHERE post_id = {$p_id} AND post_status = 'published'";
                }

                $select_posts = mysqli_query($connect, $query);
                
                if(mysqli_num_rows($select_posts) < 1){
                    echo "<h1> No post Found </h1>";
                }else{
                while($row = mysqli_fetch_assoc($select_posts)){
                   $post_id = $row['post_id'];
                   $post_title = $row['post_title'];
                   $post_date = $row['post_date'];
                   $post_author = $row['post_author'];
                   $post_user = $row['post_user'];
                   $post_image = $row['post_image'];
                   $post_content = $row['post_content'];

                   ?>

                <!-- First Blog Post -->
                <h2>
                    <a href=""><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_user; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                

                <hr>

           <?php } 
              
                
                ?>


           <hr>

                <!-- Blog Comments -->

                
                 <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>

                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="com_author" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="com_email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="post">Post comment</label>
                            <textarea name="post_comment" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add_comment">Submit</button>
                    </form>
                </div>

                <hr>

        <?php
        
            if(isset($_POST['add_comment'])){
                $post_id = $_GET['p_id'];

                $com_author = $_POST['com_author'];
                $com_email = $_POST['com_email'];
                $post_comment = $_POST['post_comment'];

                if(!empty($com_author) && !empty($com_email) && !empty($post_comment)){

                    $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                    $query .= "VALUES($post_id, '{$com_author}', '{$com_email}', '{$post_comment}', 'unapproved', now())";
    
                    $insert_comment = mysqli_query($connect, $query);
                    if(!$insert_comment){
                        die("query failed".mysqli_error($connect));
                    }else{

                        echo "comment added successfully";
                        // //comment increment query
                        // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                        // $query .= "WHERE post_id = $post_id";
                        // $increment_com_count = mysqli_query($connect, $query);
    
                        // if(!$increment_com_count){
                        //     die("comment query failed".mysqli_error($connect));
                        // }else{
                        //     echo "comment added successfully";
                        //     //header("Location: comments.php");
                        // }
                    }

                }else{
                    echo "<script>alert('fields are required')</script>";
                }

        
            }
        
        ?>
               

                <hr>

                <!-- Posted Comments -->

                <?php
                    $query = "SELECT * FROM comments WHERE comment_post_id = $p_id AND comment_status = 'approved'";
                    $query .= "ORDER BY comment_id DESC";
                    $view_approved_comm = mysqli_query($connect, $query);

                    if(!$view_approved_comm){
                        die("mysqli_error".mysqli_error());
                    }else{
                        while($row = mysqli_fetch_assoc($view_approved_comm)){
                            $comment_author = $row['comment_author'];
                            $comment_email = $row['comment_email'];
                            $comment_content = $row['comment_content'];
                            $comment_date = $row['comment_date'];

                        ?>


                          <!-- Comment -->
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $comment_author; ?>
                                        <small><?php echo $comment_date; ?> </small>
                                    </h4>
                                    <?php echo $comment_content; ?>
                                </div>
                            </div>

                    <?php } } }
                      }else{
                        header("Location: index.php");
                    } //if iset p_id ends here
                    ?>

              

            </div>


            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                <?php include("includes/sidebar.php"); ?>
            </div>
            

        </div>
        <!-- /.row -->

       


<?php include("includes/footer.php"); ?>