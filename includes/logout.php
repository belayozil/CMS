<?php include("db.php"); ?>
<?php include("../admin/includes/admin_header.php"); ?>


<?php

    $_SESSION['username'] = null;   
    $_SESSION['user_password'] = null;   
    $_SESSION['user_firstname'] = null;   
    $_SESSION['user_lasname'] = null;   
    $_SESSION['user_role'] = null;

    header("Location: ../index.php");


?>