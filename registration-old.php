<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<?php

if (isset($_POST['submit'])) {


    $user_name = escape($_POST['user_name']);
    $user_email = escape($_POST['user_email']);
    $user_pass = escape($_POST['user_pass']);

    if (userExists($user_name)) {

        $message = "Username already in use! please choose another name.";

    } else if (userEmailExists($user_email)) {

        $message = "E-mail address already in use! please choose another";
        
    } else if (!empty($user_name) && !empty($user_email) && !empty($user_pass)) {



        $user_pass = password_hash($user_pass, PASSWORD_BCRYPT, array('cost' => 12));

        // $query = "SELECT randSalt FROM users";
        // $sel_randsalt_query = mysqli_query($conn,$query);

        // if(!$sel_randsalt_query) {
        //     die("query failed! " . mysqli_error($conn));
        // }

        // $row = mysqli_fetch_array($sel_randsalt_query);

        // $salt = $row['randSalt'];

        // $user_pass = crypt($user_pass, $salt);



        $query = "INSERT INTO users (user_name, user_email, user_pass, user_role) ";
        $query .= "VALUES('{$user_name}','{$user_email}', '{$user_pass}','subscriber' ) ";

        $register_user_query = mysqli_query($conn, $query);

        if (!$register_user_query) {
            die("query failed! " . mysqli_error($conn) . ' ' . mysqli_errno($conn));
        } else {
            $message = "Your registration has been submitted!";
        }
    } else {
        $message = "Fields can not be empty!";
    }
} else {
    $message = "";
}




?>



<!-- Navigation -->

<?php include "includes/nav.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <h6 class="text-center"> <?php echo $message; ?> </h6>
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="user_name" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="user_email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="user_pass" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>