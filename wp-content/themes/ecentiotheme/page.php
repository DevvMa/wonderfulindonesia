
<?php
    get_header();

while(have_posts()){
  the_post();
  page_banner();
  ?>

  <div class="container page-section">

    <div class="generic-content">
      <?php the_content(); ?>
    </div>

  </div>
<?php
    }
    get_footer();
?>