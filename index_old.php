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
                $query = "SELECT * FROM posts WHERE post_status = 'published'";
                $select_posts = mysqli_query($connect, $query);

                $count = mysqli_num_rows($select_posts);
                if($count == 0){
                    echo "<h1 class='text-center'> Not post is pulished </h1>";
                }else{

                while($row = mysqli_fetch_assoc($select_posts)){
                   $post_id = $row['post_id'];
                   $post_title = $row['post_title'];
                   $post_date = $row['post_date'];
                   $post_author = $row['post_author'];
                   $post_image = $row['post_image'];
                   $post_content = substr($row['post_content'],0,120);
                   $post_status = $row['post_status'];
                
                   ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $post_author;?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

           <?php }  }?>
           
            </div>



            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <?php include("includes/sidebar.php"); ?>
            </div>

        </div>
        <!-- /.row -->

        <hr>

<?php include("includes/footer.php"); ?>