<?php

?>
<p>
  <label for="<?php echo $this->get_field_id('orderby'); ?>">Popular Posts Order By:</label>
  <select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" class="widefat" style="width:100%;">
    <option <?php if ('Highest Comments' == $orderby) echo 'selected="selected"'; ?>>Highest Comments</option>
    <option <?php if ('Highest Views' == $orderby) echo 'selected="selected"'; ?>>Highest Views</option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('posts'); ?>">Number of popular posts:</label>
  <input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $posts; ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('tags'); ?>">Number of recent posts:</label>
  <input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>" value="<?php echo $tags; ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('comments'); ?>">Number of comments:</label>
  <input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('comments'); ?>" name="<?php echo $this->get_field_name('comments'); ?>" value="<?php echo $comments; ?>" />
</p>
<p>
  <input class="checkbox" type="checkbox" <?php checked($show_popular_posts, 'on'); ?> id="<?php echo $this->get_field_id('show_popular_posts'); ?>" name="<?php echo $this->get_field_name('show_popular_posts'); ?>" />
  <label for="<?php echo $this->get_field_id('show_popular_posts'); ?>">Show popular posts</label>
</p>
<p>
  <input class="checkbox" type="checkbox" <?php checked($show_recent_posts, 'on'); ?> id="<?php echo $this->get_field_id('show_recent_posts'); ?>" name="<?php echo $this->get_field_name('show_recent_posts'); ?>" />
  <label for="<?php echo $this->get_field_id('show_recent_posts'); ?>">Show recent posts</label>
</p>
<p>
  <input class="checkbox" type="checkbox" <?php checked($show_comments, 'on'); ?> id="<?php echo $this->get_field_id('show_comments'); ?>" name="<?php echo $this->get_field_name('show_comments'); ?>" />
  <label for="<?php echo $this->get_field_id('show_comments'); ?>">Show comments</label>
</p>
