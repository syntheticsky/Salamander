<?php
	global $post, $wpdb;

	$default_field_data = array(
		'#label' => array(),
		'#container' => array(
			'tag' => 'div',
			'#attributes' => array(
				'class' => 'form-group sl-metabox-field',
			),
		),
	);
?>
<div id="tabs" class="ui-tabs-vertical ui-helper-clearfix">
	<div class="options-sidebar">
	  <ul class="aside-tabs">
	    <li><a href="#general"><?php _e('General Settings', 'salamander'); ?></a></li>
	    <li><a href="#options"><?php _e('Post Options', 'salamander'); ?></a></li>
	    <li><a href="#skining"><?php _e('Skining', 'salamander'); ?></a></li>
	    <li><a href="#slides"><?php _e('Slideshow', 'salamander'); ?></a></li>
	  </ul>
  </div>
  <div class="options-content">
	  <div id="general">
	    <h4><?php _e('General Settings', 'salamander'); ?></h4>
  		<div id="layout-wrapper" class="layout-options single-option">
  			<h5><?php ; ?></h5>
  			<div class="layout-container">
  				<?php
  					$default = ($mt = get_post_meta($post->ID, 'sl_meta_page_layout', true)) ? $mt : 'default';
  					$options = array(
							'default' => __('Default', 'salamander'),
							'right' => __('Right', 'salamander'),
							'left' => __('Left', 'salamander'),
							'full' => __('No sidebar', 'salamander'),
						);
  				?>
  				<ul id="layout-select">
  				<?php foreach ($options as $key => $value) : ?>
  					<li class="ui-state-default <?php if ($key == $default) print 'ui-selected'; ?>" data-layout="<?php print $key; ?>">
  						<img src="<?php print ASSETS_DIR; ?>/images/page-layout-<?php print $key; ?>.png">
  					</li>
  				<?php endforeach; ?>
  				</ul>
  				<input type="hidden" value="<?php print $default; ?>" name="sl_meta_page_layout" id="page_layout" />
  				<div class="clear"></div>
  				<span class="help-block"><?php _e("Please choose this page's layout.", 'salamander'); ?></span>
  				<?php unset($default, $options);?>
				</div>
  		</div>

							<?php
	    					$field = array(
									'#type' => 'select',
									'#title' => __('Sidebar Position', 'salamander'),
									'#attributes' => array(
										'id' => 'sl_meta_sidebar_position',
										'name' => 'sl_meta_sidebar_position',
									),
									'#default_value' => get_post_meta($post->ID, 'sl_meta_sidebar_position', true),
									'#options' => array(
										'default' => 'Default',
										'right' => 'Right',
										'left' => 'Left',
									),
								);
								// print Helper::renderElement(array_merge($field, $default_field_data));
	    				?>
	    <div class="clear"></div>
  		<div class="page-title-options single-option">
  			<?php
  				$field = array(
						'#type' => 'select',
						'#title' => __('Page Title Bar', 'salamander'),
						'#attributes' => array(
							'id' => 'sl_meta_page_title',
							'name' => 'sl_meta_page_title',
						),
						'#default_value' => get_post_meta($post->ID, 'sl_meta_page_title', true),
						'#options' => array(
							'true' => 'Show',
							'false' => 'Hide',
						),
					);
					print Helper::renderElement(array_merge($field, $default_field_data));
				?>
				<?php
					$field = array(
						'#type' => 'select',
						'#title' => __('Page Title Text', 'salamander'),
						'#attributes' => array(
							'id' => 'sl_meta_page_title_text',
							'name' => 'sl_meta_page_title_text',
						),
						'#default_value' => get_post_meta($post->ID, 'sl_meta_page_title_text', true),
						'#options' => array(
							'true' => 'Show',
							'false' => 'Hide',
						),
					);
					print Helper::renderElement(array_merge($field, $default_field_data));
					?>
					<?php
  				$field = array(
						'#type' => 'select',
						'#title' => __('Breadcrumbs', 'salamander'),
						'#attributes' => array(
							'id' => 'sl_meta_breadcrumb',
							'name' => 'sl_meta_breadcrumb',
						),
						'#default_value' => get_post_meta($post->ID, 'sl_meta_breadcrumb', true),
						'#options' => array(
							'true' => 'Show',
							'false' => 'Hide',
						),
						'#help' => __('You can disable Breadcrumb for this page using this option.', 'salamander'),
					);
					print Helper::renderElement(array_merge($field, $default_field_data));
				?>
				<?php
  				$field = array(
						'#type' => 'select',
						'#title' => __('Page Tile Align', 'salamander'),
						'#attributes' => array(
							'id' => 'sl_meta_page_title_align',
							'name' => 'sl_meta_page_title_align',
						),
						'#default_value' => get_post_meta($post->ID, 'sl_meta_page_title_align', true),
						'#options' => array(
							'center' => __('Center', 'salamander'),
							'left' => __('Left', 'salamander'),
							'right' => __('Right', 'salamander'),
						),
						'#help' => __('You can change title text align.', 'salamander'),
					);
					print Helper::renderElement(array_merge($field, $default_field_data));
				?>
				<?php
					$field = array(
						'#type' => 'text',
						'#title' => __('Custom Page Title', 'salamander'),
						'#attributes' => array(
							'name' => 'sl_meta_page_title_custom',
							'value' => get_post_meta($post->ID, 'sl_meta_page_title_custom', true),
							'id' => 'sl_meta_page_title_custom',
						),
						'#help' => __('If left Blank the global title will be used.', 'salamander'),
					);
					print Helper::renderElement(array_merge($field, $default_field_data));
				?>
			</div>
			<div class="clear"></div>
			<div class="video-embed-options single-option">
			<?php
			 	$field = array(
					'#type' => 'textarea',
					'#title' => __('Video Embed Code', 'salamander'),
					'#attributes' => array(
						'name' => 'sl_meta_video',
						'id' => 'sl_meta_video',
						'value' => get_post_meta($post->ID, 'sl_meta_video', true),
						'cols' => 60,
						'rows' => 8,
					),
				);
				print Helper::renderElement(array_merge($field, $default_field_data));
		  ?>
			</div>
	  </div><!-- general options end -->
	  <div id="options">
	    <h4><?php _e('Single Post Options', 'salamander'); ?></h4>
	    <div class="single-option">
				<?php
					$field = array(
						'#type' => 'select',
						'#title' => __('Featured images', 'salamander'),
						'#attributes' => array(
							'id' => 'sl_meta_page_featured_images',
							'name' => 'sl_meta_page_featured_images',
						),
						'#default_value' => get_post_meta($post->ID, 'sl_meta_page_featured_images', true),
						'#options' => array(
							'true' => __('Show', 'salamander'),
							'false' => __('Hide', 'salamander'),
						),
						'#help' => __('If you do not want to set a featured image disable it here.', 'salamander'),
					);
					print Helper::renderElement(array_merge($field, $default_field_data));
				?>
			</div>
			<div class="single-option">
				<?php
					$field = array(
						'#type' => 'select',
						'#title' => __('Tags.', 'salamander'),
						'#attributes' => array(
							'id' => 'sl_meta_page_tags',
							'name' => 'sl_meta_page_tags',
						),
						'#default_value' => get_post_meta($post->ID, 'sl_meta_page_tags', true),
						'#options' => array(
							'true' => __('Show', 'salamander'),
							'false' => __('Hide', 'salamander'),
						),
						'#help' => __('Tags could be disabled using this option.', 'salamander'),
					);
					print Helper::renderElement(array_merge($field, $default_field_data));
				?>
			</div>
			<div class="single-option">
				<?php
					$field = array(
						'#type' => 'select',
						'#title' => __('Meta section.', 'salamander'),
						'#attributes' => array(
							'id' => 'sl_meta_page_meta',
							'name' => 'sl_meta_page_meta',
						),
						'#default_value' => get_post_meta($post->ID, 'sl_meta_page_meta', true),
						'#options' => array(
							'true' => __('Show', 'salamander'),
							'false' => __('Hide', 'salamander'),
						),
						'#help' => __('Meta section could be disabled using this option.', 'salamander'),
					);
					print Helper::renderElement(array_merge($field, $default_field_data));
				?>
			</div>
			<div class="single-option">
		    <?php
		    $field = array(
					'#type' => 'select',
					'#title' => __('Show Related Posts.', 'salamander'),
					'#attributes' => array(
						'id' => 'sl_meta_related_posts',
						'name' => 'sl_meta_related_posts',
					),
					'#default_value' => get_post_meta($post->ID, 'sl_meta_related_posts', true),
					'#options' => array(
						'true' => __('Show', 'salamander'),
						'false' => __('Hide', 'salamander'),
					),
				);
				print Helper::renderElement(array_merge($field, $default_field_data));
			?>
		 	</div>
		 	<div class="single-option">
		    <?php
		    $field = array(
					'#type' => 'select',
					'#title' => __('About Author Box.', 'salamander'),
					'#attributes' => array(
						'id' => 'sl_meta_author_box',
						'name' => 'sl_meta_author_box',
					),
					'#default_value' => get_post_meta($post->ID, 'sl_meta_author_box', true),
					'#options' => array(
						'true' => __('Show', 'salamander'),
						'false' => __('Hide', 'salamander'),
					),
					'#help' => __('Disable the about author box here', 'salamander'),
				);
				print Helper::renderElement(array_merge($field, $default_field_data));
			?>
		 	</div>
	  </div><!-- post options end -->
	  <div id="skining">
	  	<div class="single-option">
	    	<?php
	    		$field = array(
						'#type' => 'select',
						'#title' => __('Page layout type.', 'salamander'),
						'#attributes' => array(
							'id' => 'sl_meta_full_width',
							'name' => 'sl_meta_full_width',
						),
						'#default_value' => get_post_meta($post->ID, 'sl_meta_full_width', true),
						'#options' => array(
							'full' => __('Full width', 'salamander'),
							'boxed' => __('Boxed', 'salamander'),
						),
					);
					print Helper::renderElement(array_merge($field, $default_field_data));
				?>
			</div>
			<div class="single-option">
	    	<?php
					$field = array(
						'#type' => 'text',
						'#title' => __('Background Color (Hex Code).', 'salamander'),
						'#attributes' => array(
							'name' => 'sl_meta_page_bg_color',
							'value' => get_post_meta($post->ID, 'sl_meta_page_bg_color', true),
							'id' => 'sl_meta_page_bg_color',
						),
					);
					print Helper::renderElement(array_merge($field, $default_field_data));
					?>
			</div>
			<div class="single-option">
	    	<h5><?php _e('Background Image.', 'salamander'); ?></h5>
					<?php Metaboxes::upload('page_bg', ''); ?>
			</div>
			<div class="single-option">
				<?php
					$field = array(
						'#type' => 'select',
						'#title' => __('100% Background Image.', 'salamander'),
						'#attributes' => array(
							'id' => 'sl_meta_page_bg_full',
							'name' => 'sl_meta_page_bg_full',
						),
						'#default_value' => get_post_meta($post->ID, 'sl_meta_page_bg_full', true),
						'#options' => array(
							'false' => __('No', 'salamander'),
							'true' => __('Yes', 'salamander'),
						),
					);

					print Helper::renderElement(array_merge($field, $default_field_data));
				?>
			</div>
			<div class="single-option">
				<?php
					$field = array(
						'#type' => 'select',
						'#title' => __('Background Repeat.', 'salamander'),
						'#attributes' => array(
							'id' => 'sl_meta_page_bg_repeat',
							'name' => 'sl_meta_page_bg_repeat',
						),
						'#default_value' => get_post_meta($post->ID, 'sl_meta_page_bg_repeat', true),
						'#options' => array(
							'repeat' => __('Tile', 'salamander'),
							'repeat-x' => __('Tile Horizontally', 'salamander'),
							'repeat-y' => __('Tile Vertically', 'salamander'),
							'no-repeat' => __('No Repeat', 'salamander'),
						),
					);

					print Helper::renderElement(array_merge($field, $default_field_data));
					?>
			</div>
			<div class="single-option">
					<?php Metaboxes::upload('page_title_bar_bg', 'Page Title Bar Background'); ?>
					<?php Metaboxes::upload('page_title_bar_bg_retina', 'Page Title Bar Background Retina'); ?>
					<?php
					$field = array(
						'#type' => 'text',
						'#title' => __('Page Title Bar Background Color (Hex Code)', 'salamander'),
						'#attributes' => array(
							'name' => 'sl_meta_page_title_bar_bg_color',
							'value' => get_post_meta($post->ID, 'sl_meta_page_title_bar_bg_color', true),
							'id' => 'sl_meta_page_title_bar_bg_color',
						),
					);
					print Helper::renderElement(array_merge($field, $default_field_data));
					?>
			</div>
			<div class="single-option">
				<?php
					$field = array(
						'#type' => 'text',
						'#title' => __('Featured Image Width.', 'salamander'),
						'#attributes' => array(
							'name' => 'sl_meta_fimg_width',
							'value' => get_post_meta($post->ID, 'sl_meta_fimg_width', true),
							'id' => 'sl_meta_fimg_width',
						),
						'#help' => __('Set in pixels or percentage, e.g.: 100% or 100px.  Or Use "auto" for automatic resizing if you added either width or height', 'salamander'),
					);

					print Helper::renderElement(array_merge($field, $default_field_data));
				?>
			</div>
			<div class="single-option">
				<?php
					$field = array(
						'#type' => 'text',
						'#title' => __('Featured Image Height', 'salamander'),
						'#attributes' => array(
							'name' => 'sl_meta_fimg_height',
							'value' => get_post_meta($post->ID, 'sl_meta_fimg_height', true),
							'id' => 'sl_meta_fimg_height',
						),
						'#help' => 'Set in pixels or percentage, e.g.: 100% or 100px.  Or Use "auto" for automatic resizing if you added either width or height',
					);

					print Helper::renderElement(array_merge($field, $default_field_data));
				?>
			</div>
			<div class="single-option">
				<?php
					$field = array(
						'#type' => 'select',
						'#title' => __('Image Rollover Icons', 'salamander'),
						'#attributes' => array(
							'id' => 'sl_meta_image_rollover_icons',
							'name' => 'sl_meta_image_rollover_icons',
						),
						'#default_value' => get_post_meta($post->ID, 'sl_meta_image_rollover_icons', true),
						'#options' => array(
							'linkzoom' => 'Link + Zoom',
							'link' => 'Link',
							'zoom' => 'Zoom',
							'no' => 'No Icons',
						),
					);
					print Helper::renderElement(array_merge($field, $default_field_data));

					$field = array(
						'#type' => 'text',
						'#title' => __('Link Icon URL', 'salamander'),
						'#attributes' => array(
							'name' => 'sl_meta_link_icon_url',
							'value' => get_post_meta($post->ID, 'sl_meta_link_icon_url', true),
							'id' => 'sl_meta_link_icon_url',
						),
						'#help' => 'Leave blank for post URL',
					);
					print Helper::renderElement(array_merge($field, $default_field_data));
					?>
			</div>
		</div><!-- skining end -->
	  <div id="slides">
	    <h4><?php _e('Slideshow', 'salamander'); ?></h4>
	    <div class="single-option">
	    	<?php

	    		$field = array(
						'#type' => 'select',
						'#title' => __('Slider Type', 'salamander'),
						'#attributes' => array(
							'id' => 'sl_meta_slider_type',
							'name' => 'sl_meta_slider_type',
						),
						'#default_value' => get_post_meta($post->ID, 'sl_meta_slider_type', true),
						'#options' => array(
							'false' => 'No Slider',
							'layer' => 'LayerSlider',
							'flex' => 'FlexSlider',
							'flex2' => 'ThemeFusion Slider',
							'revolution' => 'Revolution Slider',
							'elastic' => 'Elastic Slider',
						),
					);
					print Helper::renderElement(array_merge($field, $default_field_data));

					$slides = array();
					$slides_array[0] = 'Select a slider';
					// Table name
					$table_name = $wpdb->prefix . "layerslider";

					// Get sliders
					$sliders = $wpdb->get_results( "SELECT * FROM $table_name
														WHERE flag_hidden = '0' AND flag_deleted = '0'
														ORDER BY date_c ASC LIMIT 100" );

					if(!empty($sliders)):
						foreach($sliders as $key => $item):
							$slides[$item->id] = '';
						endforeach;
					endif;

					if($slides) :
						foreach($slides as $key => $val) :
							$slides_array[$key] = 'LayerSlider #'.($key);
						endforeach;
					endif;
					Metaboxes::select(	'slider',
									'Select LayerSlider',
									$slides_array,
									''
								);
					?>
					<?php
					$slides_array = array();
					$slides_array[0] = 'Select a slider';
					$slides = get_terms('slide-page');
					if($slides && !isset($slides->errors)){
					$slides = is_array($slides) ? $slides : unserialize($slides);
					foreach($slides as $key => $val){
						$slides_array[$val->slug] = $val->name;
					}
					}
					Metaboxes::select(	'wooslider',
									'Select FlexSlider',
									$slides_array,
									''
								);
					?>
					<?php
					$slides_array = array();
					$slides_array[0] = 'Select a slider';
					$i = 1;
					$data = Salamander::getData();
					while($i <= $data['flexsliders_number']){
						$slides_array['flexslider_'.$i] = 'TFSlider'.$i;
						$i++;
					}
					Metaboxes::select('flexslider', 'Select ThemeFusion Slider', $slides_array, '');
					?>
					<?php
					global $wpdb;
					$get_sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
					$revsliders[0] = 'Select a slider';
					if($get_sliders) {
						foreach($get_sliders as $slider) {
							$revsliders[$slider->alias] = $slider->title;
						}
					}
					Metaboxes::select('revslider',
									'Select Revolution Slider',
									$revsliders,
									''
								);
					?>
					<?php
					$slides_array = array();
					$slides_array[0] = 'Select a slider';
					$slides = get_terms('themefusion_es_groups');
					if($slides && !isset($slides->errors)){
					$slides = is_array($slides) ? $slides : unserialize($slides);
					foreach($slides as $key => $val){
						$slides_array[$val->slug] = $val->name;
					}
					}
					Metaboxes::select(	'elasticslider',
									'Select Elastic Slider',
									$slides_array,
									''
								);
					?>
					<?php Metaboxes::upload('fallback', 'Slider Fallback Image'); ?>
	    </div>
	  </div><!-- slides end -->
  </div>
</div>
