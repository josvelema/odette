<table class="table table-bordered">
  <thead>
    <tr>
      <th>id</th>
      <th>Username</th>
      <th>FirstName</th>
      <th>LastName</th>
      <th>Email</th>
      <th>Role</th>
      <th>Date</th>
      <th>Change role</th>
    </tr>
  </thead>

  <tbody>

    <?php
    $query = "SELECT * FROM users";
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


      echo "<tr>";
      echo "<td>{$user_id}</td>";
      echo "<td>{$user_name}</td>";
      echo "<td>{$user_first_name}</td>";
      echo "<td>{$user_last_name}</td>";
      echo "<td>{$user_email}</td>";
      echo "<td>{$user_role}</td>";
      echo "<td>date</td>";

      // $query = "SELECT * FROM users";
      // $select_user_id_query = mysqli_query($conn,$query);
      // while($row = mysqli_fetch_assoc($select_user_id_query)) {
      //   $user_id = $row['user_id'];
      //   $user_name = $row['user_name'];

      //   echo "<td><a href='../post.php?p_id=$user_id'>$user_name</a></td?";
      // }


      echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a> / <a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";

      echo "<td style='display: flex;justify-content: center;align-items: center;background: orange;'>";
      echo "<a href='users.php?source=edit_user&edit_user={$user_id}' class='';>Edit</a>";

      echo "<td style='display: flex;justify-content: center;align-items: center;background: red;'>";
      echo "<a href='users.php?delete={$user_id}' class='';>Delete</a></td>";


      echo "</tr>";
    }


    ?>

  </tbody>

  <?php


  if (isset($_GET['change_to_sub'])) {

    $role_user_id = $_GET['change_to_sub'];

    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$role_user_id}";

    $sub_role_query = mysqli_query($conn, $query);

    header("Location: users.php");
  }


  if (isset($_GET['change_to_admin'])) {

    $role_user_id = $_GET['change_to_admin'];

    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$role_user_id}";

    $admin_role_query = mysqli_query($conn, $query);

    header("Location: users.php");
  }


  if (isset($_GET['delete'])) {

    if (isset($_SESSION['user_role'])) {

      if ($_SESSION['user_role'] == 'admin') {


        $del_user_id = mysqli_real_escape_string($conn,$_GET['delete']);

        $query = "DELETE FROM users WHERE user_id = {$del_user_id}";

        $delete_query = mysqli_query($conn, $query);

        header("Location: users.php");
      }
    }
  }



  ?>





</table>