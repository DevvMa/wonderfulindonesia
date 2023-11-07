<footer class="site-footer">

    <div class="site-footer__inner container">

      <div class="group">

        <div class="site-footer__col-one">
          <h1 class="school-logo-text school-logo-text--alt-color"><?=get_bloginfo('name')?></h1>
          <p><?=get_bloginfo('description')?></p>
        </div>

        <div class="site-footer__col-four">
          <h3 class="headline headline--small">Connect With Us</h3>
          <nav>
            <ul class="min-list social-icons-list group">
              <?php
                $social_media_types = ['instagram', 'facebook', 'twitter', 'tiktok'];

                foreach ($social_media_types as $type) {
                    $url = get_option('my_social_media_' . $type);
                    if ($url) {
                      ?>
                        <li><a href="<?=esc_url($url)?>" class="social-color-<?=$type?>"><i class="fa fa-<?=$type?>" aria-hidden="true"></i></a></li>
                      <?php
                    }
                }
              ?>
            </ul>
          </nav>
        </div>
      </div>

    </div>
  </footer>

<?php wp_footer(); ?>
</body>
</html>

