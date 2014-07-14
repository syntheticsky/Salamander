
<div class="twitter-box">
  <div class="twitter-holder">
    <div class="b">
      <div class="tweets-container" id="tweets_<?php echo $widget_id; ?>">
        <ul id="jtwt">
          <?php foreach($twitter as $tweet): ?>
            <li class="jtwt_tweet">
              <p class="jtwt_tweet_text">
                <?php
                $latestTweet = $tweet->text;
                $latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet);
                $latestTweet = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet);
                echo $latestTweet;
                ?>
              </p>
              <?php
              $twitterTime = strtotime($tweet->created_at);
              $timeAgo = $this->ago($twitterTime);
              ?>
              <a href="http://twitter.com/<?php echo $tweet->user->screen_name; ?>/statuses/<?php echo $tweet->id_str; ?>" class="jtwt_date"><?php echo $timeAgo; ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
  <span class="arrow"></span>
</div>