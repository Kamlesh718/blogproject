<?php
require 'partials/header.php';

if(isset($_GET['search']) && isset($_GET['submit'])){
  $search = filter_var($_GET['search'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $query = "SELECT * FROM posts WHERE title LIKE '%$search%' ORDER BY id DESC";
  $posts = mysqli_query($connection,$query);

} else{
  header('location: ' . ROOT_URL . 'blog.php');
  die();
}
?>




<section class="featured-post"></section>
<?php if(mysqli_num_rows($posts) > 0) : ?>
<section class="posts">
      <div class="containers container-post">
        <?php while($post = mysqli_fetch_assoc($posts)) : ?>
        <article class="post">

          <div class="post-info">
          <?php 
          //fetching category from categories table using category_id of post
                $category_id = $post['category_id'];
                $category_query = "SELECT title FROM categories WHERE id=$category_id";
                $category_result = mysqli_query($connection,$category_query);
                $category = mysqli_fetch_assoc($category_result);
                ?>
                
                <a href="<?= ROOT_URL ?>categoryPosts.php?id=<?= $post['category_id']?>" class="btn-category">
                <?= $category['title'] ?>
              </a>
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
          <p> No posts found for this search😴</p>
        </div>

    <?php endif  ?>


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

    <?php
    include 'partials/footer.php';
    ?>