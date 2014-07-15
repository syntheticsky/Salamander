<?php

/**
 *
 */
class Metaboxes {

	private $helper;

	public function __construct()
	{
		$this->helper = Helper::getInstance();
		add_action('add_meta_boxes', array($this, 'addMetaBoxes'));
		add_action('save_post', array($this, 'saveMetaBoxes'));
		add_action('admin_enqueue_scripts', array($this, 'adminScriptLoader'));
	}

	// Load backend scripts
	function adminScriptLoader() {
		global $pagenow;
		if (is_admin() && ($pagenow=='post-new.php' || $pagenow=='post.php')) {
			wp_enqueue_style('jquery-ui', ASSETS_DIR . '/css/jquery-ui/jquery-ui.css');
			wp_enqueue_style('meta-options', ASSETS_DIR . '/css/admin/meta-options.css');
			wp_enqueue_style('thickbox');

			wp_enqueue_script('jquery-ui', ASSETS_DIR . '/js/jquery-ui/jquery-ui.min.js');
			wp_enqueue_script('meta-options', ASSETS_DIR . '/js/admin/meta-options.js');
    	wp_enqueue_script('sl_upload', ASSETS_DIR . '/js/upload.js');
    	wp_enqueue_script('media-upload');
    	wp_enqueue_script('thickbox');
		}
	}

	public function addMetaBoxes()
	{
		$this->addMetaBox('postOptions', __('Post Options', 'optionsframework'), 'post');
		// $this->addMetaBox('pageOptions', __('Page Options', 'optionsframework'), 'page');
		// $this->addMetaBox('portfolioOptions', __('Portfolio Options', 'optionsframework'), 'salamander_portfolio');

		// $this->addMetaBox('seOptions', __('Elastic Slide Options', 'optionsframework'), 'salamander_elastic');
	}

	public function addMetaBox($id, $label, $post_type)
	{
	    add_meta_box(
	        'sl_meta_' . $id,
	        $label,
	        array($this, $id),
	        $post_type
	    );
	}

	public function saveMetaBoxes($post_id)
	{
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		foreach($_POST as $key => $value) {
			if(strstr($key, 'sl_meta_')) {
				update_post_meta($post_id, $key, $value);
			}
		}
	}

	public function postOptions()
	{
		print Helper::render(VIEWS_PATH . 'admin' . DS . 'metaboxes' . DS . 'style.php');
		print Helper::render(VIEWS_PATH . 'admin' . DS . 'metaboxes' . DS . 'post_options.php');
	}

	public function page_options()
	{
		include 'views/metaboxes/style.php';
		include 'views/metaboxes/page_options.php';
	}

	public function portfolio_options()
	{
		include 'views/metaboxes/style.php';
		include 'views/metaboxes/portfolio_options.php';
	}

	public function es_options()
	{
		include 'views/metaboxes/style.php';
		include 'views/metaboxes/es_options.php';
	}

	public static function text($id, $label, $desc = '')
	{
		global $post;

		$html = '';
		$html .= '<div class="sl_meta_metabox_field">';
			$html .= '<label for="sl_meta_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
				$html .= '<input type="text" id="sl_meta_' . $id . '" name="sl_meta_' . $id . '" value="' . get_post_meta($post->ID, 'sl_meta_' . $id, true) . '" />';
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}

	public static function select($id, $label, $options, $desc = '')
	{
		global $post;
		$html = '';
		$html .= '<div class="sl_meta_metabox_field">';
			$html .= '<label for="sl_meta_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
				$html .= '<select id="sl_meta_' . $id . '" name="sl_meta_' . $id . '">';
				foreach($options as $key => $option) {
					if(get_post_meta($post->ID, 'sl_meta_' . $id, true) == $key) {
						$selected = 'selected="selected"';
					} else {
						$selected = '';
					}

					$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
				}
				$html .= '</select>';
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}

	public static function multiple($id, $label, $options, $desc = '')
	{
		global $post;

		$html = '';
		$html .= '<div class="sl_meta_metabox_field">';
			$html .= '<label for="sl_meta_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
				$html .= '<select multiple="multiple" id="sl_meta_' . $id . '" name="sl_meta_' . $id . '[]">';
				foreach($options as $key => $option) {
					if(is_array(get_post_meta($post->ID, 'sl_meta_' . $id, true)) && in_array($key, get_post_meta($post->ID, 'sl_meta_' . $id, true))) {
						$selected = 'selected="selected"';
					} else {
						$selected = '';
					}

					$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
				}
				$html .= '</select>';
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}

	public static function textarea($id, $label, $desc = '')
	{
		global $post;

		$html = '';
		$html = '';
		$html .= '<div class="sl_meta_metabox_field">';
			$html .= '<label for="sl_meta_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
				$html .= '<textarea cols="60" rows="10" id="sl_meta_' . $id . '" name="sl_meta_' . $id . '">' . get_post_meta($post->ID, 'sl_meta_' . $id, true) . '</textarea>';
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}

	public static function upload($id, $label, $desc = '')
	{
		global $post;

		$html = '';
		$html = '';
		$html .= '<div class="sl_meta_metabox_field">';
			$html .= '<label for="sl_meta_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
			    $html .= '<input name="sl_meta_' . $id . '" class="upload_field" id="sl_meta_' . $id . '" type="text" value="' . get_post_meta($post->ID, 'sl_meta_' . $id, true) . '" />';
			    $html .= '<input class="upload_button" type="button" value="Browse" />';
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}

}
