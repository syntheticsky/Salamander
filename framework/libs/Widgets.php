<?php

class Widgets
{
  function __construct()
  {
    add_action('widgets_init', array($this, 'loadWidgets'));
  }

  function loadWidgets()
  {
    register_widget('TabsWidget');
    register_widget('TweetsWidget');
    register_widget('SocialLinksWidget');
  }
}
