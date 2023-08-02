<?php
require 'config/database.php';

// Get signup form data
if(isset($_POST['submit'])){
  $firstname = filter_var($_POST['firstname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $lastname = filter_var($_POST['lastname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $username = filter_var($_POST['username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
  $createpassword = filter_var($_POST['createpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $confirmpassword = filter_var($_POST['confirmpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $profile = $_FILES['profile'];
// profile(file) is array

  // Validating input values
  if(!$firstname){
    $_SESSION['signup']= 'Please enter your FirstName';
  } 
  elseif (!$lastname){
    $_SESSION['signup']= 'Please enter your Lastname';
  }
  elseif (!$username){
    $_SESSION['signup']= 'Please enter your Username 👤';
  }
  elseif (!$email){
    $_SESSION['signup']= 'Please enter your validate email ✉️';
  }
  elseif (strlen($createpassword < 8) || strlen($confirmpassword < 8)){
    $_SESSION['signup']= '🔑 Password should be 8+ characters ';
  }
  elseif (!$profile['name']){
    $_SESSION['signup']= 'Please select a profile image';
  } else {
    // Check if passwords dont match
    if($createpassword !== $confirmpassword){
      $_SESSION['signup'] = 'Passwords do not match';
    } else{
      // hash password
      $hashed_password = password_hash($createpassword,PASSWORD_DEFAULT);

      // check if username or email already exist in database
      $user_check_query = "SELECT * FROM users WHERE (username='$username' OR email = '$email');";
      $user_check_result = mysqli_query($connection,$user_check_query);
      if(mysqli_num_rows($user_check_result)){

        $row = mysqli_fetch_assoc($user_check_result);
        if($email == isset($row['email'])){
          $_SESSION['add-user'] = 'Username or Email already exists';
        }
        if($username == isset($row['username'])){
          $_SESSION['add-user'] = 'Username or Email already exists';
        } } else{
        // Work on profile
        // Rename Profile
        $time = time(); //making each image name unique using current timestamp
        $profile_name = $time . $profile['name'];
        $profile_tmp_name = $profile['tmp_name'];
        $profile_destination_path = 'images/' . $profile_name;

        //Checking File is an image
        $allowed_files = ['png','jpg','jpeg'];
        $extension = explode('.',$profile_name);
        $extension = end($extension);
        if (in_array($extension,$allowed_files)){
          //Making sure image is not to large (1mb+)
          if($profile['size'] < 1000000){
            // upload profile
            move_uploaded_file($profile_tmp_name,$profile_destination_path);
          } else {
            $_SESSION['signup'] = 'File size too big.Should be less than 1mb';
          }
        } else {
          $_SESSION['signup'] = 'File should be png,jpg or jpeg';
        }
      }
    }
  }

  // Redirect back to signup page if any problem
  if(isset($_SESSION['signup'])) {
    // pass form data back to signup page
    $_SESSION['signup-data'] = $_POST;
    header('location: ' . ROOT_URL . 'signup.php');
    die();
  } else {
    // insert new user into users table
    $insert_user_query = "INSERT INTO users SET firstname = '$firstname',lastname='$lastname',username='$username',email='$email',password='$hashed_password',profile='$profile_name',is_admin=0";
    $insert_user_result = mysqli_query($connection,$insert_user_query);

    if(!mysqli_errno($connection)){
      // redirect the login page with success message
      $_SESSION['signup-success'] = 'Registration Successful.Please Login';
      header('location: ' . ROOT_URL . 'signin.php');
      die();
    }
  }

} else {
  // if button wasnt click ,bounce back to signup page
  header('location: ' . ROOT_URL . 'signup.php');
  die();
}
?>