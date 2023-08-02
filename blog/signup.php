<?php
session_start();
require 'config/constants.php';

//get back form data if there was a registration error
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;

// delete signup data session
unset($_SESSION['signup-data']);

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
    <link rel="stylesheet" href="<?=ROOT_URL?>css/style.css" />
    <link rel="stylesheet" href="<?=ROOT_URL?>css/responsive.css" />
    <!-- STYLESHEET -->
    <title>Blog Website</title>
  </head>
  <body>
    <!-- SIGNUP -->

    <section class="section-form">
      <div class="containers section-form-container">
        <h2 class="signup-label">Sign Up</h2>

        <?php if(isset($_SESSION['signup'])) : ?>
          <div class="alert-message error">
            <p>
              <?= $_SESSION['signup'];
              unset($_SESSION['signup']);
              ?>
            </p>
          </div>

        <?php endif ?>
        <form  class="signup-form" action="<?=ROOT_URL?>signup-logic.php" enctype="multipart/form-data" method="POST">
          <input type="text" name="firstname" value="<?=$firstname?>" placeholder="First Name" />
          <input type="text" name="lastname" value="<?=$lastname?>"  placeholder="Last Name" />
          <input type="text" name="username" value="<?=$username?>"  placeholder=" Username" />
          <input type="email" name="email" value="<?=$email?>"  placeholder="Email" />
          <input type="password" name="createpassword" value="<?=$createpassword?>" placeholder="Create Password" />
          <input type="password" name="confirmpassword" value="<?=$confirmpassword?>" placeholder="Confirm Password" />
          <div class="form-control">
            <label for="UserProfile">Profile Picture</label>
            <input type="file" name="profile" id="profile-picture" />
          </div>
          <button type="submit" name="submit" class="signup-btn">SignUp</button>
          <small
            >Already have an account? <a href="signin.php">SignIn</a></small
          >
        </form>
      </div>
    </section>
    <!------------  ------------>
  </body>
</html>
