<?php
if (isset($_POST['add_user'])) {
  // $user_id = escape($_POST['user_id']);

  $user_name = escape($_POST['user_name']);
  $user_pass = escape($_POST['user_pass']);
  $user_email = escape($_POST['user_email']);
  $user_first_name = escape($_POST['user_first_name']);
  $user_last_name  = escape($_POST['user_last_name']);

  $user_role = escape($_POST['user_role']);

  // $user_image = $_FILES['user_image']['name'];
  // $user_image_tmp = $_FILES['user_image']['tmp_name'];

  // $user_date = date(DATE_RFC2822);


  // move_uploaded_file($user_image_tmp, "../images/$user_image");

  $user_pass = password_hash($user_pass, PASSWORD_BCRYPT , array('cost' => 12));

  $query = "INSERT INTO users(user_first_name, user_last_name, user_role,user_name,user_email,user_pass) ";

  $query .= "VALUES('{$user_first_name}','{$user_last_name}','{$user_role}','{$user_name}','{$user_email}', '{$user_pass}') ";
  $add_user_query = mysqli_query($conn, $query);

  confirm_query($add_user_query);

  echo "<h3>User Created: {$user_name} ! " . "<a href='users.php'>View Users</a></h3><br>";
}

?>

<form action="" method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Username</label>
    <input type="text" class="form-control" name="user_name" />
  </div>


  <div class="form-group">
    <label for="user_pass">password</label>
    <input type="password" class="form-control" name="user_pass" />
  </div>

  <div class="form-group">
    <label for="user_email">E-mail</label>
    <input type="email" class="form-control" name="user_email" id="" />
  </div>

  <div class="form-group">
    <label for="user_first_nametitle">First Name</label>
    <input type="text" class="form-control" name="user_first_name" />
  </div>

  <div class="form-group">
    <label for="user_last_name">Last Name</label>
    <input type="text" class="form-control" name="user_last_name" />
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
    <select name="user_role" id="" value="admin">
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
  </div>

  <!-- <div class="form-group">
    <label for="user_image">User Image</label>
    <input type="file" name="user_image" />
  </div> -->


  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="add_user" value="Add user">
  </div>
</form>