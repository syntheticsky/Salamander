<?php


class FacebookLikeWidget extends WP_Widget {

  function __construct()
  {
    $widget_ops = array('classname' => 'facebook-like', 'description' => __('Adds support for Facebook Like Box.', 'salamander'));
    $control_ops = array('id_base' => 'facebook-like-widget');
    $this->WP_Widget('facebook-like-widget', 'Salamander: Facebook Like Box', $widget_ops, $control_ops);
  }

  function widget($args, $instance)
  {
    extract($args);

    $instance['title'] = apply_filters('widget_title', $instance['title']);

    $instance['show_faces'] = isset($instance['show_faces']) ? 'true' : 'false';
    $instance['show_stream'] = isset($instance['show_stream']) ? 'true' : 'false';
    $instance['show_header'] = isset($instance['show_header']) ? 'true' : 'false';
    $instance['border'] = isset($instance['border']) ? 'true' : 'false';
    $instance['height'] = '65';

    if($instance['show_faces'] == 'true')
    {
      $instance['height'] = '240';
    }

    if($instance['show_stream'] == 'true')
    {
      $instance['height'] = '515';
    }

    if($instance['show_stream'] == 'true' && $instance['show_faces'] == 'true' && $instance['show_header'] == 'true')
    {
      $instance['height'] = '540';
    }

    if($instance['show_stream'] == 'true' && $instance['show_faces'] == 'true' && $instance['show_header'] == 'false')
    {
      $instance['height'] = '540';
    }
    if($instance['show_header'] == 'true') {
      $instance['height'] = $instance['height'] + 30;
    }
    $params = $args;
    $params['instance'] = $instance;

    print Helper::render(VIEWS_PATH . 'widgets' . DS . 'facebook.php', $params);
  }

  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;

    $instance['title'] = strip_tags($new_instance['title']);
    $instance['page_url'] = $new_instance['page_url'];
    $instance['width'] = $new_instance['width'];
    $instance['color_scheme'] = $new_instance['color_scheme'];
    $instance['show_faces'] = $new_instance['show_faces'];
    $instance['show_stream'] = $new_instance['show_stream'];
    $instance['show_header'] = $new_instance['show_header'];
    $instance['border'] = $new_instance['border'];

    return $instance;
  }

  function form($instance)
  {
    $defaults = array(
      'title' => __('Find us on Facebook', 'salamansder'),
      'page_url' => '',
      'width' => '268',
      'color_scheme' => 'light',
      'show_faces' => 'on',
      'show_stream' => false,
      'show_header' => false,
      'border' => false,
    );
    $params['instance'] = wp_parse_args((array) $instance, $defaults);
    $params['widget'] = $this;

    print Helper::render(VIEWS_PATH . 'widgets' . DS . 'facebook-form.php', $params);
  }
}