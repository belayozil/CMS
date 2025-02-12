<?php include("includes/admin_header.php"); ?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include("includes/admin_navbar.php"); ?>

<?php // display user based on session start

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];

    $query = "SELECT * FROM user WHERE username = '{$username}'";
    $select_user = mysqli_query($connect, $query);

    if(!$select_user){
        die("mysqli_error".mysqli_error($connect));
    }else{
        while($row = mysqli_fetch_assoc($select_user)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_password = $row['user_password'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            $user_email = $row['user_email'];
        }
    }
}
// display user based on session end


//update user profile start
if(isset($_POST['Edit_profile'])){
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    move_uploaded_file($user_image_temp, "images/$user_image");

    if(empty($user_image)){
        $query = "SELECT * FROM user WHERE username = '{$username}'";
        $select_user_image = mysqli_query($connect, $query);

        while($row = mysqli_fetch_assoc($select_user_image)){
            $user_image = $row['user_image'];
        }
    }

    //$user_role = $_POST['user_role'];
    $password = $_POST['password'];

    $query = "UPDATE user SET username = '{$username}', user_password = '{$password}', user_firstname = '{$first_name}', user_lastname = '{$last_name}',";
    $query .= "user_email = '{$email}', user_image = '{$user_image}' WHERE username = '{$username}'";
    $update_user = mysqli_query($connect, $query);

    if(!$update_user){
        die("query failed".mysqli_error($connect));
    }else{
        echo "user updated successfully";
        header("Location: view_all_users.php");
    }
}
//update user profile end

?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Edit Profile
                        </h1>

                        <!-- //edit Profile -->
                        <div class="col-lg-8">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                        <label for="firstname">First name</label>
                                        <input type="text" value="<?php echo $user_firstname; ?>" name="first_name" class="form-control">
                                </div>
                                <div class="form-group">
                                        <label for="lastnametname">Last name</label>
                                        <input type="text" value="<?php echo $user_lastname; ?>" name="last_name" class="form-control">
                                </div>
                                <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" value="<?php echo $user_email; ?>" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                        <label for="user-image">Profile Image</label>
                                        <input type="file" name="user_image" class="form-control">
                                        <img src="images/<?php echo $user_image; ?>" alt="user image" width="100">
                                </div>
                                <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" value="<?php echo $username; ?>" name="username" class="form-control">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="user-role">User Role</label>
                                    <select class="form-control" name="user_role" id="">
                                        <option value="Admin">Admin</option>
                                        <option value="Subscriber">Subscriber</option>
                                    </select>
                                </div> -->
                                <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" autocomplete="off" class="form-control">
                                </div>
                              
                                <div class="form-group">
                                        <button name="Edit_profile" type="submit" class="form-control btn btn-primary col-4 mx-auto">Edit Profile</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.edit profile -->

                   
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("includes/admin_footer.php"); ?>