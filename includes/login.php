<?php include("db.php"); ?>
<?php include("../admin/includes/admin_header.php"); ?>
<?php session_start(); ?>

<?php

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['user_password'];

    $username = mysqli_real_escape_string($connect, $username);
    $password = mysqli_real_escape_string($connect, $password);

    $query = "SELECT * FROM user WHERE username = '{$username}'";
    $select_match_user = mysqli_query($connect, $query);

    if(!$select_match_user){
        die("query failed".mysqli_error($connect));
    }else{

         if(mysqli_num_rows($select_match_user) > 0){
            while($row = mysqli_fetch_assoc($select_match_user)){
                $user_id_db = $row['user_id'];
                $username_db = $row['username'];
                $user_password_db = $row['user_password'];
                $user_firstname_db = $row['user_firstname'];
                $user_lastname_db = $row['user_lastname'];
                $user_role_db = $row['user_role'];
            }
            

            //if ($username === $username_db && $password === $user_password_db){
            //password decrypt
            if (password_verify($password, $user_password_db)) {
                //set session datas
                $_SESSION['username'] = $username_db;
                $_SESSION['user_password'] = $user_password_db;   
                $_SESSION['user_firstname'] = $user_firstname_db;   
                $_SESSION['user_lastname'] = $user_lastname_db;   
                $_SESSION['user_role'] = $user_role_db;

                // Redirect to admin dashboard
                header("Location: ../admin");
                exit();
                }else{
                    // Incorrect password
                    header("Location: ../index.php?login=failed");
                    exit();
                }      
        }else{
               // No user found
               header("Location: ../index.php?login=failed");
               exit();
        }

    }
       
}


?>