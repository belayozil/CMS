<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<?php
//grabing the form data
if(isset($_POST['submit'])){

    $to = "belayozil10@gmail.com";
    $subject = wordwrap($_POST['subject'], 70);
    $body = $_POST['message'];
    $header = "From: " . $_POST['email'];

    //check if form is not empty
    if(!empty($subject) && !empty($header) && !empty($body)){

        if (mail($to, $subject, $body, $header)) {
            $message = "Email sent successfully.";
        } else {
            $message = "Failed to send email. Please try again.";
        }
   
    }else {
        $message = "Please fill out the form.";
    }

}else{
    $message = "";
}

?>




    <!-- Navigation -->
    <?php  include "includes/navbar.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <h4 class="text-center"><?php echo $message; ?></h4>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                        </div>
                         <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Add Subject">
                        </div>
                        <div class="form-group">
                            <label for="message" class="sr-only">Message</label>
                            <textarea class="form-control" name="message" id="" rows="10" col="10" placeholder="Type Your Message"></textarea>
                        </div>
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
