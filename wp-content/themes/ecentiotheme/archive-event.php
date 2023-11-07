
<?php
    get_header();
    page_banner();
?>

  <div class="container container--narrow page-section">

    <?php
    $today = date('Ymd');
      while(have_posts()){
        the_post();
        get_template_part('template-parts/content', 'event');
      }
      echo paginate_links();
    ?>
  </div>
<?php
    get_footer();
?>