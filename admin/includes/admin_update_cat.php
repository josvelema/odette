<form action="" method="post">
  <div class="form-group">
    <label for="cat-title">Edit Category</label>


    <?php

    if (isset($_GET['update'])) {

      $cat_id = escape($_GET['update']);




      $query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
      $select_categories_id = mysqli_query($conn, $query);

      while ($row = mysqli_fetch_assoc($select_categories_id)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

    ?>

        <input value="<?php echo trim($cat_title); ?>" type="text" class="form-control" name="cat_title">



    <?php }
    } ?>

    <?php

    // UPDATE QUERY

    if (isset($_POST['update_category'])) {

      $the_cat_title = escape($_POST['cat_title']);

      $cat_user_id = loggedInUserId();

      $stmt = mysqli_prepare($conn, "UPDATE categories SET cat_title = ?, cat_user_id= ? WHERE cat_id = ? ");

      mysqli_stmt_bind_param($stmt, 'sii', $the_cat_title,$cat_user_id, $cat_id); //s = string i = integer

      mysqli_stmt_execute($stmt);


      if (!$stmt) {

        die("QUERY FAILED" . mysqli_error($conn));
      }

      mysqli_stmt_close($stmt);


      redirect("categories.php");
    }

    ?>



  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
  </div>

</form>