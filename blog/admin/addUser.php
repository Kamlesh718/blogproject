<?php
  include 'partials/header.php';

  // get back form data if there was an error
  $firstname = $_SESSION['add-user-data']['firstname'] ?? null;
  $lastname = $_SESSION['add-user-data']['lastname'] ?? null;
  $username = $_SESSION['add-user-data']['username'] ?? null;
  $email = $_SESSION['add-user-data']['email'] ?? null;
  $createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
  $confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;

  // delete session data
  unset($_SESSION['add-user-data']);
?>

    <!------------ ADD USER ------------>
    <section class="section-form">
      <div class="containers section-form-container">
        <h2 class="add-user-label">Add User</h2>
        <?php if(isset($_SESSION['add-user'])) : ?>
        <div class="alert-message error">
          <p>
            <?= $_SESSION['add-user'] ;
            unset($_SESSION['add-user']);
            ?>
          </p>
        </div>

        <?php endif ?>
        <form class="add-user-form" action="<?= ROOT_URL ?>admin/addUser-logic.php" enctype="multipart/form-data" method="POST">
          <input type="text" name="firstname" value="<?= $firstname?>" placeholder="First Name" />
          <input type="text" name="lastname" value="<?= $lastname?>" placeholder="Last Name" />
          <input type="text" name="username" value="<?= $username?>" placeholder=" Username" />
          <input type="email" name="email" value="<?= $email?>" placeholder="Email" />
          <input type="password" name="createpassword" value="<?= $createpassword?>"     placeholder="Create Password" />
          <input type="password" name="confirmpassword" value="<?= $confirmpassword?>"placeholder="Confirm Password" />
          <select name="userrole">
            <option value="0">Author</option>
            <option value="1">Admin</option>
          </select>
          <div class="form-control">
            <label for="UserProfile">Profile Picture</label>
            <input type="file" name="profile" id="profile-picture" />
          </div>
          <button type="submit" name="submit" class="add-user-btn">Add User</button>
        </form>
      </div>
    </section>
    <!------------  ------------>

    <?php
  include '../partials/footer.php';
?>