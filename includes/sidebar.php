
<?php


if(isMethod('post')){


        if(isset($_POST['login'])){


            if(isset($_POST['user_name']) && isset($_POST['user_pass'])){

                loginUser($_POST['user_name'], $_POST['user_pass']);


            }else {


                redirect('index');
            }


        }

}

?>


<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="POST">
            <div class="input-group">
                <input type="text" class="form-control" name="search">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <div class="well">
        <?php 
        if(session_status() === PHP_SESSION_NONE) session_start();
        ?>

        <?php
        if(isset($_SESSION['session_user_role'])) : ?>

            <h4>Logged in as: <?php echo $_SESSION['session_user_name']; ?></h4>
            <a href="includes/logout.php" class="btn btn-primary">Log out</a>
</div>

        <?php else : ?>
            <h4>Login</h4>

            <form method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" name="user_name" placeholder="username">
                </div>

                <div class="input-group">
                    <input type="password" class="form-control" name="user_pass" placeholder="password">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" name="login" type="submit">Login</button>
                    </span>

                </div>
                    <div class="form-group"><a href="forgot.php?forgot=<?php echo uniqid(true) ;?>">Forgot password?</a></div>
            </form>
            <!-- /.input-group -->
    </div>


<?php endif; ?>




<!-- Blog Categories Well -->
<div class="well">

    <?php


    $query = "SELECT * FROM categories";
    $select_all_sidebar = mysqli_query($conn, $query);

    ?>

    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
                <?php

                while ($row = mysqli_fetch_assoc($select_all_sidebar)) {
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];


                    echo "<li><a href='category.php?category=$cat_id '>{$cat_title}</a></li>";
                }

                ?>


            </ul>
        </div>
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>





<!-- Side Widget Well -->
<?php include "widget.php" ?>

</div>