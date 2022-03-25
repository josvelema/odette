<?php
if (isset($_GET['edit_user'])) {

  $edit_user_id = $_GET['edit_user'];

  $query = "SELECT * FROM users WHERE user_id = $edit_user_id ";
  $select_users = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($select_users)) {
    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
    $user_pass = $row['user_pass'];
    $user_first_name = $row['user_first_name'];
    $user_last_name = $row['user_last_name'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
  }


  if (isset($_POST['edit_user'])) {
    // $user_id = $_POST['user_id'];

    $user_name = $_POST['user_name'];
    $user_pass = $_POST['user_pass'];
    $user_email = $_POST['user_email'];
    $user_first_name = $_POST['user_first_name'];
    $user_last_name  = $_POST['user_last_name'];

    $user_role = $_POST['user_role'];


    // $query = "SELECT randSalt FROM users";
    // $sel_randsalt_query = mysqli_query($conn, $query);

    // if (!$sel_randsalt_query) {
    //   die("query failed! " . mysqli_error($conn));
    // }

    // $row = mysqli_fetch_array($sel_randsalt_query);

    // $salt = $row['randSalt'];

    // $hashed_pass = crypt($user_pass, $salt);
    if (!empty($user_pass)) {
      $query_pass = "SELECT user_pass FROM users WHERE user_id = $edit_user_id";
      $get_user_query = mysqli_query($conn, $query_pass);
      confirm_query($get_user_query);

      $row = mysqli_fetch_array($get_user_query);

      $db_user_pass = $row['user_pass'];

      $hashed_pass = "";
      if ($db_user_pass != $user_pass) {

        $hashed_pass = password_hash($user_pass, PASSWORD_BCRYPT, array('cost' => 12));
      }




      $query = "UPDATE users SET ";
      $query .= "user_name = '{$user_name}', ";
      $query .= "user_pass = '{$hashed_pass}', ";

      $query .= "user_first_name = '{$user_first_name}', ";
      $query .= "user_last_name = '{$user_last_name}', ";
      $query .= "user_email = '{$user_email}', ";
      $query .= "user_role = '{$user_role}', ";
      $query .= "user_image = '{$user_image}' ";
      $query .= "WHERE user_id = {$edit_user_id} ";



      $edit_user_query = mysqli_query($conn, $query);

      confirm_query($edit_user_query);

      echo "User Updated " . " <a href='users.php'>View Users?</a>";
    } // end if of password empty check

  } // post request to edit user

} else {  // If the user id is not present in the URL we redirect to the home page


  header("Location: index.php");
}

?>

<form action="" method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Username</label>
    <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>" />
  </div>


  <div class="form-group">
    <label for="user_pass">password</label>
    <input type="password" class="form-control" name="user_pass" autocomplete="off" />
  </div>

  <div class="form-group">
    <label for="user_email">E-mail</label>
    <input type="email" class="form-control" name="user_email" id="" value="<?php echo $user_email; ?>" />
  </div>

  <div class="form-group">
    <label for="user_first_nametitle">First Name</label>
    <input type="text" class="form-control" name="user_first_name" value="<?php echo $user_first_name; ?>" />
  </div>

  <div class="form-group">
    <label for="user_last_name">Last Name</label>
    <input type="text" class="form-control" name="user_last_name" value="<?php echo $user_last_name; ?>" />
  </div>

  <!-- <div class="form-group">
    <label for="user_role">User role</label>
    <select name="user_role" id="">
      
      <?php

      // $query = "SELECT * FROM users";
      // $add_select_role = mysqli_query($conn, $query);

      // confirm_query($add_select_role);


      // while ($row = mysqli_fetch_assoc($add_select_role)) {
      //   $user_id = $row['user_id'];
      //   $user_role = $row['user_role'];


      //   echo "<option value='$user_id'>{$user_role}</option>";
      // }

      ?> 

  </select>
  </div> -->
  <div class="form-group">


    <label for="user_role">User role</label>
    <select name="user_role" id="">
      <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
      <?php

      if ($user_role == 'admin') {
        echo '<option value="subscriber">Subscriber</option>';
      } else {
        echo '<option value="admin">Admin</option>';
      }


      ?>


    </select>
  </div>

  <!-- <div class="form-group">
    <label for="user_image">User Image</label>
    <input type="file" name="user_image" />
  </div> -->


  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user" value="Edit user">
  </div>
</form>