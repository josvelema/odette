<?php ob_start();

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

include "includes/header.php";
include "includes/db.php";
include "includes/nav.php";
$max_posts_per_page = 6;

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
?>

<main class="home">
    <section class="hero">
        
        <h1>Odette<br>Frances Fae</h1>

        <div class="band">
        <?php
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


          <div class="item-1">
            <a href="post/<?php echo $post_id; ?>" class="card">
              <div class="thumb">
                  <img src="images/<?php echo $post_image; ?>" alt="<?php echo $post_title;  ?>">
              </div>
              <article>
                <h2><?php echo $post_title;  ?></h2>
                <p><?php echo $post_content ;?></p>
                <span><small><?php echo "Posted on: " . $post_date ?></small></span>
              </article>
            </a>
          </div>





        <?php }
        } ?>

    </div>
    </section>
    </main>







        <ul class="pager">
            <?php


            // for ($i = 1; $i <= $counted_posts; $i++) {

            // if ($i == $page) {
            // echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            // } else {
            // echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            // }
            // }
            // 
            ?>

        </ul> 



        <!-- Footer -->
        <?php include "includes/footer.php" ?>