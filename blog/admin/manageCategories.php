<?php
  include 'partials/header.php';

  // fetch categories from database
  $query = "SELECT * FROM categories ORDER BY title";
  $categories = mysqli_query($connection,$query);

?>
    <!------------ MANAGE CATEGORIES ------------>

    <section class="dashboard">

    <?php if(isset($_SESSION['add-category-success'])) : //Show if category added successfull?>
      <div class="alert-message success containers">
          <p>
            <?=$_SESSION['add-category-success'];
            unset($_SESSION['add-category-success']);
            ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['add-category'])) : //Show if category  added not successfull?>
      <div class="alert-message error containers">
          <p>
            <?=$_SESSION['add-category'];
            unset($_SESSION['add-category']);
            ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['edit-category'])) : //Show if category edited not successfull?>
      <div class="alert-message error containers">
          <p>
            <?=$_SESSION['edit-category'];
            unset($_SESSION['edit-category']);
            ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['edit-category-success'])) : //Show if category edited  successfull?>
      <div class="alert-message success containers">
          <p>
            <?=$_SESSION['edit-category-success'];
            unset($_SESSION['edit-category-success']);
            ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['delete-category-success'])) : //Show if category deleted  successfull?>
      <div class="alert-message success containers">
          <p>
            <?=$_SESSION['delete-category-success'];
            unset($_SESSION['delete-category-success']);
            ?>
            </p>
        </div>


        <?php endif ?>
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
      <div class="containers container-dashboard">
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
              <a href="manageUsers.php"
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
              <a href="manageCategories.php" class="active"
                ><ion-icon name="list-outline"></ion-icon>
                <h5>Manage Category</h5>
              </a>
            </li>
            <?php endif ?>
          </ul>
        </aside>
        <main>
          <h2>Manage Categories</h2>
          <?php if(mysqli_num_rows($categories) > 0) : ?>
          <table>
            <thead>
              <tr>
                <th>Title</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php while($category = mysqli_fetch_assoc($categories)) : ?>
              <tr>
                <td><?=$category['title']?></td>
                <td><a href="<?=ROOT_URL?>admin/editCategory.php?id=<?= $category['id']?>" class="btn-edit">Edit</a></td>
                <td>
                  <a href="<?=ROOT_URL?>admin/deleteCategory.php?id=<?= $category['id']?>" class="btn-delete danger"
                    >Delete</a
                  >
                </td>
              </tr>
              <?php endwhile?>
            </tbody>
          </table>
          <?php else : ?>
            <div class="alert-message error"><?="No categories found"?></div>
          <?php endif?>
        </main>
      </div>
    </section>
<?php
  include '../partials/footer.php';
?>