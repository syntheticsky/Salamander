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
