$query = "UPDATE posts SET(post_cat_id , post_title, post_author, post_date, ";
  $query .= "post_image, post_content, post_tags) ";

  $query .= "VALUES({$post_cat_id} , '{$post_title}', '{$post_author}', now(), ";
  $query .= "'{$post_image}', '{$post_content}', '{$post_tags}' ) ";

  $query .= "WHERE post_id = {$edit_post_id}";