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

                        <!-- add new category -->
                        <div class="col-sm-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="add-post">Add New Category</label>
                                    <input name="add-post" class="form-control" type="text">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Add New Category" class="btn btn-primary">
                                </div>
                            </form>
                        </div>

                        <?php add_new_category(); //add new category?> 


                        <!-- display categories -->
                         <div class="col-sm-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cat Title</th>
                                        <th>Delete</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>

                                   <?php display_all_categories();   //display all categories ?>

                                </tbody>
                            </table>
                         </div>
                        
                         <?php //deleting query

                            delete_category();
                            
                         ?>

                        <?php
                        
                            if(isset($_GET['edit'])){
                                $update_key = $_GET['edit'];
                                include "includes/update_categories.php";
                            }    

                        ?>
                       

                        
                   
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("includes/admin_footer.php"); ?>