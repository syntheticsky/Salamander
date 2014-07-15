<p>
  <label for="<?php echo $widget->get_field_id('orderby'); ?>"><?php _e('Popular Posts Order By', 'salamander'); ?>:</label>
  <select id="<?php echo $widget->get_field_id('orderby'); ?>" name="<?php echo $widget->get_field_name('orderby'); ?>" class="widefat" style="width:100%;">
    <option value="comments" <?php if ('comments' == $instance['orderby']) echo 'selected="selected"'; ?>><?php _e('Highest Comments', 'salamander'); ?></option>
    <option value="views" <?php if ('views' == $instance['orderby']) echo 'selected="selected"'; ?>><?php _e('Highest Views', 'salamander'); ?></option>
  </select>
</p>
<p>
  <label for="<?php echo $widget->get_field_id('posts'); ?>"><?php _e('Number of popular posts', 'salamander'); ?>:</label>
  <input class="widefat" style="width: 30px;" id="<?php echo $widget->get_field_id('posts'); ?>" name="<?php echo $widget->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
</p>
<p>
  <label for="<?php echo $widget->get_field_id('tags'); ?>"><?php _e('Number of recent posts', 'salamander'); ?>:</label>
  <input class="widefat" style="width: 30px;" id="<?php echo $widget->get_field_id('tags'); ?>" name="<?php echo $widget->get_field_name('tags'); ?>" value="<?php echo $instance['tags']; ?>" />
</p>
<p>
  <label for="<?php echo $widget->get_field_id('comments'); ?>"><?php _e('Number of comments', 'salamander'); ?>:</label>
  <input class="widefat" style="width: 30px;" id="<?php echo $widget->get_field_id('comments'); ?>" name="<?php echo $widget->get_field_name('comments'); ?>" value="<?php echo $instance['comments']; ?>" />
</p>
<p>
  <input class="checkbox" type="checkbox" <?php checked($instance['show_popular_posts'], 'on'); ?> id="<?php echo $widget->get_field_id('show_popular_posts'); ?>" name="<?php echo $widget->get_field_name('show_popular_posts'); ?>" />
  <label for="<?php echo $widget->get_field_id('show_popular_posts'); ?>"><?php _e('Show popular posts', 'salamander'); ?></label>
</p>
<p>
  <input class="checkbox" type="checkbox" <?php checked($instance['show_recent_posts'], 'on'); ?> id="<?php echo $widget->get_field_id('show_recent_posts'); ?>" name="<?php echo $widget->get_field_name('show_recent_posts'); ?>" />
  <label for="<?php echo $widget->get_field_id('show_recent_posts'); ?>"><?php _e('Show recent posts', 'salamander'); ?></label>
</p>
<p>
  <input class="checkbox" type="checkbox" <?php checked($instance['show_comments'], 'on'); ?> id="<?php echo $widget->get_field_id('show_comments'); ?>" name="<?php echo $widget->get_field_name('show_comments'); ?>" />
  <label for="<?php echo $widget->get_field_id('show_comments'); ?>"><?php _e('Show comments', 'salamander'); ?></label>
</p>
