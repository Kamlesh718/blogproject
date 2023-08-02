<?php
  include 'partials/header.php';

  // fetch categories from database
  $query = "SELECT * FROM categories";
  $categories = mysqli_query($connection,$query);

  //get back form data if form was invalid
  $title = $_SESSION['add-post-data']['title'] ?? null;
  $body = $_SESSION['add-post-data']['body'] ?? null;

  // delete form data session
  unset($_SESSION['add-post-data']);

?>

    <!------------ ADD POST ------------>
    <section class="section-form">
      <div class="containers section-form-container">
        <h2 class="add-post-label">Add Post</h2>
        <?php if(isset($_SESSION['add-post'])) : ?>
        <div class="alert-message error">
          <p>
            <?= $_SESSION['add-post'];
            unset($_SESSION['add-post']);
          ?>
          </p>
        </div>
        <?php endif ?>
        <form class="add-post-form" action="<?= ROOT_URL ?>admin/addPost-logic.php"  method="POST">
        
          <input type="text" name="title" value="<?=$title?>" placeholder="Title" />

          <select name="category">

            <?php while($category = mysqli_fetch_assoc($categories)): ?>
              <option value="<?=$category['id']?>"><?=$category['title']?></option>
            <?php endwhile ?>
          </select>

          <textarea rows="10" name="body"  placeholder="Body"><?=$body?> </textarea>
          <button type="submit" name="submit" class="add-post-btn">Add Post</button>


          <?php if(isset($_SESSION['user_is_admin'])) : ?>

          <!-- <div class="form-control checkbox">
            <input
              type="checkbox"
              name="is_featured"
              id="is_featured"
              value="1"
              class="featured-checkbox"
              checked
            />
            <label for="is_featured">Featured</label>
            <?php endif ?>
          </div> -->
          <!-- <div class="form-control">
            <label for="thumbnail">Add Thumbnail</label>
            <input type="file" name="thumbnail" id="thumbnail" />
          </div> -->

          </form>
      </div>
    </section>
    <!------------  ------------>

<?php
  include '../partials/footer.php';
?>