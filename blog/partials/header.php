<?php
require 'config/database.php';

if(isset($_SESSION['user-id'])){
  $id = filter_var($_SESSION['user-id'],FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT profile FROM users WHERE id=$id";
  $result = mysqli_query($connection,$query);
  $profile = mysqli_fetch_assoc($result);

}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Slackside+One&display=swap"
      rel="stylesheet"
    />
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>css/style.css" />
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>css/responsive.css" />
    <!-- STYLESHEET -->
    <title>The Blog</title>
  </head>
  <body>
    <!----------- NAVBAR ------------>
    <nav>
      <div class="containers navbar">
        <a href="<?php echo ROOT_URL ?>" class="blog-logo">THE-BLOG</a>
        <ul class="nav-links hidden">
          <li class="nav-items"><a href="<?php echo ROOT_URL ?>blog.php">Blog</a></li>
          <li class="nav-items"><a href="<?php echo ROOT_URL ?>about.php">About</a></li>
          <!-- <li class="nav-items"><a href="<?php echo ROOT_URL ?>services.php">Services</a></li> -->
          <!-- <li class="nav-items"><a href="<?php echo ROOT_URL ?>contact.php">Contact</a></li> -->
          <?php if(isset($_SESSION['user-id'])): ?>

          <li class="user-profile nav-items">
            <div class="profile-image">
            <img src="<?=ROOT_URL . 'images/' . $profile['profile'] ?>" />

            </div>
            <ul>
              <li><a href="<?php echo ROOT_URL ?>admin/index.php">Dashboard</a></li>
              <li><a href="<?php echo ROOT_URL ?>logout.php">Logout</a></li>
            </ul>
          </li>
          <?php else :?>
              <li class="nav-items"><a href="<?php echo ROOT_URL ?>signin.php">Signin</a></li>
          <?php endif ?>
        </ul>

        <button id="open-nav-btn">
          <ion-icon
            name="menu-outline"
            class="nav-icon hamburger-icon"
          ></ion-icon>
        </button>
        <button id="close-nav-btn">
          <ion-icon name="close-circle-outline" class="nav-icon"></ion-icon>
        </button>
      </div>
    </nav>
    <!------------  ------------>