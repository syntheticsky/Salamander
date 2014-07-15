<?php
/**
 *
 */

class SalamanderInit
{
	public $post;
	public $pageNow;

	private static $instance;
	private $helper;
	private $options; //default
	private $optionsMachine = array(); //default

	private function __construct()
	{
		global $pagenow;
		$this->pageNow = $pagenow;
		//Define site constants
		$this->defineConstants();
		$this->helper = Helper::getInstance();
		$this->setOptions();
		$this->optionsMachine = $this->helper->optionsMachine($this->options);
		new Widgets();
	}

	public static function getInstance()
	{
	  if (self::$instance == null)
	  {
	    self::$instance = new self();
	  }

	  return self::$instance;
	}

	public function defineConstants()
	{
		if( function_exists('wp_get_theme'))
		{
			if(is_child_theme())
			{
				$temp_obj = wp_get_theme();
				$theme_obj = wp_get_theme( $temp_obj->get('Template') );
			}
			else
			{
				$theme_obj = wp_get_theme();
			}

			$theme_version = $theme_obj->get('Version');
			$theme_name = $theme_obj->get('Name');
			$theme_uri = $theme_obj->get('ThemeURI');
			$author_uri = $theme_obj->get('AuthorURI');
		}
		else
		{
			$theme_data = get_theme_data( TEMPLATEPATH.'/style.css' );
			$theme_version = $theme_data['Version'];
			$theme_name = $theme_data['Name'];
			$theme_uri = $theme_data['ThemeURI'];
			$author_uri = $theme_data['AuthorURI'];
		}

		define('DS', DIRECTORY_SEPARATOR);
		define('SMOF_VERSION', '1.0');
		define('TEMPLATE_DIR', get_template_directory_uri());
		define('ADMIN_PATH', TEMPLATEPATH . DS . 'admin' .DS); // ??
		define('ADMIN_DIR', TEMPLATE_DIR . DS . 'admin' . DS); //??
		define('FRAMEWORK_DIR', TEMPLATE_DIR . '/framework/');
		define('FRAMEWORK_PATH', TEMPLATEPATH . DS . 'framework' . DS);
		define('VIEWS_PATH', TEMPLATEPATH . DS . 'framework' . DS . 'views' . DS);
		define('VIEWS_DIR', TEMPLATE_DIR . '/framework/views/');
    define('WIDGETS_PATH', TEMPLATEPATH . DS . 'framework' . DS . 'widgets' . DS);
		define('WIDGETS_DIR', TEMPLATE_DIR . '/framework/widgets/');
		define('ASSETS_PATH', TEMPLATEPATH . DS . 'framework' . DS . 'assets' . DS);
		define('ASSETS_DIR', TEMPLATE_DIR . '/framework/assets/');
		define('LIBS_PATH', TEMPLATEPATH . DS . 'framework' . DS . 'libs' . DS);
		define('LIBS_DIR', TEMPLATE_DIR . '/framework/libs/');
		define('LAYOUT_PATH', ADMIN_PATH . DS . 'layouts' . DS);
		define('THEMENAME', $theme_name);
		define('SITE_URL', get_option('siteurl'));
		/* Theme version, uri, and the author uri are not completely necessary, but may be helpful in adding functionality */
		define('THEMEVERSION', $theme_version);
		define('THEMEURI', $theme_uri);
		define('THEMEAUTHORURI', $author_uri);

		define('THEME_OPTIONS', strtolower($theme_name) . '_options');
		define('THEME_OPTIONS_BACKUPS', strtolower($theme_name) . '_backups');
	}

	public function registerNavMenus()
	{
		$menus = array(
			'main_navigation' => 'Main Navigation',
			'top_navigation' => 'Top Navigation',
			'footer_navigation' => 'Boottom Navigation',
			'404_pages' => '404 Ustful Pages',
		);
		register_nav_menus($menus);
	}

