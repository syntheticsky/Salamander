<p><a href="http://dev.twitter.com/apps">Find or Create your Twitter App</a></p>
<p>
  <label for="<?php print $widget->get_field_id('title'); ?>">Title:</label>
  <input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('title'); ?>" name="<?php print $widget->get_field_name('title'); ?>" value="<?php print $instance['title']; ?>" />
</p>

<p>
  <label for="<?php print $widget->get_field_id('consumer_key'); ?>">Consumer Key:</label>
  <input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('consumer_key'); ?>" name="<?php print $widget->get_field_name('consumer_key'); ?>" value="<?php print $instance['consumer_key']; ?>" />
</p>

<p>
  <label for="<?php print $widget->get_field_id('consumer_secret'); ?>">Consumer Secret:</label>
  <input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('consumer_secret'); ?>" name="<?php print $widget->get_field_name('consumer_secret'); ?>" value="<?php print $instance['consumer_secret']; ?>" />
</p>

<p>
  <label for="<?php print $widget->get_field_id('access_token'); ?>">Access Token:</label>
  <input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('access_token'); ?>" name="<?php print $widget->get_field_name('access_token'); ?>" value="<?php print $instance['access_token']; ?>" />
</p>

<p>
  <label for="<?php print $widget->get_field_id('access_token_secret'); ?>">Access Token Secret:</label>
  <input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('access_token_secret'); ?>" name="<?php print $widget->get_field_name('access_token_secret'); ?>" value="<?php print $instance['access_token_secret']; ?>" />
</p>

<p>
  <label for="<?php print $widget->get_field_id('twitter_id'); ?>">Twitter ID:</label>
  <input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('twitter_id'); ?>" name="<?php print $widget->get_field_name('twitter_id'); ?>" value="<?php print $instance['twitter_id']; ?>" />
</p>

<label for="<?php print $widget->get_field_id('count'); ?>">Number of Tweets:</label>
<input class="widefat" style="width: 216px;" id="<?php print $widget->get_field_id('count'); ?>" name="<?php print $widget->get_field_name('count'); ?>" value="<?php print $instance['count']; ?>" />
</p>