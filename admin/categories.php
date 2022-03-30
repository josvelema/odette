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
          <div class="col-xs-6">

            <?php
            insert_category();
            ?>



            <form action="" method="POST">

              <div class="form-group">
                <label for="cat_title">Add Category</label>
                <input type="text" name="cat_title" class="form-control">

              </div>

              <div class="form-group">

                <input type="submit" name="submit" value="Add Category" class="btn btn-primary">

              </div>


            </form>

            <?php //update and include
            if (isset($_GET['update'])) {

              $cat_id = $_GET['update'];

              include "includes/admin_update_cat.php";
            }
            ?>

          </div>

          <div class="col-xs-6">



            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Category ID</th>
                  <th>User ID</th>
                  <th>Category Title</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php // read all categories query
                read_categories();
                ?>

                <?php // Delete category query
                delete_category();

                ?>
              </tbody>
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