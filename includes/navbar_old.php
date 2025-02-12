<?php include("db.php"); ?>
<?php include("header.php"); 

// Get current page name
$page_name = basename($_SERVER['PHP_SELF']);

// Initialize all class variables
$category_class = '';
$registration_class = '';
$admin_class = '';
$contact_class = '';

// Check if on registration page
if ($page_name == 'registration.php') {
    $registration_class = 'active';
}

// Check if on contact page
if ($page_name == 'contact.php') {
    $contact_class = 'active';
}

// Check if in admin section (example: check URL path)
if (strpos($_SERVER['REQUEST_URI'], '/admin/') !== false) {
    $admin_class = 'active';
}

?>

<nav class="navbar navbar-light bg-light navbar-fixed-top" style="background-color: #FAFAFA;" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Start Bootstrap</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav nav-tabs">
                <!-- Categories -->
                <?php 
                    $query = "SELECT * FROM categories";
                    $select_cat = mysqli_query($connect, $query);

                    while($row = mysqli_fetch_assoc($select_cat)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        $current_category_class = '';

                        // Check if this category is active
                        if (isset($_GET['cat_id']) && $_GET['cat_id'] == $cat_id) {
                            $current_category_class = 'active';
                        }

                        echo "<li class='$current_category_class'><a href='by_category.php?cat_id=$cat_id'>$cat_title</a></li>";
                    }
                ?>

                <!-- Admin Link -->
                <li class="<?php echo $admin_class; ?>">
                    <a href="admin">Admin</a>
                </li>

                <!-- Registration Link -->
                <li class="<?php echo $registration_class; ?>">
                    <a href="registration.php">Registration</a>
                </li>

                <!-- Contact Link -->
                <li class="<?php echo $contact_class; ?>">
                    <a href="contact.php">Contact</a>
                </li>

                <!-- Edit Post Link (Conditional) -->
                <?php
                    if (isset($_GET['p_id'])) {
                        $edit_post_id = $_GET['p_id'];
                        echo "<li><a href='admin/posts.php?source=edit_post&edit={$edit_post_id}'>Edit Post</a></li>";
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>