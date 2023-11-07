<!DOCTYPE html>
<html <?=language_attributes()?>>
  <head>
    <meta charset="<?=bloginfo('charset')?>"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
  </head>
  <body <?=body_class()?>>
    <header class="site-header">
    <div class="container">
      <h1 class="school-logo-text float-left"><a href="<?=site_url()?>"><?=get_bloginfo('name')?></a></h1>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">
          <?php
            wp_nav_menu(array(
              'theme_location' => 'headernav'
            ));
          ?>
        </nav>
      </div>
    </div>
    </header>
