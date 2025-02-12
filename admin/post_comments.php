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
                            Welcome To Admin
                            <small>Author</small>
                        </h1>

                        <!-- display posts -->
                        <div>

<?php

    if(isset($_GET['id'])){
        $post_id = $_GET['id'];
    }

?>
<table class="table table-responsive table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In responce to</th>
            <th>Approve</th>
            <th>UnApprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php
                $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id}  ORDER BY comment_id DESC";
                $select_comment = mysqli_query($connect,$query);

                while($row = mysqli_fetch_assoc($select_comment)){
                    $com_id = $row['comment_id'];
                    $com_post_id = $row['comment_post_id'];
                    $com_author = $row['comment_author'];
                    $com_email = $row['comment_email'];
                    $com_content = $row['comment_content'];
                    $com_status = $row['comment_status'];
                    $com_date = $row['comment_date'];

                    echo "<td>$com_id</td>";
                    echo "<td>$com_author</td>";
                    echo "<td>$com_content</td>";
                    echo "<td>$com_email</td>";
                    echo "<td class='btn btn-primary'>$com_status</td>";

                    $query = "SELECT * FROM posts WHERE post_id = $com_post_id";
                    $select_post = mysqli_query($connect, $query);
                    while($row = mysqli_fetch_assoc($select_post)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];

                        echo "<td> <a href='../post.php?p_id=$post_id'>$post_title </a></td>";
                    }
                    


                    echo "<td><a href='post_comments.php?approve=$com_id&id=$post_id'>approve</a></td>";
                    echo "<td><a href='post_comments.php?unapprove=$com_id&id=$post_id'>Unapprove</a></td>";
                    echo "<td><a href='post_comments.php?com_id=$com_id&id=$post_id'>delete</a></td>";
                    echo "</tr>";
                }
            ?>





        <?php 
                //change comment status to approve
                if(isset($_GET['approve'])){
                    $com_id = $_GET['approve'];

                    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = '$com_id'";
                    $update_com = mysqli_query($connect, $query);

                    if(!$update_com){
                        die("query_failed".mysqli_error());
                    }else{
                        header("Location: post_comments.php?id=$post_id");
                        echo "comment status updated successfully";
                    }
                }

                //change specific comment status into un approve
                if(isset($_GET['unapprove'])){
                    $com_id = $_GET['unapprove'];

                    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = '$com_id'";
                    $update_com_s = mysqli_query($connect, $query);

                    if(!$update_com_s){
                        die("query failed".mysqli_error());
                    }else{
                        header("Location: post_comments.php?id=$post_id");
                        echo "comment status updated successfully";
                    }
                }


                //delete specific comment
                if(isset($_GET['com_id'])){
                    $com_id = $_GET['com_id'];

                    $query = "DELETE FROM comments WHERE comment_id = $com_id";
                    $del_com = mysqli_query($connect, $query);

                    if(!$del_com){
                        die("query failed".mysqli_error($connect));
                    }else{
                        header("Location: post_comments.php?id=$post_id");
                        echo "comment deleted successfully";
                    }
                }
        
        ?>


    </tbody>
</table>


                        </div>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("includes/admin_footer.php"); ?>