	public function registerPosts()
	{
		// Register custom post types
		register_post_type(
			'salamander_portfolio',
			array(
				'labels' => array(
					'name' => 'Portfolio',
					'singular_name' => 'Portfolio'
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'portfolio_items'),//$data['portfolio_slug']),
				'supports' => array('title', 'editor', 'thumbnail', 'comments'),
				'can_export' => true,
			)
		);
		$params = array('hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true);
		register_taxonomy('portfolio_category', 'salamander_portfolio', $params);
		$params = array('hierarchical' => true, 'label' => 'Skills', 'query_var' => true, 'rewrite' => true);
		register_taxonomy('portfolio_skills', 'salamander_portfolio', $params);

		register_post_type(
			'salamander_faq',
			array(
				'labels' => array(
					'name' => 'FAQs',
					'singular_name' => 'FAQ'
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'faq-items'),
				'supports' => array('title', 'editor', 'thumbnail', 'comments'),
				'can_export' => true,
			)
		);

		register_taxonomy('faq_category', 'salamander_faq', array('hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true));

		register_post_type(
			'salamander_elastic',
			array(
				'labels' => array(
					'name' => 'Elastic Slider',
					'singular_name' => 'Elastic Slide'
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'elastic-slide'),
				'supports' => array('title', 'thumbnail'),
				'can_export' => true,
				'menu_position' => 100,
			)
		);

		register_taxonomy('themefusion_es_groups', 'themefusion_elastic', array('hierarchical' => false, 'label' => 'Groups', 'query_var' => true, 'rewrite' => true));
	}

	public function registerSidebars()
	{
		// Register widgetized zones
		if(function_exists('register_sidebar')) {
			register_sidebar(array(
				'name' => 'Blog Right Sidebar',
				'id' => 'right-blog-sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Blog Left Sidebar',
				'id' => 'left-blog-sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Header Widget 1',
				'id' => 'header-widget-1',
				'before_widget' => '<div id="%1$s" class="header-widget-col %2$s">',
				'after_widget' => '<div style="clear:both;"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Header Widget 2',
				'id' => 'header-widget-2',
				'before_widget' => '<div id="%1$s" class="header-widget-col %2$s">',
				'after_widget' => '<div style="clear:both;"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Header Widget 3',
				'id' => 'header-widget-3',
				'before_widget' => '<div id="%1$s" class="header-widget-col %2$s">',
				'after_widget' => '<div style="clear:both;"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Header Widget 4',
				'id' => 'header-widget-4',
				'before_widget' => '<div id="%1$s" class="header-widget-col %2$s">',
				'after_widget' => '<div style="clear:both;"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Footer Widget 1',
				'id' => 'footer-widget-1',
				'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
				'after_widget' => '<div style="clear:both;"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Footer Widget 2',
				'id' => 'footer-widget-2',
				'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
				'after_widget' => '<div style="clear:both;"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Footer Widget 3',
				'id' => 'footer-widget-3',
				'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
				'after_widget' => '<div style="clear:both;"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Footer Widget 4',
				'id' => 'footer-widget-4',
				'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
				'after_widget' => '<div style="clear:both;"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));
		}
	}

	public function initAdmin()
	{
		// $page = add_theme_page( THEMENAME, 'Theme Options', 'manage_options', 'slthemeoptions', array($this ,'adminOptionsPage'));
		add_options_page(THEMENAME, __('Theme Options', 'optionsframework'), 'manage_options', 'slthemeoptions', array($this ,'adminOptionsPage'));
	}

	/**
	 * Change activation message
	 *
	 * @since 1.0.0
	 */
	function adminSetJs()
	{
    print '<script type="text/javascript">
    				var templateDir = "' . TEMPLATE_DIR . '";
	  				var frameworkDir = "' . FRAMEWORK_DIR . '";
	  				var viewsDir = "' . VIEWS_DIR . '";
	  				var assetsDir = "' . ASSETS_DIR . '";
	  				var libsDir = "' . LIBS_DIR . '";
		        jQuery(function(){
		          var message = \'<p>This theme comes with an <a href="' . admin_url("admin.php?page=slthemeoptions") . '">options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="' . admin_url("widgets.php") . '">widgets settings page</a> to configure them.</p>\';
		        	jQuery(".themes-php #message2").html(message);
		        });
        	</script>';
	}

	public function adminOptionsPage()
	{
		foreach ($this->options as $value)
		{
			if ($value['type'] == 'head_zone')
			{
				$classes[] = str_replace(' ','',strtolower($value['name']));
			}
		}
		wp_enqueue_style('admin-style', ASSETS_DIR . 'css/admin-style.css');
		wp_enqueue_style('color-picker', ASSETS_DIR . 'css/colorpicker.css');

		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-input-mask', ASSETS_DIR . 'js/jquery.maskedinput-1.2.2.js', array('jquery'));
		wp_enqueue_script('tipsy', ASSETS_DIR . 'js/jquery.tipsy.js', array('jquery'));
		wp_enqueue_script('color-picker', ASSETS_DIR . 'js/colorpicker.js', array('jquery'));
		wp_enqueue_script('ajaxupload', ASSETS_DIR . 'js/ajaxupload.js', array('jquery'));
		wp_enqueue_script('cookie', ASSETS_DIR . 'js/cookie.js', array('jquery'));
		wp_enqueue_script('scf', ASSETS_DIR . 'js/scf.js', array('jquery'));

		wp_register_script('medialibrary-uploader', ASSETS_DIR . 'js/medialibrary-uploader.js', array('jquery', 'thickbox') );
		wp_enqueue_script('medialibrary-uploader');
		wp_enqueue_script('media-upload');

		$params = array(
			'headerClassesArray' => $classes,
			'optionsMachine' => $this->optionsMachine,
		);
		print Helper::render(VIEWS_PATH . 'admin' . DS . 'optionsPage.php', $params);
	}

	/**
	 * Ajax Save Options
	 *
	 * @uses get_option()
	 * @uses update_option()
	 *
	 * @since 1.0.0
	 */
	public function ajaxCallback()
	{
		if (!wp_verify_nonce($_POST['security'], 'ajax_nonce')) die('-1');
		//get options array from db
		$currentOptions = get_option(THEME_OPTIONS);

		$operation = $_POST['type'];

		//echo $_POST['data'];

		//Uploads
		switch ($operation)
		{
			case 'upload':
				$cID = $_POST['data']; // Acts as the name
				$filename = $_FILES[$cID];
	     	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']);
				$override['test_form'] = false;
				$override['action'] = 'wp_handle_upload';
				$uploaded_file = wp_handle_upload($filename, $override);
				$upload_tracking[] = $cID;
				$currentOptions[$cID] = $uploaded_file['url'];
				update_option(THEME_OPTIONS, $currentOptions ) ;

				if(!empty($uploaded_file['error']))
				{
					echo 'Upload Error: ' . $uploaded_file['error'];
				}
				else
				{
					echo $uploaded_file['url'];
				}
				break;
			case 'image_reset':
				$id = $_POST['data']; // Acts as the name
				$currentOptions[$id] = ''; //update array key with empty value
				update_option(THEME_OPTIONS, $currentOptions) ;
				break;
			case 'backup_options':
				$currentOptions['backup_log'] = date('r');
				update_option(THEME_OPTIONS_BACKUPS, $currentOptions) ;
				die('1');
				break;
			case 'restore_options':
				$data = get_option(THEME_OPTIONS_BACKUPS);
				update_option(THEME_OPTIONS, $data);
				die('1');
				break;
			case 'import_options':
				$data = $_POST['data'];
				$data = unserialize(base64_decode($data)); //100% safe - ignore theme check nag
				update_option(THEME_OPTIONS, $data);
				die('1');
				break;
			case 'save':
				wp_parse_str(stripslashes($_POST['data']), $data);
				unset($data['security']);
				unset($data['save']);
				update_option(THEME_OPTIONS, $data);
				die('1');
				break;
			case 'reset':
				update_option(THEME_OPTIONS, $this->optionsMachine['defaults']);
				die('1');
				break;
		}
  	die();
	}

	public function optionsSetup()
	{
		$optionsMachine = $this->helper->optionsMachine($this->options);
		if (!get_option(THEME_OPTIONS))
		{
			update_option(THEME_OPTIONS, $optionsMachine['defaults']);
		}
		if (!get_option(THEME_OPTIONS_BACKUPS))
		{
			update_option(THEME_OPTIONS_BACKUPS, $optionsMachine['defaults']);
		}
	}

	public function stylesheets()
	{
		if (!is_admin() && !in_array($this->pageNow, array('wp-login.php', 'wp-register.php')))
    {
    	wp_deregister_style('normalize');
	    wp_register_style('normalize', TEMPLATE_DIR . '/css/normalize.css', array(), false, 'all');
	    wp_enqueue_style('normalize');
    }
	}

	public function scripts() {
		global $post;
    if (!is_admin() && !in_array($this->pageNow, array('wp-login.php', 'wp-register.php'))) {
    wp_reset_query();

    $slider_page_id = $post->ID;
    if(is_home() && !is_front_page()){
        $slider_page_id = get_option('page_for_posts');
    }

    wp_enqueue_script( 'jquery', false, array(), false, true);

    wp_deregister_script('ccgallery_modernizr');

    wp_deregister_script( 'modernizr' );
    wp_register_script( 'modernizr', get_bloginfo('template_directory').'/js/modernizr.js', array(), false, true);
    wp_enqueue_script( 'modernizr' );

    wp_deregister_script( 'jquery.carouFredSel' );
    wp_register_script( 'jquery.carouFredSel', get_bloginfo('template_directory').'/js/jquery.carouFredSel-6.2.1-packed.js', array(), false, true);
    //if(is_single()) {
        wp_enqueue_script( 'jquery.carouFredSel' );
    //}

    wp_deregister_script( 'jquery.prettyPhoto' );
    wp_register_script( 'jquery.prettyPhoto', get_bloginfo('template_directory').'/js/jquery.prettyPhoto.js', array(), false, true);
    wp_enqueue_script( 'jquery.prettyPhoto' );

    wp_deregister_script( 'jquery.isotope' );
    wp_register_script( 'jquery.isotope', get_bloginfo('template_directory').'/js/jquery.isotope.min.js', array(), false, true);
    /*if(
        is_page_template('portfolio-one-column.php') || is_page_template('portfolio-one-column-text.php') ||
        is_page_template('portfolio-two-column.php') || is_page_template('portfolio-two-column-text.php') ||
        is_page_template('portfolio-three-column.php') || is_page_template('portfolio-three-column-text.php') ||
        is_page_template('portfolio-four-column.php') || is_page_template('portfolio-four-column-text.php') ||
        (is_home() && $data['blog_layout'] == 'Grid') || is_page_template('demo-gridblog.php') ||
        is_page_template('demo-timelineblog.php')
    ) {*/
        wp_enqueue_script( 'jquery.isotope' );
    //}

    wp_deregister_script( 'jquery.flexslider' );
    wp_register_script( 'jquery.flexslider', get_bloginfo('template_directory').'/js/jquery.flexslider-min.js', array(), false, true);
    //if(is_home() || is_single() || is_search() || is_archive() || get_post_meta($slider_page_id, 'pyre_slider_type', true) == 'flex2') {
        wp_enqueue_script( 'jquery.flexslider' );
    //}

    wp_deregister_script( 'jquery.cycle' );
    wp_register_script( 'jquery.cycle', get_bloginfo('template_directory').'/js/jquery.cycle.lite.js', array(), false, true);
    //wp_enqueue_script( 'jquery.cycle' );

    wp_deregister_script( 'jquery.fitvids' );
    wp_register_script( 'jquery.fitvids', get_bloginfo('template_directory').'/js/jquery.fitvids.js', array(), false, true);
    wp_enqueue_script( 'jquery.fitvids' );

    wp_deregister_script( 'jquery.hoverIntent' );
    wp_register_script( 'jquery.hoverIntent', get_bloginfo('template_directory').'/js/jquery.hoverIntent.minified.js', array(), false, true);
    wp_enqueue_script( 'jquery.hoverIntent' );

    wp_deregister_script( 'jquery.easing' );
    wp_register_script( 'jquery.easing', get_bloginfo('template_directory').'/js/jquery.easing.js', array(), false, false);
    //wp_enqueue_script( 'jquery.easing' );

    wp_deregister_script( 'jquery.eislideshow' );
    wp_register_script( 'jquery.eislideshow', get_bloginfo('template_directory').'/js/jquery.eislideshow.js', array(), false, true);
    //if(get_post_meta($slider_page_id, 'pyre_slider_type', true) == 'elastic') {
        wp_enqueue_script( 'jquery.eislideshow' );
    //}

    wp_deregister_script( 'froogaloop' );
    wp_register_script( 'froogaloop', get_bloginfo('template_directory').'/js/froogaloop.js', array(), false, true);
    wp_enqueue_script( 'froogaloop' );

    wp_deregister_script( 'jquery.placeholder' );
    wp_register_script( 'jquery.placeholder', get_bloginfo('template_directory').'/js/jquery.placeholder.js', array(), false, true);
    wp_enqueue_script( 'jquery.placeholder' );

    wp_deregister_script( 'jquery.waypoint' );
    wp_register_script( 'jquery.waypoint', get_bloginfo('template_directory').'/js/jquery.waypoint.js', array(), false, true);
    wp_enqueue_script( 'jquery.waypoint' );

    //wp_deregister_script('gmaps.api');
    //wp_register_script('gmaps.api', 'https://maps.google.com/maps/api/js?v=3.exp&amp;sensor=false&amp;language='.substr(get_locale(), 0, 2), array(), false, true);
    //if(is_page_template('contact.php') || is_page_template('contact-2.php')) {
        //wp_enqueue_script( 'gmaps.api' );
    //}

    wp_deregister_script( 'jquery.ui.map' );
    wp_register_script( 'jquery.ui.map', get_bloginfo('template_directory').'/js/gmap.js', array(), false, true);
    //if(is_page_template('contact.php') || is_page_template('contact-2.php')) {
        wp_enqueue_script( 'jquery.ui.map' );
    //}

    wp_deregister_script( 'jquery.gauge' );
    wp_register_script( 'jquery.gauge', get_bloginfo('template_directory').'/js/gauge.js', array(), false, true);
    wp_enqueue_script( 'jquery.gauge' );

    wp_deregister_script( 'jquery.ddslick.' );
    wp_register_script( 'jquery.ddslick', get_bloginfo('template_directory').'/js/jquery.ddslick.min.js', array(), false, true);
    wp_enqueue_script( 'jquery.ddslick' );

    //if($data['blog_pagination_type'] == 'Infinite Scroll' || is_page_template('demo-gridblog.php') || is_page_template('demo-timelineblog.php')) {
        wp_deregister_script( 'jquery.infinitescroll' );
        wp_register_script( 'jquery.infinitescroll', get_bloginfo('template_directory').'/js/jquery.infinitescroll.min.js', array(), false, true);
        wp_enqueue_script( 'jquery.infinitescroll' );
    //}

    wp_deregister_script( 'avada' );
    wp_register_script( 'avada', get_bloginfo('template_directory').'/js/main.js', array(), false, true);
    wp_enqueue_script( 'avada' );
    }
	}

  public function setPostViews() {
    global $post;

    if('post' == get_post_type() && is_single()) {
      $postID = $post->ID;

      if(!empty($postID)) {
        $count_key = 'sl_post_views_count';
        $count = get_post_meta($postID, $count_key, true);

        if($count == '') {
          $count = 0;
          delete_post_meta($postID, $count_key);
          add_post_meta($postID, $count_key, '0');
        } else {
          $count++;
          update_post_meta($postID, $count_key, $count);
        }
      }
    }
  }

  public static function salamanderComment($comment, $args, $depth)
  {
    $GLOBALS['comment'] = $comment; ?>
    <?php $add_below = ''; ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

    <div class="the-comment">
      <div class="avatar">
        <?php echo get_avatar($comment, 54); ?>
      </div>

      <div class="comment-box">

        <div class="comment-author meta">
          <strong><?php echo get_comment_author_link() ?></strong>
          <?php printf(__('%1$s at %2$s', 'salamander'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__(' - Edit', 'salamander'),'  ','') ?><?php comment_reply_link(array_merge( $args, array('reply_text' => __(' - Reply', 'salamander'), 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>

        <div class="comment-text">
          <?php if ($comment->comment_approved == '0') : ?>
            <em><?php echo __('Your comment is awaiting moderation.', 'Avada') ?></em>
            <br />
          <?php endif; ?>
          <?php comment_text() ?>
        </div>

      </div>

    </div>
    <?php
  }

	public function setOptions()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat)
		{
		  $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
		}
		$categories_tmp = array_unshift($of_categories, 'Select a category:');

		//Access the WordPress Pages via an Array
		$functionof_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');
		if($of_pages_obj)
		{
			foreach ($of_pages_obj as $of_page)
			{
		    $of_pages[$of_page->ID] = $of_page->post_name;
		  }
			$of_pages_tmp = array_unshift($of_pages, 'Select a page:');
		}

		//Testing
		$of_options_select = array(
			'one',
			'two',
			'three',
			'four',
			'five',
		);

		$of_options_radio = array(
			'one' => 'One',
			'two' => 'Two',
			'three' => 'Three',
			'four' => 'Four',
			'five' => 'Five',
		);

		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		(
			'disabled' => array (
				'placebo' 		=> 'placebo', //REQUIRED!
				'block_one'		=> 'Block One',
				'block_two'		=> 'Block Two',
				'block_three'	=> 'Block Three',
			),
			'enabled' => array (
				'placebo' => 'placebo', //REQUIRED!
				'block_four'	=> 'Block Four',
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();

		if (is_dir($alt_stylesheet_path))
		{
	    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path))
	    {
        while (($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false)
        {
          if(stristr($alt_stylesheet_file, '.css') !== false)
          {
            $alt_stylesheets[] = $alt_stylesheet_file;
          }
        }
	    }
		}

		//Background Images Reader
		$bg_images_path = STYLESHEETPATH. '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_bloginfo('template_url').'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();

		if (is_dir($bg_images_path))
		{
	    if ($bg_images_dir = opendir($bg_images_path))
	    {
        while (($bg_images_file = readdir($bg_images_dir)) !== false)
        {
          if(stristr($bg_images_file, '.png') !== false || stristr($bg_images_file, '.jpg') !== false) {
            $bg_images[] = $bg_images_url . $bg_images_file;
          }
        }
	    }
		}


		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/

		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array('Select a number:', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19');

		$body_repeat = array(
			'no-repeat',
			'repeat-x',
			'repeat-y',
			'repeat',
		);

		$body_pos = array(
			'top left',
			'top center',
			'top right',
			'center left',
			'center center',
			'center right',
			'bottom left',
			'bottom center',
			'bottom right',
		);

		// Image Alignment radio box
		$of_options_thumb_align = array(
			'alignleft' => 'Left',
			'alignright' => 'Right',
			'aligncenter' => 'Center',
		);

		// Image Links to Options
		$of_options_image_link_to = array(
			'image' => 'The Image',
			'post' => 'The Post',
		);

		$font_sizes = array(
			'10' => '10',
			'11' => '11',
			'12' => '12',
			'13' => '13',
			'14' => '14',
			'15' => '15',
			'16' => '16',
			'17' => '17',
			'18' => '18',
			'19' => '19',
			'20' => '20',
			'21' => '21',
			'22' => '22',
			'23' => '23',
			'24' => '24',
			'25' => '25',
			'26' => '26',
			'27' => '27',
			'28' => '28',
			'29' => '29',
			'30' => '30',
			'31' => '31',
			'32' => '32',
			'33' => '33',
			'34' => '34',
			'35' => '35',
			'36' => '36',
			'37' => '37',
			'38' => '38',
			'39' => '39',
			'40' => '40',
			'41' => '41',
			'42' => '42',
			'43' => '43',
			'44' => '44',
			'45' => '45',
			'46' => '46',
			'47' => '47',
			'48' => '48',
			'49' => '49',
			'50' => '50',
		);

		$google_fonts = array(
			'0' => 'Select Font',
			'ABeeZee' => 'ABeeZee',
			'Abel' => 'Abel',
			'Abril Fatface' => 'Abril Fatface',
			'Aclonica' => 'Aclonica',
			'Acme' => 'Acme',
			'Actor' => 'Actor',
			'Adamina' => 'Adamina',
			'Advent Pro' => 'Advent Pro',
			'Aguafina Script' => 'Aguafina Script',
			'Akronim' => 'Akronim',
			'Aladin' => 'Aladin',
			'Aldrich' => 'Aldrich',
			'Alegreya' => 'Alegreya',
			'Alegreya SC' => 'Alegreya SC',
			'Alex Brush' => 'Alex Brush',
			'Alfa Slab One' => 'Alfa Slab One',
			'Alice' => 'Alice',
			'Alike' => 'Alike',
			'Alike Angular' => 'Alike Angular',
			'Allan' => 'Allan',
			'Allerta' => 'Allerta',
			'Allerta Stencil' => 'Allerta Stencil',
			'Allura' => 'Allura',
			'Almendra' => 'Almendra',
			'Almendra Display' => 'Almendra Display',
			'Almendra SC' => 'Almendra SC',
			'Amarante' => 'Amarante',
			'Amaranth' => 'Amaranth',
			'Amatic SC' => 'Amatic SC',
			'Amethysta' => 'Amethysta',
			'Anaheim' => 'Anaheim',
			'Andada' => 'Andada',
			'Andika' => 'Andika',
			'Angkor' => 'Angkor',
			'Annie Use Your Telescope' => 'Annie Use Your Telescope',
			'Anonymous Pro' => 'Anonymous Pro',
			'Antic' => 'Antic',
			'Antic Didone' => 'Antic Didone',
			'Antic Slab' => 'Antic Slab',
			'Anton' => 'Anton',
			'Arapey' => 'Arapey',
			'Arbutus' => 'Arbutus',
			'Arbutus Slab' => 'Arbutus Slab',
			'Architects Daughter' => 'Architects Daughter',
			'Archivo Black' => 'Archivo Black',
			'Archivo Narrow' => 'Archivo Narrow',
			'Arimo' => 'Arimo',
			'Arizonia' => 'Arizonia',
			'Armata' => 'Armata',
			'Artifika' => 'Artifika',
			'Arvo' => 'Arvo',
			'Asap' => 'Asap',
			'Asset' => 'Asset',
			'Astloch' => 'Astloch',
			'Asul' => 'Asul',
			'Atomic Age' => 'Atomic Age',
			'Aubrey' => 'Aubrey',
			'Audiowide' => 'Audiowide',
			'Autour One' => 'Autour One',
			'Average' => 'Average',
			'Average Sans' => 'Average Sans',
			'Averia Gruesa Libre' => 'Averia Gruesa Libre',
			'Averia Libre' => 'Averia Libre',
			'Averia Sans Libre' => 'Averia Sans Libre',
			'Averia Serif Libre' => 'Averia Serif Libre',
			'Bad Script' => 'Bad Script',
			'Balthazar' => 'Balthazar',
			'Bangers' => 'Bangers',
			'Basic' => 'Basic',
			'Battambang' => 'Battambang',
			'Baumans' => 'Baumans',
			'Bayon' => 'Bayon',
			'Belgrano' => 'Belgrano',
			'Belleza' => 'Belleza',
			'BenchNine' => 'BenchNine',
			'Bentham' => 'Bentham',
			'Berkshire Swash' => 'Berkshire Swash',
			'Bevan' => 'Bevan',
			'Bigelow Rules' => 'Bigelow Rules',
			'Bigshot One' => 'Bigshot One',
			'Bilbo' => 'Bilbo',
			'Bilbo Swash Caps' => 'Bilbo Swash Caps',
			'Bitter' => 'Bitter',
			'Black Ops One' => 'Black Ops One',
			'Bokor' => 'Bokor',
			'Bonbon' => 'Bonbon',
			'Boogaloo' => 'Boogaloo',
			'Bowlby One' => 'Bowlby One',
			'Bowlby One SC' => 'Bowlby One SC',
			'Brawler' => 'Brawler',
			'Bree Serif' => 'Bree Serif',
			'Bubblegum Sans' => 'Bubblegum Sans',
			'Bubbler One' => 'Bubbler One',
			'Buda' => 'Buda',
			'Buenard' => 'Buenard',
			'Butcherman' => 'Butcherman',
			'Butterfly Kids' => 'Butterfly Kids',
			'Cabin' => 'Cabin',
			'Cabin Condensed' => 'Cabin Condensed',
			'Cabin Sketch' => 'Cabin Sketch',
			'Caesar Dressing' => 'Caesar Dressing',
			'Cagliostro' => 'Cagliostro',
			'Calligraffitti' => 'Calligraffitti',
			'Cambo' => 'Cambo',
			'Candal' => 'Candal',
			'Cantarell' => 'Cantarell',
			'Cantata One' => 'Cantata One',
			'Cantora One' => 'Cantora One',
			'Capriola' => 'Capriola',
			'Cardo' => 'Cardo',
			'Carme' => 'Carme',
			'Carrois Gothic' => 'Carrois Gothic',
			'Carrois Gothic SC' => 'Carrois Gothic SC',
			'Carter One' => 'Carter One',
			'Caudex' => 'Caudex',
			'Cedarville Cursive' => 'Cedarville Cursive',
			'Ceviche One' => 'Ceviche One',
			'Changa One' => 'Changa One',
			'Chango' => 'Chango',
			'Chau Philomene One' => 'Chau Philomene One',
			'Chela One' => 'Chela One',
			'Chelsea Market' => 'Chelsea Market',
			'Chenla' => 'Chenla',
			'Cherry Cream Soda' => 'Cherry Cream Soda',
			'Cherry Swash' => 'Cherry Swash',
			'Chewy' => 'Chewy',
			'Chicle' => 'Chicle',
			'Chivo' => 'Chivo',
			'Cinzel' => 'Cinzel',
			'Cinzel Decorative' => 'Cinzel Decorative',
			'Clicker Script' => 'Clicker Script',
			'Coda' => 'Coda',
			'Coda Caption' => 'Coda Caption',
			'Codystar' => 'Codystar',
			'Combo' => 'Combo',
			'Comfortaa' => 'Comfortaa',
			'Coming Soon' => 'Coming Soon',
			'Concert One' => 'Concert One',
			'Condiment' => 'Condiment',
			'Content' => 'Content',
			'Contrail One' => 'Contrail One',
			'Convergence' => 'Convergence',
			'Cookie' => 'Cookie',
			'Copse' => 'Copse',
			'Corben' => 'Corben',
			'Courgette' => 'Courgette',
			'Cousine' => 'Cousine',
			'Coustard' => 'Coustard',
			'Covered By Your Grace' => 'Covered By Your Grace',
			'Crafty Girls' => 'Crafty Girls',
			'Creepster' => 'Creepster',
			'Crete Round' => 'Crete Round',
			'Crimson Text' => 'Crimson Text',
			'Croissant One' => 'Croissant One',
			'Crushed' => 'Crushed',
			'Cuprum' => 'Cuprum',
			'Cutive' => 'Cutive',
			'Cutive Mono' => 'Cutive Mono',
			'Damion' => 'Damion',
			'Dancing Script' => 'Dancing Script',
			'Dangrek' => 'Dangrek',
			'Dawning of a New Day' => 'Dawning of a New Day',
			'Days One' => 'Days One',
			'Delius' => 'Delius',
			'Delius Swash Caps' => 'Delius Swash Caps',
			'Delius Unicase' => 'Delius Unicase',
			'Della Respira' => 'Della Respira',
			'Denk One' => 'Denk One',
			'Devonshire' => 'Devonshire',
			'Didact Gothic' => 'Didact Gothic',
			'Diplomata' => 'Diplomata',
			'Diplomata SC' => 'Diplomata SC',
			'Domine' => 'Domine',
			'Donegal One' => 'Donegal One',
			'Doppio One' => 'Doppio One',
			'Dorsa' => 'Dorsa',
			'Dosis' => 'Dosis',
			'Dr Sugiyama' => 'Dr Sugiyama',
			'Droid Sans' => 'Droid Sans',
			'Droid Sans Mono' => 'Droid Sans Mono',
			'Droid Serif' => 'Droid Serif',
			'Duru Sans' => 'Duru Sans',
			'Dynalight' => 'Dynalight',
			'EB Garamond' => 'EB Garamond',
			'Eagle Lake' => 'Eagle Lake',
			'Eater' => 'Eater',
			'Economica' => 'Economica',
			'Electrolize' => 'Electrolize',
			'Elsie' => 'Elsie',
			'Elsie Swash Caps' => 'Elsie Swash Caps',
			'Emblema One' => 'Emblema One',
			'Emilys Candy' => 'Emilys Candy',
			'Engagement' => 'Engagement',
			'Englebert' => 'Englebert',
			'Enriqueta' => 'Enriqueta',
			'Erica One' => 'Erica One',
			'Esteban' => 'Esteban',
			'Euphoria Script' => 'Euphoria Script',
			'Ewert' => 'Ewert',
			'Exo' => 'Exo',
			'Expletus Sans' => 'Expletus Sans',
			'Fanwood Text' => 'Fanwood Text',
			'Fascinate' => 'Fascinate',
			'Fascinate Inline' => 'Fascinate Inline',
			'Faster One' => 'Faster One',
			'Fasthand' => 'Fasthand',
			'Federant' => 'Federant',
			'Federo' => 'Federo',
			'Felipa' => 'Felipa',
			'Fenix' => 'Fenix',
			'Finger Paint' => 'Finger Paint',
			'Fjalla One' => 'Fjalla One',
			'Fjord One' => 'Fjord One',
			'Flamenco' => 'Flamenco',
			'Flavors' => 'Flavors',
			'Fondamento' => 'Fondamento',
			'Fontdiner Swanky' => 'Fontdiner Swanky',
			'Forum' => 'Forum',
			'Francois One' => 'Francois One',
			'Freckle Face' => 'Freckle Face',
			'Fredericka the Great' => 'Fredericka the Great',
			'Fredoka One' => 'Fredoka One',
			'Freehand' => 'Freehand',
			'Fresca' => 'Fresca',
			'Frijole' => 'Frijole',
			'Fruktur' => 'Fruktur',
			'Fugaz One' => 'Fugaz One',
			'GFS Didot' => 'GFS Didot',
			'GFS Neohellenic' => 'GFS Neohellenic',
			'Gabriela' => 'Gabriela',
			'Gafata' => 'Gafata',
			'Galdeano' => 'Galdeano',
			'Galindo' => 'Galindo',
			'Gentium Basic' => 'Gentium Basic',
			'Gentium Book Basic' => 'Gentium Book Basic',
			'Geo' => 'Geo',
			'Geostar' => 'Geostar',
			'Geostar Fill' => 'Geostar Fill',
			'Germania One' => 'Germania One',
			'Gilda Display' => 'Gilda Display',
			'Give You Glory' => 'Give You Glory',
			'Glass Antiqua' => 'Glass Antiqua',
			'Glegoo' => 'Glegoo',
			'Gloria Hallelujah' => 'Gloria Hallelujah',
			'Goblin One' => 'Goblin One',
			'Gochi Hand' => 'Gochi Hand',
			'Gorditas' => 'Gorditas',
			'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
			'Graduate' => 'Graduate',
			'Grand Hotel' => 'Grand Hotel',
			'Gravitas One' => 'Gravitas One',
			'Great Vibes' => 'Great Vibes',
			'Griffy' => 'Griffy',
			'Gruppo' => 'Gruppo',
			'Gudea' => 'Gudea',
			'Habibi' => 'Habibi',
			'Hammersmith One' => 'Hammersmith One',
			'Hanalei' => 'Hanalei',
			'Hanalei Fill' => 'Hanalei Fill',
			'Handlee' => 'Handlee',
			'Hanuman' => 'Hanuman',
			'Happy Monkey' => 'Happy Monkey',
			'Headland One' => 'Headland One',
			'Henny Penny' => 'Henny Penny',
			'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
			'Holtwood One SC' => 'Holtwood One SC',
			'Homemade Apple' => 'Homemade Apple',
			'Homenaje' => 'Homenaje',
			'IM Fell DW Pica' => 'IM Fell DW Pica',
			'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
			'IM Fell Double Pica' => 'IM Fell Double Pica',
			'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
			'IM Fell English' => 'IM Fell English',
			'IM Fell English SC' => 'IM Fell English SC',
			'IM Fell French Canon' => 'IM Fell French Canon',
			'IM Fell French Canon SC' => 'IM Fell French Canon SC',
			'IM Fell Great Primer' => 'IM Fell Great Primer',
			'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
			'Iceberg' => 'Iceberg',
			'Iceland' => 'Iceland',
			'Imprima' => 'Imprima',
			'Inconsolata' => 'Inconsolata',
			'Inder' => 'Inder',
			'Indie Flower' => 'Indie Flower',
			'Inika' => 'Inika',
			'Irish Grover' => 'Irish Grover',
			'Istok Web' => 'Istok Web',
			'Italiana' => 'Italiana',
			'Italianno' => 'Italianno',
			'Jacques Francois' => 'Jacques Francois',
			'Jacques Francois Shadow' => 'Jacques Francois Shadow',
			'Jim Nightshade' => 'Jim Nightshade',
			'Jockey One' => 'Jockey One',
			'Jolly Lodger' => 'Jolly Lodger',
			'Josefin Sans' => 'Josefin Sans',
			'Josefin Slab' => 'Josefin Slab',
			'Joti One' => 'Joti One',
			'Judson' => 'Judson',
			'Julee' => 'Julee',
			'Julius Sans One' => 'Julius Sans One',
			'Junge' => 'Junge',
			'Jura' => 'Jura',
			'Just Another Hand' => 'Just Another Hand',
			'Just Me Again Down Here' => 'Just Me Again Down Here',
			'Kameron' => 'Kameron',
			'Karla' => 'Karla',
			'Kaushan Script' => 'Kaushan Script',
			'Kavoon' => 'Kavoon',
			'Keania One' => 'Keania One',
			'Kelly Slab' => 'Kelly Slab',
			'Kenia' => 'Kenia',
			'Khmer' => 'Khmer',
			'Kite One' => 'Kite One',
			'Knewave' => 'Knewave',
			'Kotta One' => 'Kotta One',
			'Koulen' => 'Koulen',
			'Kranky' => 'Kranky',
			'Kreon' => 'Kreon',
			'Kristi' => 'Kristi',
			'Krona One' => 'Krona One',
			'La Belle Aurore' => 'La Belle Aurore',
			'Lancelot' => 'Lancelot',
			'Lato' => 'Lato',
			'League Script' => 'League Script',
			'Leckerli One' => 'Leckerli One',
			'Ledger' => 'Ledger',
			'Lekton' => 'Lekton',
			'Lemon' => 'Lemon',
			'Libre Baskerville' => 'Libre Baskerville',
			'Life Savers' => 'Life Savers',
			'Lilita One' => 'Lilita One',
			'Limelight' => 'Limelight',
			'Linden Hill' => 'Linden Hill',
			'Lobster' => 'Lobster',
			'Lobster Two' => 'Lobster Two',
			'Londrina Outline' => 'Londrina Outline',
			'Londrina Shadow' => 'Londrina Shadow',
			'Londrina Sketch' => 'Londrina Sketch',
			'Londrina Solid' => 'Londrina Solid',
			'Lora' => 'Lora',
			'Love Ya Like A Sister' => 'Love Ya Like A Sister',
			'Loved by the King' => 'Loved by the King',
			'Lovers Quarrel' => 'Lovers Quarrel',
			'Luckiest Guy' => 'Luckiest Guy',
			'Lusitana' => 'Lusitana',
			'Lustria' => 'Lustria',
			'Macondo' => 'Macondo',
			'Macondo Swash Caps' => 'Macondo Swash Caps',
			'Magra' => 'Magra',
			'Maiden Orange' => 'Maiden Orange',
			'Mako' => 'Mako',
			'Marcellus' => 'Marcellus',
			'Marcellus SC' => 'Marcellus SC',
			'Marck Script' => 'Marck Script',
			'Margarine' => 'Margarine',
			'Marko One' => 'Marko One',
			'Marmelad' => 'Marmelad',
			'Marvel' => 'Marvel',
			'Mate' => 'Mate',
			'Mate SC' => 'Mate SC',
			'Maven Pro' => 'Maven Pro',
			'McLaren' => 'McLaren',
			'Meddon' => 'Meddon',
			'MedievalSharp' => 'MedievalSharp',
			'Medula One' => 'Medula One',
			'Megrim' => 'Megrim',
			'Meie Script' => 'Meie Script',
			'Merienda' => 'Merienda',
			'Merienda One' => 'Merienda One',
			'Merriweather' => 'Merriweather',
			'Merriweather Sans' => 'Merriweather Sans',
			'Metal' => 'Metal',
			'Metal Mania' => 'Metal Mania',
			'Metamorphous' => 'Metamorphous',
			'Metrophobic' => 'Metrophobic',
			'Michroma' => 'Michroma',
			'Milonga' => 'Milonga',
			'Miltonian' => 'Miltonian',
			'Miltonian Tattoo' => 'Miltonian Tattoo',
			'Miniver' => 'Miniver',
			'Miss Fajardose' => 'Miss Fajardose',
			'Modern Antiqua' => 'Modern Antiqua',
			'Molengo' => 'Molengo',
			'Molle' => 'Molle',
			'Monda' => 'Monda',
			'Monofett' => 'Monofett',
			'Monoton' => 'Monoton',
			'Monsieur La Doulaise' => 'Monsieur La Doulaise',
			'Montaga' => 'Montaga',
			'Montez' => 'Montez',
			'Montserrat' => 'Montserrat',
			'Montserrat Alternates' => 'Montserrat Alternates',
			'Montserrat Subrayada' => 'Montserrat Subrayada',
			'Moul' => 'Moul',
			'Moulpali' => 'Moulpali',
			'Mountains of Christmas' => 'Mountains of Christmas',
			'Mouse Memoirs' => 'Mouse Memoirs',
			'Mr Bedfort' => 'Mr Bedfort',
			'Mr Dafoe' => 'Mr Dafoe',
			'Mr De Haviland' => 'Mr De Haviland',
			'Mrs Saint Delafield' => 'Mrs Saint Delafield',
			'Mrs Sheppards' => 'Mrs Sheppards',
			'Muli' => 'Muli',
			'Mystery Quest' => 'Mystery Quest',
			'Neucha' => 'Neucha',
			'Neuton' => 'Neuton',
			'New Rocker' => 'New Rocker',
			'News Cycle' => 'News Cycle',
			'Niconne' => 'Niconne',
			'Nixie One' => 'Nixie One',
			'Nobile' => 'Nobile',
			'Nokora' => 'Nokora',
			'Norican' => 'Norican',
			'Nosifer' => 'Nosifer',
			'Nothing You Could Do' => 'Nothing You Could Do',
			'Noticia Text' => 'Noticia Text',
			'Noto Sans' => 'Noto Sans',
			'Noto Serif' => 'Noto Serif',
			'Nova Cut' => 'Nova Cut',
			'Nova Flat' => 'Nova Flat',
			'Nova Mono' => 'Nova Mono',
			'Nova Oval' => 'Nova Oval',
			'Nova Round' => 'Nova Round',
			'Nova Script' => 'Nova Script',
			'Nova Slim' => 'Nova Slim',
			'Nova Square' => 'Nova Square',
			'Numans' => 'Numans',
			'Nunito' => 'Nunito',
			'Odor Mean Chey' => 'Odor Mean Chey',
			'Offside' => 'Offside',
			'Old Standard TT' => 'Old Standard TT',
			'Oldenburg' => 'Oldenburg',
			'Oleo Script' => 'Oleo Script',
			'Oleo Script Swash Caps' => 'Oleo Script Swash Caps',
			'Open Sans' => 'Open Sans',
			'Open Sans Condensed' => 'Open Sans Condensed',
			'Oranienbaum' => 'Oranienbaum',
			'Orbitron' => 'Orbitron',
			'Oregano' => 'Oregano',
			'Orienta' => 'Orienta',
			'Original Surfer' => 'Original Surfer',
			'Oswald' => 'Oswald',
			'Over the Rainbow' => 'Over the Rainbow',
			'Overlock' => 'Overlock',
			'Overlock SC' => 'Overlock SC',
			'Ovo' => 'Ovo',
			'Oxygen' => 'Oxygen',
			'Oxygen Mono' => 'Oxygen Mono',
			'PT Mono' => 'PT Mono',
			'PT Sans' => 'PT Sans',
			'PT Sans Caption' => 'PT Sans Caption',
			'PT Sans Narrow' => 'PT Sans Narrow',
			'PT Serif' => 'PT Serif',
			'PT Serif Caption' => 'PT Serif Caption',
			'Pacifico' => 'Pacifico',
			'Paprika' => 'Paprika',
			'Parisienne' => 'Parisienne',
			'Passero One' => 'Passero One',
			'Passion One' => 'Passion One',
			'Patrick Hand' => 'Patrick Hand',
			'Patrick Hand SC' => 'Patrick Hand SC',
			'Patua One' => 'Patua One',
			'Paytone One' => 'Paytone One',
			'Peralta' => 'Peralta',
			'Permanent Marker' => 'Permanent Marker',
			'Petit Formal Script' => 'Petit Formal Script',
			'Petrona' => 'Petrona',
			'Philosopher' => 'Philosopher',
			'Piedra' => 'Piedra',
			'Pinyon Script' => 'Pinyon Script',
			'Pirata One' => 'Pirata One',
			'Plaster' => 'Plaster',
			'Play' => 'Play',
			'Playball' => 'Playball',
			'Playfair Display' => 'Playfair Display',
			'Playfair Display SC' => 'Playfair Display SC',
			'Podkova' => 'Podkova',
			'Poiret One' => 'Poiret One',
			'Poller One' => 'Poller One',
			'Poly' => 'Poly',
			'Pompiere' => 'Pompiere',
			'Pontano Sans' => 'Pontano Sans',
			'Port Lligat Sans' => 'Port Lligat Sans',
			'Port Lligat Slab' => 'Port Lligat Slab',
			'Prata' => 'Prata',
			'Preahvihear' => 'Preahvihear',
			'Press Start 2P' => 'Press Start 2P',
			'Princess Sofia' => 'Princess Sofia',
			'Prociono' => 'Prociono',
			'Prosto One' => 'Prosto One',
			'Puritan' => 'Puritan',
			'Purple Purse' => 'Purple Purse',
			'Quando' => 'Quando',
			'Quantico' => 'Quantico',
			'Quattrocento' => 'Quattrocento',
			'Quattrocento Sans' => 'Quattrocento Sans',
			'Questrial' => 'Questrial',
			'Quicksand' => 'Quicksand',
			'Quintessential' => 'Quintessential',
			'Qwigley' => 'Qwigley',
			'Racing Sans One' => 'Racing Sans One',
			'Radley' => 'Radley',
			'Raleway' => 'Raleway',
			'Raleway Dots' => 'Raleway Dots',
			'Rambla' => 'Rambla',
			'Rammetto One' => 'Rammetto One',
			'Ranchers' => 'Ranchers',
			'Rancho' => 'Rancho',
			'Rationale' => 'Rationale',
			'Redressed' => 'Redressed',
			'Reenie Beanie' => 'Reenie Beanie',
			'Revalia' => 'Revalia',
			'Ribeye' => 'Ribeye',
			'Ribeye Marrow' => 'Ribeye Marrow',
			'Righteous' => 'Righteous',
			'Risque' => 'Risque',
			'Roboto' => 'Roboto',
			'Roboto Condensed' => 'Roboto Condensed',
			'Roboto Slab' => 'Roboto Slab',
			'Rochester' => 'Rochester',
			'Rock Salt' => 'Rock Salt',
			'Rokkitt' => 'Rokkitt',
			'Romanesco' => 'Romanesco',
			'Ropa Sans' => 'Ropa Sans',
			'Rosario' => 'Rosario',
			'Rosarivo' => 'Rosarivo',
			'Rouge Script' => 'Rouge Script',
			'Ruda' => 'Ruda',
			'Rufina' => 'Rufina',
			'Ruge Boogie' => 'Ruge Boogie',
			'Ruluko' => 'Ruluko',
			'Rum Raisin' => 'Rum Raisin',
			'Ruslan Display' => 'Ruslan Display',
			'Russo One' => 'Russo One',
			'Ruthie' => 'Ruthie',
			'Rye' => 'Rye',
			'Sacramento' => 'Sacramento',
			'Sail' => 'Sail',
			'Salsa' => 'Salsa',
			'Sanchez' => 'Sanchez',
			'Sancreek' => 'Sancreek',
			'Sansita One' => 'Sansita One',
			'Sarina' => 'Sarina',
			'Satisfy' => 'Satisfy',
			'Scada' => 'Scada',
			'Schoolbell' => 'Schoolbell',
			'Seaweed Script' => 'Seaweed Script',
			'Sevillana' => 'Sevillana',
			'Seymour One' => 'Seymour One',
			'Shadows Into Light' => 'Shadows Into Light',
			'Shadows Into Light Two' => 'Shadows Into Light Two',
			'Shanti' => 'Shanti',
			'Share' => 'Share',
			'Share Tech' => 'Share Tech',
			'Share Tech Mono' => 'Share Tech Mono',
			'Shojumaru' => 'Shojumaru',
			'Short Stack' => 'Short Stack',
			'Siemreap' => 'Siemreap',
			'Sigmar One' => 'Sigmar One',
			'Signika' => 'Signika',
			'Signika Negative' => 'Signika Negative',
			'Simonetta' => 'Simonetta',
			'Sintony' => 'Sintony',
			'Sirin Stencil' => 'Sirin Stencil',
			'Six Caps' => 'Six Caps',
			'Skranji' => 'Skranji',
			'Slackey' => 'Slackey',
			'Smokum' => 'Smokum',
			'Smythe' => 'Smythe',
			'Sniglet' => 'Sniglet',
			'Snippet' => 'Snippet',
			'Snowburst One' => 'Snowburst One',
			'Sofadi One' => 'Sofadi One',
			'Sofia' => 'Sofia',
			'Sonsie One' => 'Sonsie One',
			'Sorts Mill Goudy' => 'Sorts Mill Goudy',
			'Source Code Pro' => 'Source Code Pro',
			'Source Sans Pro' => 'Source Sans Pro',
			'Special Elite' => 'Special Elite',
			'Spicy Rice' => 'Spicy Rice',
			'Spinnaker' => 'Spinnaker',
			'Spirax' => 'Spirax',
			'Squada One' => 'Squada One',
			'Stalemate' => 'Stalemate',
			'Stalinist One' => 'Stalinist One',
			'Stardos Stencil' => 'Stardos Stencil',
			'Stint Ultra Condensed' => 'Stint Ultra Condensed',
			'Stint Ultra Expanded' => 'Stint Ultra Expanded',
			'Stoke' => 'Stoke',
			'Strait' => 'Strait',
			'Sue Ellen Francisco' => 'Sue Ellen Francisco',
			'Sunshiney' => 'Sunshiney',
			'Supermercado One' => 'Supermercado One',
			'Suwannaphum' => 'Suwannaphum',
			'Swanky and Moo Moo' => 'Swanky and Moo Moo',
			'Syncopate' => 'Syncopate',
			'Tangerine' => 'Tangerine',
			'Taprom' => 'Taprom',
			'Tauri' => 'Tauri',
			'Telex' => 'Telex',
			'Tenor Sans' => 'Tenor Sans',
			'Text Me One' => 'Text Me One',
			'The Girl Next Door' => 'The Girl Next Door',
			'Tienne' => 'Tienne',
			'Tinos' => 'Tinos',
			'Titan One' => 'Titan One',
			'Titillium Web' => 'Titillium Web',
			'Trade Winds' => 'Trade Winds',
			'Trocchi' => 'Trocchi',
			'Trochut' => 'Trochut',
			'Trykker' => 'Trykker',
			'Tulpen One' => 'Tulpen One',
			'Ubuntu' => 'Ubuntu',
			'Ubuntu Condensed' => 'Ubuntu Condensed',
			'Ubuntu Mono' => 'Ubuntu Mono',
			'Ultra' => 'Ultra',
			'Uncial Antiqua' => 'Uncial Antiqua',
			'Underdog' => 'Underdog',
			'Unica One' => 'Unica One',
			'UnifrakturCook' => 'UnifrakturCook',
			'UnifrakturMaguntia' => 'UnifrakturMaguntia',
			'Unkempt' => 'Unkempt',
			'Unlock' => 'Unlock',
			'Unna' => 'Unna',
			'VT323' => 'VT323',
			'Vampiro One' => 'Vampiro One',
			'Varela' => 'Varela',
			'Varela Round' => 'Varela Round',
			'Vast Shadow' => 'Vast Shadow',
			'Vibur' => 'Vibur',
			'Vidaloka' => 'Vidaloka',
			'Viga' => 'Viga',
			'Voces' => 'Voces',
			'Volkhov' => 'Volkhov',
			'Vollkorn' => 'Vollkorn',
			'Voltaire' => 'Voltaire',
			'Waiting for the Sunrise' => 'Waiting for the Sunrise',
			'Wallpoet' => 'Wallpoet',
			'Walter Turncoat' => 'Walter Turncoat',
			'Warnes' => 'Warnes',
			'Wellfleet' => 'Wellfleet',
			'Wendy One' => 'Wendy One',
			'Wire One' => 'Wire One',
			'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
			'Yellowtail' => 'Yellowtail',
			'Yeseva One' => 'Yeseva One',
			'Yesteryear' => 'Yesteryear',
			'Zeyada' => 'Zeyada'
		);

		$this->options = array();

		$this->options[] = array(
			'name' => 'General Options',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Custom Favicon',
			'desc' => 'You can put url of an ico image that will represent your website\'s favicon (16px x 16px)',
			'id' => 'favicon',
			'default' => '',
			'type' => 'upload',
		);

		$this->options[] = array(
			'name' => 'Apple iPhone Icon Upload',
			'desc' => 'Icon for Apple iPhone (57px x 57px)',
			'id' => 'iphone_icon',
			'default' => '',
			'type' => 'upload',
		);

		$this->options[] = array(
			'name' => 'Apple iPhone Retina Icon Upload',
			'desc' => 'Icon for Apple iPhone Retina Version (114px x 114px)',
			'id' => 'iphone_icon_retina',
			'default' => '',
			'type' => 'upload',
		);

		$this->options[] = array(
			'name' => 'Apple iPad Icon Upload',
			'desc' => 'Icon for Apple iPhone (72px x 72px)',
			'id' => 'ipad_icon',
			'default' => '',
			'type' => 'upload',
		);

		$this->options[] = array(
			'name' => 'Apple iPad Retina Icon Upload',
			'desc' => 'Icon for Apple iPad Retina Version (144px x 144px)',
			'id' => 'ipad_icon_retina',
			'default' => '',
			'type' => 'upload',
		);

		$this->options[] = array(
			'name' => 'Default Sidebar Position',
			'desc' => 'Select the defeault position of the sidebar.',
			'id' => 'default_sidebar_pos',
			'default' => 'right',
			'options' => array('right' => 'Right', 'left' => 'Left'),
			'type' => 'select',
		);

		$this->options[] = array(
			'name' => 'Tracking Code',
			'desc' => 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.',
			'id' => 'google_analytics',
			'default' => '',
			'type' => 'textarea',
		);

		$this->options[] = array(
			'name' => 'Allow comments on pages',
			'desc' => 'Allow comments on regular pages.',
			'id' => 'comments_pages',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Disable featured images on pages',
			'desc' => 'Disable featured images on regular pages.',
			'id' => 'featured_images_pages',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Responsive Design',
			'desc' => 'Use the responsive design features.',
			'id' => 'responsive',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Use Fixed Layout for iPad Portrait',
			'desc' => 'Check this box to use the fixed layout for the iPad in portrait view.',
			'id' => 'ipad_potrait',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Space before &lt;/head&gt;',
			'desc' => 'Add code before the &lt;/head&gt; tag.',
			'id' => 'head_after',
			'default' => '',
			'type' => 'textarea',
		);

		$this->options[] = array(
			'name' => 'Space before &lt;/body&gt;',
			'desc' => 'Add code before the &lt;/body&gt; tag.',
			'id' => 'space_body',
			'default' => '',
			'type' => 'textarea',
		);

		$this->options[] = array(
			'name' => 'Header Options',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Header Info',
			'desc' => '',
			'id' => 'header_info',
			'default' => '<h3 style="margin: 0;">Header Content Options</h3>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' => 'Select a Header Layout',
      'desc' => '',
      'id' => 'header_layout',
      'default' => 'v1',
      'type' => 'images',
      'options' => array(
          'v1' => get_bloginfo('template_directory').'/images/patterns/header1.jpg',
          'v2' => get_bloginfo('template_directory').'/images/patterns/header2.jpg',
          'v3' => get_bloginfo('template_directory').'/images/patterns/header3.jpg',
          'v4' => get_bloginfo('template_directory').'/images/patterns/header4.jpg',
          'v5' => get_bloginfo('template_directory').'/images/patterns/header5.jpg'
    	)
    );

		$this->options[] = array(
			'name' => 'Header Top Left Content',
			'desc' => '',
			'id' => 'header_left_content',
			'default' => 'Contact Info',
			'type' => 'select',
			'options' => array('contactinfo' => 'Contact Info', 'socialinks' => 'Social Links', 'nav' => 'Navigation'));

		$this->options[] = array(
			'name' => 'Header Top Right Content',
			'desc' => '',
			'id' => 'header_right_content',
			'default' => 'Navigation',
			'type' => 'select',
			'options' => array('contactinfo' => 'Contact Info', 'socialinks' => 'Social Links', 'nav' => 'Navigation'));

		$this->options[] = array(
			'name' => 'Header Tagline Area Content For Header #4',
			'desc' => '',
			'id' => 'header_v4_content',
			'default' => 'Tagline + Search',
			'type' => 'select',
			'options' => array('tagline' => 'Tagline', 'search' => 'Search', 'taglinesearch' => 'Tagline + Search', 'banner' => 'Banner'));

		$this->options[] = array(
			'name' => 'Banner Code For Header #4',
                    'desc' => 'Add HTML banner code for Header # 4',
                    'id' => 'header_banner_code',
                    'default' => '',
                    'type' => 'textarea',
		);

		$this->options[] = array(
			'name' => 'Header Phone Number',
			'desc' => '',
			'id' => 'header_number',
			'default' => 'Call Us Today! 1.555.555.555',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Header Email Address',
			'desc' => '',
			'id' => 'header_email',
			'default' => 'info@yourdomain.com',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Header Tagline',
			'desc' => '',
			'id' => 'header_tagline',
			'default' => 'Insert Any Headline Or Link You Want Here',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Background Image For Header Area',
			'desc' => 'Please choose an image or insert an image url to use for the header backgroud.',
			'id' => 'header_bg_image',
			'default' => '',
			'mode' => 'mini',
			'type' => 'media',
		);

		$this->options[] = array(
			'name' => '100% Background Image',
			'desc' => 'Have header background image always at 100% in width and height and scale according to the browser size.',
			'id' => 'header_bg_full',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Background Repeat',
			'desc' => '',
			'id' => 'header_bg_repeat',
			'default' => '',
			'type' => 'select',
			'options' => array(
				'repeat' => 'repeat',
				'repeat-x' => 'repeat-x',
				'repeat-y' => 'repeat-y',
				'no-repeat' => 'no-repeat',
			),
		);

		$this->options[] = array(
			'name' => 'Display social icons on header of the page:',
			'desc' => 'Select the checkbox to show social media icons on the header of the page.',
			'id' => 'icons_header',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Open social icons on header in a new window',
			'desc' => '',
			'id' => 'icons_header_new',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Header Top Margin',
			'desc' => '(in pixels)',
			'id' => 'margin_header_top',
			'default' => '0px',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Header Bottom Margin',
			'desc' => '(in pixels)',
			'id' => 'margin_header_bottom',
			'default' => '0px',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Header Info',
			'desc' => '',
			'id' => 'header_info',
			'default' => '<h3 style="margin: 0;">Logo Options</h3>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' => 'Logo',
			'desc' => 'Please choose an image file for your logo.',
			'id' => 'logo',
			'default' => get_bloginfo('template_directory').'/images/logo.png',
			'mode' => 'mini',
			'type' => 'media',
		);

		$this->options[] = array(
			'name' => 'Logo (Retina Version @2x)',
			'desc' => 'Please choose an image file for the retina version of the logo. It should be 2x the size of main logo.',
			'id' => 'logo_retina',
			'default' => '',
			'mode' => 'mini',
			'type' => 'media',
		);

		$this->options[] = array(
			'name' => 'Standard Logo Width for Retina Logo',
			'desc' => 'If retina logo is uploaded, please enter the standard logo (1x) version width, do not enter the retina logo width.',
			'id' => 'retina_logo_width',
			'default' => '97',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Standard Logo Height for Retina Logo',
			'desc' => 'If retina logo is uploaded, please enter the standard logo (1x) version height, do not enter the retina logo height.',
			'id' => 'retina_logo_height',
			'default' => '22',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Logo Left Margin',
			'desc' => '(in pixels)',
			'id' => 'margin_logo_left',
			'default' => '0px',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Logo Right Margin',
			'desc' => '(in pixels)',
			'id' => 'margin_logo_right',
			'default' => '0px',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Logo Top Margin',
			'desc' => '(in pixels)',
			'id' => 'margin_logo_top',
			'default' => '31px',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Logo Bottom Margin',
			'desc' => '(in pixels)',
			'id' => 'margin_logo_bottom',
			'default' => '0px',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Header Info',
			'desc' => '',
			'id' => 'header_info',
			'default' => '<h3 style="margin: 0;">Menu Options</h3>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' => 'Main Nav Height',
			'desc' => '(Only use number without \'px\', default is 83)',
			'id' => 'nav_height',
			'default' => '83',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Dropdown Menu Width',
			'desc' => '(in pixels)',
			'id' => 'dropdown_menu_width',
			'default' => '170px',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Header Info',
			'desc' => '',
			'id' => 'header_info',
			'default' => '<h3 style="margin: 0;">Page Title Bar Options</h3>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' => 'Page Title Bar',
			'desc' => 'Show page title bar',
			'id' => 'page_title_bar',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Page Title Bar Height',
			'desc' => '(in pixels)',
			'id' => 'page_title_height',
			'default' => '87px',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Page Title Bar Background',
			'desc' => '',
			'id' => 'page_title_bg',
			'default' => get_bloginfo('template_directory').'/images/page_title_bg.png',
			'mode' => 'mini',
			'type' => 'media',
		);

		$this->options[] = array(
			'name' => 'Page Title Bar Background (Retina Version @2x)',
			'desc' => '',
			'id' => 'page_title_bg_retina',
			'default' => '',
			'mode' => 'mini',
			'type' => 'media',
		);

		$this->options[] = array(
			'name' => 'Page Title Bar Background Color',
			'desc' => '',
			'id' => 'page_title_bg_color',
			'default' => '#F6F6F6',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Page Title Bar Borders',
			'desc' => '',
			'id' => 'page_title_border_color',
			'default' => '#d2d3d4',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' => 'Header Info',
			'desc' => '',
			'id' => 'header_info',
			'default' => '<h3 style="margin: 0;">Breadcrumb Options</h3>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' => 'Breadcrumbs or Search Box?',
			'desc' => 'Show breadcrumbs or search box on page title bar?',
			'id' => 'page_title_bar_bs',
			'default' => 'Breadcrumbs',
			'options' => array('breadcrumbs' => 'Breadcrumbs', 'search' => 'Search Box'),
			'type' => 'select',
		);

		$this->options[] = array(
			'name' => 'Breadcrumb Menu',
			'desc' => 'Show breadcrumbs in general',
			'id' => 'breadcrumb',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Breadcrumb on Mobile Devices',
			'desc' => 'Show breadcrumbs on mobile devices',
			'id' => 'breadcrumb_mobile',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Breadcrumb Menu Prefix',
			'desc' => 'The text before the breadcrumb menu',
			'id' => 'breacrumb_prefix',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Footer Options',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Copyright Bar',
			'desc' => 'Show copyright bar',
			'id' => 'footer_copyright',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Copyright Text',
      'desc' => '',
      'id' => 'footer_text',
      'default' => 'Copyright 2014 Salamander | All Rights Reserved | Powered by <a href=\'http://wordpress.org\'>WordPress</a>  |  <a href=\'#\'>Salamander Theme</a>',
      'type' => 'textarea',
		);

		$this->options[] = array(
			'name' => 'Footer Widgets',
			'desc' => 'Show footer widgets',
			'id' => 'footer_widgets',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Number of Footer Columns',
			'desc' => '',
			'id' => 'footer_widgets_columns',
			'default' => '4',
			'options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4'),
			'type' => 'select',
		);

		$this->options[] = array(
			'name' => 'Display social icons on footer of the page:',
			'desc' => 'Select the checkbox to show social media icons on the footer of the page.',
			'id' => 'icons_footer',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Open social icons on footer in a new window',
			'desc' => '',
			'id' => 'icons_footer_new',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Background Options',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Layout',
			'desc' => 'Boxed or wide layout?',
			'id' => 'layout',
			'default' => 'wide',
			'type' => 'select',
			'options' => array(
				'boxed' => 'Boxed',
				'wide' => 'Wide',
			),
		);

		$this->options[] = array(
			'name' => 'Layout Type',
			'desc' => 'Fixed or fluid layout?',
			'id' => 'layout_type',
			'default' => 'fixed',
			'type' => 'select',
			'options' => array(
				'fixed' => 'Fixed',
				'fluid' => 'Fluid',
			),
		);

		$this->options[] = array(
			'name' => 'Boxed Mode Only',
			'desc' => '',
			'id' => 'boxed_mode_only',
			'default' => '<h3 style="margin: 0;">Background options below only work in boxed mode.</h3>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' => 'Background Image For Outer Areas In Boxed Mode',
			'desc' => 'Please choose an image or insert an image url to use for the backgroud.',
			'id' => 'bg_image',
			'default' => '',
			'mode' => 'mini',
			'type' => 'media',
		);

		$this->options[] = array(
			'name' => '100% Background Image',
			'desc' => 'Have background image always at 100% in width and height and scale according to the browser size.',
			'id' => 'bg_full',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Background Repeat',
			'desc' => '',
			'id' => 'bg_repeat',
			'default' => '',
			'type' => 'select',
			'options' => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));

		$this->options[] = array(
			'name' =>  'Background Color',
			'desc' => 'Pick a background color.',
			'id' => 'bg_color',
			'default' => '#d7d6d6',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' => 'Background Pattern?',
			'desc' => 'If yes, select the pattern from below:',
			'id' => 'bg_pattern_option',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Select a Background Pattern',
			'desc' => '',
			'id' => 'bg_pattern',
			'default' => 'pattern1',
			'type' => 'images',
			'options' => array(
				'pattern1' => get_bloginfo('template_directory').'/images/patterns/pattern1.png',
				'pattern2' => get_bloginfo('template_directory').'/images/patterns/pattern2.png',
				'pattern3' => get_bloginfo('template_directory').'/images/patterns/pattern3.png',
				'pattern4' => get_bloginfo('template_directory').'/images/patterns/pattern4.png',
				'pattern5' => get_bloginfo('template_directory').'/images/patterns/pattern5.png',
				'pattern6' => get_bloginfo('template_directory').'/images/patterns/pattern6.png',
				'pattern7' => get_bloginfo('template_directory').'/images/patterns/pattern7.png',
				'pattern8' => get_bloginfo('template_directory').'/images/patterns/pattern8.png',
				'pattern9' => get_bloginfo('template_directory').'/images/patterns/pattern9.png',
				'pattern10' => get_bloginfo('template_directory').'/images/patterns/pattern10.png',
			),
		);

		$this->options[] = array(
			'name' => 'Both Modes',
			'desc' => '',
			'id' => 'both_modes_only',
			'default' => '<h3 style="margin: 0;">Background Options Below Work For Boxed & Wide Mode</h3>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' => 'Background Image For Main Content Area',
			'desc' => 'Please choose an image or insert an image url to use for the main content area backgroud.',
			'id' => 'content_bg_image',
			'default' => '',
			'mode' => 'mini',
			'type' => 'media',
		);

		$this->options[] = array(
			'name' => '100% Background Image',
			'desc' => 'Have background image always at 100% in width and height and scale according to the browser size.',
			'id' => 'content_bg_full',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Background Repeat',
			'desc' => '',
			'id' => 'content_bg_repeat',
			'default' => '',
			'type' => 'select',
			'options' => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));

		$this->options[] = array(
			'name' => 'Typography Options',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Custom Nav / Headings Font',
			'desc' => '',
			'id' => 'custom_heading_font',
			'default' => '<h3 style="margin: 0;">Only for navigation menus and headings.</h3><p style="margin-bottom:0;">This will overwrite the google / standard font options if custom font files are uploaded.</p>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' => 'Custom Font .woff',
			'desc' => '',
			'id' => 'custom_font_woff',
			'default' => '',
			'type' => 'upload',
		);

		$this->options[] = array(
			'name' => 'Custom Font .ttf',
			'desc' => '',
			'id' => 'custom_font_ttf',
			'default' => '',
			'type' => 'upload',
		);

		$this->options[] = array(
			'name' => 'Custom Font .svg',
			'desc' => '',
			'id' => 'custom_font_svg',
			'default' => '',
			'type' => 'upload',
		);

		$this->options[] = array(
			'name' => 'Custom Font .eot',
			'desc' => '',
			'id' => 'custom_font_eot',
			'default' => '',
			'type' => 'upload',
		);

		$this->options[] = array(
			'name' => 'Google Fonts',
			'desc' => '',
			'id' => 'google_fonts_intro',
			'default' => '<h3 style="margin: 0;">Google Fonts</h3>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' => 'Select Body Font Family',
			'desc' => 'Select a font family for body text',
			'id' => 'google_body',
			'default' => 'PT Sans',
			'type' => 'select',
			'options' => $google_fonts);

		$this->options[] = array(
			'name' => 'Select Menu Font',
			'desc' => 'Select a font family for navigation',
			'id' => 'google_nav',
			'default' => 'Antic Slab',
			'type' => 'select',
			'options' => $google_fonts);

		$this->options[] = array(
			'name' => 'Select Headings Font',
			'desc' => 'Select a font family for headings',
			'id' => 'google_headings',
			'default' => 'Antic Slab',
			'type' => 'select',
			'options' => $google_fonts);

		$this->options[] = array(
			'name' => 'Select Footer Headings Font',
			'desc' => 'Select a font family for footer headings',
			'id' => 'google_footer_headings',
			'default' => 'Antic Slab',
			'type' => 'select',
			'options' => $google_fonts);

		$this->options[] = array(
			'name' => 'Standard Fonts',
			'desc' => '',
			'id' => 'standard_fonts_intro',
			'default' => '<h3 style="margin: 0; margin-bottom:10px;">Standards</h3>If you have a Google Font selected above, it will override the standard font.',
			'icon' => true,
			'type' => 'info',
		);

		$standard_fonts = array(
			'0' => 'Select Font',
			'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
			"'Arial Black', Gadget, sans-serif" => "'Arial Black', Gadget, sans-serif",
			"'Bookman Old Style', serif" => "'Bookman Old Style', serif",
			"'Comic Sans MS', cursive" => "'Comic Sans MS', cursive",
			"Courier, monospace" => "Courier, monospace",
			"Garamond, serif" => "Garamond, serif",
			"Georgia, serif" => "Georgia, serif",
			"Impact, Charcoal, sans-serif" => "Impact, Charcoal, sans-serif",
			"'Lucida Console', Monaco, monospace" => "'Lucida Console', Monaco, monospace",
			"'Lucida Sans Unicode', 'Lucida Grande', sans-serif" => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
			"'MS Sans Serif', Geneva, sans-serif" => "'MS Sans Serif', Geneva, sans-serif",
			"'MS Serif', 'New York', sans-serif" => "'MS Serif', 'New York', sans-serif",
			"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
			"Tahoma, Geneva, sans-serif" => "Tahoma, Geneva, sans-serif",
			"'Times New Roman', Times, serif" => "'Times New Roman', Times, serif",
			"'Trebuchet MS', Helvetica, sans-serif" => "'Trebuchet MS', Helvetica, sans-serif",
			"Verdana, Geneva, sans-serif" => "Verdana, Geneva, sans-serif"
		);

		$this->options[] = array(
			'name' => 'Select Body Font Family',
			'desc' => 'Select a font family for body text',
			'id' => 'standard_body',
			'default' => '',
			'type' => 'select',
			'options' => $standard_fonts);

		$this->options[] = array(
			'name' => 'Select Menu Font Family',
			'desc' => 'Select a font family for menu / navigation',
			'id' => 'standard_nav',
			'default' => '',
			'type' => 'select',
			'options' => $standard_fonts);

		$this->options[] = array(
			'name' => 'Select Headings Font Family',
			'desc' => 'Select a font family for headings',
			'id' => 'standard_headings',
			'default' => '',
			'type' => 'select',
			'options' => $standard_fonts);

		$this->options[] = array(
			'name' => 'Select Footer Headings Font Family',
			'desc' => 'Select a font family for footer headings',
			'id' => 'standard_footer_headings',
			'default' => '',
			'type' => 'select',
			'options' => $standard_fonts);

		$this->options[] = array(
			'name' => 'Standard Fonts',
			'desc' => '',
			'id' => 'font_size_intro',
			'default' => '<h3 style="margin: 0;">Font Sizes</h3>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' => 'Body Font Size (px)',
			'desc' => 'Default is 13',
			'id' => 'body_font_size',
			'default' => '13',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Top Nav Font Size (px)',
			'desc' => 'Default is 14',
			'id' => 'nav_font_size',
			'default' => '14',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Secondary Nav & Top Contact Info Font Size (px)',
			'desc' => 'Default is 12',
			'id' => 'snav_font_size',
			'default' => '12',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Side Nav Font Size (px)',
			'desc' => 'Default is 14',
			'id' => 'side_nav_font_size',
			'default' => '14',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Breadcrumbs Font Size (px)',
			'desc' => 'Default is 10',
			'id' => 'breadcrumbs_font_size',
			'default' => '10',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Sidebar Widget Title Font Size (px)',
			'desc' => 'Default is 13',
			'id' => 'sidew_font_size',
			'default' => '13',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Footer Widget Title Font Size (px)',
			'desc' => 'Default is 13',
			'id' => 'footw_font_size',
			'default' => '13',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Copyright Font Size (px)',
			'desc' => 'Default is 12',
			'id' => 'copyright_font_size',
			'default' => '12',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Heading Font Size H1 (px)',
			'desc' => 'Default is 32',
			'id' => 'h1_font_size',
			'default' => '32',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Heading Font Size H2 (px)',
			'desc' => 'Default is 18',
			'id' => 'h2_font_size',
			'default' => '18',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Heading Font Size H3 (px)',
			'desc' => 'Default is 16',
			'id' => 'h3_font_size',
			'default' => '16',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Heading Font Size H4 (px)',
			'desc' => 'Default is 13',
			'id' => 'h4_font_size',
			'default' => '13',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Heading Font Size H5 (px)',
			'desc' => 'Default is 12',
			'id' => 'h5_font_size',
			'default' => '12',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Heading Font Size H6 (px)',
			'desc' => 'Default is 11',
			'id' => 'h6_font_size',
			'default' => '11',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' =>  'Header Tagline Font Size',
			'desc' => 'Default is 16',
			'id' => 'tagline_font_size',
			'default' => '16',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' =>  'Page Title Font Size',
			'desc' => 'Default is 18',
			'id' => 'page_title_font_size',
			'default' => '18',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Custom Nav / Headings Font',
			'desc' => '',
			'id' => 'custom_heading_font',
			'default' => '<h3 style="margin: 0;">Font Line Heights</h3>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' => 'Body Font Line Height (px)',
			'desc' => 'Default is 20',
			'id' => 'body_font_lh',
			'default' => '20',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Heading Font Line Height H1 (px)',
			'desc' => 'Default is 48',
			'id' => 'h1_font_lh',
			'default' => '48',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Heading Font Line Height H2 (px)',
			'desc' => 'Default is 27',
			'id' => 'h2_font_lh',
			'default' => '27',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Heading Font Line Height H3 (px)',
			'desc' => 'Default is 24',
			'id' => 'h3_font_lh',
			'default' => '24',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Heading Font Line Height H4 (px)',
			'desc' => 'Default is 20',
			'id' => 'h4_font_lh',
			'default' => '20',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Heading Font Line Height H5 (px)',
			'desc' => 'Default is 18',
			'id' => 'h5_font_lh',
			'default' => '18',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Heading Font Line Height H6 (px)',
			'desc' => 'Default is 17',
			'id' => 'h6_font_lh',
			'default' => '17',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Styling Options',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Choose Theme Skin',
			'desc' => '',
			'id' => 'scheme_type',
			'default' => 'Light',
			'type' => 'select',
			'options' => array('light' => 'Light', 'dark' => 'Dark'));

		$this->options[] = array(
			'name' => 'Predefined Color Scheme',
			'desc' => '',
			'id' => 'color_scheme',
			'default' => 'Green',
			'type' => 'select',
			'options' => array('red' => 'Red', 'lighred' => 'Light Red', 'blue' => 'Blue', 'lightblue' => 'Light Blue', 'green' => 'Green', 'darkgreen' => 'Dark Green', 'orange' => 'Orange', 'pink' => 'Pink', 'brown' => 'Brown', 'lightgrey' => 'Light Grey'));

		$this->options[] = array(
			'name' => 'Custom Color Scheme',
			'desc' => '',
			'id' => 'custom_color_scheme_bg',
			'default' => '<h3 style="margin: 0;">Background Colors</h3>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' =>  'Primary Color',
			'desc' => '',
			'id' => 'primary_color',
			'default' => '#a0ce4e',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Header Background Color',
			'desc' => '',
			'id' => 'header_bg_color',
			'default' => '#ffffff',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' => 'Header Border Color',
			'desc' => '',
			'id' => 'header_border_color',
			'default' => '#e1e1e1',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Header Top Background Color',
			'desc' => '',
			'id' => 'header_top_bg_color',
			'default' => '#a0ce4e',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Content Background Color',
			'desc' => '',
			'id' => 'content_bg_color',
			'default' => '#ffffff',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Footer Background Color',
			'desc' => '',
			'id' => 'footer_bg_color',
			'default' => '#363839',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Footer Border Color',
			'desc' => '',
			'id' => 'footer_border_color',
			'default' => '#e9eaee',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Copyright Border Color',
			'desc' => '',
			'id' => 'copyright_border_color',
			'default' => '#4b4c4d',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Copyright Background Color',
			'desc' => '',
			'id' => 'copyright_bg_color',
			'default' => '#282a2b',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' => 'Custom Color Scheme',
			'desc' => '',
			'id' => 'custom_color_scheme_element',
			'default' => '<h3 style="margin: 0;">Element Colors</h3>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' =>  'Rollover Image Gradient Top Color',
			'desc' => '',
			'id' => 'image_gradient_top_color',
			'default' => '#D1E990',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Rollover Image Gradient Bottom Color',
			'desc' => '',
			'id' => 'image_gradient_bottom_color',
			'default' => '#AAD75B',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Button Gradient Top Color',
			'desc' => '',
			'id' => 'button_gradient_top_color',
			'default' => '#D1E990',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Button Gradient Bottom Color',
			'desc' => '',
			'id' => 'button_gradient_bottom_color',
			'default' => '#AAD75B',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Form Background Color',
			'desc' => '',
			'id' => 'form_bg_color',
			'default' => '#ffffff',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Form Text Color',
			'desc' => '',
			'id' => 'form_text_color',
			'default' => '#aaa9a9',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Form Border Color',
			'desc' => '',
			'id' => 'form_border_color',
			'default' => '#d2d2d2',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Blog Grid & Timeline Element Colors',
			'desc' => 'Controls blog grid & timeline post box border, divider lines, date box and border, timeline dots, timeline icon, timeline arrow.',
			'id' => 'timeline_color',
			'default' => '#f6f6f6',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' => 'Social Share Box Icons Color Scheme',
			'desc' => '',
			'id' => 'socialbox_icons_color',
			'default' => 'Dark',
			'type' => 'select',
			'options' => array('light' => 'Light', 'dark' => 'Dark'));

		$this->options[] = array(
			'name' => 'Header Social Icons Color Scheme',
			'desc' => '',
			'id' => 'header_icons_color',
			'default' => 'Light',
			'type' => 'select',
			'options' => array('light' => 'Light', 'dark' => 'Dark'));

		$this->options[] = array(
			'name' => 'Disable Button Text Shadow',
			'desc' => 'Check to disable button text shadow',
			'id' => 'button_text_shadow',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Disable Footer Text Shadow',
			'desc' => 'Check to disable footer text shadow',
			'id' => 'footer_text_shadow',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Custom Color Scheme',
			'desc' => '',
			'id' => 'custom_color_scheme_font',
			'default' => '<h3 style="margin: 0;">Font Colors</h3>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' =>  'Button Text Color',
			'desc' => '',
			'id' => 'button_gradient_text_color',
			'default' => '#54770f',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Header Tagline Font Color',
			'desc' => '',
			'id' => 'tagline_font_color',
			'default' => '#747474',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Page Title Font Color',
			'desc' => '',
			'id' => 'page_title_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Heading 1 (H1) Font Color',
			'desc' => '',
			'id' => 'h1_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Heading 2 (H2) Font Color',
			'desc' => '',
			'id' => 'h2_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Heading 3 (H3) Font Color',
			'desc' => '',
			'id' => 'h3_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Heading 4 (H4) Font Color',
			'desc' => '',
			'id' => 'h4_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Heading 5 (H5) Font Color',
			'desc' => '',
			'id' => 'h5_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Heading 6 (H6) Font Color',
			'desc' => '',
			'id' => 'h6_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Body Text Color',
			'desc' => '',
			'id' => 'body_text_color',
			'default' => '#747474',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Link Color',
			'desc' => '',
			'id' => 'link_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Breadcrumbs Text Color',
			'desc' => '',
			'id' => 'breadcrumbs_text_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Footer Headings Color',
			'desc' => '',
			'id' => 'footer_headings_color',
			'default' => '#DDDDDD',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Footer Font Color',
			'desc' => '',
			'id' => 'footer_text_color',
			'default' => '#8C8989',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Footer Link Color',
			'desc' => '',
			'id' => 'footer_link_color',
			'default' => '#BFBFBF',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' => 'Menu Colors',
			'desc' => '',
			'id' => 'menu_colors_intro',
			'default' => '<h3 style="margin: 0;">Menu Colors</h3>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' =>  'Menu Font Color - First Level',
			'desc' => '',
			'id' => 'menu_first_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Menu Background Color - Sublevels',
			'desc' => '',
			'id' => 'menu_sub_bg_color',
			'default' => '#edebeb',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Menu Font Color - Sublevels',
			'desc' => '',
			'id' => 'menu_sub_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Menu Hover Background Color - Sublevels',
			'desc' => '',
			'id' => 'menu_bg_hover_color',
			'default' => '#f5f4f4',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Menu Separator - Sublevels',
			'desc' => '',
			'id' => 'menu_sub_sep_color',
			'default' => '#dcdadb',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Secondary Menu - First Level & Top Contact Info Color',
			'desc' => '',
			'id' => 'snav_color',
			'default' => '#747474',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Header Top Menu Divider Color - First Level',
			'desc' => '',
			'id' => 'header_top_first_border_color',
			'default' => '#ffffff',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Header Top Menu Background Color - Sublevels',
			'desc' => '',
			'id' => 'header_top_sub_bg_color',
			'default' => '#ffffff',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Header Top Menu Font Color - Sublevels',
			'desc' => '',
			'id' => 'header_top_menu_sub_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Header Top Menu Hover Background Color - Sublevels',
			'desc' => '',
			'id' => 'header_top_menu_bg_hover_color',
			'default' => '#fafafa',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Header Top Menu Hover Font Color - Sublevels',
			'desc' => '',
			'id' => 'header_top_menu_sub_hover_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Header Top Menu Border  - Sublevels',
			'desc' => '',
			'id' => 'header_top_menu_sub_sep_color',
			'default' => '#e0dfdf',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' => 'Shortcodes Styling Options',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' =>  'Accordion Inactive Box Color',
			'desc' => 'Controls color of the inactive boxes behind the '+' icons.',
			'id' => 'accordian_inactive_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Animated Filled Color',
			'desc' => '',
			'id' => 'counter_filled_color',
			'default' => '#a0ce4e',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Animated Unfilled Color',
			'desc' => '',
			'id' => 'counter_unfilled_color',
			'default' => '#f6f6f6',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Arrow Color',
			'desc' => 'Controls color of '>'.',
			'id' => 'arrow_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Blog Alternate Date & Date-on-side Recent News Date Box Color',
			'desc' => 'Controls color of the box behind the icon.',
			'id' => 'dates_box_color',
			'default' => '#eef0f2',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Carousel Default Nav Box Color',
			'desc' => '',
			'id' => 'carousel_nav_color',
			'default' => '#999999',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Carousel Hover Nav Box Color',
			'desc' => '',
			'id' => 'carousel_hover_color',
			'default' => '#808080',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Content Box Background Color',
			'desc' => 'Only change color for the \'icon-boxed\' style. Leave transparent for other styles.',
			'id' => 'content_box_bg_color',
			'default' => 'transparent',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' => 'Checklist Icon Color',
			'desc' => '',
			'id' => 'checklist_icons_color',
			'default' => 'Light',
			'type' => 'select',
			'options' => array('light' => 'Light', 'dark' => 'Dark'));

		$this->options[] = array(
			'name' =>  'Double Border Title Separator Color',
			'desc' => 'Controls color of double lines next to text titles.',
			'id' => 'title_border_color',
			'default' => '#e0dede',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Icon Circle Color',
			'desc' => '',
			'id' => 'icon_circle_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Icon Circle Border Color',
			'desc' => '',
			'id' => 'icon_border_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Icon Color',
			'desc' => '',
			'id' => 'icon_color',
			'default' => '#ffffff',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Imageframe Border Color',
			'desc' => '',
			'id' => 'imgframe_border_color',
			'default' => '#f6f6f6',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Imageframe Style Color',
			'desc' => 'Only works for glow and dropshadow style.',
			'id' => 'imgframe_style_color',
			'default' => '#000000',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Pricing Box Color',
			'desc' => 'Controls the color portions of pricing boxes.',
			'id' => 'pricing_box_color',
			'default' => '#a0ce4e',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Pricing Box Bg Color',
			'desc' => 'Controls the color of main background and title background.',
			'id' => 'pricing_bg_color',
			'default' => '#ffffff',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Pricing Box Border Color',
			'desc' => 'Controls outer border and pricing row and footer row backgrounds.',
			'id' => 'pricing_border_color',
			'default' => '#f8f8f8',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Pricing Box Divider Color',
			'desc' => 'Controls dividers inbetween pricing rows.',
			'id' => 'pricing_divider_color',
			'default' => '#ededed',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Separators Color',
			'desc' => 'This option controls all separators,  divider lines and borders for meta, previous & next,  filters, category page, boxes around number pagination,  sidebar widgets, accordion divider lines.',
			'id' => 'sep_color',
			'default' => '#e0dede',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Social Share Box Background Color',
			'desc' => '',
			'id' => 'social_bg_color',
			'default' => '#f6f6f6',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Tabs Background Color + Hover Color',
			'desc' => 'Controls active tab, content background color and tab hover color.',
			'id' => 'tabs_bg_color',
			'default' => '#ffffff',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Tabs Inactive Color',
			'desc' => 'Controls color of inactive tabs plus the outer tab border.',
			'id' => 'tabs_inactive_color',
			'default' => '#ebeaea',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' => 'Tagline Box Background Color',
			'desc' => '',
			'id' => 'tagline_bg',
			'default' => '#f6f6f6',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Tagline Box Border Color',
			'desc' => '',
			'id' => 'tagline_border_color',
			'default' => '#f6f6f6',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Testimonial Background Color',
			'desc' => '',
			'id' => 'testimonial_bg_color',
			'default' => '#f6f6f6',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Testimonial Text Color',
			'desc' => '',
			'id' => 'testimonial_text_color',
			'default' => '#747474',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' => 'Social Links Color',
			'desc' => 'Controls social icons in the social links shortcode used in page content',
			'id' => 'social_links_color',
			'default' => 'Dark',
			'type' => 'select',
			'options' => array('light' => 'Light', 'dark' => 'Dark'));

		$this->options[] = array(
			'name' => 'Blog Options',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Blog Layout',
			'desc' => '',
			'id' => 'blog_layout',
			'default' => 'Large',
			'type' => 'select',
			'options' => array(
				'large' => 'Large',
				'medium' => 'Medium',
				'large_alternate' => 'Large Alternate',
				'medium_alternate' => 'Medium Alternate',
				'grid' => 'Grid',
				'timeline' => 'Timeline'
			)
		);

		$this->options[] = array(
			'name' => 'Pagination Type',
			'desc' => '',
			'id' => 'blog_pagination_type',
			'default' => 'pagination',
			'type' => 'select',
			'options' => array(
				'pagination' => 'Pagination',
				'infinite' => 'Infinite Scroll',
			)
		);

		$this->options[] = array(
			'name' => 'Blog Page Title Bar Title',
			'desc' => '',
			'id' => 'blog_title',
			'default' => 'Blog',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Full Width',
			'desc' => 'Turn the blog into full width.',
			'id' => 'blog_full_width',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Sidebar Position',
			'desc' => 'Blog listings page sidebar position',
			'id' => 'blog_sidebar_position',
			'default' => 'right',
			'type' => 'select',
			'options' => array(
				'right' => __('Right', 'salamander'),
				'left' => __('Left', 'salamander'),
				'both' => __('Two sidebars', 'salamander'),
			)
		);

		$this->options[] = array(
			'name' => 'Disable Previous/Next Pagination',
			'desc' => 'Check to disable previous/next pagination',
			'id' => 'blog_pn_nav',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Featured Image On Blog Archive Page',
			'desc' => 'Show featured images on blog archive page',
			'id' => 'featured_images',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Featured Image on Single Post Page',
			'desc' => 'Show featured images on single post pages.',
			'id' => 'featured_images_single',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Post Title',
			'desc' => 'Show the post title that goes below the featured images.',
			'id' => 'blog_post_title',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Author Info Box',
			'desc' => 'Show the author info box below posts.',
			'id' => 'author_info',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Social Sharing Box',
			'desc' => 'Show the social sharing box.',
			'id' => 'social_sharing_box',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Related Posts',
			'desc' => 'Show related posts.',
			'id' => 'related_posts',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Comments',
			'desc' => 'Show comments.',
			'id' => 'blog_comments',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Date Format',
			'desc' => '<a href=\'http://codex.wordpress.org/Formatting_Date_and_Time\'>Formatting Date and Time</a>',
			'id' => 'date_format',
			'default' => 'F jS, Y',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Post Meta',
			'desc' => 'Show post meta on blog posts.',
			'id' => 'post_meta',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Disable Post Meta Author',
			'desc' => 'Check to hide author name from post meta.',
			'id' => 'post_meta_author',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Disable Post Meta Date',
			'desc' => 'Check to hide date from post meta.',
			'id' => 'post_meta_date',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Disable Post Meta Categories',
			'desc' => 'Check to hide categories from post meta.',
			'id' => 'post_meta_cats',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Disable Post Meta Comments',
			'desc' => 'Check to hide comments from post meta.',
			'id' => 'post_meta_comments',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Disable Post Meta Read More Link',
			'desc' => 'Check to hide read more link from post meta.',
			'id' => 'post_meta_read',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Excerpt or Full Blog Content',
			'desc' => 'Show excerpt or full blog content on archive / blog pages',
			'id' => 'content_length',
			'default' => 'Excerpt',
			'type' => 'select',
			'options' => array('excerpt' => 'Excerpt', 'full' => 'Full Content'));

		$this->options[] = array(
			'name' => 'Excerpt Length',
			'desc' => 'Input the number of words you want to cut from the content to be the excerpt of search and archive page.',
			'id' => 'excerpt_length_blog',
			'default' => '285',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Strip HTML from Excerpt',
			'desc' => 'Check this if you want to strip HTML from the excerpt content only.',
			'id' => 'strip_html_excerpt',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Portfolio Options',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Number of Portfolio Items',
			'desc' => '',
			'id' => 'portfolio_items',
			'default' => '10',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Excerpt Length',
			'desc' => 'Input the number of words you want to cut from the content to be the excerpt of the 1 column portfolio page.',
			'id' => 'excerpt_length_portfolio',
			'default' => '285',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Portfolio Slug',
			'desc' => 'Change/Rewrite the permalink when you use the permalink type as %postname%.<strong>Make sure to regenerate permalinks.</strong>',
			'id' => 'portfolio_slug',
			'default' => 'portfolio-items',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Disable Previous/Next Pagination',
			'desc' => 'Check to disable previous/next pagination',
			'id' => 'portfolio_pn_nav',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Social Sharing Box',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Facebook',
			'desc' => 'Show the facebook sharing option in blog posts.',
			'id' => 'sharing_facebook',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Twitter',
			'desc' => 'Show the twitter sharing option in blog posts.',
			'id' => 'sharing_twitter',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Reddit',
			'desc' => 'Show the reddit sharing option in blog posts.',
			'id' => 'sharing_reddit',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'LinkedIn',
			'desc' => 'Show the linkedin sharing option in blog posts.',
			'id' => 'sharing_linkedin',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Google Plus',
			'desc' => 'Show the g+ sharing option in blog posts.',
			'id' => 'sharing_google',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Tumblr',
			'desc' => 'Show the tumblr sharing option in blog posts.',
			'id' => 'sharing_tumblr',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Pinterest',
			'desc' => 'Show the pinterest sharing option in blog posts.',
			'id' => 'sharing_pinterest',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Email',
			'desc' => 'Show the email sharing option in blog posts.',
			'id' => 'sharing_email',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Social Sharing Links',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Facebook',
			'desc' => 'Place the link you want and facebook icon will appear. To remove it, just leave it blank.',
			'id' => 'facebook_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Flickr',
			'desc' => 'Place the link you want and flickr icon will appear. To remove it, just leave it blank.',
			'id' => 'flickr_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'RSS',
			'desc' => 'Place the link you want and rss icon will appear. To remove it, just leave it blank.',
			'id' => 'rss_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Twitter',
			'desc' => 'Place the link you want and twitter icon will appear. To remove it, just leave it blank.',
			'id' => 'twitter_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Vimeo',
			'desc' => 'Place the link you want and vimeo icon will appear. To remove it, just leave it blank.',
			'id' => 'vimeo_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Youtube',
			'desc' => 'Place the link you want and youtube icon will appear. To remove it, just leave it blank.',
			'id' => 'youtube_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Pinterest',
			'desc' => 'Place the link you want and pinterest icon will appear. To remove it, just leave it blank.',
			'id' => 'pinterest_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Tumblr',
			'desc' => 'Place the link you want and tumblr icon will appear. To remove it, just leave it blank.',
			'id' => 'tumblr_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Google Plus',
			'desc' => 'Place the link you want and g+ icon will appear. To remove it, just leave it blank.',
			'id' => 'google_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Dribbble',
			'desc' => 'Place the link you want and dribbble icon will appear. To remove it, just leave it blank.',
			'id' => 'dribbble_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Digg',
			'desc' => 'Place the link you want and digg icon will appear. To remove it, just leave it blank.',
			'id' => 'digg_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'LinkedIn',
			'desc' => 'Place the link you want and linkedin icon will appear. To remove it, just leave it blank.',
			'id' => 'linkedin_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Blogger',
			'desc' => 'Place the link you want and blogger icon will appear. To remove it, just leave it blank.',
			'id' => 'blogger_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Skype',
			'desc' => 'Place the link you want and skype icon will appear. To remove it, just leave it blank.',
			'id' => 'skype_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Forrst',
			'desc' => 'Place the link you want and forrst icon will appear. To remove it, just leave it blank.',
			'id' => 'forrst_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Myspace',
			'desc' => 'Place the link you want and myspace icon will appear. To remove it, just leave it blank.',
			'id' => 'myspace_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Deviantart',
			'desc' => 'Place the link you want and deviantart icon will appear. To remove it, just leave it blank.',
			'id' => 'deviantart_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Yahoo',
			'desc' => 'Place the link you want and yahoo icon will appear. To remove it, just leave it blank.',
			'id' => 'yahoo_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Reddit',
			'desc' => 'Place the link you want and reddit icon will appear. To remove it, just leave it blank.',
			'id' => 'reddit_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Custom Icon Name',
			'desc' => '',
			'id' => 'custom_icon_name',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Custom Icon Image',
			'desc' => '',
			'id' => 'custom_icon_image',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Custom Icon Image Retina',
			'desc' => '',
			'id' => 'custom_icon_image_retina',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Custom Icon Link',
			'desc' => '',
			'id' => 'custom_icon_link',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Slideshows',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Legacy Posts Slideshow',
			'desc' => 'Check to enable posts slideshow in legacy mode.',
			'id' => 'legacy_posts_slideshow',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Posts Slideshow',
			'desc' => 'Show posts slideshow in post/portfolio pages.',
			'id' => 'posts_slideshow',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Posts Slideshow Images',
			'desc' => 'Number of images in posts/portfolio slideshow',
			'id' => 'posts_slideshow_number',
			'default' => '5',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Autoplay',
			'desc' => 'Autoplay the slideshow',
			'id' => 'slideshow_autoplay',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Number of FlexSlider Slides',
			'desc' => 'Number of flexslider slides per group',
			'id' => 'flexslider_number',
			'default' => '5',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Pagination circles below video slides',
			'desc' => 'Please check this box if you want to show pagination circles for slider below a video slider or uncheck it to hide them on video slides.',
			'id' => 'pagination_video_slide',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'ThemeFusion Slider',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Width',
			'desc' => 'In pixels or percentage, e.g.: 100% or 100px',
			'id' => 'flexslider_width',
			'default' => '100%',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Pagination',
			'desc' => 'Turn on pagination circles',
			'id' => 'flexslider_circles',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Animation',
			'desc' => 'The animation the slides will have when rotating',
			'id' => 'tfs_animation',
			'default' => 'fade',
			'options' => array('fade' => 'fade', 'slide' => 'slide'),
			'type' => 'select',
		);

		$this->options[] = array(
			'name' => 'Autoplay',
			'desc' => 'Autoplay the slides',
			'id' => 'tfs_autoplay',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Slideshow Speed',
			'desc' => 'Select the slideshow speed, 1000 = 1 second',
			'id' => 'tfs_slideshow_speed',
			'default' => '7000',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Animation speed',
			'desc' => 'Select the animation speed, 1000 = 1 second',
			'id' => 'tfs_animation_speed',
			'default' => '600',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Number of ThemeFusion Sliders',
			'desc' => 'Select the number of slider sets',
			'id' => 'flexsliders_number',
			'default' => '1',
			'type' => 'text',
		);

	$i = 1;
	if (isset($this->optionsMachine['flexsliders_number']))
	{
		while($i <= $this->optionsMachine['flexsliders_number'])
		{
			$this->options[] = array(
				'name' => 'TFSlider'.$i,
				'desc' => '',
				'id' => 'flexslider_'.$i,
				'default' => '',
				'type' => 'slider',
			);
		$i++;
		}
	}

		$this->options[] = array(
			'name' => 'Elastic Slider',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Slider Width',
			'desc' => 'in pixels or percentage, e.g.: 100% or 100',
			'id' => 'tfes_slider_width',
			'default' => '100%',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Slider Height',
			'desc' => 'in pixels, e.g.: 100px',
			'id' => 'tfes_slider_height',
			'default' => '400px',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Animation',
			'desc' => 'New slides animating from sides or center',
			'id' => 'tfes_animation',
			'default' => 'sides',
			'options' => array('sides' => 'sides', 'center' => 'center'),
			'type' => 'select',
		);

		$this->options[] = array(
			'name' => 'Autoplay',
			'desc' => 'Autoplay the slides',
			'id' => 'tfes_autoplay',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Slideshow Interval',
			'desc' => 'Select the slideshow speed, 1000 = 1 second',
			'id' => 'tfes_interval',
			'default' => '3000',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Sliding Speed',
			'desc' => 'Select the animation speed, 1000 = 1 second',
			'id' => 'tfes_speed',
			'default' => '800',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Thumbnail Width',
			'desc' => 'Please enter the width for thumbnail without \'px\' e.g 100',
			'id' => 'tfes_width',
			'default' => '150',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Title Font Size (px)',
			'desc' => 'Default is 42',
			'id' => 'es_title_font_size',
			'default' => '42',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' => 'Caption Font Size (px)',
			'desc' => 'Default is 20',
			'id' => 'es_caption_font_size',
			'default' => '20',
			'type' => 'select',
			'options' => $font_sizes);

		$this->options[] = array(
			'name' =>  'Title Color',
			'desc' => '',
			'id' => 'es_title_color',
			'default' => '#333333',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' =>  'Caption Color',
			'desc' => '',
			'id' => 'es_caption_color',
			'default' => '#747474',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' => 'Lightbox Options',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Animation Speed',
			'desc' => 'Set speed of animation',
			'id' => 'lightbox_animation_speed',
			'default' => 'fast',
			'type' => 'select',
			'options' => array(
				'fast' => 'Fast',
				'slow' => 'Slow',
				'normal' => 'Normal'
			)
		);

		$this->options[] = array(
			'name' => 'Show gallery',
			'desc' => 'Show gallery',
			'id' => 'lightbox_gallery',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Autoplay the Lightbox Gallery',
			'desc' => 'Autoplay the lightbox gallery',
			'id' => 'lightbox_autoplay',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Slideshow Speed',
			'desc' => 'If autoplay is enabled, set the slideshow speed 1000 = 1 second',
			'id' => 'lightbox_slideshow_speed',
			'default' => '5000',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Background Opacity',
			'desc' => 'Set the opacity of background, 1 = 100%',
			'id' => 'lightbox_opacity',
			'default' => '0.8',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Show Caption',
			'desc' => 'Show the image caption',
			'id' => 'lightbox_title',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Show Description',
			'desc' => 'Show the image description',
			'id' => 'lightbox_desc',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Social Sharing',
			'desc' => 'Show social sharing buttons on lightbox',
			'id' => 'lightbox_social',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Show Post Images in Lightbox',
			'desc' => 'Show post images between post content in the lightbox',
			'id' => 'lightbox_post_images',
			'default' => 0,
			'type' => 'checkbox',
		);

// Theme Specific Options
		$this->options[] = array(
			'name' => 'Contact Options',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Google Map Type',
			'desc' => 'Select the type of map to show on google map',
			'id' => 'gmap_type',
			'default' => 'roadmap',
			'options' => array('roadmap' => 'roadmap', 'satellite' => 'satellite', 'hybrid' => 'hybrid', 'terrain' => 'terrain'),
			'type' => 'select',
		);

		$this->options[] = array(
			'name' => 'Google Map Width',
			'desc' => '(in pixels or percentage, e.g.:100% or 100px)',
			'id' => 'gmap_width',
			'default' => '100%',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Google Map Height',
			'desc' => '(in pixels, e.g.: 100px)',
			'id' => 'gmap_height',
			'default' => '415px',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Google Map Address',
			'desc' => 'Example: 775 New York Ave, Brooklyn, Kings, New York 11203. For multiple markers, simply separate the addresses with the |  symbol.',
			'id' => 'gmap_address',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Email Address',
			'desc' => '',
			'id' => 'email_address',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Map Zoom Level',
			'desc' => 'Higher number will be more zoomed in',
			'id' => 'map_zoom_level',
			'default' => '8',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Disable Map Scrollwheel',
			'desc' => 'Check to disable scrollwheel on google maps',
			'id' => 'map_scrollwheel',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Disable Map Scale',
			'desc' => 'Check to disable scale on google maps',
			'id' => 'map_scale',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Disable Map Zoom & Pan Control Icons',
			'desc' => 'Check to disable zoom control icon and pan control icon on google maps',
			'id' => 'map_zoomcontrol',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Recaptcha Public Key',
			'desc' => 'Follow the steps in our docs to get your key',
			'id' => 'recaptcha_public',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Recaptcha Private Key',
			'desc' => 'Follow the steps in our docs to get your key',
			'id' => 'recaptcha_private',
			'default' => '',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Sidebar Options',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' =>  'Sidebar Background Color',
			'desc' => '',
			'id' => 'sidebar_bg_color',
			'default' => '#ffffff',
			'type' => 'color',
		);

		$this->options[] = array(
			'name' => 'Content Area Width',
			'desc' => 'Please enter a value (based on percentage) without % sign',
			'id' => 'content_width',
			'default' => '71.1702128',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Sidebar Width',
			'desc' => 'Please enter a value (based on percentage) without % sign',
			'id' => 'sidebar_width',
			'default' => '23.4042553',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Sidebar Padding',
			'desc' => 'Please enter a value (based on percentage) without % sign',
			'id' => 'sidebar_padding',
			'default' => '0',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Sidebar Info',
			'desc' => '',
			'id' => 'sidebar_info',
			'default' => '<h3 style="margin-top:0;">Important Notes & Instructions:</h3><b>1.  100% </b>- Your values added up cannot go over 100% or your sidebar will not show.<br /></br />
<b>2. PADDING </b>-  Is always multiplied by 2 because it adds left and right padding. So a padding value of 5, actually equals 10.  And you should only use padding if you are using a background color that is different than your main background color.<br /></br />

<b>3.  UNSEEN SPACE</b> - You need to factor in the space between the Content Width &amp; Sidebar Width. This space does not have a field.<br /></br />

<b>EXAMPLE 1:</b> Content Width = 65 + Sidebar Width = 30  + Padding = 0
* this example adds up to 95% which leaves you 5% in between the content and sidebar sections. This is good to use if your sidebar background is the same color as your main background<br /></br />

<b>EXAMPLE 2:</b> Content Width = 60 + Sidebar Width = 30  + Padding = 2.5
* this example adds up to 95% which leaves you 5% in between the content and sidebar sections. This is good to use if your sidebar background is a different color than your main background',
			'icon' => true,
			'type' => 'info',
		);

// Theme Specific Options
		$this->options[] = array(
			'name' => 'Extra Options',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Testimonials Speed',
			'desc' => 'Select the slideshow speed, 1000 = 1 second',
			'id' => 'testimonials_speed',
			'default' => '4000',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Image Rollover',
			'desc' => 'Show rollover box on images',
			'id' => 'image_rollover',
			'default' => 1,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Image Rollover Opacity',
			'desc' => 'From 0.1 to 1',
			'id' => 'image_rollover_opacity',
			'default' => '1',
			'type' => 'text',
		);

		$this->options[] = array(
			'name' => 'Sidenav Behavior',
			'desc' => 'Sidenav slidedown / slideup animation on click or hover',
			'id' => 'sidenav_behavior',
			'default' => 'hover',
			'options' => array('hover' => 'Hover', 'click' => 'Click'),
			'type' => 'select',
		);

		$this->options[] = array(
			'name' => 'Search Results Content',
			'desc' => 'Select the type of content to display in search results',
			'id' => 'search_content',
			'default' => 'Posts and Pages',
			'type' => 'select',
			'options' => array('posts_pages' => 'Posts and Pages', 'posts' => 'Only Posts', 'pages' => 'Only Pages'));

		$this->options[] = array(
			'name' => 'Hide Search Results Excerpt',
			'desc' => 'Check this if you want to hide excerpt for search results.',
			'id' => 'search_excerpt',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Hide Featured Images from Search Results',
			'desc' => 'Check this if you want to hide featured images for search results.',
			'id' => 'search_featured_images',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Plugins',
			'desc' => '',
			'id' => 'plugins_only',
			'default' => '<h3 style="margin: 0;">Enable or Disable Support For Plugins Installed Manually</h3>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' => 'UberMenu Plugin Support',
			'desc' => 'If you are using UberMenu, check this option to add ubermenu support without editing any code.',
			'id' => 'ubermenu',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Plugins',
			'desc' => '',
			'id' => 'plugins_only',
			'default' => '<h3 style="margin: 0;">Enable or Disable Plugins Integrated Within The Theme</h3>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' => 'Enable posts type order plugin',
			'desc' => 'Check to enable post type order plugin. Disabled by default. Note: It can break the order of next post/previous post links.',
			'id' => 'post_type_order',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Disable LayerSlider',
			'desc' => 'Check to disable LayerSlider',
			'id' => 'status_layerslider',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Disable RevSlider',
			'desc' => 'Check to disable Revolution Slider',
			'id' => 'status_revslider',
			'default' => 0,
			'type' => 'checkbox',
		);

		$this->options[] = array(
			'name' => 'Disable FlexSlider',
			'desc' => 'Check to disable Flexslider',
			'id' => 'status_flexslider',
			'default' => 0,
			'type' => 'checkbox',
		);

		// Backup Options
		$this->options[] = array(
			'name' => 'Custom CSS',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Advanced CSS Customizations',
			'desc' => '',
			'id' => 'advanced_css_intro',
			'default' => '<h3 style="margin: 0;">Advanced CSS Customizations</h3><p style="margin-bottom:0;">Paste your css code. Do not include <stlye></stlye> tags or any html tag in this field.</p>',
			'icon' => true,
			'type' => 'info',
		);

		$this->options[] = array(
			'name' => 'CSS Code',
	    'desc' => 'Any custom CSS from the user should go in this field, it will override the theme CSS',
	    'id' => 'custom_css',
	    'default' => '',
	    'type' => 'textarea',
	  );

		// Backup Options
		$this->options[] = array(
			'name' => 'Backup Options',
			'type' => 'head_zone',
		);

		$this->options[] = array(
			'name' => 'Backup and Restore Options',
      'id' => 'of_backup',
      'default' => '',
      'type' => 'backup',
			'desc' => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
		);

		$this->options[] = array(
			'name' => 'Transfer Theme Options Data',
      'id' => 'of_transfer',
      'default' => '',
      'type' => 'transfer',
			'desc' => 'You can transfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click \'Import Options\'.',
		);
	}
}




