<nav class="navbar navbar-light bg-light navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS Admin</a>
            </div>
            <!-- Top Menu Items -->
            
            <ul class="nav navbar-right top-nav">

                <!-- <li><a href="">Online users <?php //echo count_users_online(); ?></a></li> -->
                <li><a href="">Online users: <span class="usersonline"></span></a></li>

                <li><a href="../index.php">Home</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                        
                        <?php 
                            if(isset($_SESSION['username'])){

                                echo $_SESSION['username']; 

                            }
                            
                        ?>

                    <b class="caret">
                    </b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>


            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="posts.php">View All Posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_post">Add New Posts</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="category.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
                    </li>
                    <li class="active link">
                        <a href="comments.php"><i class="fa fa-fw fa-file"></i> Comments</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#users_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="users_dropdown" class="collapse">
                            <li>
                                <a href="view_all_users.php">List of Users</a>
                            </li>
                            <li>
                                <a href="add_new_user.php">Add New User</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="profile.php"><i class="fa fa-fw fa-dashboard"></i> Profiles</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>