<?php

/**
 * Helper class
 */

class Helper
{
	static private $themeOptions;
	static private $instance;

	private function __construct()
	{
		self::$themeOptions = get_option(THEME_OPTIONS);
	}

	public static function getInstance()
	{
	  if (self::$instance == null)
	  {
	    self::$instance = new self();
	  }

	  return self::$instance;
	}

	//render template
	public function function_get_output($fn)
	{
	  $args = func_get_args();unset($args[0]);
	  ob_start();
	  call_user_func_array(array($this, $fn), $args);
	  $output = ob_get_contents();
	  ob_end_clean();
	  return $output;
	}

	public function display($template, $params = array())
	{
	  extract($params);
	  // require $template;
	  include $template;
	}

	public function render($template, $params = array())
	{
	  return $this->function_get_output('display', $template, $params);
	}

  public static function stringLimitWords($string, $word_limit)
  {
    $words = explode(' ', $string, ($word_limit + 1));

    if(count($words) > $word_limit) {
      array_pop($words);
    }

    return implode(' ', $words);
  }

	public static function optionsMachine($options)
	{
    $data = self::$themeOptions;

		$defaults = array();
    $n = 0;
		$menu = '';
		$output = '';

		foreach ($options as $value)
		{
			$n++;
			$val = '';
			//create array of defaults
			if ($value['type'] == 'multicheck')
			{
				if (is_array($value['default']))
				{
					foreach($value['default'] as $i=>$key)
					{
						$defaults[$value['id']][$key] = true;
					}
				}
				else
				{
					$defaults[$value['id']][$value['default']] = true;
				}
			}
			elseif (isset($value['id']))
			{
				$defaults[$value['id']] = $value['default'];
			}

			if ($data)
			{
				//Start Head zone
				if ($value['type'] != 'head_zone')
				{
					$class = '';
					if(isset( $value['class'] ))
					{
						$class = $value['class'];
					}

					//hide items in checkbox group
					$fold = '';
					if (array_key_exists('fold', $value))
					{
						if ($data[$value['fold']])
						{
							$fold = 'f_' . $value['fold'] . ' ';
						}
						else
						{
							$fold = 'f_' . $value['fold'] . ' temphide ';
						}
					}

					$output .= '<div id="section-' . $value['id'] . '" class="' . $fold . 'section section-' . $value['type'] . ' ' . $class . '">' . "\n";
					//only show header if 'name' value exists
					if($value['name'])
					{
						$output .= '<h3 class="heading">' . $value['name'] . '</h3>' . "\n";
					}
					$output .= '<div class="option">' . "\n" . '<div class="controls">' . "\n";
				}
				//End Head zone
				//switch statement to handle various options type
				switch ($value['type'])
				{
					//text input
					case 'text':
						$val = '';
						$val = stripslashes($data[$value['id']]);

						$mini ='';
						if(isset($value['mode']) && $value['mode'] == 'mini')
						{
							$mini = 'mini';
						}

						$field = array(
							'#type' => $value['type'],
							'#title' => '',
							'#attributes' => array(
								'name' =>  $value['id'],
								'id' => $value['id'],
								'class' => $mini,
								'value' => $val,
							),
							'#container' => array(
								'tag' => 'div',
								'#attributes' => array(
									'class' => 'form-group sl-field',
								),
							),
							// '#help' => __('If left Blank the global title will be used.', 'salamander'),
						);
						$output .= Helper::renderElement($field);
						// $output .= '<input class="of-input ' . $mini . '" name="' . $value['id'] . '" id="' . $value['id'] . '" type="' . $value['type'] . '" value="'. $val . '" />';
					break;

					//select option
					case 'select':
						$mini ='';
						if(isset($value['mode']) && $value['mode'] == 'mini')
						{
							$mini = 'mini';
						}
						$field = array(
							'#type' => $value['type'],
							'#title' => '',
							'#attributes' => array(
								'id' => $value['id'],
								'name' => $value['id'],
								'class' => 'select',
							),
							'#default_value' => $data[$value['id']],
							'#options' => $value['options'],
							'#container' => array(
								'tag' => 'div',
								'#attributes' => array(
									'class' => 'form-group sl-field select_wrapper ' . $mini,
								),
							),
						);
						$output .= Helper::renderElement($field);
					break;

					//textarea option
					case 'textarea':
						$cols = '8';
						$val = '';
						if(isset($value['options']['cols']))
						{
							$cols = $value['options']['cols'];
						}
						$val = $data[$value['id']];
						$field = array(
							'#type' => $value['type'],
							'#title' => '',
							'#attributes' => array(
								'name' => $value['id'],
								'id' => $value['id'],
								'value' => $val,
								'cols' => $cols,
								'rows' => 8,
							),
							'#container' => array(
								'tag' => 'div',
								'#attributes' => array(
									'class' => 'form-group sl-field',
								),
							),
						);
						$output .= Helper::renderElement($field);
					break;

					//radiobox option
					case "radios":
						$field = array(
							'#type' => $value['type'],
							'#title' => '',
							'#attributes' => array(
								'id' => $value['id'],
								'name' => $value['id'],
								'class' => 'of-radio',
							),
							'#default_value' => 'repeat',
							'#options' => $value['options'],
							'#container' => array(
								'tag' => 'div',
								'#attributes' => array(
									'class' => 'form-group sl-field',
								),
							),
						);
						$output .= Helper::renderElement($field);
					break;

					//checkbox option
					case 'checkbox':
						if (!isset($data[$value['id']]))
						{
							$data[$value['id']] = 0;
						}

						$fold = '';
						if (array_key_exists('folds', $value))
						{
							$fold = 'fld ';
						}

						$output .= '<input type="hidden" class="' . $fold . 'checkbox aq-input" name="' . $value['id'] . '" id="' . $value['id'] . '" value="0"/>';
						$output .= '<input type="checkbox" class="' . $fold . 'checkbox of-input" name="' . $value['id'] . '" id="' . $value['id'] . '" value="1" ' . checked($data[$value['id']], 1, false) . ' />';
					break;

					//multiple checkbox option
					case 'multicheck':
						$multi_stored = $data[$value['id']];

						foreach ($value['options'] as $key => $option)
						{
							if (!isset($multi_stored[$key]))
							{
								$multi_stored[$key] = '';
							}
							$of_key_string = $value['id'] . '_' . $key;
							$output .= '<input type="checkbox" class="checkbox of-input" name="' . $value['id'] . '[' . $key . ']' . '" id="' . $of_key_string .'" value="1" '. checked($multi_stored[$key], 1, false) .' /><label class="multicheck" for="'. $of_key_string .'">' . $option . '</label><br />';
						}
					break;

					//ajax image upload option
					case 'upload':
						if(!isset($value['mode']))
						{
							$value['mode'] = '';
						}
						$output .= self::optionsframework_uploader_function($value['id'],$value['default'],$value['mode']);
					break;

					// native media library uploader - @uses optionsframework_media_uploader_function()
					case 'media':
						$_id = strip_tags( strtolower($value['id']) );
						$int = '';
						$int = self::optionsframeworkGetSilentpost($_id);
						if(!isset($value['mode']))
						{
							$value['mode'] = '';
						}
						$output .= self::optionsframework_media_uploader_function( $value['id'], $value['default'], $int, $value['mode'] ); // New AJAX Uploader using Media Library
					break;

					//colorpicker option
					case 'color':
						$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div style="background-color: ' . $data[$value['id']] . '"></div></div>';
						$output .= '<input class="of-color" name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" value="' . $data[$value['id']] . '" />';
					break;

					//typography option
					case 'typography':
						$typography_stored = isset($data[$value['id']]) ? $data[$value['id']] : $value['default'];
						/* Font Size */
						if(isset($typography_stored['size'])) {
							$output .= '<div class="select_wrapper typography-size" original-title="Font size">';
							$output .= '<select class="of-typography of-typography-size select" name="' . $value['id'] . '[size]" id="' . $value['id'] . '_size">';
								for ($i = 9; $i < 20; $i++)
								{
									$test = $i . 'px';
									$output .= '<option value="' . $i . 'px" ' . selected($typography_stored['size'], $test, false) . '>' . $i . 'px</option>';
								}

							$output .= '</select></div>';
						}

						/* Line Height */
						if(isset($typography_stored['height']))
						{
							$output .= '<div class="select_wrapper typography-height" original-title="Line height">';
							$output .= '<select class="of-typography of-typography-height select" name="' . $value['id'] . '[height]" id="' . $value['id'] . '_height">';
								for ($i = 20; $i < 38; $i++)
								{
									$test = $i.'px';
									$output .= '<option value="'. $i .'px" ' . selected($typography_stored['height'], $test, false) . '>'. $i .'px</option>';
								}

							$output .= '</select></div>';
						}

						/* Font Face */
						if(isset($typography_stored['face']))
						{
							$output .= '<div class="select_wrapper typography-face" original-title="Font family">';
							$output .= '<select class="of-typography of-typography-face select" name="'.$value['id'].'[face]" id="'. $value['id'].'_face">';

							$faces = array('arial'=>'Arial',
											'verdana'=>'Verdana, Geneva',
											'trebuchet'=>'Trebuchet',
											'georgia' =>'Georgia',
											'times'=>'Times New Roman',
											'tahoma'=>'Tahoma, Geneva',
											'palatino'=>'Palatino',
											'helvetica'=>'Helvetica' );
							foreach ($faces as $i=>$face)
							{
								$output .= '<option value="' . $i . '" ' . selected($typography_stored['face'], $i, false) . '>' . $face . '</option>';
							}
							$output .= '</select></div>';
						}

						/* Font Weight */
						if(isset($typography_stored['style']))
						{
							$output .= '<div class="select_wrapper typography-style" original-title="Font style">';
							$output .= '<select class="of-typography of-typography-style select" name="' . $value['id'] . '[style]" id="' . $value['id'] . '_style">';
							$styles = array('normal'=>'Normal',
											'italic'=>'Italic',
											'bold'=>'Bold',
											'bold italic'=>'Bold Italic');

							foreach ($styles as $i=>$style)
							{
								$output .= '<option value="' . $i . '" ' . selected($typography_stored['style'], $i, false) . '>' . $style . '</option>';
							}
							$output .= '</select></div>';

						}

						/* Font Color */
						if(isset($typography_stored['color']))
						{
							$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: '.$typography_stored['color'].'"></div></div>';
							$output .= '<input class="of-color of-typography of-typography-color" original-title="Font color" name="' . $value['id'].'[color]" id="'. $value['id'] . '_color" type="text" value="' . $typography_stored['color'] . '" />';

						}

					break;

					//border option
					case 'border':
						/* Border Width */
						$border_stored = $data[$value['id']];

						$output .= '<div class="select_wrapper border-width">';
						$output .= '<select class="of-border of-border-width select" name="' . $value['id'] . '[width]" id="' . $value['id'] . '_width">';
						for ($i = 0; $i < 21; $i++)
						{
							$output .= '<option value="' . $i . '" ' . selected($border_stored['width'], $i, false) . '>' . $i . '</option>';
						}
						$output .= '</select></div>';

						/* Border Style */
						$output .= '<div class="select_wrapper border-style">';
						$output .= '<select class="of-border of-border-style select" name="' . $value['id'] . '[style]" id="' . $value['id'] . '_style">';

						$styles = array(
							'none'=>'None',
							'solid'=>'Solid',
							'dashed'=>'Dashed',
							'dotted'=>'Dotted'
						);

						foreach ($styles as $i=>$style)
						{
							$output .= '<option value="'. $i .'" ' . selected($border_stored['style'], $i, false) . '>' . $style . '</option>';
						}

						$output .= '</select></div>';

						/* Border Color */
						$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div style="background-color: ' . $border_stored['color'].'"></div></div>';
						$output .= '<input class="of-color of-border of-border-color" name="'.$value['id'] . '[color]" id="' . $value['id'] . '_color" type="text" value="' . $border_stored['color'] . '" />';

					break;

					//images checkbox - use image as checkboxes
					case 'images':

						$i = 0;

						$select_value = $data[$value['id']];

						foreach ($value['options'] as $key => $option)
						{
						$i++;

							$checked = '';
							$selected = '';
							if(NULL!=checked($select_value, $key, false)) {
								$checked = checked($select_value, $key, false);
								$selected = 'of-radio-img-selected';
							}
							$output .= '<span>';
							$output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="' . $key . '" name="' . $value['id'] . '" ' . $checked . ' />';
							$output .= '<div class="of-radio-img-label">' . $key . '</div>';
							$output .= '<img src="'.$option.'" alt="" class="of-radio-img-img ' . $selected . '" onClick="document.getElementById(\'of-radio-img-' . $value['id'] . $i .'\').checked = true;" />';
							$output .= '</span>';
						}

					break;

					//info (for small intro box etc)
					case "info":
						$info_text = $value['default'];
						$output .= '<div class="of-info">' . $info_text . '</div>';
					break;

					//display a single image
					case "image":
						$src = $value['default'];
						$output .= '<img src="' . $src . '">';
					break;

					//tab head zone
					case 'head_zone':
						if($n >= 2)
						{
						   $output .= '</div>' . "\n";
						}
						$header_class = str_replace(' ', '', strtolower($value['name']));
						$jquery_click_hook = str_replace(' ', '', strtolower($value['name']) );
						$jquery_click_hook = 'of-option-' . $jquery_click_hook;
						$menu .= '<li class="' . $header_class . '"><a title="' .  $value['name'] . '" href="#' .  $jquery_click_hook  . '">' .  $value['name'] . '</a></li>';
						$output .= '<div class="group" id="' . $jquery_click_hook  . '"><h2>' . $value['name'] . '</h2>' . "\n";
					break;

					//drag & drop slide manager
					case 'slider':
						$_id = strip_tags( strtolower($value['id']) );
						$int = '';
						$int = self::optionsframework_mlu_get_silentpost( $_id );
						$output .= '<div class="slider"><ul id="' . $value['id'] . '" rel="' . $int . '">';
						if(isset($data[$value['id']]))
						{
							$slides = $data[$value['id']];
						}
						$count = count($slides);
						if ($count < 2)
						{
							$oldorder = 1;
							$order = 1;
							$output .= self::optionsframework_slider_function($value['id'], $value['default'], $oldorder, $order, $int);
						}
						else
						{
							$i = 0;
							foreach ($slides as $slide)
							{
								$oldorder = $slide['order'];
								$i++;
								$order = $i;
								$output .= self::optionsframework_slider_function($value['id'], $value['default'], $oldorder, $order, $int);
							}
						}
						$output .= '</ul>';
						$output .= '<a href="#" class="button slide_add_button">Add New Slide</a></div>';

					break;

					//drag & drop block manager
					case 'sorter':

						$sortlists = isset($data[$value['id']]) && !empty($data[$value['id']]) ? $data[$value['id']] : $value['default'];

						$output .= '<div id="' . $value['id'] . '" class="sorter">';


						if ($sortlists)
						{
							foreach ($sortlists as $group=>$sortlist)
							{
								$output .= '<ul id="'.$value['id'].'_'.$group.'" class="sortlist_'.$value['id'].'">';
								$output .= '<h3>'.$group.'</h3>';

								foreach ($sortlist as $key => $list) {

									$output .= '<input class="sorter-placebo" type="hidden" name="'.$value['id'].'['.$group.'][placebo]" value="placebo">';

									if ($key != "placebo")
									{
										$output .= '<li id="'.$key.'" class="sortee">';
										$output .= '<input class="position" type="hidden" name="'.$value['id'].'['.$group.']['.$key.']" value="'.$list.'">';
										$output .= $list;
										$output .= '</li>';
									}
								}
								$output .= '</ul>';
							}
						}

						$output .= '</div>';
					break;

					//background images option
					case 'tiles':

						$i = 0;
						$select_value = isset($data[$value['id']]) && !empty($data[$value['id']]) ? $data[$value['id']] : '';

						foreach ($value['options'] as $key => $option)
						{
						$i++;

							$checked = '';
							$selected = '';
							if(NULL!=checked($select_value, $option, false))
							{
								$checked = checked($select_value, $option, false);
								$selected = 'of-radio-tile-selected';
							}
							$output .= '<span>';
							$output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="'.$option.'" name="'.$value['id'].'" '.$checked.' />';
							$output .= '<div class="of-radio-tile-img '. $selected .'" style="background: url('.$option.')" onClick="document.getElementById(\'of-radio-tile-'. $value['id'] . $i.'\').checked = true;"></div>';
							$output .= '</span>';
						}

					break;

					//backup and restore options data
					case 'backup':

						$instructions = $value['desc'];
						$backup = get_option(THEME_OPTIONS_BACKUPS);

						if(!isset($backup['backup_log']))
						{
							$log = 'No backups yet';
						}
						else
						{
							$log = $backup['backup_log'];
						}

						$output .= '<div class="backup-box">';
						$output .= '<div class="instructions">' . $instructions . "\n";
						$output .= '<p><strong>'. __('Last Backup : ', 'salamander').'<span class="backup-log">' . $log . '</span></strong></p></div>'."\n";
						$output .= '<a href="#" id="of_backup_button" class="button" title="Backup Options">Backup Options</a>';
						$output .= '<a href="#" id="of_restore_button" class="button" title="Restore Options">Restore Options</a>';
						$output .= '</div>';

					break;
					//export or import data between different installs
					case 'transfer':
						$instructions = $value['desc'];
						$output .= '<textarea id="export_data" rows="8">' . base64_encode(serialize($data)) /* 100% safe - ignore theme check nag */ .'</textarea>'."\n";
						$output .= '<a href="#" id="of_import_button" class="button" title="Restore Options">Import Options</a>';
					break;
				}
			}
			//description of each option
			if ( $value['type'] != 'head_zone' )
			{
				if(!isset($value['desc']))
				{
					$explain_value = '';
				}
				else
				{
					$explain_value = '<div class="explain">' . $value['desc'] . '</div>' . "\n";
				}
				$output .= '</div>' . $explain_value . "\n";
				$output .= '<div class="clear"> </div></div></div>' . "\n";
			}
		}

    $output .= '</div>';

    return array(
    	'inputs' => $output,
    	'menu' => $menu,
    	'defaults' => $defaults,
    );
	}

