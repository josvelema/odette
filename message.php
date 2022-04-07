<?php

include "includes/header.php";
include "includes/db.php";
include "includes/nav.php";
?>

<main class="home message">
    <section class="section-post">
        <h1>Odette's Gastenboek</h1>


        <?php


        if (isset($_POST['create_msg'])) {


            $msg_author = escape($_POST['msg_author']);
            $msg_email = escape($_POST['msg_email']);
            $msg_content = escape($_POST['msg_content']);
            if (!empty($msg_author) && !empty($msg_email) && !empty($msg_content)) {

                $query = "INSERT INTO messages (msg_author, msg_email, msg_content, msg_status) ";

                $query .= "VALUES ('{$msg_author}', '{$msg_email}', '{$msg_content}', 'approved')";

                $create_msg_query = mysqli_query($conn, $query);

                confirm_query($create_msg_query);

                // $query = "UPDATE posts SET msg_msg_count = msg_msg_count + 1 ";
                // $query .= "WHERE msg_id = $this_msg_id ";
                // $update_msg_count = mysqli_query($conn, $query);


            } else {
                echo "<script>alert('Fields cannot be empty!');</script>";
            }
        }

        ?>
        <div class="band">
            <div class="item-1">
                <div class="form-wrapper card">
                    <h4>Laat een bericht achter</h4>
                    <form method="POST">
                        <div class="rj-input-group">
                            <label class="form-label" for="msg_author">Naam</label>
                            <input type="text" id="name" placeholder="naam" name="msg_author">
                        </div>
                        <div class="rj-input-group">
                            <label class="form-label" for="email">E-mail</label>
                            <input type="text" id="email" placeholder="email@email.com" name="msg_email">
                        </div>
                        <div class="rj-input-group">
                            <label class="form-label" for="content">Comment</label>
                            <textarea rows="5" columns ="50" id="content" placeholder="Comment" name="msg_content"></textarea>
                        </div>
                        <input type="submit" value="Submit" name="create_msg">
                    </form>
                </div>
            </div>

            <?php

            $query = "SELECT * FROM messages ";
            $query .= "WHERE msg_status = 'approved' ";
            $query .= "ORDER BY msg_id DESC ";

            $select_msg_query = mysqli_query($conn, $query);

            confirm_query($select_msg_query);

            while ($row = mysqli_fetch_array($select_msg_query)) {
                $msg_date = $row['msg_date'];
                $msg_content = $row['msg_content'];
                $msg_author = $row['msg_author'];
                $msg_email = $row['msg_email'];



            ?>




                <!-- Comment -->
                <div class="item-1">

                    <article class="card">
                        <h2><?php echo $msg_author;  ?></h2>
                        <p><?php echo $msg_content; ?></p>
                        <span><small><?php echo "Posted on: " . $msg_date ?></small></span>
                    </article>
                </div>
            <?php
            }
            ?>
        </div>
    </section>

    <!-- Comments Form -->
    <!-- <div class="well">
        
        <form role="form" action="" method="POST">
            <label for="author">author</label>
            <div class="form-group">
                <input type="text" name="msg_author" id="" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>

                <input type="email" name="msg_email" id="" class="form-control">
            </div>

            <div class="form-group">
                <label for="content">Comment:</label>
                <textarea class="form-control" rows="3" name="msg_content"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="create_msg">Submit</button>

        </form>
    </div> -->
    <section class="section-post">






        <!-- Posted Comments -->




    </section>
</main>

<!-- Footer -->
<?php include "includes/footer.php" ?>