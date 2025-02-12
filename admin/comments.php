<?php include("includes/admin_header.php"); ?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include("includes/admin_navbar.php"); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small>Author</small>
                        </h1>

                        <!-- display posts -->
                        <div>

                        <?php

                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            }else{
                                $source = '';
                            }

                            switch($source){

                                case 'add_post';
                                include "includes/add_post.php";
                                break;

                                case 'edit_post';
                                include "includes/edit_post.php";
                                break;

                                case 'view_post';
                                include "includes/update_categories.php";
                                break;

                                default:
                                include "includes/view_all_comments.php";
                                break;



                            }

                        ?>

                        </div>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("includes/admin_footer.php"); ?>