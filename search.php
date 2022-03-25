<?php

include "includes/header.php";
include "includes/db.php";

?>
<!-- Navigation -->
<?php include "includes/nav.php"; ?>

<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">
      <?php
      if (isset($_POST['submit'])) {

        $search = escape($_POST['search']);

        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";

        $search_query = mysqli_query($conn, $query);

        if (!$search_query) {

          die("Query failed!" . mysqli_error($conn));
        }

        $count = mysqli_num_rows($search_query);

        if ($count == 0) {
          echo "<h2>No result</h2>";
        } else {




          // $query = "SELECT * FROM posts";

          // $select_all_posts = mysqli_query($conn, $query);

          while ($row = mysqli_fetch_assoc($search_query)) {

            $post_id = $row['post_id'];

            $post_title = $row['post_title'];


            $post_author = $row['post_author'];

            $post_date = $row['post_date'];

            $post_image = $row['post_image'];

            $post_content = $row['post_content'];
      ?>

            <h1 class="page-header">
              <!-- <h2> <?php echo $total_posts; ?></h2> -->
              <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <h2>
              <!-- <a href="post.php?p_id= -->

              <a href="post/<?php echo $post_id; ?>"><?php echo $post_title; ?></a>

            </h2>


            <p class="lead">
              by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author; ?></a>
            </p>


            <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>


            <hr>
            <a href="post/<?php echo $post_id; ?>">
              <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
            </a>
            <hr>


            <p><?php echo $post_content ?></p>
            <a class="btn btn-primary" href="post/<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>



      <?php }
        }
      }

      ?>







    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php"; ?>
  </div>
  <!-- /.row -->

  <hr>

  <!-- Footer
  <?php include "includes/footer.php"; ?>