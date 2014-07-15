<?php
  print $before_widget;

  if ($instance['title'])
    print $before_title . $instance['title'] . $after_title;
?>
<?php if ($instance['address']) : ?>
  <p class="address"><?php print $instance['address']; ?></p>
<?php endif; ?>
<?php if ($instance['phone']) : ?>
  <p class="phone"><?php _e('Phone:', 'salamander'); ?> <?php print $instance['phone']; ?></p>
<?php endif; ?>
<?php if ($instance['fax']) : ?>
  <p class="fax"><?php _e('Fax:', 'salamander'); ?> <?php print $instance['fax']; ?></p>
<?php endif; ?>
<?php if ($instance['email']) : ?>
  <p class="email">
    <?php _e('Email:', 'salamander'); ?>
    <a href="mailto:<?php print $instance['email']; ?>">
      <?php print ($instance['emailtxt']) ? $instance['emailtxt'] : $instance['email']; ?>
    </a>
  </p>
<?php endif; ?>
<?php if ($instance['web']) : ?>
  <p class="web">
    <?php _e('Web:', 'salamander'); ?>
    <a href="<?php print $instance['web']; ?>">
      <?php print ($instance['webtxt']) ? $instance['webtxt'] : $instance['web']; ?>
    </a>
  </p>
<?php endif; ?>
<?php print $after_widget; ?>