<?php
  include 'partials/header.php';

  // fetch users from database but not current users
  $current_admin_id = $_SESSION['user-id'];

  $query = "SELECT * FROM users WHERE NOT id=$current_admin_id";
  $users = mysqli_query($connection,$query);

?>
    <!------------ MANAGE USERS ------------>

    <section class="dashboard">
    <?php if(isset($_SESSION['add-user-success'])) : //Show if user added successfull?>
      <div class="alert-message success containers">
          <p>
            <?=$_SESSION['add-user-success'];
            unset($_SESSION['add-user-success']);
            ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['edit-user-success'])) : //Show if user edited successfull ?>
      <div class="alert-message success containers">
          <p>
            <?=$_SESSION['edit-user-success'];
            unset($_SESSION['edit-user-success']);
            ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['edit-user'])) : //Show if user edited not successfull ?>
      <div class="alert-message error containers">
          <p>
            <?=$_SESSION['edit-user'];
            unset($_SESSION['edit-user']);
            ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['delete-user'])) : //Show if delete user not successfull ?>
      <div class="alert-message error containers">
          <p>
            <?=$_SESSION['delete-user'];
            unset($_SESSION['delete-user']);
            ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['delete-user-success'])) : //Show if delete user successfull ?>
      <div class="alert-message success containers">
          <p>
            <?=$_SESSION['delete-user-success'];
            unset($_SESSION['delete-user-success']);
            ?>
            </p>
        </div>
        <?php endif ?>
      <div class="containers container-dashboard">
      <button id="show-sidebar-btn" class="sidebar-toggle">
        <ion-icon
          name="chevron-forward-circle-outline"
          class="sidebar-toggle"
        ></ion-icon>
      </button>
      <button id="hide-sidebar-btn" class="sidebar-toggle">
        <ion-icon
          name="chevron-back-circle-outline"
          class="sidebar-toggle"
        ></ion-icon>
      </button>


        <aside>
          <ul>
            <li>
              <a href="addPost.php"
                ><ion-icon name="pencil-outline"></ion-icon>
                <h5>Add Post</h5>
              </a>
            </li>
            <li>
              <a href="index.php"
                ><ion-icon name="build-outline"></ion-icon>
                <h5>Manage Post</h5>
              </a>
            </li>
            <?php if(isset($_SESSION['user_is_admin'])) : ?>

            <li>
              <a href="addUser.php"
                ><ion-icon name="person-add-outline"></ion-icon>
                <h5>Add user</h5>
              </a>
            </li>
            <li>
              <a href="manageUsers.php" class="active"
                ><ion-icon name="people-outline"></ion-icon>
                <h5>Manage Users</h5>
              </a>
            </li>
            <li>
              <a href="addCategory.php"
                ><ion-icon name="create-outline"></ion-icon>
                <h5>Add Category</h5>
              </a>
            </li>
            <li>
              <a href="manageCategories.php" 
                ><ion-icon name="list-outline"></ion-icon>
                <h5>Manage Category</h5>
              </a>
            </li>
            <?php endif ?>
          </ul>
        </aside>
        <main>
          <h2>Manage Users</h2>
          <?php if(mysqli_num_rows($users) > 0) : ?>
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Admin</th>
              </tr>
            </thead>
            <tbody>
              <?php while($user= mysqli_fetch_assoc($users)) : ?>
              <tr>
                <td><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                <td><?="{$user['username']}"?></td>
                <td><a href="<?= ROOT_URL ?>admin/editUser.php?id=<?= $user['id']?>" class="btn-edit"> Edit </a></td>
                <td>
                  <a href="<?= ROOT_URL ?>admin/deleteUser.php?id=<?= $user['id']?>"class="btn-delete danger"
                    >Delete</a
                  >
                </td>
                <td><?=$user['is_admin'] ? 'Yes' :'No' ?></td>
              </tr>
             <?php endwhile ?> 

            </tbody>
          </table>
          <?php else : ?>
            <div class="alert-message error"><?="No users found"?></div>
          <?php endif?>
        </main>
      </div>
    </section>

<?php
  include '../partials/footer.php';
?>