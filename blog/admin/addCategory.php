<?php
  include 'partials/header.php';

  // get back form data if error occurs
  $title = $_SESSION['add-category-data']['title'] ?? null;
  $description = $_SESSION['add-category-data']['description'] ?? null;

  unset($_SESSION['add-category-data']);
?>
    <!------------ ADD CATEGORY ------------>
    <section class="section-form">
      <div class="containers section-form-container">
        <h2 class="add-category-label">Add Category</h2>
        <?php if(isset($_SESSION['add-category'])) : ?>
          <div class="alert-message error">
            <p>
              <?= $_SESSION['add-category'];
                unset($_SESSION['add-category'])?>
            </p>
          </div>
        <?php endif ?>
        <form class="add-category-form" action="<?=ROOT_URL?>admin/addCategory-logic.php" method="POST">
          <input type="text" name="title" value="<?=$title?>" placeholder="Title" />
          <textarea rows="5" name="description"  placeholder="Description"><?=$description?></textarea>
          <button type="submit" name="submit" class="add-category-btn">Add Category</button>
        </form>
      </div>
    </section>
    <!------------  ------------>
<?php
  include '../partials/footer.php';
?>