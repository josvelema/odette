<?php include "includes/admin_header.php"; ?>

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



          <table class="table table-bordered">
            <thead>
              <tr>
                <th>id</th>
                <th>author</th>
                <th>Comment</th>
                <th>Email</th>
                <th>Status</th>
                <th>Response to</th>
                <th>Date</th>
                <th>(un)approve</th>
              </tr>
            </thead>

            <tbody>

              <?php


              $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($conn, $_GET['id']) . " ";
              $select_comments = mysqli_query($conn, $query);

              while ($row = mysqli_fetch_assoc($select_comments)) {
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_email = $row['comment_email'];
                $comment_date = $row['comment_date'];
                // $comment_image = $row['comment_image'];
                $comment_content = $row['comment_content'];
                // $comment_tags = $row['comment_tags'];
                // $comment_comment_count = $row['comment_comment_count'];
                $comment_status = $row['comment_status'];

                echo "<tr>";
                echo "<td>{$comment_id}</td>";
                echo "<td>{$comment_author}</td>";
                echo "<td><div class='rj-td-wrap'>{$comment_content}</div></td>";





                echo "<td>{$comment_email}</td>";
                echo "<td>{$comment_status}</td>";

                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                $select_post_id_query = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                  $post_id = $row['post_id'];
                  $post_title = $row['post_title'];

                  echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td?";
                }

                echo "<td>{$comment_post_id}</td>";

                echo "<td>{$comment_date}</td>";



                echo "<td >";
                echo "<a href='comments.php?approve={$comment_id}' class='';>Approve</a>";

                echo " / ";
                echo "<a href='comments.php?unapprove={$comment_id}' class='';>Unapprove</a></td>";



                echo "<td style='display: flex;justify-content: center;align-items: center;background: red;'>";
                echo "<a href='comments.php?delete={$comment_id}' class='';>Delete</a></td>";

                echo "</tr>";
              }


              ?>

            </tbody>

            <?php


            if (isset($_GET['approve'])) {

              $approve_comment_id = $_GET['approve'];

              $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$approve_comment_id}";

              $status_query = mysqli_query($conn, $query);

              header("Location: comments.php");
            }

            if (isset($_GET['unapprove'])) {

              $unapprove_comment_id = $_GET['unapprove'];

              $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$unapprove_comment_id}";

              $status_query = mysqli_query($conn, $query);

              header("Location: comments.php");
            }


            if (isset($_GET['delete'])) {

              if (isset($_SESSION['user_role'])) {

                if ($_SESSION['user_role'] == 'admin') {


                  $del_comment_id = mysqli_real_escape_string($conn, $_GET['delete']);

                  $query = "DELETE FROM comments WHERE comment_id = {$del_comment_id}";

                  $delete_query = mysqli_query($conn, $query);

                  header("Location: comments.php");
                }
              }
            }




            ?>





          </table>


        </div>

      </div>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->



<?php include "includes/admin_footer.php"; ?>