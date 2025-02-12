<?php

//sql enjection avoiding function
function escape($string){
    global $connect;
    return mysqli_real_escape_string($connect, trim($string));
}


function add_new_category() {

     global $connect;
    
                
    if(isset($_POST['submit'])){
        $add_post = $_POST['add-post'];
        

        if($add_post === "" || empty($add_post)){
            echo "Category Shouldn't be Empty";
        }else{
            $query = "INSERT INTO categories(cat_title) VALUES('{$add_post}')";
            $add_cat = mysqli_query($connect, $query);

            if(!$add_cat){
                die("Query Failed".mysqli_error($connect));
            }
        }
    }
}
?>


<?php

 function display_all_categories() {
    global $connect;
    $query = "SELECT * FROM categories";
    $select_cat = mysqli_query($connect, $query);
    if(!$select_cat){
        die("connection error".mysqli_error($connect));
    }else{
    while($row = mysqli_fetch_assoc($select_cat)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

    ?>
                <tr>
                    <td><?php echo $cat_id; ?></td>
                    <td><?php echo $cat_title; ?></td>
                    <td><a href="category.php?delete=<?php echo $cat_id; ?>">Delete</a></td>
                    <td><a href="category.php?edit=<?php echo $cat_id; ?>">Edit</a></td>
                </tr>
                <?php } }

    }
    ?>


<?php

    function delete_category() {
        global $connect;

        if(isset($_GET['delete'])){

            $del_id = $_GET['delete'];

            $query = "DELETE FROM categories WHERE cat_id = {$del_id}";
            $delete_cat = mysqli_query($connect,$query);
            if(!$delete_cat){
                die("mysqli_error".mysqli_error($connect));
            }else{
                header("Location: category.php");
            }
            

        }                     

    }



    function count_users_online() {
        if (isset($_GET['onlineusers'])) {
            echo "Online users request detected.<br>";
    
            global $connect;
    
            if (!$connect) {
                echo "Database connection not established. Including db.php...<br>";
                session_start();
                include("../../includes/db.php");
    
                if (!$connect) {
                    die("Database connection still not established after including db.php.<br>");
                }
            }
    
            // Online user count
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 30;
            $time_out = $time - $time_out_in_seconds;
    
            $query = "SELECT * FROM user_online WHERE session = '$session'";
            echo "Query: $query<br>";
            $send_query = mysqli_query($connect, $query);
    
            if (!$send_query) {
                die("Query failed: " . mysqli_error($connect) . "<br>");
            }
    
            $count = mysqli_num_rows($send_query);
            echo "Current session count: $count<br>";
    
            if ($count == 0) {
                $insert_query = "INSERT INTO user_online(session, time) VALUES('$session', '$time')";
                echo "Insert query: $insert_query<br>";
                mysqli_query($connect, $insert_query) or die(mysqli_error($connect));
            } else {
                $update_query = "UPDATE user_online SET time = '$time' WHERE session = '$session'";
                echo "Update query: $update_query<br>";
                mysqli_query($connect, $update_query) or die(mysqli_error($connect));
            }
    
            $user_online_query = "SELECT * FROM user_online WHERE time > '$time_out'";
            echo "User online query: $user_online_query<br>";
            $result = mysqli_query($connect, $user_online_query);
    
            if (!$result) {
                die("Query failed: " . mysqli_error($connect) . "<br>");
            }
    
            $count_user = mysqli_num_rows($result);
            echo "Number of users online: $count_user<br>";
        }
    }
    count_users_online();

    function confirmQuery($result){
        global $connect;
        if(!$result){
            die("Query Failed".mysqli_error($connect));
        }
    }

    function recordCount($table){
        global $connect;
        $query = "SELECT * FROM " . $table;
        $select_all = mysqli_query($connect, $query);
        $result = mysqli_num_rows($select_all);
        confirmQuery($result);
        return $result;
    }


    function checkStatus($table, $column, $status){
        global $connect;
        $query = "SELECT * FROM $table WHERE $column = '$status'";
        $result = mysqli_query($connect, $query);
        confirmQuery($result);
        return mysqli_num_rows($result);
    }

    function checkUserRole($table, $column, $role){
        global $connect;
        $query = "SELECT * FROM $table WHERE $column = '$role'";
        $result = mysqli_query($connect, $query);
        confirmQuery($result);
        return mysqli_num_rows($result);
    }

    function is_admin($username){
        global $connect;
        $query = "SELECT user_role FROM user WHERE username = '$username'";
        $result = mysqli_query($connect, $query);
        confirmQuery($result);
        $row = mysqli_fetch_array($result);
        if($row['user_role'] == 'Admin'){
            return true;
        }else{
            return false;
        }
    }

    function username_exists($username){
        global $connect;
        $query = "SELECT username FROM user WHERE username = '$username'";
        $result = mysqli_query($connect, $query);
        confirmQuery($result);
        if(mysqli_num_rows($result) > 0){
            return true;
        }else{
            return false;
        }
    }

?>

