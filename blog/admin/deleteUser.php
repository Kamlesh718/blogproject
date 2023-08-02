<?php
require 'config/database.php';

// Getting id from url
if(isset($_GET['id'])){
  $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
  
  // fetch user from database
  $query = "SELECT * FROM users WHERE id=$id";
  $result = mysqli_query($connection,$query);
  $user = mysqli_fetch_assoc($result);

  // Making sure we got only one user
  if(mysqli_num_rows($result) == 1){
    $profile_name = $user['profile'];
    $profile_path = '../images/' . $profile_name; 
    // delete image if available
    if($profile_path){
      unlink($profile_path);
    }
  }


  // delete user from database
  $delete_user_query = "DELETE FROM users WHERE id=$id";
  $delete_user_result = mysqli_query($connection,$delete_user_query);
  if(mysqli_errno($connection)){
    $_SESSION['delete-user'] = "Couldn't delete '{$user['firstname']}' '{$user['lastname']}' ";
  } else{
    $_SESSION['delete-user-success'] = "{$user['firstname']} {$user['lastname']} deleted successfully";
  }
}

header('location: ' . ROOT_URL . 'admin/manageUsers.php');
die();