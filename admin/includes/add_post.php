<?php
if (isset($_POST['create_post'])) {
  
  $post_user_id = escape($_SESSION['session_user_id']);
  
  $post_title = escape($_POST['post_title']);
  $post_author = escape($_POST['post_author']);
  $post_cat_id = escape($_POST['post_cat']);
  $post_status  = escape($_POST['post_status']);

  $post_image = $_FILES['post_image']['name'];
  $post_image_tmp = $_FILES['post_image']['tmp_name'];


  $post_tags = escape($_POST['post_tags']);
  $post_content = escape($_POST['post_content']);
  $post_date = date(DATE_RFC2822);
  

  move_uploaded_file($post_image_tmp, "../images/$post_image");

  $query = "INSERT INTO posts(post_cat_id , post_user_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";

  $query .= "VALUES({$post_cat_id}, '{$post_user_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' ) ";

  $create_post_query = mysqli_query($conn, $query);

  confirm_query($create_post_query);

  // last inserted 

  $post_id = mysqli_insert_id($conn);

  echo "<p class='bg-success'>Post created! - <a href='../post.php?p_id={$post_id}'>View post</a> - 
  <a href='posts.php?source=add_post'>Add more posts</a></p>" ;
}

?>

<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="post_title" />
  </div>

  <div class="form-group">
    <label for="category">Category</label>
    <select name="post_cat" id="">

      <?php

      $query = "SELECT * FROM categories";
      $add_select_categories = mysqli_query($conn, $query);

      confirm_query($add_select_categories);


      while ($row = mysqli_fetch_assoc($add_select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];


        echo "<option value='$cat_id'>{$cat_title}</option>";
      }

      ?>


    </select>

  </div>


  <div class="form-group">
    <label for="title">Post Author</label>
    <input type="text" class="form-control" name="post_author" />
  </div>

    
  <div class="form-group">
    <label for="post_status">Post Status</label>
<select name="post_status" id="">
  <option value="draft">Select option</option>
  <option value="published">published</option>
  <option value="draft">draft</option>

  
</select>
  </div>



  <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="post_image" />
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags" />
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" id="summernote" rows="10" cols="30"></textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
  </div>
</form>