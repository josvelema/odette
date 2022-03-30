<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<?php

if (isset($_POST['submit'])) {

    $to = "rjvelemail@gmail.com";
    $con_name = escape($_POST['con_name']);
    $con_email = escape($_POST['con_email']);
    $con_subject = escape($_POST['con_subject']);
    $con_msg = escape($_POST['con_msg']);


    if (!empty($con_name) && !empty($con_email) && !empty($con_subject)) {

      
    }

  }

?>



<!-- Navigation -->

<?php include "includes/nav.php"; ?>

<br>
<br>

<!-- Page Content -->
<div class="container">

<h1>Contact</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <!-- <h6 class="text-center"> <?php echo $message; ?> </h6> -->
                            <div class="form-group">
                                <label for="con_name" class="sr-only">Name</label>
                                <input type="text" name="con_name" id="con_name" class="form-control" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label for="con_email" class="sr-only">Email</label>
                                <input type="email" name="con_email" id="con_email" class="form-control" placeholder="Enter your e-mail">
                            </div>
                            <div class="form-group">
                                <label for="con_subject" class="sr-only">Subject/label>
                                <input type="text" name="con_subject" id="con_subject" class="form-control" placeholder="Subject">
                            </div>
                            <div class="form-group">
                              <textarea name="con_msg" id="con_msg" col="50" rows="10"></textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="submit">
                        </form>



    <hr>



    <?php include "includes/footer.php"; ?>