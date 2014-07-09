<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

/**
 * Define autoload function
 */
function salamanderAutoload($class_name) {
    //class directories
    $directories = array(
        'admin',
        'framework',
        // 'framework' . DIRECTORY_SEPARATOR . 'Views',
        'framework' . DIRECTORY_SEPARATOR . 'libs',
        'framework' . DIRECTORY_SEPARATOR . 'widgets',
        'framework' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'kdMultipleFeaturedImages',
    );

    //for each directory
    foreach($directories as $dir)
    {
        //see if the file exsists
        if(file_exists(get_template_directory() . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $class_name . '.php'))
        {
            require_once(get_template_directory() . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $class_name . '.php');
            //only require the class once, so quit after to save effort (if you got more, then name them something else
            return;
        }
    }
}
// Register autoload function
spl_autoload_register('salamanderAutoload');
//Init theme framework class
$salamander = Salamander::getInstance();
// Registe nav menus
add_action('init', array($salamander, 'registerNavMenus'));
// Register custom post types
add_action('init', array($salamander, 'registerPosts'));
//Register Basic Sidebars (widget zones)
add_action('init', array($salamander, 'registerSidebars'));
//Setup default options when theme enabled
if (is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' )
{
  add_action('admin_head', array($salamander->init, 'optionsSetup'));
}

add_action('admin_menu', array($salamander->init, 'initAdmin'));

require_once LIBS_PATH . 'mediauploader.php'; ///////////////////////

add_action('wp_ajax_options_post_action', array($salamander->init, 'ajaxCallback'));

add_action('admin_head', array($salamander->init, 'adminSetJs'));

add_action('init', 'mediauploader_init');

add_action('wp_enqueue_scripts', array($salamander->init, 'stylesheets'), 0, 1);
add_action('wp_enqueue_scripts', array($salamander->init, 'scripts'));
//set latest theme options to theme object
$salamander->setData();
if (!is_admin())
{
// print '<pre>';
// $data = $salamander->getData();
// print_r($data);
// print '<pre>';
}

if(Salamander::getData('blog_layout') == 'Large Alternate' || Salamander::getData('blog_layout') == 'Medium Alternate') {
    add_theme_support('post-formats', array('gallery', 'link', 'image', 'quote', 'video', 'audio', 'chat'));
}

if(class_exists('kdMultipleFeaturedImages')  && !Salamander::getData('legacy_posts_slideshow')) {
  $i = 2;
  while($i <= Salamander::getData('posts_slideshow_number')) {
    $args = array(
      'id' => 'featured-image-'.$i,
      'post_type' => 'post',      // Set this to post or page
      'labels' => array(
        'name'=> 'Featured image '.$i,
        'set' => 'Set featured image '.$i,
        'remove' => 'Remove featured image '.$i,
        'use' => 'Use as featured image '.$i,
      )
    );

    new kdMultipleFeaturedImages($args);

    $args = array(
      'id' => 'featured-image-'.$i,
      'post_type' => 'page',      // Set this to post or page
      'labels' => array(
        'name' => 'Featured image '.$i,
        'set' => 'Set featured image '.$i,
        'remove' => 'Remove featured image '.$i,
        'use' => 'Use as featured image '.$i,
      )
    );

    new kdMultipleFeaturedImages($args);

    $args = array(
      'id' => 'featured-image-'.$i,
      'post_type' => 'avada_portfolio',      // Set this to post or page
      'labels' => array(
        'name' => 'Featured image '.$i,
        'set' => 'Set featured image '.$i,
        'remove' => 'Remove featured image '.$i,
        'use' => 'Use as featured image '.$i,
      )
    );

    new kdMultipleFeaturedImages($args);

    $i++;
  }
}

// Add post thumbnail functionality
add_theme_support('post-thumbnails');
add_image_size('blog-large', 669, 272, true);
add_image_size('blog-medium', 320, 202, true);
add_image_size('tabs-img', 52, 50, true);
add_image_size('related-img', 180, 138, true);
add_image_size('portfolio-one', 540, 272, true);
add_image_size('portfolio-two', 460, 295, true);
add_image_size('portfolio-three', 300, 214, true);
add_image_size('portfolio-four', 220, 161, true);
add_image_size('portfolio-full', 940, 400, true);
add_image_size('recent-posts', 700, 441, true);
add_image_size('recent-works-thumbnail', 66, 66, true);
