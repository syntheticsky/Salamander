<p>
  <label for="<?php print $widget->get_field_id('title'); ?>"><?php _e('Title', 'salamander'); ?>:</label>
  <input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('title'); ?>"
         name="<?php print $widget->get_field_name('title'); ?>" value="<?php print $instance['title']; ?>"/>
</p>
<p>
  <label for="<?php print $widget->get_field_id('address'); ?>"><?php _e('Address', 'salamander'); ?>:</label>
  <input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('address'); ?>"
         name="<?php print $widget->get_field_name('address'); ?>" value="<?php print $instance['address']; ?>"/>
</p>
<p>
  <label for="<?php print $widget->get_field_id('phone'); ?>"><?php _e('Phone', 'salamander'); ?>:</label>
  <input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('phone'); ?>"
         name="<?php print $widget->get_field_name('phone'); ?>" value="<?php print $instance['phone']; ?>"/>
</p>
<p>
  <label for="<?php print $widget->get_field_id('fax'); ?>"><?php _e('Fax', 'salamander'); ?>:</label>
  <input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('fax'); ?>"
         name="<?php print $widget->get_field_name('fax'); ?>" value="<?php print $instance['fax']; ?>"/>
</p>
<p>
  <label for="<?php print $widget->get_field_id('email'); ?>"><?php _e('Email', 'salamander'); ?>:</label>
  <input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('email'); ?>"
         name="<?php print $widget->get_field_name('email'); ?>" value="<?php print $instance['email']; ?>"/>
</p>
<p>
  <label for="<?php print $widget->get_field_id('emailtxt'); ?>"><?php _e('Email Link Text', 'salamander'); ?>:</label>
  <input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('emailtxt'); ?>"
         name="<?php print $widget->get_field_name('emailtxt'); ?>" value="<?php print $instance['emailtxt']; ?>"/>
</p>
<p>
  <label for="<?php print $widget->get_field_id('web'); ?>"><?php _e('Website URL (with HTTP)', 'salamander'); ?>:</label>
  <input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('web'); ?>"
         name="<?php print $widget->get_field_name('web'); ?>" value="<?php print $instance['web']; ?>"/>
</p>
<p>
  <label for="<?php print $widget->get_field_id('webtxt'); ?>"><?php _e('Website URL Text', 'salamander'); ?>:</label>
  <input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('webtxt'); ?>"
         name="<?php print $widget->get_field_name('webtxt'); ?>" value="<?php print $instance['webtxt']; ?>"/>
</p>