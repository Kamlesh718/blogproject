<?php
require 'config/database.php';

if(isset($_POST['submit'])){
  // get form data
  $username_email = filter_var($_POST['username_email'],FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS);

  if(!$username_email){
    $_SESSION['signin'] = 'Username or Email Required';
  } elseif(!$password){
    $_SESSION['signin'] = 'Password required';
  } else{
    // Fetch user from database
    $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
    $fetch_user_result = mysqli_query($connection,$fetch_user_query);

    if(mysqli_num_rows($fetch_user_result) == 1) {
      // Convert the array into associative array
      $user_record = mysqli_fetch_assoc($fetch_user_result);
      $db_password = $user_record['password'];
      // Comparing password with db password
      if(password_verify($password,$db_password)){
        // Set session for access control
        $_SESSION['user-id'] = $user_record['id'];
        // set session if user is an admin
        if($user_record['is_admin'] == 1){
          $_SESSION['user_is_admin'] = true;
        }
        // log user in
        header('location: ' . ROOT_URL . 'admin/');
      } else{
        $_SESSION['signin'] = 'Please check your inputs';
      }

    } else {
      $_SESSION['signin'] = 'User not Found';
    }

  }

  // if any problem redirect back to signin page with login data
  if(isset($_SESSION['signin'])){
    header('location: ' . ROOT_URL . 'signin.php');
    die();
  }

} else {
  header('location: ' . ROOT_URL . 'signin.php');
  die();
}
