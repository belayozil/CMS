<?php //updating query


if(isset($_GET['edit'])){
    $update_key = $_GET['edit'];

    $query = "SELECT * FROM categories WHERE cat_id = '{$update_key}'";
    $select_cat = mysqli_query($connect,$query);
    while($row = mysqli_fetch_assoc($select_cat)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
    }
?>
    
    <div class="col-sm-6">
        <form action="" method="post">
            <div class="form-group">
                <label for="update">Update</label>
                <input name="new_cat" class="form-control" type="text" value="<?php echo $cat_title; ?>">
            </div>
            <div class="form-group">
                <input  name="update" type="submit" value="Update" class="btn btn-primary">
            </div>
        </form>
    </div>

    <?php

    if(isset($_POST['update'])){
        $update = $_POST['new_cat'];

        $query = "UPDATE categories SET cat_title = '{$update}' WHERE cat_id = '{$update_key}' ";
        

        $update_category = mysqli_query($connect, $query);
        if(!$update_category){
            die("mysqli_error".mysqli_error($connect));
        }else{
            echo "item updated successfully";
            header("Location: category.php");
        }
    }


    ?>


<?php } ?>
