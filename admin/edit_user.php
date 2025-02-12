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
                            Edit User
                        </h1>

<?php 

if(isset($_GET['edit'])){
    $get_user_id = $_GET['edit'];

    $query = "SELECT * FROM user WHERE user_id = {$get_user_id}";
    $select_user = mysqli_query($connect, $query);
    if(!$select_user){
        die("query_failed".mysqli_error($connect));
    }else{
        while($row = mysqli_fetch_assoc($select_user)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_password = $row['user_password'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        }
    }




if(isset($_POST['Edit_user'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_role = $_POST['user_role'];

    move_uploaded_file($user_image_temp, "images/$user_image");

    if(empty($user_image)){
        $query = "SELECT * FROM user WHERE user_id = {$get_user_id}";
        $select_user_image = mysqli_query($connect, $query);

        while($row = mysqli_fetch_assoc($select_user_image)){
            $user_image = $row['user_image'];
        }
    }

    // Grabbing user password
    if(!empty($password)){
        $get_pass = mysqli_query($connect, "SELECT user_password FROM user WHERE user_id = $get_user_id") or die(mysqli_error($connect));
        $row = mysqli_fetch_array($get_pass);
        $db_user_pass = $row['user_password'];
    }

    // If password is not empty, hash it
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_BCRYPT);
    } else {
        $password = $db_user_pass;  // If password is not updated, keep the existing one
    }

    // Update user details
    $query = "UPDATE user SET username = '{$username}', user_password = '{$password}', user_firstname = '{$first_name}', user_lastname = '{$last_name}', user_email = '{$email}', user_image = '{$user_image}', user_role = '{$user_role}' WHERE user_id = {$get_user_id}";
    $update_user = mysqli_query($connect, $query);
    if(!$update_user){
        die("query failed".mysqli_error($connect));
    } else {
        echo "user updated successfully";
        header("Location: view_all_users.php");
    }
}


}//get requist ends here 
else{

    header("Location: index.php");

}

?>

    
                        <!-- //add new user form -->
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
                                <div class="form-group">
                                    <label for="user-role">User Role</label>
                                    <select class="form-control" name="user_role" id="">
                                        <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
                                        <?php
                                            if($user_role == 'Admin'){
                                                echo "<option value='Subscriber'>Subscriber</option>";
                                            }else{
                                                echo "<option value='Admin'>Admin</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" autocomplete="off" class="form-control">
                                </div>
                              
                                <div class="form-group">
                                        <button name="Edit_user" type="submit" class="form-control btn btn-primary col-4 mx-auto">Edit User</button>
                                </div>
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