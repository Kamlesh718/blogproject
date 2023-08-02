<?php
require 'config/database.php';

if(isset($_POST['submit'])){
  $id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
  $title = filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $body = filter_var($_POST['body'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $category_id = filter_var($_POST['category'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if(!$title){
    $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page";
  } elseif (!$category_id){
    $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page";
  } elseif(!$body){
    $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page";
  }
  //redirect to manage form page if form was invalid
  if(isset($_SESSION['edit-post'])){
    header('location: ' . ROOT_URL . 'admin/');
    die();
  } else {


    // updating posts into data base
    $query = "UPDATE posts SET title='$title', body='$body', category_id=$category_id WHERE id=$id LIMIT 1";
    $result = mysqli_query($connection,$query);
    if(mysqli_errno($connection)){
      $_SESSION['edit-post'] = "Unable to edit post";
      header('location: ' . ROOT_URL . 'admin/editPost.php');
      die();
    } else {
      $_SESSION['edit-post-success'] = "Post edited successfully";
      header('location: ' . ROOT_URL . 'admin/');
      die();
    }
  }
}