		/**
	 * Ajax image uploader - supports various types of image types
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_uploader_function($id,$std,$mod)
	{

	  $data = get_option(THEME_OPTIONS);
		$uploader = '';
	  $upload = $data[$id];
		$hide = '';

		if ($mod == "min")
		{
			$hide ='hide';
		}
		if(!empty($upload))
		{
			$val = $upload;
			$hide = '';
		}
		else
		{
			$val = $std;
			$hide = 'hide';
		}

		$uploader .= '<input class="' . $hide . ' upload of-input" name="' . $id . '" id="'. $id . '_upload" value="' . $val . '" />';
		$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">'._('Upload').'</span>';
		$uploader .= '<span class="button image_reset_button ' . $hide . '" id="reset_' . $id . '" title="' . $id . '">Remove</span>';
		$uploader .='</div>' . "\n";
    $uploader .= '<div class="clear"></div>' . "\n";
		if(!empty($upload) && !($id == 'custom_font_woff' || $id == 'custom_font_ttf' || $id == 'custom_font_svg' || $id == 'custom_font_eot'))
		{
			$uploader .= '<div class="screenshot">';
    	$uploader .= '<a class="of-uploaded-image" href="' . $upload . '">';
    	$uploader .= '<img class="of-option-image" id="image_' . $id . '" src="' . $upload . '" alt="" />';
    	$uploader .= '</a>';
			$uploader .= '</div>';
		}
		$uploader .= '<div class="clear"></div>' . "\n";

		return $uploader;

	}

	/**
	 * Native media library uploader
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_media_uploader_function($id, $std, $int, $mod)
	{

    $data = get_option(THEME_OPTIONS);
		$uploader = '';
    $upload = $data[$id];
		$hide = '';
		if ($mod == "min")
		{
			$hide ='hide';
		}
		if(!empty($upload))
		{
			$val = $upload;
			$hide = '';
		}
		else
		{
			$val = '';
			$hide = 'hide';
		}

		$uploader .= '<input class="' . $hide.' upload of-input" name="' . $id . '" id="' . $id . '_upload" value="' . $val . '" />';
		$uploader .= '<div class="upload_button_div"><span class="button media_upload_button" id="' . $id . '" rel="' . $int . '">Upload</span>';
		$uploader .= '<span class="button mlu_remove_button ' . $hide . '" id="reset_' . $id . '" title="' . $id . '">Remove</span>';
		$uploader .='</div>' . "\n";
		$uploader .= '<div class="screenshot">';
		if(!empty($upload))
		{
    	$uploader .= '<a class="of-uploaded-image" href="' . $upload . '">';
    	$uploader .= '<img class="of-option-image" id="image_' . $id . '" src="' . $upload . '" alt="" />';
    	$uploader .= '</a>';
		}
		$uploader .= '</div>';
		$uploader .= '<div class="clear"></div>' . "\n";

		return $uploader;
	}

	/**
	 * Drag and drop slides manager
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_slider_function($id,$std,$oldorder,$order,$int)
	{

    $data = get_option(THEME_OPTIONS);

		$slider = '';
		$slide = array();
		if(isset($data[$id]))
		{
	    $slide = $data[$id];
		}

    if (isset($slide[$oldorder]))
    {
    	$val = $slide[$oldorder];
    }
    else
    {
    	$val = $std;
    }

		//initialize all vars
		$slidevars = array('title', 'url', 'link', 'description');

		foreach ($slidevars as $slidevar)
		{
			if (!isset($val[$slidevar]))
			{
				$val[$slidevar] = '';
			}
		}

		//begin slider interface
		if (!empty($val['title']))
		{
			$slider .= '<li><div class="slide_header"><strong>' . stripslashes($val['title']) . '</strong>';
		}
		else
		{
			$slider .= '<li><div class="slide_header"><strong>Slide ' . $order . '</strong>';
		}

		$slider .= '<input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';
		$slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';
		$slider .= '<div class="slide_body">';
		$slider .= '<label>Title</label>';
		$slider .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. stripslashes($val['title']) .'" />';
		$slider .= '<label>Image URL</label>';
		$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][url]" id="'. $id .'_'.$order .'_slide_url" value="'. $val['url'] .'" />';

		$slider .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'_'.$order .'" rel="' . $int . '">Upload</span>';

		if(!empty($val['url']))
		{
			$hide = '';
		}
		else
		{
			$hide = 'hide';
		}
		$slider .= '<span class="button mlu_remove_button '. $hide.'" id="reset_'. $id .'_'.$order .'" title="' . $id . '_'.$order .'">Remove</span>';
		$slider .='</div>' . "\n";
		$slider .= '<div class="screenshot">';
		if(!empty($val['url']))
		{
    	$slider .= '<a class="of-uploaded-image" href="'. $val['url'] . '">';
    	$slider .= '<img class="of-option-image" id="image_'.$id.'_'.$order .'" src="'.$val['url'].'" alt="" />';
    	$slider .= '</a>';
		}
		$slider .= '</div>';
		$slider .= '<label>Link URL (optional)</label>';
		$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][link]" id="'. $id .'_'.$order .'_slide_link" value="'. $val['link'] .'" />';
		$slider .= '<label>Video Embed Code (optional)</label>';
		$slider .= '<textarea class="slide of-input" name="'. $id .'['.$order.'][description]" id="'. $id .'_'.$order .'_slide_description" cols="8" rows="8">'.stripslashes($val['description']).'</textarea>';
		$slider .= '<a class="slide_delete_button" href="#">Delete</a>';
	  $slider .= '<div class="clear"></div>' . "\n";
		$slider .= '</div>';
		$slider .= '</li>';

		return $slider;
	}

	public static function optionsframework_mlu_get_silentpost ( $_token ) {

		global $wpdb;
		$_id = 0;

		// Check if the token is valid against a whitelist.
		// $_whitelist = array( 'of_logo', 'of_custom_favicon', 'of_ad_top_image' );
		// Sanitise the token.

		$_token = strtolower( str_replace( ' ', '_', $_token ) );

		// if ( in_array( $_token, $_whitelist ) ) {
		if ( $_token ) {

			// Tell the function what to look for in a post.

			$_args = array( 'post_type' => 'options', 'post_name' => 'of-' . $_token, 'post_status' => 'draft', 'comment_status' => 'closed', 'ping_status' => 'closed' );

			// Look in the database for a "silent" post that meets our criteria.
			$query = 'SELECT ID FROM ' . $wpdb->posts . ' WHERE post_parent = 0';
			foreach ( $_args as $k => $v ) {
				$query .= ' AND ' . $k . ' = "' . $v . '"';
			} // End FOREACH Loop

			$query .= ' LIMIT 1';
			$_posts = $wpdb->get_row( $query );

			// If we've got a post, loop through and get it's ID.
			if ( count( $_posts ) ) {
				$_id = $_posts->ID;
			} else {

				// If no post is present, insert one.
				// Prepare some additional data to go with the post insertion.
				$_words = explode( '_', $_token );
				$_title = join( ' ', $_words );
				$_title = ucwords( $_title );
				$_post_data = array( 'post_title' => $_title );
				$_post_data = array_merge( $_post_data, $_args );
				$_id = wp_insert_post( $_post_data );
			}
		}
		return $_id;
	}

	public static function optionsframeworkGetSilentpost ( $_token ) {

		global $wpdb;
		$_id = 0;

		// Check if the token is valid against a whitelist.
		// $_whitelist = array( 'of_logo', 'of_custom_favicon', 'of_ad_top_image' );
		// Sanitise the token.

		$_token = strtolower( str_replace( ' ', '_', $_token ) );

		// if ( in_array( $_token, $_whitelist ) ) {
		if ( $_token ) {

			// Tell the function what to look for in a post.

			$_args = array( 'post_type' => 'options', 'post_name' => 'of-' . $_token, 'post_status' => 'draft', 'comment_status' => 'closed', 'ping_status' => 'closed' );

			// Look in the database for a "silent" post that meets our criteria.
			$query = 'SELECT ID FROM ' . $wpdb->posts . ' WHERE post_parent = 0';
			foreach ( $_args as $k => $v ) {
				$query .= ' AND ' . $k . ' = "' . $v . '"';
			} // End FOREACH Loop

			$query .= ' LIMIT 1';
			$_posts = $wpdb->get_row( $query );

			// If we've got a post, loop through and get it's ID.
			if ( count( $_posts ) ) {
				$_id = $_posts->ID;
			} else {

				// If no post is present, insert one.
				// Prepare some additional data to go with the post insertion.
				$_words = explode( '_', $_token );
				$_title = join( ' ', $_words );
				$_title = ucwords( $_title );
				$_post_data = array( 'post_title' => $_title );
				$_post_data = array_merge( $_post_data, $_args );
				$_id = wp_insert_post( $_post_data );
			}
		}
		return $_id;
	}

	private static function elementSetClass(&$element, $class = array())
	{
	  if (!empty($class))
	  {
	    if (!isset($element['#attributes']['class']))
	    {
	      $element['#attributes']['class'] = '';
	    }
	    else
	    {
  	    $element['#attributes']['class'] .= ' ';
	    }
	    $element['#attributes']['class'] .= implode(' ', $class);
	  }
	  if (isset($element['#attributes']['required'])) {
	    $element['#attributes']['class'] = ' required';
	  }
	}

	private static function setAttributes($attributes) {
		if (!$attributes) $attributes = array();
	  foreach ($attributes as $attribute => &$data) {
	    $data = $attribute . '="' . $data . '"';
	  }
	  return $attributes ? ' ' . implode(' ', $attributes) : '';
	}

	public static function renderElement($element)
	{
		$label = $open = $close = $help = '';
		if (isset($element['#attributes']['id']) && isset($element['#label']))
	  {
	  	$attributes = '';
	  	if (isset($element['#label']['#attributes']))
	  	{
	  		$attributes = self::setAttributes($element['#label']['#attributes']);
	  	}
	  	$label = '<label for="' . $element['#attributes']['id'] . '" ' . $attributes . ' >' . __($element['#title'], 'salamander') . '</label>';
	  }
		if (isset($element['#container']))
		{
			$open = '<' . $element['#container']['tag'] . ' ' . self::setAttributes($element['#container']['#attributes']) . '>';
			$close = '</' . $element['#container']['tag'] . '>';
		}
		if (isset($element['#help']))
		{
			$help = '<span class="help-block">' . $element['#help'] . '</span>';
		}
		$method = $element['#type'] . 'Field';

		return $open . $label . self::$method($element) . $close . $help;
	}

	private static function textField($element)
	{
		$element['#attributes'] =	array_merge(array('type' => 'text'), $element['#attributes']);
	  self::elementSetClass($element, array('form-text', 'form-control'));
		return '<input' . self::setAttributes($element['#attributes']) . ' />';
	}

	private static function selectField($element)
	{
		$options = '';
	  self::elementSetClass($element, array('form-select', 'form-control'));
	  if (isset($element['#options']) && !empty($element['#options']))
	  {
	  	$default_value = $element['#default_value'];
	  	foreach ($element['#options'] as $val => $key)
	  	{
	  		$options .= '<option value="' . $val . '" ' . selected($default_value, $val, false) . '>'. $key . '</option>' . "\n";
	  	}
	  }
	  return '<select ' . self::setAttributes($element['#attributes']) . '>' . $options .'</select>';
	}

	private static function textareaField($element)
	{
		$value = $element['#attributes']['value'];
		unset($element['#attributes']['value']);
	  self::elementSetClass($element, array('form-textarea', 'form-control'));
		return '<textarea' . self::setAttributes($element['#attributes']) . '>' . $value . '</textarea>';
	}

	private static function radiosField($element)
	{
		$output = '';
	  self::elementSetClass($element, array('form-radio', 'form-control'));
	  $id = $element['#attributes']['id'];
	  unset($element['#attributes']['id']);
	  if (isset($element['#options']) && !empty($element['#options']))
	  {
	  	$default_value = $element['#default_value'];
	  	foreach ($element['#options'] as $val => $name)
	  	{
	  		$output .= '<input type="radio" id="' . $id . '_' . $val . '" ' . self::setAttributes($element['#attributes']) . ' value="' . $val . '" ' . checked($default_value, $val, false) . ' /><label for="' . $id . '_' . $val . '" class="radio">' . $name . '</label><br/>';
	  	}
	  }

	  return $output;
	}
}
