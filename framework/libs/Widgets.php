<?php

class Widgets
{
  public function __construct()
  {
    add_action('widgets_init', array($this, 'loadWidgets'));
  }

  public function loadWidgets()
  {
    register_widget('TabsWidget');
    register_widget('TweetsWidget');
    register_widget('SocialLinksWidget');
    register_widget('ContactInfoWidget');
    register_widget('FacebookLikeWidget');
    register_widget('FlickrWidget');
    register_widget('Ad125x125Widget');
    register_widget('RecentWorksWidget');
  }
}
