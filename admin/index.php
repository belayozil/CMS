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
                            Welcome Page
                            <small><?php echo $_SESSION['user_firstname']; ?></small>
                        </h1>
                   
                    </div>
                </div>
                <!-- /.row -->

                   
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <!-- calling function recordCount() from functions.php -->
                                        <div class='huge'><?php echo $count_post = recordCount('posts');; ?></div> 
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <!-- calling function recordCount() from functions.php -->
                                        <div class='huge'><?php echo $count_comments = recordCount('comments'); ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <!-- calling function recordCount() from functions.php -->
                                        <div class='huge'><?php echo $count_user = recordCount('user'); ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="view_all_users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <!-- calling function by table name recordCount() from functions.php -->
                                        <div class='huge'><?php echo $count_category = recordCount('categories'); ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="category.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->


            <?php 
                    //querying from functions.php
                    $active_post  = checkStatus('posts', 'post_status', 'published');
                    $draft_post = checkStatus('posts', 'post_status', 'draft');
                    $unapproved_comments = checkStatus('comments', 'comment_status', 'unapproved');
                    $number_of_subscriber = checkUserRole('user', 'user_role', 'subscriber');

            ?>

                <div class="row"><!-- /.row displaying chart start -->

                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                            ['data','count'],

                                <?php

                                    $element_text = ['all post', 'active Posts', 'draft post', 'comments', 'unapproved comments', 'users', 'subscriber user', 'categories'];
                                    $element_count = [$count_post, $active_post, $draft_post, $count_comments, $unapproved_comments, $count_user, $number_of_subscriber, $count_category];

                                    for($i=0; $i<7; $i++) {
                                        echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                                    }

                                ?>


                            // ['posts', 1000],
                            
                            ]);

                            var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>

                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>

                </div>
                <!-- /.row displaying chart ends -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("includes/admin_footer.php"); ?>