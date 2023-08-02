<?php
  include 'partials/header.php';

  if(isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection,$query);
    $user = mysqli_fetch_assoc($result);

  } else {
    header('location: ' . ROOT_URL . 'admin/manageUsers.php');
  }
?>
    <!------------  ------------>

    <!------------ EDIT USER ------------>
    <section class="section-form">
      <div class="containers section-form-container">
        <h2 class="edit-user-label">Edit User</h2>
        <form class="edit-user-form" action="<?=ROOT_URL?>admin/editUser-logic.php" method="POST">
          <input type="hidden" name="id"  value="<?=$user['id']?>"/>
          <input type="text" name="firstname"  value="<?=$user['firstname']?>" placeholder="First Name" />
          <input type="text" name="lastname"  value="<?=$user['lastname']?>" placeholder="Last Name" />
          <label>User Role</label>
          <select name="userrole">
            <option value="0">Author</option>
            <option value="1">Admin</option>
          </select>
          <button type="submit" name="submit" class="edit-user-btn">Update User</button>
        </form>
      </div>
    </section>
    <!------------  ------------>

<?php
  include '../partials/footer.php';
?>