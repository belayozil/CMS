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

            if(isset($_POST['search'])){
               $search = $_POST['search'];

               $query = "SELECT * FROM posts WHERE post_tags Like '%$search%' ";
               $search_query = mysqli_query($connect, $query);

               if(!$search_query){
                die("query failed" . mysqli_error($connect));
               }else{
                
                $count = mysqli_num_rows($search_query);
                if($count === 0){
                    echo "<h1> Object Not Found </h1>";
                }else{

                while($row = mysqli_fetch_assoc($search_query)){
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
                    <a href="index.php"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr class="btn btn">

           <?php } } }     } ?>
           
            </div>



            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <?php include("includes/sidebar.php"); ?>
            </div>

        </div>
        <!-- /.row -->

        <hr>

<?php include("includes/footer.php"); ?>