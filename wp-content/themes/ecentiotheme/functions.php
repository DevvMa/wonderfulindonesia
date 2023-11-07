<?php

function ecentio_theme_style() {
    wp_enqueue_style( 'custom_google_font', '//fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,400;1,700&display=swap');
    wp_enqueue_style( 'font_awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style( 'ecentioheme_style', get_stylesheet_uri());
    wp_enqueue_script('ecentioheme_script', get_theme_file_uri('/js/scripts-bundled.js'), NULL, 1.0, true);
}

add_action( 'wp_enqueue_scripts', 'ecentio_theme_style' );

function ecentio_theme_support(){
    register_nav_menu('headernav', 'Header Navigation');
    register_nav_menu('footernav', 'Footer Navigation');
    add_theme_support( 'title-tag');
    add_theme_support( 'post-thumbnails');
    add_image_size('pageBanner',1440,800, true);
}

add_action('after_setup_theme','ecentio_theme_support');

function page_banner($args = NULL){
    
    $keys = array('title', 'subtitle', 'photo');
    
    if($args == NULL){
        $args = array('title'=>NULL, 'subtitle' => NULL, 'photo' => NULL);
    } 
    
    foreach($keys as $key){
        !array_key_exists($key, $args)? $args[$key] = NULL:'';
    }

    if(!$args['title']){
        $args['title'] = get_field('page_banner_title');
    }
    if(!$args['subtitle']){
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    if(!$args['photo']){
        if(get_field('page_banner_image')){
            $args['photo'] = get_field('page_banner_image')['sizes']['pageBanner'];
        } else{
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }

    ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?=$args['photo']?>);"></div>
        <div class="page-banner__content container">
        <h1 class="page-banner__title"><?=$args['title']?></h1>
        <div class="page-banner__intro">
           <p><?=$args['subtitle']?></p>
        </div>
        </div>  
    </div>
    <?php

}

function custom_post_types(){
    register_post_type('event',array(
        'supports' => array('title','editor', 'excerpt', 'thumbnail'),
        'rewrite' => array('slug' => 'events'),
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'view_item' => 'View Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event',
        ),
        'menu_icon' => 'dashicons-calendar'
    ));

    register_post_type('slider',array(
        'supports' => array('title','editor'),
        'rewrite' => array('slug' => 'slider'),
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Slider',
            'add_new_item' => 'Add New Slider',
            'edit_item' => 'Edit Slider',
            'view_item' => 'View Slider',
            'all_items' => 'All Slider',
            'singular_name' => 'Slider',
        ),
        'menu_icon' => 'dashicons-images-alt'
    ));

}

add_action('init', 'custom_post_types');

function get_near_events($query){
    if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()){
        $today = date('Ymd');
        $queryParam = array(
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
        );

        foreach($queryParam as $key => $value){
            $query->set($key, $value);
        }
    }
}

add_action('pre_get_posts', 'get_near_events');

function my_social_media_admin_menu() {
    add_menu_page(
        'Social Media Accounts', 
        'Social Media', 
        'manage_options', 
        'social-media', 
        'my_social_media_page_content', 
        'dashicons-share'
    );
}
add_action('admin_menu', 'my_social_media_admin_menu');

function my_register_settings() {
    register_setting('my-social-media-settings', 'my_social_media_instagram');
    register_setting('my-social-media-settings', 'my_social_media_facebook');
    register_setting('my-social-media-settings', 'my_social_media_twitter');
}
add_action('admin_init', 'my_register_settings');

function my_social_media_page_content() {
    ?>
    <div class="wrap">
        <h1>Social Media Accounts</h1>
        <form method="post" action="options.php">
            <?php settings_fields('my-social-media-settings'); ?>
            <?php do_settings_sections('my-social-media-settings'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Instagram URL:</th>
                    <td><input type="url" name="my_social_media_instagram" value="<?php echo esc_url(get_option('my_social_media_instagram')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Facebook URL:</th>
                    <td><input type="url" name="my_social_media_facebook" value="<?php echo esc_url(get_option('my_social_media_facebook')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Twitter URL:</th>
                    <td><input type="url" name="my_social_media_twitter" value="<?php echo esc_url(get_option('my_social_media_twitter')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

?>

