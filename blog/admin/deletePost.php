<?php
require 'config/database.php';

if(isset($_GET['id'])){
  $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);

  //fetch post from database
  // delete category
  $query = "DELETE FROM posts WHERE id=$id LIMIT 1";
  $result = mysqli_query($connection,$query);
  $_SESSION['delete-post-success'] = "Post deleted successfully";
}



header('location: ' . ROOT_URL . 'admin/');