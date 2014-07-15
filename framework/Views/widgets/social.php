<?php
  print $before_widget;
  if($instance['title'])
    print $before_title . $instance['title'] . $after_title;
?>

<ul class="social-networks clearfix">
  <?php if($instance['rss_link']): ?>
    <li class="rss">
      <a class="rss" href="<?php print $instance['rss_link']; ?>">RSS</a>
      <div class="popup">
        <div class="holder">
          <p>RSS</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['fb_link']): ?>
    <li class="facebook">
      <a class="facebook" href="<?php print $instance['fb_link']; ?>">Facebook</a>
      <div class="popup">
        <div class="holder">
          <p>Facebook</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['twitter_link']): ?>
    <li class="twitter">
      <a class="twitter" href="<?php print $instance['twitter_link']; ?>">Twitter</a>
      <div class="popup">
        <div class="holder">
          <p>Twitter</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['dribbble_link']): ?>
    <li class="dribbble">
      <a class="dribbble" href="<?php print $instance['dribbble_link']; ?>">Dribble</a>
      <div class="popup">
        <div class="holder">
          <p>Dribbble</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['google_link']): ?>
    <li class="google">
      <a class="google" href="<?php print $instance['google_link']; ?>">Google</a>
      <div class="popup">
        <div class="holder">
          <p>Google +1</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['linkedin_link']): ?>
    <li class="linkedin">
      <a class="linkedin" href="<?php print $instance['linkedin_link']; ?>">LinkedIn</a>
      <div class="popup">
        <div class="holder">
          <p>LinkedIn</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['blogger_link']): ?>
    <li class="blogger">
      <a class="blogger" href="<?php print $instance['blogger_link']; ?>">Blogger</a>
      <div class="popup">
        <div class="holder">
          <p>Blogger</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['tumblr_link']): ?>
    <li class="tumblr">
      <a class="tumblr" href="<?php print $instance['tumblr_link']; ?>">Tumblr</a>
      <div class="popup">
        <div class="holder">
          <p>Tumblr</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['reddit_link']): ?>
    <li class="reddit">
      <a class="reddit" href="<?php print $instance['reddit_link']; ?>">Reddit</a>
      <div class="popup">
        <div class="holder">
          <p>Reddit</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['yahoo_link']): ?>
    <li class="yahoo">
      <a class="yahoo" href="<?php print $instance['yahoo_link']; ?>">Yahoo</a>
      <div class="popup">
        <div class="holder">
          <p>Yahoo</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['deviantart_link']): ?>
    <li class="deviantart">
      <a class="deviantart" href="<?php print $instance['deviantart_link']; ?>">Deviantart</a>
      <div class="popup">
        <div class="holder">
          <p>DeviantArt</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['vimeo_link']): ?>
    <li class="vimeo">
      <a class="vimeo" href="<?php print $instance['vimeo_link']; ?>">Vimeo</a>
      <div class="popup">
        <div class="holder">
          <p>Vimeo</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['youtube_link']): ?>
    <li class="youtube">
      <a class="youtube" href="<?php print $instance['youtube_link']; ?>">Youtube</a>
      <div class="popup">
        <div class="holder">
          <p>Youtube</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['pinterest_link']): ?>
    <li class="pinterest">
      <a class="pinterest" href="<?php print $instance['pinterest_link']; ?>">Pinterest</a>
      <div class="popup">
        <div class="holder">
          <p>Pinterest</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['digg_link']): ?>
    <li class="digg">
      <a class="digg" href="<?php print $instance['digg_link']; ?>">Digg</a>
      <div class="popup">
        <div class="holder">
          <p>Digg</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['forrst_link']): ?>
    <li class="forrst">
      <a class="forrst" href="<?php print $instance['forrst_link']; ?>">Forrst</a>
      <div class="popup">
        <div class="holder">
          <p>Forrst</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['myspace_link']): ?>
    <li class="myspace">
      <a class="myspace" href="<?php print $instance['myspace_link']; ?>">Myspace</a>
      <div class="popup">
        <div class="holder">
          <p>Myspace</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['skype_link']): ?>
    <li class="skype">
      <a class="skype" href="<?php print $instance['skype_link']; ?>">Skype</a>
      <div class="popup">
        <div class="holder">
          <p>Skype</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
  <?php if($instance['flickr_link']): ?>
    <li class="flickr">
      <a class="flickr" href="<?php print $instance['flickr_link']; ?>">Flickr</a>
      <div class="popup">
        <div class="holder">
          <p>Flickr</p>
        </div>
      </div>
    </li>
  <?php endif; ?>
</ul>
<?php
print $after_widget;
?>