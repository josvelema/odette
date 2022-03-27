<?php ob_start(); ?>
<?php

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

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

            $max_posts_per_page = 5;

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {

                $page = "";
            }

            if ($page == "" || $page == 1) {
                $page_1 = 0;
            } else {

                $page_1 = ($page * $max_posts_per_page) - $max_posts_per_page;
            }


            $post_query_count = "SELECT * FROM posts";
            $count_posts = mysqli_query($conn, $post_query_count);
            $counted_posts = mysqli_num_rows($count_posts);
            // $total_posts = mysqli_num_rows($count_posts);
            $counted_posts = ceil($counted_posts / $max_posts_per_page);


            $query = "SELECT * FROM posts ORDER by post_id DESC LIMIT $page_1, $max_posts_per_page ";

            $select_all_posts = mysqli_query($conn, $query);


            while ($row = mysqli_fetch_assoc($select_all_posts)) {

                $post_id = $row['post_id'];

                $post_title = $row['post_title'];


                $post_author = $row['post_author'];

                $post_date = $row['post_date'];

                $post_image = $row['post_image'];

                $post_content = substr($row['post_content'], 0, 128);

                $post_status = $row['post_status'];

                if ($post_status == 'published') {

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
            } ?>







        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>
    </div>
    <!-- /.row -->

    <hr>
    <ul class="pager">
        <?php


        for ($i = 1; $i <= $counted_posts; $i++) {

            if ($i == $page) {
                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            } else {
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
        }
        ?>

    </ul>



    <!-- Footer -->
    <?php include "includes/footer.php" ?>