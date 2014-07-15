<p>
  <label for="<?php print $widget->get_field_id('title'); ?>"><?php _e('Title', 'salamander'); ?> :</label>
  <input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('title'); ?>" name="<?php print $widget->get_field_name('title'); ?>" value="<?php print $instance['title']; ?>" />
</p>

<p>
  <label for="<?php print $widget->get_field_id('page_url'); ?>"><?php _e('Facebook Page URL', 'salamander'); ?> :</label>
  <input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('page_url'); ?>" name="<?php print $widget->get_field_name('page_url'); ?>" value="<?php print $instance['page_url']; ?>" />
</p>

<p>
  <label for="<?php print $widget->get_field_id('width'); ?>"><?php _e('Width', 'salamander'); ?> :</label>
  <input class="widefat" style="width: 60px;" id="<?php print $widget->get_field_id('width'); ?>" name="<?php print $widget->get_field_name('width'); ?>" value="<?php print $instance['width']; ?>" />
</p>

<p>
  <label for="<?php print $widget->get_field_id('color_scheme'); ?>"><?php _e('Color Scheme', 'salamander'); ?> :</label>
  <select id="<?php print $widget->get_field_id('color_scheme'); ?>" name="<?php print $widget->get_field_name('color_scheme'); ?>" class="widefat" style="width:100%;">
    <option <?php if ('light' == $instance['color_scheme']) print 'selected="selected"'; ?>>light</option>
    <option <?php if ('dark' == $instance['color_scheme']) print 'selected="selected"'; ?>>dark</option>
  </select>
</p>

<p>
  <input class="checkbox" type="checkbox" <?php checked($instance['show_faces'], 'on'); ?> id="<?php print $widget->get_field_id('show_faces'); ?>" name="<?php print $widget->get_field_name('show_faces'); ?>" />
  <label for="<?php print $widget->get_field_id('show_faces'); ?>"><?php _e('Show faces', 'salamander'); ?> </label>
</p>

<p>
  <input class="checkbox" type="checkbox" <?php checked($instance['show_stream'], 'on'); ?> id="<?php print $widget->get_field_id('show_stream'); ?>" name="<?php print $widget->get_field_name('show_stream'); ?>" />
  <label for="<?php print $widget->get_field_id('show_stream'); ?>"><?php _e('Show stream', 'salamander'); ?> </label>
</p>

<p>
  <input class="checkbox" type="checkbox" <?php checked($instance['show_header'], 'on'); ?> id="<?php print $widget->get_field_id('show_header'); ?>" name="<?php print $widget->get_field_name('show_header'); ?>" />
  <label for="<?php print $widget->get_field_id('show_header'); ?>"><?php _e('Show facebook header', 'salamander'); ?> </label>
</p>
<p>
  <input class="checkbox" type="checkbox" <?php checked($instance['border'], 'on'); ?> id="<?php print $widget->get_field_id('border'); ?>" name="<?php print $widget->get_field_name('border'); ?>" />
  <label for="<?php print $widget->get_field_id('border'); ?>"><?php _e('Show Boreder', 'salamander'); ?> </label>
</p>