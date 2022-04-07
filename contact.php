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

<!-- Page Content -->

<main class="home contact">
    <h1>Contact</h1>

    <form method="POST">
        <div class="rj-input-group">
            <label class="form-label" for="msg_author">Name</label>
            <input type="text" id="con_name" placeholder="naam" name="con_author">
        </div>
        <div class="rj-input-group">
            <label class="form-label" for="email">E-mail</label>
            <input type="text" id="con_email" placeholder="email@email.com" name="con_email">
        </div>
        <div class="rj-input-group">
            <label class="form-label" for="con-subject">Subject</label>
            <input type="text" id="con_subject" placeholder="email@email.com" name="con_email">
        </div>
        <div class="rj-input-group">
            <label class="form-label" for="content">Message</label>
            <textarea rows="5" columns="50" id="content" placeholder="message" name="con_msg"></textarea>
        </div>
        <input type="submit" value="Submit" name="submit">
    </form>



    
</main>



<?php include "includes/footer.php"; ?>