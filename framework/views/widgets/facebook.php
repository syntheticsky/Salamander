<?php
  print $before_widget;
  if($instance['title'])
    print $before_title . $instance['title'] . $after_title;
?>
<?php if($instance['page_url']): ?>
<iframe src="http://www.facebook.com/plugins/likebox.php?href=<?php print urlencode($instance['page_url']); ?>&amp;width=<?php print $instance['width']; ?>&amp;colorscheme=<?php print $instance['color_scheme']; ?>&amp;show_faces=<?php print $instance['show_faces']; ?>&amp;stream=<?php print $instance['show_stream']; ?>&amp;header=<?php print $instance['show_header']; ?>&amp;height=<?php print $instance['height']; ?>&amp;force_wall=true<?php if($instance['show_faces'] == 'true'): ?>&amp;connections=8<?php endif; ?>&amp;show_border=<?php print $instance['border']; ?>" style="border:none; overflow:hidden; width:<?php print $instance['width']; ?>px; height: <?php print $instance['height']; ?>px;" allowTransparency="true"></iframe>
<?php endif; ?>
<?php print $after_widget; ?>