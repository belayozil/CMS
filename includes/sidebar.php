     <?php include("db.php"); ?>
     <!-- Blog Search Well -->
     <div class="well">
                    <h4>Blog Search</h4>

                    <form action="search.php" Method="post">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                    <div class="well">
                        <?php
                            if(isset($_SESSION['username'])){
                                echo "<h4>Logged in as {$_SESSION['username']}</h4>";
                                echo "<a href='includes/logout.php' class='btn btn-primary'>Logout</a>";
                            }else{
                        ?>
                        <h4>Login</h4>
                        <form action="includes/login.php" Method="post">
                            <div class="form-group">
                                <div class="form-group">
                                    <input name="username" type="text" class="form-control">
                                </div>
                                <div class="input-group">
                                    <input type="password" name="user_password" class="form-control">
                                    <span class="input-group-btn">
                                        <button name="login" type="submit" class="btn btn-primary">Login</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <?php } ?>
                    </div>
                    <!-- /.Login form -->

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">

                            <?php 
                                
                                $query = "SELECT * FROM categories";
                                $select_cat = mysqli_query($connect, $query);

                                while($row = mysqli_fetch_assoc($select_cat)){
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                            ?>

                                <li><a href="by_category.php?cat_id=<?php echo $cat_id; ?>"><?php echo $cat_title; ?></a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>

                   

                        <!-- /.col-lg-6 -->
                        <!-- <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div> -->
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>