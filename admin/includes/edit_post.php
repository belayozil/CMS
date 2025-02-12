<?php

if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];

    $query = "SELECT * FROM posts WHERE post_id = {$edit_id}";
    $select_post = mysqli_query($connect,$query);

    if(!$select_post){
        die("query failed".mysqli_error($connect));
    }else{
    while($row = mysqli_fetch_assoc($select_post)){
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_author = $row['post_author'];
        $post_user = $row['post_user'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];

    }
}
}


if(isset($_POST['edit_post'])){
    
    $post_title = escape($_POST['post_title']);
    $post_category_id = escape($_POST['post_category']);
    //$post_author = $_POST['post_author'];
    $post_user = escape($_POST['post_user']);
    $post_status = escape($_POST['post_status']);
    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($post_image_temp, "../files/$post_image");

    if(empty($post_image)){
        $query = "SELECT * FROM posts WHERE post_id = {$edit_id}";
        $select_image = mysqli_query($connect,$query);

        while($row = mysqli_fetch_assoc($select_image)){
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = '{$post_category_id}', post_user = '{$post_user}',";
    $query .= "post_status = '{$post_status}', post_image = '{$post_image}', post_tags = '{$post_tags}', post_content = '{$post_content}'";
    $query .= "WHERE post_id = {$edit_id}";

    $update_post = mysqli_query($connect,$query);

    if(!$update_post){
        die("query failed".mysqli_error($update_post));
    }else{
        echo "<p class='bg-success'>Post update successfull <a href='../post.php?p_id=$edit_id'>view edited post</a>
        Or <a href='./posts.php?p_id=$edit_id'>Edit Other Posts</a></p>";
    }
}


?>



<div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="post-title">Post Title</label>
            <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
        </div>

        <div class="form-group">
            <label for="post-cat-id">Post category</label>
            <select class="form-control" name="post_category" id="">
                <?php

                $query = "SELECT * FROM categories";
                $select_cat = mysqli_query($connect,$query);
                if(!$select_cat){
                    die("query failed".mysqli_error($select_cat));
                }else{
                    while($row=mysqli_fetch_assoc($select_cat)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                 if($cat_id == $post_category_id){
                    echo "<option selected value='$cat_id'>{$cat_title}</option>";
                }else{
                    echo "<option value='$cat_id'>{$cat_title}</option>";
                }
            }
        }
                ?>
            </select>
        </div>

        
       
        <div class="form-group">
            <label for="post-autho">Post User</label>
            <select class="form-control" name="post_user" id="">

                <?php echo "<option value='{$post_user}'>{$post_user}</option>"; ?> <!-- displaying the current user -->

                <?php

                $query = "SELECT * FROM user";
                $select_user = mysqli_query($connect,$query);

                while($row = mysqli_fetch_assoc($select_user)){
                    $user_id = $row['user_id'];
                    $username = $row['username'];

                    echo "<option value='{$username}'>{$username}</option>";
                }

                ?>
            </select>
        </div>
        <!-- <div class="form-group">
            <label for="post-author">Post Author</label>
            <input value="<?php //echo $post_author; ?>" type="text" name="post_author" class="form-control">
        </div> -->

        <div class="form-group">
            <label for="post-status">Post Status</label>
            <!--<input value="<?php //echo $post_status; ?>" type="text" name="post_status" class="form-control"> -->
            <select class="form-control" name="post_status" id="">
                <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
                <?php
                    if($post_status == 'published'){
                        echo "<option value='draft'>Draft</option>";
                    }else{
                        echo "<option value='published'>Publish</option>";
                    }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="post-image">Post Image</label>
            <input type="file" name="image" class="form-control">
            <img src="../images/<?php echo $post_image; ?>" alt="images" width="100">
        </div>

        <div class="form-group">
            <label for="post-tags">Post Tags</label>
            <input value="<?php echo $post_tags; ?>" type="text" name="post_tags" class="form-control">
        </div>

        <div class="form-group">
            <label for="post-content">Post Content</label>
            <textarea name="post_content" id="summernote" class="form-control" cols="10" rows="7"><?php echo $post_content; ?></textarea>
        </div>

        <div class="form-group">
            <input type="submit" name="edit_post" value="Edit Post" class="btn btn-primary">
        </div>
    </form>
</div>