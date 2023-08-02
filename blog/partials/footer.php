
    <!------------ FOOTER ------------>
    <footer>
      <div class="footer-socials">
        <a href="https://www.instagram.com/" target="_blank">
          <ion-icon name="logo-instagram"></ion-icon
        ></a>
        <a href="https://www.twitter.com/" target="_blank">
          <ion-icon name="logo-twitter"></ion-icon
        ></a>
        <a href="https://www.facebook.com/" target="_blank">
          <ion-icon name="logo-facebook"></ion-icon
        ></a>
      </div>

      <div class="containers footer-container">
      <?php 
          $all_categories_query = "SELECT * FROM categories";
          $all_categories_result = mysqli_query($connection,$all_categories_query);
        ?>
        <article>
          <h4 class="footer-info-label">Categories</h4>
          <ul>
             <?php while($category = mysqli_fetch_assoc($all_categories_result) ) : ?>
        
              <li><a href="<?= ROOT_URL?>categoryPosts.php?id=<?=$category['id']?>" class="btn-category">
              <?=$category['title']?>
            </a></li>
        <?php endwhile ?>
          </ul>
        </article>

        <div class="containers buttons-category-container">

        <?php while($category = mysqli_fetch_assoc($all_categories_result) ) : ?>
        <a href="<?= ROOT_URL?>categoryPosts.php?id=<?=$category['id']?>" class="btn-category"><?=$category['title']?></a>
        <?php endwhile ?>
      </div>
        <!-- <article>
          <h4 class="footer-info-label">Support</h4>
          <ul>
            <li><a href="">CALL NUMBERS</a></li>
            <li><a href="">EMAILS</a></li>
            <li><a href="">LOCATION</a></li>
          </ul>
        </article> -->
        <!-- <article>
          <h4 class="footer-info-label">Blog</h4>
          <ul>
            <li><a href="">SAFETY</a></li>
            <li><a href="">RECENT</a></li>
            <li><a href="">POPULAR</a></li>
            <li><a href="">CATEGORIES</a></li>
          </ul>
        </article> -->
        <article>
          <h4 class="footer-info-label">Links</h4>
          <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="blog.php">BLOG</a></li>
            <li><a href="about.php">ABOUT</a></li>
          </ul>
        </article>
      </div>
      <div class="copyright-footer">
        <small>Copyright &copy; Kamlesh Vishwakarma</small>
      </div>
    </footer>
    <!------------  ------------>

    <script src="<?php echo ROOT_URL?>js/script.js"></script>
  </body>
</html>
