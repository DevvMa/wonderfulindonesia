<?php 
    get_header();
?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/hero-beach.png') ?>);"></div>
    <div class="page-banner__content container c-white">
      <h1 class="headline headline--large">Let's Escape!</h1>
      <h2 class="headline headline--small">Discover hidden gems and breathtaking destinations that await your exploration</h2>
      <a href="<?=get_post_type_archive_link('program')?>" class="btn btn--medium btn--orange">Explore our Catalog</a>
    </div>
</div>

  <div class="full-width-split group">
    <div class="full-width-split__one">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">Join Our Action</h2>
        <?php
            $today = date('Ymd');
            $latestEventPost = new WP_Query(array(
                'posts_per_page' => 5,
                'post_type' => 'event',
                'meta_key' => 'event_date',
                'orderby' => 'meta_value_num',
                'order' => "ASC",
                'meta_query' => array(
                  array(
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'numeric'
                  )
                )
            ));
            while ($latestEventPost -> have_posts()){
                $latestEventPost -> the_post();
                get_template_part('template-parts/content', 'event');
            }

            wp_reset_postdata();
        ?>
      </div>
    </div>
    <div class="full-width-split__two">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>

        <?php
          $latestBlogPost = new WP_Query(array(
              'posts_per_page' => 5
          ));
          while ($latestBlogPost -> have_posts()){
            $latestBlogPost -> the_post();
            ?>
                <div class="event-summary">
                    <a class="event-summary__date event-summary__date--orange t-center" href="<?=the_permalink()?>">
                        <span class="event-summary__month"><?=the_time('M')?></span>
                        <span class="event-summary__day"><?=the_time('d')?></span>  
                    </a>
                    <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"><a href="<?=the_permalink()?>"><?=the_title();?></a></h5>
                        <p><?php
                        if(has_excerpt()){
                          echo get_the_excerpt();
                        } else {
                          echo wp_trim_words(get_the_content(),18);
                        }
                        ?> <a href="<?=the_permalink()?>" class="nu gray">Read more</a></p>
                    </div>
                </div>
            <?php
          }

          wp_reset_postdata();
        ?>
      </div>
    </div>
  </div>

  <div class="hero-slider">
  <?php
    $sliders = new WP_Query(array(
        'posts_per_page' => 5,
        'post_type' => 'slider',
    ));
    while ($sliders -> have_posts()){
        $sliders -> the_post();
        get_template_part('template-parts/content-slider');
    }

    wp_reset_postdata();
  ?>
  
</div>

<?php
    get_footer();
?>