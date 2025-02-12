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
                            Add New User
                        </h1>

                        <!-- //add new user form -->
                        <div class="col-lg-8">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                        <label for="firstname">First name</label>
                                        <input type="text" name="first_name" class="form-control">
                                </div>
                                <div class="form-group">
                                        <label for="lastnametname">Last name</label>
                                        <input type="text" name="last_name" class="form-control">
                                </div>
                                <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                        <label for="user-image">Profile Image</label>
                                        <input type="file" name="user_image" class="form-control">
                                </div>
                                <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" class="form-control">
                                </div>
                                <div class="form-group">
                                        <label for="user-role">Selecet User Role</label>
                                        <select class="form-control" name="user_role" id="">
                                                <option value="Subscriber">Subscriber</option>
                                                <option value="Admin">Admin</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                        <button name="add_user" type="submit" class="form-control btn btn-primary col-4 mx-auto">Add User</button>
                                </div>


                                <?php 
                        
                        if(isset($_POST['add_user'])){
                                $first_name = $_POST['first_name'];
                                $last_name = $_POST['last_name'];
                                $email = $_POST['email'];

                                $user_image = $_FILES['user_image']['name'];
                                $user_image_temp = $_FILES['user_image']['tmp_name'];

                                $username = $_POST['username'];
                                $user_role = $_POST['user_role'];
                                $password = $_POST['password'];
                                $password = password_hash($password, PASSWORD_BCRYPT);

                                move_uploaded_file($user_image_temp, "images/$user_image");

                                $query = "INSERT INTO user(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role)";
                                $query .= "VALUES('{$username}', '{$password}', '{$first_name}', '{$last_name}', '{$email}', '{$user_image}', '{$user_role}')";

                                $insert_user = mysqli_query($connect, $query);
                                if(!$insert_user){
                                        die("query failed".mysqli_error($connect));
                                }else{
                                        echo "user Added successfully"." "."<a href='view_all_users.php'>View USer</a>";
                                        
                                }



                        }

                ?>


                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("includes/admin_footer.php"); ?>