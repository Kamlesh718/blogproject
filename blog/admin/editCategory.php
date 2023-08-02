<?php
  include 'partials/header.php';

  if(isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);

    // fetch category from database
    $query = "SELECT * FROM categories WHERE id=$id";
    $result = mysqli_query($connection,$query);
    if(mysqli_num_rows($result) == 1){
      $category = mysqli_fetch_assoc($result);
    }
  } else {
    header('location: ' . ROOT_URL . 'admin/manageCategories.php');
    die();
  }
?>
    <!------------ EDIT CATEGORY ------------>
    <section class="section-form">
      <div class="containers section-form-container">
        <h2 class="edit-category-label">Edit Category</h2>
        <form class="edit-category-form" action="<?=ROOT_URL?>admin/editCategory-logic.php" method="POST">
          <input type="hidden" name="id" value="<?=$category['id']?>" />
          <input type="text" name="title" value="<?=$category['title']?>" placeholder="Title" />
          <textarea rows="5" name="description" placeholder="Description"><?=$category['description']?></textarea>
          <button type="submit" name="submit" class="edit-category-btn">
            Update Category
          </button>
        </form>
      </div>
    </section>
    <!------------  ------------>
<?php
  include '../partials/footer.php';
?>