
<?php

if(isset($_POST['create_post'])){

    $post_title = escape($_POST['post_title']);
    $post_cat_id = escape($_POST['post_cat_id']);
    $post_user = escape($_POST['post_user']);
    $post_status = escape($_POST['post_status']);

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = date('d-m-y');
    //$post_comment_count = 4;

    move_uploaded_file($post_image_temp, "../files/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status)";
    $query .= "VALUES({$post_cat_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

    // , post_image, post_content, post_tags, post_comment_count, post_status)
    // ,$post_date,'{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}'

    $insert_posts = mysqli_query($connect, $query);
    if(!$insert_posts){
        die("mysqli query failed".mysqli_error($connect));
    }else{
        //function to grab the last inserted id from the database 
        $edit_id = mysqli_insert_id($connect);

        echo "<p class='bg-success'>Post Added successfull <a href='../post.php?p_id=$edit_id'>view Added post</a>
        Or <a href='./posts.php?p_id=$edit_id'>view Other Posts</a></p>";
    }



}

?>


<div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="post-title">Post Title</label>
            <input type="text" class="form-control" name="post_title">
        </div>

        <div class="form-group">
            <label for="post-cat-id">Post category</label>
            <select class="form-control" name="post_cat_id" id="">
                <?php

                $query = "SELECT * FROM categories";
                $select_cat = mysqli_query($connect,$query);

                while($row = mysqli_fetch_assoc($select_cat)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }

                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="post-autho">Post User</label>
            <select class="form-control" name="post_user" id="">
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
            <input type="text" name="post_author" class="form-control">
        </div> -->

        <div class="form-group">
            <label for="post-status">Post Status</label>
            <select value="" class="form-control" name="post_status" id="">
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
            </select>
        </div>

        <div class="form-group">
            <label for="post-image">Post Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group">
            <label for="post-tags">Post Tags</label>
            <input type="text" name="post_tags" class="form-control">
        </div>

        <div class="form-group">
            <label for="summernote">Post Content</label>
            <textarea name="post_content" id="summernote" class="form-control" cols="10" rows="7"></textarea>
        </div>

        <div class="form-group">
            <input type="submit" name="create_post" value="Publish Post" class="btn btn-primary">
        </div>
    </form>
</div>