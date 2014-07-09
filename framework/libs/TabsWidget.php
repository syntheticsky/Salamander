<?php

class TabsWidget extends WP_Widget {

  private $helper;

  public function __construct()
  {
    $this->helper = Helper::getInstance();
    $widget_ops = array('classname' => 'sl_tabs', 'description' => 'Popular posts, recent post and comments.');

    $control_ops = array('id_base' => 'sl_tabs-widget');

    $this->WP_Widget('sl_tabs-widget', 'Salamander: Tabs', $widget_ops, $control_ops);
  }

  public function widget($args, $instance)
  {
    global $post;

        // extract($args);
    $params = $args;
    $params['posts'] = $instance['posts'];
    $params['comments'] = $instance['comments'];
    $params['tags_count'] = $instance['tags'];
    $params['show_popular_posts'] = isset($instance['show_popular_posts']) ? 'true' : 'false';
    $params['show_recent_posts'] = isset($instance['show_recent_posts']) ? 'true' : 'false';
    $params['show_comments'] = isset($instance['show_comments']) ? 'true' : 'false';
    $params['show_tags'] = isset($instance['show_tags']) ? 'true' : 'false';

    if(!$instance['orderby']) {
      $instance['orderby'] = 'Highest Comments';
    }

    if($instance['orderby'] == 'Highest Comments') {
      $params['order_string'] = '&orderby=comment_count';
    } else {
      $params['order_string'] = '&meta_key=avada_post_views_count&orderby=meta_value_num';
    }

    print $this->helper->render(VIEWS_PATH . 'widgets' . DS . 'tabs.php', $params);
  }

  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;

    $instance['posts'] = $new_instance['posts'];
    $instance['comments'] = $new_instance['comments'];
    $instance['tags'] = $new_instance['tags'];
    $instance['show_popular_posts'] = $new_instance['show_popular_posts'];
    $instance['show_recent_posts'] = $new_instance['show_recent_posts'];
    $instance['show_comments'] = $new_instance['show_comments'];
    $instance['show_tags'] = $new_instance['show_tags'];
    $instance['orderby'] = $new_instance['orderby'];

    return $instance;
  }

  function form($instance)
  {
    $defaults = array(
      'posts' => 3,
      'comments' => '3',
      'tags' => 20,
      'show_popular_posts' => 'on',
      'show_recent_posts' => 'on',
      'show_comments' => 'on',
      'show_tags' => 'on',
      'orderby' => 'Highest Comments',
    );
    $instance = wp_parse_args((array) $instance, $defaults); ?>
    <p>
      <label for="<?php echo $this->get_field_id('orderby'); ?>">Popular Posts Order By:</label>
      <select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" class="widefat" style="width:100%;">
        <option <?php if ('Highest Comments' == $instance['orderby']) echo 'selected="selected"'; ?>>Highest Comments</option>
        <option <?php if ('Highest Views' == $instance['orderby']) echo 'selected="selected"'; ?>>Highest Views</option>
      </select>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('posts'); ?>">Number of popular posts:</label>
      <input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('tags'); ?>">Number of recent posts:</label>
      <input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>" value="<?php echo $instance['tags']; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('comments'); ?>">Number of comments:</label>
      <input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('comments'); ?>" name="<?php echo $this->get_field_name('comments'); ?>" value="<?php echo $instance['comments']; ?>" />
    </p>
    <p>
      <input class="checkbox" type="checkbox" <?php checked($instance['show_popular_posts'], 'on'); ?> id="<?php echo $this->get_field_id('show_popular_posts'); ?>" name="<?php echo $this->get_field_name('show_popular_posts'); ?>" />
      <label for="<?php echo $this->get_field_id('show_popular_posts'); ?>">Show popular posts</label>
    </p>
    <p>
      <input class="checkbox" type="checkbox" <?php checked($instance['show_recent_posts'], 'on'); ?> id="<?php echo $this->get_field_id('show_recent_posts'); ?>" name="<?php echo $this->get_field_name('show_recent_posts'); ?>" />
      <label for="<?php echo $this->get_field_id('show_recent_posts'); ?>">Show recent posts</label>
    </p>
    <p>
      <input class="checkbox" type="checkbox" <?php checked($instance['show_comments'], 'on'); ?> id="<?php echo $this->get_field_id('show_comments'); ?>" name="<?php echo $this->get_field_name('show_comments'); ?>" />
      <label for="<?php echo $this->get_field_id('show_comments'); ?>">Show comments</label>
    </p>
  <?php }
}
