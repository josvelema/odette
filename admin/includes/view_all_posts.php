<table class="table table-bordered">
  <thead>
    <tr>
      <th>id</th>
      <th>title</th>
      <th>author</th>
      <th>cat</th>
      <th>date</th>
      <th>image</th>
      <th>content</th>
      <th>tags</th>
      <th>comment_<br>count</th>
      <th>status</th>
      <th>views</th>
    </tr>
  </thead>

  <tbody>


    <?php
    // $thisUser = currentUser();
    $thisUser = "Jos";

    // joining tables , seperate tables and colums by a dot.

    $query = "SELECT posts.post_id, posts.post_author, posts.post_title, posts.post_content, posts.post_cat_id, posts.post_status, ";
    $query .= "posts.post_image, posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views, ";
    $query .= "categories.cat_id, categories.cat_title ";
    $query .= "FROM posts LEFT JOIN categories ON posts.post_cat_id = categories.cat_id ";
    // $query .= "WHERE post_author = 'Jos'";

//todo above change to $thisUser when db is reset. and make when admin function to see all posts

    $select_posts = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($select_posts)) {
      $post_id = $row['post_id'];
      $post_cat_id = $row['post_cat_id'];
      $post_title = $row['post_title'];
      $post_author = $row['post_author'];
      $post_date = $row['post_date'];
      $post_image = $row['post_image'];
      $post_content = $row['post_content'];
      $post_tags = $row['post_tags'];
      $post_comment_count = $row['post_comment_count'];
      $post_status = $row['post_status'];
      $post_views = $row['post_views'];
      $cat_title = $row['cat_title'];
      //cat_id also available if needed

      echo "<tr>";
      echo "<td>{$post_id}</td>";
      echo "<td><a href='../post.php?p_id={$post_id}';>{$post_title}</a></td>";
      echo "<td>{$post_author}</td>";
      echo "<td>{$cat_title}</td>";
      echo "<td>{$post_date}</td>";
      echo "<td><img class='rj-img-posts' src='../images/$post_image' alt='img'></td>";
      echo "<td><div class='rj-td-wrap'>{$post_content}</div></td>";
      echo "<td>{$post_tags}</td>";

      $comment_query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
      $send_comment_query = mysqli_query($conn, $comment_query);

      $comment_row = mysqli_fetch_array($send_comment_query);
      $comment_id = $comment_row['comment_id'];

      $count_comments = mysqli_num_rows($send_comment_query);

      // echo "<td>{$post_comment_count}</td>";
      echo "<td>$count_comments<br><a href='post_comments.php?id=$post_id'>view</a></td>";

      echo "<td>{$post_status}</td>";
      echo "<td>{$post_views}<br>
      <a href='posts.php?reset={$post_id}' onClick=\" return confirm('Are you sure you want to reset views?'); \">reset</a></td>";



      // echo "<td><a href='../post.php?p_id={$post_id}';>View Post</a></td>";

      echo "<td style='display: flex;justify-content: center;align-items: center;background: orange;'>";
      echo "<a href='posts.php?source=edit_post&p_id={$post_id}' class='';>Edit</a></td>";

      echo "<td style='display: flex;justify-content: center;align-items: center;background: red;'>";
      echo "<a href='posts.php?delete={$post_id}' class=''; onClick=\" return confirm('Are you sure you want to delete?'); \">Delete</a></td>";

      echo "</tr>";
    }


    ?>
    <script>
      function confirmMe() {
        //TODO write better confirm function!!

        confirm('are you sure you want to delete?');

        return

      }
    </script>


  </tbody>

  <?php

  if (isset($_GET['delete'])) {

    if (isset($_SESSION['user_role'])) {

      if ($_SESSION['user_role'] == 'admin') {


        $del_post_id = mysqli_real_escape_string($conn, $_GET['delete']);

        $query = "DELETE FROM posts WHERE post_id = {$del_post_id}";

        $delete_query = mysqli_query($conn, $query);

        header("Location: posts.php");
      }
    }
  }

  if (isset($_GET['reset'])) {

    if (isset($_SESSION['user_role'])) {

      if ($_SESSION['user_role'] == 'admin') {


        $rst_user_id = mysqli_real_escape_string($conn, $_GET['delete']);

        $query = "UPDATE posts SET post_views = 0 WHERE post_id = {$rst_post_id}";

        $reset_query = mysqli_query($conn, $query);

        header("Location: posts.php");
      }
    }
  }

  ?>





</table>