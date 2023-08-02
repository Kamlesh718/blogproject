<?php
include 'partials/header.php';

//fetching posts if id is set
if(isset($_GET['id'])){
  $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM posts WHERE category_id=$id ORDER BY id DESC";
  $posts = mysqli_query($connection,$query);

} else{
  header('location: ' . ROOT_URL . 'blog.php');
}
?>
    <!----------- CATEGORY TITLE ------------>
    <header class="category-title">
        <?php 
          //fetching category from categories table using category_id of post
          $category_id = $id;
          $category_query = "SELECT * FROM categories WHERE id=$id";
          $category_result = mysqli_query($connection,$category_query);
          $category = mysqli_fetch_assoc($category_result);
          ?>
      <h2 class="category-title-label"><?= $category['title'] ?></h2>
    </header>
    <!-----------  ------------>
<?php if (mysqli_num_rows($posts) > 0) : ?>
    <section class="posts">
      <div class="containers container-post">
        <?php while($post = mysqli_fetch_assoc($posts)) : ?>
        <article class="post">

          <div class="post-info">
            <h3 class="post-title">
              <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id']?>"
                ><?= $post['title']?></a
              >
            </h3>
            <p class="post-body">
            <?= substr($post['body'],0,120)?>..............
            </p>
            <div class="post-author">
            <?php 
          //fetching users from users table using author_id of post
                $author_id = $post['author_id'];
                $author_query = "SELECT * FROM users WHERE id=$author_id";
                $author_result = mysqli_query($connection,$author_query);
                $author = mysqli_fetch_assoc($author_result);
                ?>
              <div class="post-author-profile">
                <img src="./images/<?= $author['profile'] ?>" />
              </div>
              <div class="post-author-info">
                <h4>By: <?="{$author['firstname']} {$author['lastname']}"?></h4>
              </div>
            </div>
          </div>
        </article>
        <?php endwhile ?>

      </div>
    </section>
    <?php else : ?>
      <div class="alert-message error containers">
          <p> No posts found for this category😴</p>
        </div>

    <?php endif  ?>
    <!------------  ------------>

    <!------------ CATEGORY BUTTONS  ------------>
    <section class="buttons-category">
      <div class="containers buttons-category-container">
        <?php 
          $all_categories_query = "SELECT * FROM categories";
          $all_categories_result = mysqli_query($connection,$all_categories_query);
        ?>
        <?php while($category = mysqli_fetch_assoc($all_categories_result) ) : ?>
        <a href="<?= ROOT_URL?>categoryPosts.php?id=<?=$category['id']?>" class="btn-category"><?=$category['title']?></a>
        <?php endwhile ?>
      </div>
    </section>
    <!------------  ------------>

    <?php
include 'partials/footer.php'
?>