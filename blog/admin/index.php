<?php
  include 'partials/header.php';

  //fetch current users post from the database
  $current_user_id = $_SESSION['user-id'];
  $query = "SELECT id, title,category_id FROM posts  WHERE author_id=$current_user_id ORDER BY id DESC";
  $posts = mysqli_query($connection,$query);

  
?>
    <!------------ MANAGE USERS ------------>

    <section class="dashboard">
    <?php if(isset($_SESSION['add-post-success'])) : //Show if post added successfull?>
      <div class="alert-message success containers">
          <p>
            <?=$_SESSION['add-post-success'];
            unset($_SESSION['add-post-success']);
            ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['edit-post-success'])) : //Show if edit post successfull?>
      <div class="alert-message success containers">
          <p>
            <?=$_SESSION['edit-post-success'];
            unset($_SESSION['edit-post-success']);
            ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['edit-post'])) : //Show if edit post not successfull?>
      <div class="alert-message error containers">
          <p>
            <?=$_SESSION['edit-post'];
            unset($_SESSION['edit-post']);
            ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['delete-post-success'])) : //Show if post deleted successfull?>
      <div class="alert-message success containers">
          <p>
            <?=$_SESSION['delete-post-success'];
            unset($_SESSION['delete-post-success']);
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
              <a href="index.php" class="active"
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
              <a href="manageCategories.php" 
                ><ion-icon name="list-outline"></ion-icon>
                <h5>Manage Category</h5>
              </a>
            </li>
            <?php endif ?>
          </ul>
        </aside>
        <main>
          <h2>Manage Post</h2>
          <?php if(mysqli_num_rows($posts) > 0) : ?>
          <table>
            <thead>
              <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php while($post = mysqli_fetch_assoc($posts)) : ?>
                <!-- get category title of each post from categories table -->
                <?php 
                $category_id = $post['category_id'];
                $category_query = "SELECT title FROM categories WHERE id=$category_id";
                $category_result = mysqli_query($connection,$category_query);
                $category = mysqli_fetch_assoc($category_result);
                ?>
              <tr>
                <td><?= $post['title']?>.</td>
                <td><?= $category['title'] ?></td>
                <td><a href="<?= ROOT_URL ?>admin/editPost.php?id=<?=$post['id'] ?>" class="btn-edit"> Edit </a></td>
                <td><a href="<?= ROOT_URL ?>admin/deletePost.php?id=<?=$post['id'] ?>" class="btn-delete danger""> Delete </a></td>

              </tr>
              <?php endwhile ?>
                
          </tr>
            
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