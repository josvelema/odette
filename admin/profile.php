<?php include "includes/admin_header.php"; ?>


<?php

if (isset($_SESSION['session_user_name'])) {

  $session_user_name = $_SESSION['session_user_name'];

  $query = "SELECT * FROM users WHERE user_name = '{$session_user_name}' ";

  $select_user_profile = mysqli_query($conn,$query);

  while($row = mysqli_fetch_array($select_user_profile)) {
    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
    $user_pass = $row['user_pass'];
    $user_first_name = $row['user_first_name'];
    $user_last_name = $row['user_last_name'];
    $user_email = $row['user_email'];
    // $user_image = $row['user_image'];
    $user_role = $row['user_role'];
    

  }


}

?>

<?php 

if (isset($_POST['edit_profile'])) {
  // $user_id = escape($_POST['user_id']);

  $user_name = escape($_POST['user_name']);
  $user_pass = escape($_POST['user_pass']);
  $user_email = escape($_POST['user_email']);
  $user_first_name = escape($_POST['user_first_name']);
  $user_last_name  = escape($_POST['user_last_name']);



  // $user_image = $_FILES['user_image']['name'];
  // $user_image_tmp = $_FILES['user_image']['tmp_name'];

  // $user_date = date(DATE_RFC2822);


  // move_uploaded_file($user_image_tmp, "../images/$user_image");

  $query = "UPDATE users SET ";
  $query .= "user_name = '{$user_name}', ";
  $query .= "user_pass = '{$user_pass}', ";
  
  $query .= "user_first_name = '{$user_first_name}', ";
  $query .= "user_last_name = '{$user_last_name}', ";
  $query .= "user_email = '{$user_email}', ";

  // $query .= "user_image = '{$user_image}' ";
  $query .= "WHERE user_name = '{$session_user_name}' ";



  $edit_user_query = mysqli_query($conn, $query);

  confirm_query($edit_user_query);
}


?>

<div id="wrapper">




  <?php include "includes/admin_nav.php"; ?>
  <div id="page-wrapper">

    <div class="container-fluid ">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Welcome to Admin
            <small>Author: </small>
          </h1>




        </div>

<form action="" method="POST" enctype="multipart/form-data">

<div class="form-group">
  <label for="title">Username</label>
  <input type="text" class="form-control" name="user_name" value="<?php echo $user_name;?>" />
</div>


<div class="form-group">
  <label for="user_pass">password</label>
  <input type="password" class="form-control" name="user_pass" autocomplete="off"/>
</div>

<div class="form-group">
  <label for="user_email">E-mail</label>
  <input type="email" class="form-control" name="user_email" id=""  value="<?php echo $user_email; ?>"/>
</div>

<div class="form-group">
  <label for="user_first_nametitle">First Name</label>
  <input type="text" class="form-control" name="user_first_name"  value="<?php echo $user_first_name;?>"/>
</div>

<div class="form-group">
  <label for="user_last_name">Last Name</label>
  <input type="text" class="form-control" name="user_last_name"  value="<?php echo $user_last_name; ?>"/>
</div>



<!-- <div class="form-group">
  <label for="user_image">User Image</label>
  <input type="file" name="user_image" />
</div> -->


<div class="form-group">
  <input class="btn btn-primary" type="submit" name="edit_profile" value="Update Profile">
</div>
</form>

      </div>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->



<?php include "includes/admin_footer.php"; ?>