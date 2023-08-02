<?php
include 'partials/header.php';

//fetch post from database if id is set
if (isset($_GET['id'])){
  $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM posts where id=$id";
  $result =mysqli_query($connection,$query);
  $post = mysqli_fetch_assoc($result);
} else{
  header('location: ' . ROOT_URL . 'blog.php');
  die();
}

?>

    <!------------ SINGLE-POST ------------>
    <section class="single-post">
      <div class="containers container-single-post">
        <h2>
          <?= $post['title']?>
        </h2>
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

            <h4 class="single-post-author-name">By: <?="{$author['firstname']} {$author['lastname']}"?></h4>
          </div>
        </div>
        <!-- <div class="thumbnail-single-post">
          <img src="img/blog4.jpg" />
        </div> -->
        <p>
         <?= $post['body'] ?>
        </p>
      </div>
    </section>

    <?php
include 'partials/footer.php'
?>