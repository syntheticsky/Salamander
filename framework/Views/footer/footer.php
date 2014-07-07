<?php if (Salamander::getData('footer_widgets')) : ?>
<div class="container footer-widgets">
  <section class="columns columns-<?php print Salamander::getData('footer_widgets_columns'); ?>">
    <article class="col">
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 1')):
          endif; ?>
    </article>

    <article class="col">
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 2')):
          endif; ?>
    </article>

    <article class="col">
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 3')):
          endif; ?>
    </article>

    <article class="col last">
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 4')):
          endif; ?>
    </article>
  </section>
</div>
<?php endif; ?>
<?php if (Salamander::getData('footer_copyright')): ?>
<div class="container footer-social">
<?php if (Salamander::getData('icons_footer')): ?>
  <?php $target = Salamander::getData('icons_footer_new') ? '_blank' : '_self'; ?>
<ul class="social-networks">
  <?php if (Salamander::getData('facebook_link')): ?>
  <li class="facebook"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('facebook_link'); ?>">Facebook</a>
    <div class="popup">
      <div class="holder">
        <p>Facebook</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('twitter_link')): ?>
  <li class="twitter"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('twitter_link'); ?>">Twitter</a>
    <div class="popup">
      <div class="holder">
        <p>Twitter</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('linkedin_link')): ?>
  <li class="linkedin"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('linkedin_link'); ?>">LinkedIn</a>
    <div class="popup">
      <div class="holder">
        <p>LinkedIn</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('rss_link')): ?>
  <li class="rss"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('rss_link'); ?>">RSS</a>
    <div class="popup">
      <div class="holder">
        <p>RSS</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('dribbble_link')): ?>
  <li class="dribbble"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('dribbble_link'); ?>">Dribbble</a>
    <div class="popup">
      <div class="holder">
        <p>Dribbble</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('youtube_link')): ?>
  <li class="youtube"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('youtube_link'); ?>">Youtube</a>
    <div class="popup">
      <div class="holder">
        <p>Youtube</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('pinterest_link')): ?>
  <li class="pinterest"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('pinterest_link'); ?>" class="pinterest">Pinterest</a>
    <div class="popup">
      <div class="holder">
        <p>Pinterest</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('flickr_link')): ?>
  <li class="flickr"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('flickr_link'); ?>" class="flickr">Flickr</a>
    <div class="popup">
      <div class="holder">
        <p>Flickr</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('vimeo_link')): ?>
  <li class="vimeo"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('vimeo_link'); ?>" class="vimeo">Vimeo</a>
    <div class="popup">
      <div class="holder">
        <p>Vimeo</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('tumblr_link')): ?>
  <li class="tumblr"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('tumblr_link'); ?>" class="tumblr">Tumblr</a>
    <div class="popup">
      <div class="holder">
        <p>Tumblr</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('google_link')): ?>
  <li class="google"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('google_link'); ?>" class="google">Google+</a>
    <div class="popup">
      <div class="holder">
        <p>Google</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('digg_link')): ?>
  <li class="digg"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('digg_link'); ?>" class="digg">Digg</a>
    <div class="popup">
      <div class="holder">
        <p>Digg</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('blogger_link')): ?>
  <li class="blogger"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('blogger_link'); ?>" class="blogger">Blogger</a>
    <div class="popup">
      <div class="holder">
        <p>Blogger</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('skype_link')): ?>
  <li class="skype"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('skype_link'); ?>" class="skype">Skype</a>
    <div class="popup">
      <div class="holder">
        <p>Skype</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('myspace_link')): ?>
  <li class="myspace"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('myspace_link'); ?>" class="myspace">Myspace</a>
    <div class="popup">
      <div class="holder">
        <p>Myspace</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('deviantart_link')): ?>
  <li class="deviantart"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('deviantart_link'); ?>" class="deviantart">Deviantart</a>
    <div class="popup">
      <div class="holder">
        <p>Deviantart</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('yahoo_link')): ?>
  <li class="yahoo"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('yahoo_link'); ?>" class="yahoo">Yahoo</a>
    <div class="popup">
      <div class="holder">
        <p>Yahoo</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('reddit_link')): ?>
  <li class="reddit"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('reddit_link'); ?>" class="reddit">Reddit</a>
    <div class="popup">
      <div class="holder">
        <p>Reddit</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('forrst_link')): ?>
  <li class="forrst"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('forrst_link'); ?>" class="forrst">Forrst</a>
    <div class="popup">
      <div class="holder">
        <p>Forrst</p>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <?php if(Salamander::getData('custom_icon_name') && Salamander::getData('custom_icon_link') && Salamander::getData('custom_icon_image')): ?>
  <li class="custom"><a target="<?php print $target; ?>" href="<?php print Salamander::getData('custom_icon_link'); ?>"><img src="<?php print Salamander::getData('custom_icon_image'); ?>" alt="<?php print Salamander::getData('custom_icon_name'); ?>" /></a>
    <div class="popup">
      <div class="holder">
        <p><?php print Salamander::getData('custom_icon_name'); ?></p>
      </div>
    </div>
  </li>
  <?php endif; ?>
</ul>
<?php endif; ?>
  <ul class="copyright">
    <li><?php print Salamander::getData('footer_text') ?></li>
  </ul>
</div>
<?php endif; ?>
