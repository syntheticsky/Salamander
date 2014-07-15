<?php
class SocialLinksWidget extends WP_Widget
{
  public function __construct()
  {
    $widget_ops = array('classname' => 'social_links', 'description' => '');
    $control_ops = array('id_base' => 'social-links-widget');
    $this->WP_Widget('social-links-widget', 'Salamander: Social Links', $widget_ops, $control_ops);
  }

  public function widget($args, $instance)
  {
    $params = $args;
    $instance['title'] = apply_filters('widget_title', $instance['title']);
    $params['instance'] = $instance;

    print Helper::render(VIEWS_PATH . 'widgets' . DS . 'social.php', $params);
  }

  public function update($new_instance, $old_instance)
  {
    $instance = $old_instance;

    $instance['title'] = $new_instance['title'];
    $instance['rss_link'] = $new_instance['rss_link'];
    $instance['fb_link'] = $new_instance['fb_link'];
    $instance['twitter_link'] = $new_instance['twitter_link'];
    $instance['dribbble_link'] = $new_instance['dribbble_link'];
    $instance['google_link'] = $new_instance['google_link'];
    $instance['linkedin_link'] = $new_instance['linkedin_link'];
    $instance['blogger_link'] = $new_instance['blogger_link'];
    $instance['tumblr_link'] = $new_instance['tumblr_link'];
    $instance['reddit_link'] = $new_instance['reddit_link'];
    $instance['yahoo_link'] = $new_instance['yahoo_link'];
    $instance['deviantart_link'] = $new_instance['deviantart_link'];
    $instance['vimeo_link'] = $new_instance['vimeo_link'];
    $instance['youtube_link'] = $new_instance['youtube_link'];
    $instance['pinterest_link'] = $new_instance['pinterest_link'];
    $instance['digg_link'] = $new_instance['digg_link'];
    $instance['flickr_link'] = $new_instance['flickr_link'];
    $instance['forrst_link'] = $new_instance['forrst_link'];
    $instance['myspace_link'] = $new_instance['myspace_link'];
    $instance['skype_link'] = $new_instance['skype_link'];

    return $instance;
  }

  function form($instance)
  {
    $defaults = array(
      'title' => 'Get Social',
      'rss_link' => '',
      'fb_link' => '',
      'twitter_link' => '',
      'google_link' => '',
      'dribbble_link' => '',
      'linkedin_link' => '',
      'blogger_link' => '',
      'tumblr_link' => '',
      'reddit_link' => '',
      'yahoo_link' => '',
      'deviantart_link' => '',
      'vimeo_link' => '',
      'youtube_link' => '',
      'pinterest_link' => '',
      'digg_link' => '',
      'flickr_link' => '',
      'forrst_link' => '',
      'myspace_link' => '',
      'skype_link' => '',
    );
    $params['instance'] = wp_parse_args((array) $instance, $defaults);
    $params['widget'] = $this;

    print Helper::render(VIEWS_PATH . 'widgets' . DS . 'social-form.php', $params);
  }
}