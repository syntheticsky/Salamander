<?php

?>
<p>
  <label for="<?php print $field_id_order; ?>">Popular Posts Order By:</label>
  <select id="<?php print $field_id_order; ?>" name="<?php print $field_name_order; ?>" class="widefat" style="width:100%;">
    <option value="comments" <?php if ('comments' == $orderby) print 'selected="selected"'; ?>>Highest Comments</option>
    <option value="views" <?php if ('views' == $orderby) print 'selected="selected"'; ?>>Highest Views</option>
  </select>
</p>
<p>
  <label for="<?php print $field_id_posts; ?>">Number of popular posts:</label>
  <input class="widefat" style="width: 30px;" id="<?php print $field_id_posts; ?>" name="<?php print $field_name_posts; ?>" value="<?php echo $posts; ?>" />
</p>
<p>
  <label for="<?php print $field_id_tags; ?>">Number of recent posts:</label>
  <input class="widefat" style="width: 30px;" id="<?php print $field_id_tags; ?>" name="<?php print $field_name_tags; ?>" value="<?php echo $tags; ?>" />
</p>
<p>
  <label for="<?php print $field_id_comments; ?>">Number of comments:</label>
  <input class="widefat" style="width: 30px;" id="<?php print $field_id_comments; ?>" name="<?php print $field_name_comments; ?>" value="<?php echo $comments; ?>" />
</p>
<p>
  <input class="checkbox" type="checkbox" <?php checked($show_popular_posts, 'on'); ?> id="<?php print $field_id_show_popular; ?>" name="<?php print $field_name_show_popular; ?>" />
  <label for="<?php print $field_id_show_popular; ?>">Show popular posts</label>
</p>
<p>
  <input class="checkbox" type="checkbox" <?php checked($show_recent_posts, 'on'); ?> id="<?php print $field_id_show_recent; ?>" name="<?php print $field_name_show_recent; ?>" />
  <label for="<?php print $field_id_show_recent; ?>">Show recent posts</label>
</p>
<p>
  <input class="checkbox" type="checkbox" <?php checked($show_comments, 'on'); ?> id="<?php print $field_id_show_comments; ?>" name="<?php print $field_name_show_comments; ?>" />
  <label for="<?php print $field_id_show_comments; ?>">Show comments</label>
</p>
