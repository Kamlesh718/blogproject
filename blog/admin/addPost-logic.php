<?php
require 'config/database.php';

if(isset($_POST['submit'])){
  $author_id = $_SESSION['user-id'];
  $title = filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $body = filter_var($_POST['body'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $category_id = filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
  // $is_featured = filter_var($_POST['is_featured'],FILTER_SANITIZE_NUMBER_INT);
  // set is fetured to 0 uf checked
  // $is_featured = $is_featured == 1?: 0;
  // validate form data
  if(!$title){
    $_SESSION['add-post'] = "Enter post title";
  } elseif (!$category_id){
    $_SESSION['add-post'] = "Select Post Category";
  } elseif(!$body){
    $_SESSION['add-post'] = "Enter post body";
  }
  //redirect back with form with add-post page
  if(isset($_SESSION['add-post'])){
    $_SESSION['add-post-data'] = $_POST;
    header('location: ' . ROOT_URL . 'admin/addPost.php');
    die();
  } else {


    // insert post into data base
    $query = "INSERT INTO posts (title,body,category_id,author_id) VALUES ('$title','$body',$category_id,$author_id)";
    $result = mysqli_query($connection,$query);
    if(mysqli_errno($connection)){
      $_SESSION['add-post'] = "Unable to add post";
      header('location: ' . ROOT_URL . 'admin/addPost.php');
      die();
    } else {
      $_SESSION['add-post-success'] = "Post added successfully";
      header('location: ' . ROOT_URL . 'admin/');
      die();
    }
  }
}

