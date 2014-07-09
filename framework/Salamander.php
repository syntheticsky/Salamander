<?php

/**
 * Main theme framework class
 */

class Salamander
{
	public $post;
	public $currentPageID;
	public $init;
	public $multiSidebars;
	public $metaBoxes;
	public $shortCodes;

	private static $instance;
	private static $data;
	private static $helper;

	private function __construct()
	{
		global $post;
		$this->post = $post;
		//SalamanderInit class defined in framwork folder
    $this->init = SalamanderInit::getInstance();
    //Set current page ID
    $this->currentPageID = $this->getCurrentPageId();
    //Init multipleSidebars
    //Register Custom Sidebars (widget zones)
    $this->multiSidebars = MultipleSidebars::getInstance();
    //Add metaboxes to posts and pages
    $this->metaBoxes = new Metaboxes();
    //Init Shortcodes
    $this->shortCodes = new ShortCodes();
    //Initialze Helper
    self::$helper = Helper::getInstance();
	}

	public static function __callStatic($method, $args)
	{
		if ($args && $args[0] == 'data')
		{
			$delimiter = '';
			switch ($method) {
				case 'layout_type':
					return (self::getData($method) == 'fluid') ? '-fluid': '';
					break;
				case 'classes':
					if ($args[1] == 'layout_type')
					{
						return (self::getData($args[1]) == 'fluid') ? $args[2] . '-fluid': $args[2];
					}
					if ($args[1] == 'blog_sidebar_position')
					{
						if ($args[2] == 'sidebar')
						{
							$cols = 'col-xs-3 col-sm-3 col-md-3 col-lg-3';
						}
						if (self::getData($args[1]) == 'both' && $args[2] == 'main-content')
						{
							$cols = 'col-xs-6 col-sm-6 col-md-6 col-lg-6';
						}
						elseif ((self::getData($args[1]) == 'right' || self::getData($args[1]) == 'left') && $args[2] == 'main-content') {
							$cols = 'col-xs-9 col-sm-9 col-md-9 col-lg-9';
						}

						return $args[2] . ' ' . $cols;
					}
					break;
				default:
					return self::getData($method);
					break;
			}
		}

		return '';
	}

	private function getCurrentPageId()
	{
		// if((get_option('show_on_front') && get_option('page_for_posts') && is_home()) ||
	 //    (get_option('page_for_posts') && is_archive() && !is_post_type_archive())) {
	 //    $page_id = get_option('page_for_posts');
	 //  } else {
	 //    $page_id = $this->post->ID;

	 //    if(class_exists('Woocommerce')) {
	 //      if(is_shop()) {
	 //        $page_id = get_option('woocommerce_shop_page_id');
	 //      }
	 //    }
	 //  }

	 //  return $page_id;
	}

	public static function getInstance()
	{
	  if (self::$instance == null)
	  {
	    self::$instance = new self();
	  }

	  return self::$instance;
	}

	public function registerNavMenus()
	{
		$this->init->registerNavMenus();
	}

	public function registerPosts()
	{
		// Register custom post types
		$this->init->registerPosts();
	}

	public function registerSidebars()
	{
		// Register widgetized zones
		$this->init->registerSidebars();
	}

	public function setData()
	{
		self::$data = get_option(THEME_OPTIONS);
	}

	public static function getData($name = null)
	{
		if ($name)
		{
			return isset(self::$data[$name]) ? self::$data[$name] : false;
		}

		return self::$data;
	}

	public function getSidebar($name = 0)
	{
		$this->multiSidebars->getSidebar($name);
	}

	public static function getHtml($section)
	{
		$filePath = '';
		switch ($section)
		{
			case 'favicon':
				$filePath = VIEWS_PATH . 'head' . DS . $section	. '.php';
				break;
			case 'css':
				$filePath = VIEWS_PATH . 'head' . DS . $section	. '.php';
				break;
			case 'javascripts':
				$filePath = VIEWS_PATH . 'head' . DS . $section	. '.php';
				break;
			case 'header':
				$filePath = VIEWS_PATH . $section . DS . $section . '-' . Salamander::getData('header_layout')	. '.php';
				break;
			default:
				$filePath = VIEWS_PATH . $section . DS . $section	. '.php';
				break;
		}
		if ($filePath && file_exists($filePath))
		{
			return self::$helper->render($filePath);
		}
		if ($filePath && !file_exists($filePath))
		{
			return 'Error! Can\'t find file to include ' . $filePath;
		}
		return false;
	}
}
