<?php

class ContactInfoWidget extends WP_Widget
{

  public function __construct()
  {
    $widget_ops = array('classname' => 'contact_info', 'description' => '');
    $control_ops = array('id_base' => 'contact-info-widget');
    $this->WP_Widget('contact-info-widget', 'Salamander: Contact Info', $widget_ops, $control_ops);
  }

  public function widget($args, $instance)
  {
    $instance['title'] = apply_filters('widget_title', $instance['title']);
    $params = $args;
    $params['instance'] = $instance;

    print Helper::render(VIEWS_PATH . 'widgets' . DS . 'contact.php', $params);
  }

  public function update($new_instance, $old_instance)
  {
    $instance = $old_instance;

    $instance['title'] = $new_instance['title'];
    $instance['address'] = $new_instance['address'];
    $instance['phone'] = $new_instance['phone'];
    $instance['fax'] = $new_instance['fax'];
    $instance['email'] = $new_instance['email'];
    $instance['emailtxt'] = $new_instance['emailtxt'];
    $instance['web'] = $new_instance['web'];
    $instance['webtxt'] = $new_instance['webtxt'];

    return $instance;
  }

  public function form($instance)
  {
    $defaults = array(
      'title' => 'Contact Info',
      'address' => '',
      'phone' => '',
      'fax' => '',
      'email' => '',
      'emailtxt' => '',
      'web' => '',
      'webtxt' => '',
    );
    $params['instance'] = wp_parse_args((array)$instance, $defaults);
    $params['widget'] = $this;

    print Helper::render(VIEWS_PATH . 'widgets' . DS . 'contact-form.php', $params);
  }
}