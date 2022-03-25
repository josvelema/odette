<?php
if (isset($_GET['p_id'])) {
  $the_post_id = $_GET['p_id'];
}
$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
$select_posts_by_id = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
  $post_id = $row['post_id'];
  $post_author = $row['post_author'];
  $post_title = $row['post_title'];
  $post_cat_id = $row['post_cat_id'];
  $post_status = $row['post_status'];
  $post_image = $row['post_image'];
  $post_content = $row['post_content'];
  $post_tags = $row['post_tags'];
  $post_comment_count = $row['post_comment_count'];
  $post_date = $row['post_date'];
}
if (isset($_POST['update_post'])) {
  $post_author = escape($_POST['post_author']);
  $post_title = escape($_POST['post_title']);
  $post_cat_id = escape($_POST['post_cat']);
  $post_status = escape($_POST['post_status']);

  $post_image = $_FILES['post_image']['name'];
  $post_image_tmp = $_FILES['post_image']['tmp_name'];


  //TODO lesson 266 <?php echo str_replace('\r\n','</br>', $post_content ); not working 
  // find fix and escape post_content 
  // ? stripcslashes()
  $post_content = $_POST['post_content'];
  $post_tags = escape($_POST['post_tags']);
  move_uploaded_file($post_image_tmp, "../images/$post_image");

  if (empty($post_image)) {
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
    $select_image = mysqli_query($conn, $query); //result set
    while ($row = mysqli_fetch_array($select_image)) {
      $post_image = $row['post_image'];
    }
  }



  $query = "UPDATE posts SET ";
  $query .= "post_title = '{$post_title}', ";
  $query .= "post_cat_id = {$post_cat_id}, ";
  $query .= "post_date = now(), ";
  $query .= "post_author = '{$post_author}', ";
  $query .= "post_status = '{$post_status}', ";
  $query .= "post_tags = '{$post_tags}', ";
  $query .= "post_content = '{$post_content}', ";
  $query .= "post_image = '{$post_image}' ";
  $query .= "WHERE post_id = {$the_post_id} ";

  $update_post = mysqli_query($conn, $query);

  confirm_query($update_post);

  echo "<p class='bg-success'>Post updated! - <a href='../post.php?p_id={$the_post_id}'>View post</a> - 
  <a href='posts.php'>Edit more posts</a></p>";
}

?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>" />
  </div>

  <div class="form-group">
    <select name="post_cat" id="post_cat">
      <?php
      $query = "SELECT * FROM categories";
      $select_categories = mysqli_query($conn, $query);

      confirm_query($select_categories);

      while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];

        $cat_title = $row['cat_title'];


        if($cat_id == $post_cat_id) {
        echo "<option selected value='{$cat_id}'>{$cat_title}</option>";

        } else {
        echo "<option value='{$cat_id}'>{$cat_title}</option>";

        }

      }


      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="title">Post Author</label>
    <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>" />
  </div>

  <div class="form-group">
    <select name="post_status" id="">
      <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
      <?php
      if ($post_status == 'published') {

        echo "<option value='draft'>draft</option>";
      } else {
        echo "<option value='published'>published</option>";
      }

      ?>
    </select>
  </div>










  <!-- 
  <div class="form-group">
    <label for="post_status">Post Status</label>
    <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>" />
  </div> -->

  <div class="form-group">
    <img class='rj-img-posts' src='../images/<?php echo $post_image; ?>' alt='img'>

    <label for="post_image">Post Image</label>
    <input type="file" name="post_image" />
  </div>


  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>" />
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" id="summernote" rows="10" cols="30"><?php echo $post_content;?></textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
  </div>
</form>