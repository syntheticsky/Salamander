<?php

class TabsWidget extends WP_Widget {

  public function __construct()
  {
    $widget_ops = array('classname' => 'sl-tabs', 'description' => __('Popular posts, recent post and comments.', 'salamander'));
    $control_ops = array('id_base' => 'sl-tabs-widget');
    $this->WP_Widget('sl_tabs-widget', 'Salamander: Tabs', $widget_ops, $control_ops);
  }

  public function widget($args, $instance)
  {
    global $post, $wpdb;

    // extract($args);
    $params = $args;
    $params['tags_count'] = $instance['tags'];
    $params['show_popular_posts'] = isset($instance['show_popular_posts']) ? 'true' : 'false';
    $params['show_recent_posts'] = isset($instance['show_recent_posts']) ? 'true' : 'false';
    $params['show_comments'] = isset($instance['show_comments']) ? 'true' : 'false';
    $params['show_tags'] = isset($instance['show_tags']) ? 'true' : 'false';

    if(!$instance['orderby']) {
      $instance['orderby'] = 'comments';
    }

    if($instance['orderby'] == 'comments') {
      $order_string = '&orderby=comment_count';
    } else {
      $order_string = '&meta_key=sl_post_views_count&orderby=meta_value_num';
    }

    $params['popular_posts'] = new WP_Query('showposts=' . $instance['posts'] . $order_string . '&order=DESC');
    $params['recent_posts'] = new WP_Query('showposts=' . $instance['posts']);
    $recent_comments = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,110) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $instance[comments]";
    $params['the_comments'] = $wpdb->get_results($recent_comments);


    print Helper::render(VIEWS_PATH . 'widgets' . DS . 'tabs.php', $params);
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
      'orderby' => 'comments',
    );
    $params['instance'] = wp_parse_args((array) $instance, $defaults);
    $params['widget'] = $this;

    print Helper::render(VIEWS_PATH . 'widgets' . DS . 'tabs-form.php', $params);
  }
}
