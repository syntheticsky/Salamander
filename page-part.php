<!--
            <?php $related = get_related_posts($post->ID); ?>
            <?php if ($related->have_posts() && get_post_meta($post->ID, 'sl_meta_related_posts', true) != false) : ?>
            <div class="related-posts single-related-posts">
              <div class="title"><h2><?php echo __('Related Posts', 'Avada'); ?></h2><div class="title-sep-container"><div class="title-sep"></div></div></div>
              <div id="carousel" class="es-carousel-wrapper">
                <div class="es-carousel">
                  <ul>
                    <?php while($related->have_posts()): $related->the_post(); ?>
                    <?php if(has_post_thumbnail()): ?>
                    <li>
                      <div class="image">
                          <?php if(Salamander::getData('image_rollover')): ?>
                          <?php the_post_thumbnail('related-img'); ?>
                          <?php else: ?>
                          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('related-img'); ?></a>
                          <?php endif; ?>
                          <?php
                          if(get_post_meta($post->ID, 'sl_meta_image_rollover_icons', true) == 'link') {
                            $link_icon_css = 'display:inline-block;';
                            $zoom_icon_css = 'display:none;';
                          } elseif(get_post_meta($post->ID, 'sl_meta_image_rollover_icons', true) == 'zoom') {
                            $link_icon_css = 'display:none;';
                            $zoom_icon_css = 'display:inline-block;';
                          } elseif(get_post_meta($post->ID, 'sl_meta_image_rollover_icons', true) == false) {
                            $link_icon_css = 'display:none;';
                            $zoom_icon_css = 'display:none;';
                          } else {
                            $link_icon_css = 'display:inline-block;';
                            $zoom_icon_css = 'display:inline-block;';
                          }

                          $icon_url_check = get_post_meta(get_the_ID(), 'sl_meta_link_icon_url', true); if(!empty($icon_url_check)) {
                            $icon_permalink = get_post_meta($post->ID, 'sl_meta_link_icon_url', true);
                          } else {
                            $icon_permalink = get_permalink($post->ID);
                          }
                          ?>
                          <div class="image-extras">
                            <div class="image-extras-content">
                    <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                    <a style="<?php echo $link_icon_css; ?>" class="icon link-icon" href="<?php echo $icon_permalink; ?>">Permalink</a>
                    <?php
                    if(get_post_meta($post->ID, 'sl_meta_video_url', true)) {
                      $full_image[0] = get_post_meta($post->ID, 'sl_meta_video_url', true);
                    }
                    ?>
                    <a style="<?php echo $zoom_icon_css; ?>" class="icon gallery-icon" href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery]">Gallery</a>
                              <h3><?php the_title(); ?></h3>
                            </div>
                          </div>
                      </div>
                    </li>
                    <?php endif; endwhile; ?>
                  </ul>
                </div>
                <div class="es-nav"><span class="es-nav-prev">Previous</span><span class="es-nav-next">Next</span></div>
              </div>
            </div>
            <?php endif; ?>
          -->
