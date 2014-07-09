<?php echo $before_widget; ?>
<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
  <?php if($show_popular_posts == 'true'): ?>
    <li class="active"><a href="#tab-popular" role="tab" data-toggle="tab"><?php echo __('Popular', 'salamander'); ?></a></li>
  <?php endif; ?>
  <?php if($show_recent_posts == 'true'): ?>
    <li><a href="#tab-recent" role="tab" data-toggle="tab"><?php echo __('Recent', 'salamander'); ?></a></li>
  <?php endif; ?>
  <?php if($show_comments == 'true'): ?>
    <li><a href="#tab-comments" role="tab" data-toggle="tab"><span class="chat-icon"></span></a></li>
  <?php endif; ?>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <?php if($show_popular_posts == 'true'): ?>
    <div id="tab-popular" class="tab tab-pane active">
<?php $popular_posts = new WP_Query('showposts='.$posts.$order_string.'&order=DESC');
      if($popular_posts->have_posts()): ?>
      <ul class="news-list">
        <?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
        <li>
          <?php if(has_post_thumbnail()): ?>
          <div class="image">
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail('tabs-img'); ?>
            </a>
          </div>
          <?php endif; ?>
          <div class="post-holder">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <div class="meta">
              <?php the_time(Salamander::getData('date_format')); ?>
            </div>
          </div>
        </li>
        <?php endwhile; ?>
      </ul>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php if($show_recent_posts == 'true'): ?>
      <div id="tab-recent" class="tab tab-pane">
        <?php
        $recent_posts = new WP_Query('showposts='.$posts);
        if($recent_posts->have_posts()):
        ?>
        <ul class="news-list">
          <?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
          <li>
            <?php if(has_post_thumbnail()): ?>
            <div class="image">
              <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('tabs-img'); ?>
              </a>
            </div>
            <?php endif; ?>
            <div class="post-holder">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              <div class="meta">
                <?php the_time(Salamander::getData('date_format')); ?>
              </div>
            </div>
          </li>
          <?php endwhile; ?>
        </ul>
        <?php endif; ?>
      </div>
      <?php endif; ?>
      <?php if($show_comments == 'true'): ?>
        <div id="tab-comments" class="tab tab_content" style="display: none;">
          <ul class="news-list">
            <?php
            $number = $instance['comments'];
            global $wpdb;
            $recent_comments = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,110) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $number";
            $the_comments = $wpdb->get_results($recent_comments);
            foreach($the_comments as $comment) { ?>
            <li>
              <div class="image">
                <a>
                  <?php echo get_avatar($comment, '52'); ?>
                </a>
              </div>
              <div class="post-holder">
                <p><?php echo strip_tags($comment->comment_author); ?> <?php _e('says', 'Avada'); ?>:</p>
                <div class="meta">
                  <a class="comment-text-side" href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> on <?php echo $comment->post_title; ?>"><?php echo string_limit_words(strip_tags($comment->com_excerpt), 12); ?>...</a>
                </div>
              </div>
            </li>
            <?php } ?>
          </ul>
        </div>
        <?php endif; ?>
  </div>
</div>

<?php echo $after_widget; ?>
