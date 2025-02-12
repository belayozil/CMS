<?php

    include("delete_modal.php");

    if(isset($_POST['checkBoxArray'])){
        
        foreach($_POST['checkBoxArray'] as $clicked_post_id){
            $bulk_action = $_POST['bulk_action'];

            switch ($bulk_action){

                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulk_action}' WHERE post_id = {$clicked_post_id}";
                    $publish_post = mysqli_query($connect, $query);
                    if(!$publish_post){
                        die("query failed".mysqli_error($connect));
                    }
                    break;

                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_action}' WHERE post_id = {$clicked_post_id}";
                    $draft_post = mysqli_query($connect, $query);
                    if(!$draft_post){
                        die("query failed".mysqli_error($connect));
                    }
                    break;
                
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = {$clicked_post_id}";
                    $delete_post = mysqli_query($connect, $query);
                    if(!$delete_post){
                        die("query failed".mysqli_error($connect));
                    }else{
                        header("Location: posts.php");
                    }
                    break;

                case 'clone':

                    $select_post_query = mysqli_query($connect, "SELECT * FROM posts WHERE post_id = {$clicked_post_id}")or die(myslerror());

                    while($row = mysqli_fetch_array($select_post_query)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_category_id = $row['post_category_id'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_tags = $row['post_tags'];
                        $post_status = $row['post_status'];
                    }

                    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status)";
                    $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', '{$post_date}', '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

                    $insert_clone = mysqli_query($connect, $query);

                    if(!$insert_clone){
                        die("query failed".mysqli_error($connect));
                    }else{
                        echo "clone successfull";
                    }

                    break;


            }
        }

    }


?>


<form action="" method="POST">
    <table class="table table-responsive table-bordered table-hover">


        <div id="Bulk_option_container" class="col-xs-4">
            <select value="" class="form-control" name="bulk_action" id="">
                <option value="">Select Option</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="apply" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all_checkbox"></th>
                                        <th>ID</th>
                                        <th>Users</th>
                                        <th>Post Title</th>
                                        <th>Post Category</th>
                                        <th>Post Date</th>
                                        <th>Post Image</th>
                                        <!-- <th>Post Content</th> -->
                                        <th>Post Tags</th>
                                        <th>Post Comment Count</th>
                                        <th>Post Status</th>
                                        <th>Post View Count</th>
                                        <th>DELETE</th>
                                        <th>Edit</th>
                                    </tr>
                               </thead>
                               <tbody>
                                   

                    <?php

                    //$query = "SELECT * FROM posts ORDER BY post_id DESC";
                    $query = "SELECT posts.post_id, posts.post_author, posts.post_user, posts.post_title, posts.post_category_id, posts.post_date, posts.post_image, posts.post_content, posts.post_tags, posts.post_comment_count, posts.post_status, posts.post_view_count,";
                    $query .= "categories.cat_id, categories.cat_title FROM posts LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";
                    $select_posts = mysqli_query($connect,$query);
                    
                    while ($row = mysqli_fetch_assoc($select_posts)) {
                        $post_id = $row['post_id'];                       
                        $post_author = $row['post_author'];
                        $post_user = $row['post_user'];
                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_tags = $row['post_tags'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_status = $row['post_status'];
                        $post_view_count = $row['post_view_count'];
                        $cat_id= $row['cat_id'];
                        $cat_title = $row['cat_title'];
                   

                                   echo " <tr>";
                                   ?>

                                    <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id;?>"></td>

                                    <?php
                                       echo "<td>$post_id</td>";

                                    if(!empty($post_user)){
                                        echo "<td>$post_user</td>";
                                    }elseif(!empty($post_author)){
                                       echo "<td>$post_author</td>";
                                    }


                                       echo "<td><a href='../post.php?p_id=$post_id'>$post_title</td>";


                                    // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                                    // $select_cat = mysqli_query($connect,$query);
                                    // while($row = mysqli_fetch_assoc($select_cat)){
                                    //     $cat_title = $row['cat_title'];
                                    // }

                                       echo "<td>$cat_title</a></td>";
                                       echo "<td>$post_date</td>";
                                       echo "<td><img src='../images/$post_image' width='100'></td>";
                                    //    echo "<td>$post_content</td>";
                                       echo "<td>$post_tags</td>";

                                       $comments = mysqli_query($connect,"SELECT * FROM comments WHERE comment_post_id = {$post_id}")or die(mysqli_error($connect));
                                       
                                    //    while($row = mysqli_fetch_array($comments)){
                                    //         $comm_id = $row['comment_post_id'];
                                    //    }

                                       $row = mysqli_fetch_array($comments);
                                       $comm_id = $row['comment_post_id'] ?? null; // Assign null if no rows are fetched

                                       $comment_count = mysqli_num_rows($comments);

                                       echo "<td><a href='post_comments.php?id=$comm_id'>$comment_count</a></td>";
                                            

                                       echo "<td>$post_status</td>";
                                       echo "<td><a href='posts.php?reset={$post_id}' onClick=\"javascript: return confirm('Are you Sure you want to reset'); \">$post_view_count</a></td>";
                                       //echo "<td><a href='posts.php?delete={$post_id}' onClick=\"javascript: return confirm('Are you Sure you want to delete'); \">Delete</a></td>";
                                       echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
                                       echo "<td><a href='posts.php?source=edit_post&edit={$post_id}'>Edit</a></td>";
                                    echo "</tr>";
                        }

                        ?>
                                    
        </tbody>
    </table>
</form>
                            

                <?php


                if(isset($_GET['delete'])){
                    $del_id = $_GET['delete'];

                    $query = "DELETE FROM posts WHERE post_id = {$del_id}";
                    $del_query = mysqli_query($connect,$query);

                    if(!$del_query){
                        die("query failed".mysqli_error($del_query));
                    }else{
                        echo "post deleted successfully";
                        header("Location: posts.php");
                    }
                }

                if(isset($_GET['reset'])){
                    $res_id = $_GET['reset'];

                    $query = "UPDATE posts SET post_view_count = 0 WHERE post_id =".mysqli_real_escape_string($connect, $res_id)." ";
                    $res_query = mysqli_query($connect,$query);

                    if(!$res_query){
                        die("query failed".mysqli_error($connect));
                    }else{
                        echo "post view reseted successfully";
                        header("Location: posts.php");
                    }
                }

                ?>

<script>
    $(document).ready(function(){
        $(".delete_link").on('click', function(){
            var id = $(this).attr("rel");
            var delete_url = "posts.php?delete="+ id + " ";

            $(".modal_delete_link").attr("href", delete_url);
            $("#myModal").modal('show');/// calling the modal in delete_modal.php
            //alert(delete_url);
        });
        
    });
</script>