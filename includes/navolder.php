<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/odette">Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php

                $query = "SELECT * FROM categories";
                $select_all = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($select_all)) {
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];

                    echo "<li><a href='/odette/category/{$cat_id}'>{$cat_title}</a></li>";
                }

                ?>
                <?php if (isLoggedIn()) : ?>
                    <li><a href="/odette/admin">Admin</a></li>
                    <li><a href="/odette/includes/logout.php">Log out</a></li>
                    

                <?php else : ?>
                    <li><a href="/odette/login.php">Log in</a></li>


                <?php endif; ?>
                <li><a href="/odette/registration">Registration</a></li>

                <?php

                if (isset($_SESSION['session_user_role'])) {

                    if (isset($_GET['p_id'])) {
                        $get_post =  $_GET['p_id'];
                        echo "<li><a href='/odette/admin/posts.php?source=edit_post&p_id={$get_post}'>Edit post</a></li>";
                    }
                }


                ?>





            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>