<?php include("includes/admin_header.php"); ?>
<?php include("includes/delete_modal.php"); ?>


<?php

    if(!is_admin($_SESSION['username'])){
        header("Location: index.php");
    }
      

?>


    <div id="wrapper">

        <!-- Navigation -->
        <?php include("includes/admin_navbar.php"); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Users List
                        </h1>
                            <table class="table table-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                    <?php 
                                    
                                        $query = "SELECT * FROM user";
                                        $select_user = mysqli_query($connect, $query);

                                        if(!$select_user){
                                            die("query failed".mysqli_error($connect));
                                        }else{
                                            while($row = mysqli_fetch_assoc($select_user)){
                                                $user_id = $row['user_id'];
                                                $user_name = $row['username'];
                                                $user_password = $row['user_password'];
                                                $user_fistname = $row['user_firstname'];
                                                $user_lastname = $row['user_lastname'];
                                                $user_email = $row['user_email'];
                                                $user_role = $row['user_role'];
                                          ?>
                                        <td><?php echo $user_name; ?> </td>
                                        <td><?php echo $user_fistname; ?></td>
                                        <td><?php echo $user_lastname; ?></td>
                                        <td><?php echo $user_email; ?></td>
                                        <td><?php echo $user_role; ?></td>
                                        <td><a class="btn btn-default" href="edit_user.php?edit=<?php echo $user_id; ?>">Edit</a></td>
                                        <!-- <td><a class="btn btn-danger" onClick="return confirm('Are you sure you want to delete?');" href="view_all_users.php?del=<?php //echo $user_id; ?>">Delete</a></td> -->
                                        <td><a rel="<?php echo $user_id; ?>" href="javascript:void(0)" class="btn btn-danger delete_link_user">Delete</a></td>
                                    </tr>
                                    <?php   } } ?>
                                </tbody>
                            </table>

                    </div>

                        
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php
        if(isset($_GET['del'])){
                    $del_id = $_GET['del'];

                    $query = "DELETE FROM user WHERE user_id = {$del_id}";
                    $del_user = mysqli_query($connect,$query);

                    if(!$del_user){
                        die("query failed".mysqli_error($connect));
                    }else{
                        echo "user deleted successfully";
                        header("Location: view_all_users.php");
                    }
                }
?>

<?php include("includes/admin_footer.php"); ?>

<!-- delete popup javascript -->
<script>
    $(document).ready(function(){
        $(".delete_link_user").on('click', function(){
            var id = $(this).attr("rel");
            var delete_url = "view_all_users.php?del="+ id + " ";

            $(".modal_delete_link").attr("href", delete_url);
            $("#myModal").modal('show');/// calling the modal in delete_modal.php
            //alert(delete_url);
        });
        
    });
</script>