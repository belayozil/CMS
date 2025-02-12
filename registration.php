<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<?php
//grabing the form data
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_form = $_POST['password'];

    //check if form is not empty
    if(!empty($username) && !empty($email) && !empty($password_form)){

        //escaping sql injection
        $username = mysqli_real_escape_string($connect, $username); 
        $email = mysqli_real_escape_string($connect, $email);
        $password  = mysqli_real_escape_string($connect, $password_form );

        //example_query $linkq=mysqli_query($con,"Select * from department where id='$id'") or die(mysqli_error());
        $grab_rand_salt = mysqli_query($connect, "SELECT randsalt FROM user") or die(mysqli_error());

        $row = mysqli_fetch_array($grab_rand_salt);
        $rand_salt_value = $row['randsalt'];

        //encrypt the password
        //$password = crypt($password, $rand_salt_value);
        $password = password_hash($password, PASSWORD_BCRYPT);

        if(username_exists($username)){
            $message = "username already exists";
        }else{
            $add_user = mysqli_query($connect, "INSERT INTO user(username, user_email, user_password, user_role)  VALUES('{$username}', '{$email}', '{$password}', 'subscriber')") or die(mysqli_error());
            if($add_user){
                $message = "user successfully added";
            }
        }
    }else{
        $message = "please fill out the form";
    }

   
}else{
    $message = "";
}


?>




    <!-- Navigation -->
    <?php  include "includes/navbar.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h4 class="text-center"><?php echo $message; ?></h4>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
