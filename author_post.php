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
                    $post_author = $_GET['author'];
                }
                $query = "SELECT * FROM posts WHERE post_author = '{$post_author}'";
                $select_posts = mysqli_query($connect, $query);
                while($row = mysqli_fetch_assoc($select_posts)){
                   $post_id = $row['post_id'];
                   $post_title = $row['post_title'];
                   $post_date = $row['post_date'];
                   $post_author = $row['post_author'];
                   $post_image = $row['post_image'];
                   $post_content = $row['post_content'];

                   ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href=""><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                

                <hr>

           <?php }  ?>


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
                        //comment increment query
                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                        $query .= "WHERE post_id = $post_id";
                        $increment_com_count = mysqli_query($connect, $query);
    
                        if(!$increment_com_count){
                            die("comment query failed".mysqli_error($connect));
                        }else{
                            echo "comment added successfully";
                            //header("Location: comments.php");
                        }
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

                    <?php } }?>

              

            </div>


            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                <?php include("includes/sidebar.php"); ?>
            </div>
            

        </div>
        <!-- /.row -->

       


<?php include("includes/footer.php"); ?>