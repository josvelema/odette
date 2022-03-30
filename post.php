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
            if (isset($_GET['p_id'])) {

                $this_post_id = $_GET['p_id'];
                
                if($_SERVER['REQUEST_METHOD'] !== 'POST') { // only counts when not posting comment
                $view_query = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = $this_post_id ";
                $send_query = mysqli_query($conn, $view_query);
                }


                $query = "SELECT * FROM posts WHERE post_id = $this_post_id ";

                $select_all_posts = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($select_all_posts)) {
                    $post_title = $row['post_title'];


                    $post_author = $row['post_author'];

                    $post_date = $row['post_date'];

                    $post_image = $row['post_image'];

                    $post_content = $row['post_content'];
            ?>

                    <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <?php echo $post_title ?>
                    </h2>


                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author ?></a>
                    </p>


                    <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>


                    <hr>

                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">

                    <hr>


                    <p><?php echo $post_content ?></p>


                    <hr>
            <?php }
            } else {

                header("Location: index.php");
            } ?>



            <!-- Blog Comments -->

            <?php


            if (isset($_POST['create_comment'])) {


                $this_post_id = $_GET['p_id'];

                $comment_author = escape($_POST['comment_author']);
                $comment_email = escape($_POST['comment_email']);
                $comment_content = escape($_POST['comment_content']);
                if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status) ";

                    $query .= "VALUES ({$this_post_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved')";

                    $create_comment_query = mysqli_query($conn, $query);

                    confirm_query($create_comment_query);

                    // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                    // $query .= "WHERE post_id = $this_post_id ";
                    // $update_comment_count = mysqli_query($conn, $query);


                } else {
                    echo "<script>alert('Fields cannot be empty!');</script>";
                }
            }










            ?>


            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" action="" method="POST">
                    <label for="author">author</label>
                    <div class="form-group">
                        <input type="text" name="comment_author" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>

                        <input type="email" name="comment_email" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="content">Comment:</label>
                        <textarea class="form-control" rows="3" name="comment_content"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>

                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php

            $query = "SELECT * FROM comments WHERE comment_post_id = {$this_post_id} ";
            $query .= "AND comment_status = 'approved' ";
            $query .= "ORDER BY comment_id DESC ";

            $select_comment_query = mysqli_query($conn, $query);

            confirm_query($select_comment_query);

            while ($row = mysqli_fetch_array($select_comment_query)) {
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];
                $comment_email = $row['comment_email'];



            ?>




                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?> - <small>Posted: <?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
            <?php } ?>



        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php" ?>