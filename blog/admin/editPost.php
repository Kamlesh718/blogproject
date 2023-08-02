<?php
  include 'partials/header.php';

  //fetch categories from database
  $category_query = "SELECT * FROM categories";
  $categories = mysqli_query($connection,$category_query);

  // fetching post data from database if id id set

  if(isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection,$query);
    $post = mysqli_fetch_assoc($result);
  } else {
    header('location: ' . ROOT_URL . 'admin/');
    die();
  }
?>
    <!------------  ------------>

    <!------------ EDIT POST ------------>
    <section class="section-form">
      <div class="containers section-form-container">
        <h2 class="edit-post-label">Edit Post</h2>
        <form class="edit-post-form" action="<?= ROOT_URL ?>admin/editPost-logic.php" enctype="multipart/form-data" method="POST">
          <input type="hidden" name="id" value="<?= $post['id'] ?>"  />
          <input type="text" name="title" value="<?= $post['title'] ?>" placeholder="Title" />
          <select  name="category">
            <?php while($category = mysqli_fetch_assoc($categories)) : ?>
            <option value="<?= $category['id']?>"><?= $category['title']?></option>
            <?php endwhile ?>

          </select>
          <textarea rows="10" placeholder="Body" name="body"><?= $post['body'] ?></textarea>
          <button type="submit" name="submit" class="edit-post-btn">Update Post</button>
<!-- 
          <div class="form-control checkbox">
            <input
              type="checkbox"
              id="is-featured"
              class="featured-checkbox"
              checked
            />
            <label for="is-featured">Featured</label>
          </div> -->
          <!-- <div class="form-control">
            <label for="thumbnail">Update Thumbnail</label>
            <input type="file" id="thumbnail" />
          </div> -->
        </form>
      </div>
    </section>
    <!------------  ------------>
<?php
  include '../partials/footer.php';
?>