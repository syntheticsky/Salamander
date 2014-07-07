<?php

/**
 * Salamander Theme
 */
class ShortCodes
{
	private $helper;

	private $shortcodeList;

	public function __construct()
	{
		$this->helper = Helper::getInstance();
		$this->shortcodeList = array("youtube", "vimeo", "soundcloud", "button", "dropcap", "highlight", "checklist", "tabs", "tab", "accordian", "toggle", "one_half", "one_third", "one_fourth", "two_third", "three_fourth", "tagline_box", "pricing_table", "pricing_column", "pricing_price", "pricing_row", "pricing_footer", "content_boxes", "content_box", "slider", "slide", "testimonials", "testimonial", "progress", "person", "recent_posts", "recent_works", "alert", "fontawesome", "social_links", "clients", "client", "title", "separator", "tooltip", "fullwidth", "map", "counters_circle", "counter_circle", "counters_box", "counter_box", "flexslider", "blog", "imageframe", "images", "image", "sharing");
		add_filter('widget_text', 'do_shortcode');
		add_filter('the_content', array($this, 'ShortcodesFormatter'));
		add_filter('widget_text', array($this, 'ShortcodesFormatter'));
		// Google Map
		add_shortcode('map', array($this, 'shortcodeGM'));
		// Vimeo shortcode
		add_shortcode('vimeo', array($this, 'shortcodeVimeo'));

		// Add buttons to tinyMCE
		add_action('init', array($this, 'addButton'));
	}

	public function ShortcodesFormatter($content)
	{
		$block = join("|", $this->shortcodeList);
		// opening tag
		$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]", $content);
		// closing tag
		$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)/","[/$2]",$rep);

		return $rep;
	}

	public function shortcodeGM($atts, $content = null)
	{
		wp_enqueue_script('gmaps.api');
		wp_enqueue_script('jquery.ui.map');

		$atts = shortcode_atts(array(
			'address' => '',
			'type' => 'satellite',
			'width' => '100%',
			'height' => '300px',
			'zoom' => '14',
			'scrollwheel' => 'true',
			'scale' => 'true',
			'zoom_pancontrol' => 'true',
		), $atts);

		static $mapCounter = 1;

		$atts['mapCounter'] = $mapCounter;

		$mapCounter++;

		return $this->helper->render(VIEWS_PATH . 'shortcodes' . DS . 'map.php', $atts);
	}

	public function shortcodeVimeo($atts)
	{
		$atts = shortcode_atts(
			array(
				'id' => '',
				'width' => 600,
				'height' => 360
			), $atts);

			return $this->helper->render(VIEWS_PATH . 'shortcodes' . DS . 'vimeo.php', $atts);
	}

	public function addButton()
	{
		if(strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php') || strstr($_SERVER['REQUEST_URI'], 'wp-admin/post.php')) {
      if ( current_user_can('edit_posts') && current_user_can('edit_pages')) {
        add_filter('mce_buttons', array($this, 'registerButton'));
        add_filter('mce_external_plugins', array($this, 'addPlugin'));
        add_action('edit_form_after_editor', array($this, 'shortCodesForm'));
      }
   	}
	}

	public function shortCodesForm()
	{
		$params = array(
    	// 'list' = $this->shortcodeList,
    	'list' => array(
								"vimeo" => 'Vimeo',
								'map' => 'Google Map',
							),
    );
		print $this->helper->render(VIEWS_PATH . 'admin' . DS . 'shortcodesForm.php', $params);
	}

	public function registerButton( $buttons )
	{
	   array_push($buttons, 'ssc_button');
	   return $buttons;
	}

	public function addPlugin( $plugin_array ) {
	   $plugin_array['ssc_button'] = ASSETS_DIR . 'js' . DS . 'shortcodes.js';
	   return $plugin_array;
	}
}
