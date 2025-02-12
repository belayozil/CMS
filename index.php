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


                //pagination algorithm
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }else{
                    $page = "";
                }

                $posts_perpage = 10;

                if($page == "" || $page == 1){
                    $page_1 = 0;
                }else{
                    $page_1 = ($page * $posts_perpage)-$posts_perpage;
                }


               if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin'){
                    $post_query_count = "SELECT * FROM posts";
                }else{
                    $post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
                }

                $find_count = mysqli_query($connect, $post_query_count);
                $count_1 = mysqli_num_rows($find_count); //counting how many posts are there

                $count_1 = ceil($count_1 / $posts_perpage);//divide the post into 5 and ciel the fraction number 9.5 to 10

                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin'){
                    $query = "SELECT * FROM posts LIMIT $page_1, $posts_perpage";
                }else{
                    $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, $posts_perpage";
                }
                
                $select_posts = mysqli_query($connect, $query);

                $count = mysqli_num_rows($select_posts);//counting how many posts are there
                if($count == 0){
                    echo "<h1 class='text-center'> Not post is pulished </h1>";
                }else{

                while($row = mysqli_fetch_assoc($select_posts)){
                   $post_id = $row['post_id'];
                   $post_title = $row['post_title'];
                   $post_date = $row['post_date'];
                   $post_author = $row['post_author'];
                   $post_user = $row['post_user'];
                   $post_image = $row['post_image'];
                   $post_content = substr($row['post_content'],0,120);
                   $post_status = $row['post_status'];
                
                   ?>

                <h1><?php echo $count_1; ?></h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $post_user; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
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
        <!-- <ul class="pager">   
            <?php
                    // for($i=1; $i<=$posts_perpage; $i++){

                    //     if($i == $page){
                    //         echo "<li><a class='active_link' href='index.php?page=$i'>{$i}</a></li>";
                    //     }else{
                    //         echo "<li><a href='index.php?page=$i'>{$i}</a></li>";
                    //     }
                    // }
            ?> 
        </ul>  -->

<?php if ($count_1 > 1): // Only display pagination if there are multiple pages ?>
    <ul class="pager">
        <?php
        for ($i = 1; $i <= $count_1; $i++) { // Use $count_1 to loop through total pages
            if ($i == $page || ($page == "" && $i == 1)) { // Highlight current page
                echo "<li><a class='active_link' href='index.php?page=$i'>{$i}</a></li>";
            } else {
                echo "<li><a href='index.php?page=$i'>{$i}</a></li>";
            }
        }
        ?>
    </ul>
<?php endif; ?>



<?php include("includes/footer.php"); ?>