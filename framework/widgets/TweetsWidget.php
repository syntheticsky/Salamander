<?php

class TweetsWidget extends WP_Widget {

  public function __construct()
  {
    $widget_ops = array('classname' => 'tweets', 'description' => '');
    $control_ops = array('id_base' => 'tweets-widget');
    $this->WP_Widget('tweets-widget', 'Salamander: Twitter', $widget_ops, $control_ops);
  }

  public function widget($args, $instance)
  {
    $twitter = array();
    $instance['title'] = apply_filters('widget_title', $instance['title']);

    if($instance['twitter_id'] && $instance['consumer_key'] && $instance['consumer_secret'] && $instance['access_token'] && $instance['access_token_secret'] && $instance['count']) {
      $transName = 'list_tweets_' . $args['widget_id'];
      $cacheTime = 10;
      delete_transient($transName);
      if (false === ($twitterData = get_transient($transName))) {
        // require the twitter auth class
        @require_once WIDGETS_PATH . 'twitteroauth/twitteroauth.php';

        $twitterConnection = new TwitterOAuth(
          $instance['consumer_key'], // Consumer Key
          $instance['consumer_secret'], // Consumer secret
          $instance['access_token'], // Access token
          $instance['access_token_secret'] // Access token secret
        );
        $twitterData = $twitterConnection->get(
          'statuses/user_timeline',
          array(
            'screen_name' => $instance['twitter_id'],
            'count' => $instance['count'],
            'exclude_replies' => false
          )
        );
        if ($twitterConnection->http_code != 200) {
          $twitterData = get_transient($transName);
        }

        // Save our new transient.
        set_transient($transName, $twitterData, 60 * $cacheTime);
      };
      $twitter = get_transient($transName);
    }

    $params = $args;
    $params['twitter'] = $twitter;
    $params['instance'] = $instance;
    print Helper::render(VIEWS_PATH . 'widgets' . DS . 'tweets.php', $params);
  }

  public static function ago($time)
  {
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60","60","24","7","4.35","12","10");

    $now = time();

    $difference = $now - $time;
    $tense = __('ago', 'salamander');

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++)
    {
      $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if($difference != 1)
    {
      $periods[$j].= "s";
    }

    return "$difference $periods[$j] $tense ";
  }

  public function update($new_instance, $old_instance)
  {
    $instance = $old_instance;

    $instance['title'] = strip_tags($new_instance['title']);
    $instance['consumer_key'] = $new_instance['consumer_key'];
    $instance['consumer_secret'] = $new_instance['consumer_secret'];
    $instance['access_token'] = $new_instance['access_token'];
    $instance['access_token_secret'] = $new_instance['access_token_secret'];
    $instance['twitter_id'] = $new_instance['twitter_id'];
    $instance['count'] = $new_instance['count'];

    return $instance;
  }

  public function form($instance)
  {
    $defaults = array(
      'title' => 'Recent Tweets',
      'consumer_key' => '',
      'consumer_secret' => '',
      'access_token' => '',
      'access_token_secret' => '',
      'twitter_id' => '',
      'count' => 3);

    $params['instance'] = wp_parse_args((array) $instance, $defaults);
    $params['widget'] = $this;

    print Helper::render(VIEWS_PATH . 'widgets' . DS . 'tweets-form.php', $params);
  }
}