<?php
require 'config/constants.php';

$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['sigin-data']['password'] ?? null;

unset($_SESSION['sigin-data']);
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
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- STYLESHEET -->
    <title>Blog Website</title>
  </head>
  <body>
    <!-- SIGNIN -->

    <section class="section-form">
      <div class="containers section-form-container">
        <h2 class="signin-label">Sign In</h2>
        <?php if(isset($_SESSION['signup-success'])) : ?>
        <div class="alert-message success">
          <p>
            <?=$_SESSION['signup-success'];
            unset($_SESSION['signup-success']);
            ?>
            </p>
        </div>
        <?php elseif (isset($_SESSION['signin'])) : ?>
        <div class="alert-message error">
          <p>
            <?=$_SESSION['signin'];
            unset($_SESSION['signin']);
            ?>
            </p>
        </div>
        <?php endif ?>
        <form class="signin-form" action="<?= ROOT_URL ?>signin-logic.php" method="POST">
          <input type="text" name="username_email" value="<?=$username_email?>"  placeholder="Username or Email" />
          <input type="password" name="password" value="<?=$password?>" placeholder="Password" />
          <button type="submit" name="submit" class="signin-btn">SignIn</button>
          <small
            >Doesn't have an account? <a href="signup.php">SignUp</a></small
          >
        </form>
      </div>
    </section>
    <!------------  ------------>
  </body>
</html>
