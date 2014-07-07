<?php get_header(); ?>
<?php print Salamander::getHtml('header'); ?>
<?php
	$content_css = $sidebar_css = '';
?>
	<div class="container<?php print Salamander::layout_type('data'); ?>">
		 	<div class="row<?php print Salamander::layout_type('data'); ?>">
		 		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<?php if(Salamander::getData('blog_layout') == 'Timeline'): ?>
		<div class="timeline-icon"><i class="icon-comments-alt"></i></div>
		<?php endif; ?>
		<div id="posts-container" class="clearfix">
			<?php
			$post_count = 1;

			$prev_post_timestamp = null;
			$prev_post_month = null;
			$first_timeline_loop = false;

			while(have_posts()): the_post();
				$post_timestamp = strtotime($post->post_date);
				$post_month = date('n', $post_timestamp);
				$post_year = get_the_date('o');
				$current_date = get_the_date('o-n');
			?>
			<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
				<?php if(Salamander::getData('blog_layout') == 'Timeline'): ?>
				<?php if(is_null($prev_post_month )): ?>
					<h3 class="timeline-title"><?php echo get_the_date('F Y'); ?></h3>
				<?php elseif($prev_post_month != $post_month): ?>
					<h3 class="timeline-title"><?php echo get_the_date('F Y'); ?></h3>
				<?php endif; ?>
				<?php endif; ?>

				<?php if(Salamander::getData('blog_layout') == 'Medium Alternate'): ?>
				<div class="date-and-formats">
					<div class="date-box">
						<span class="date"><?php the_time('j'); ?></span>
						<span class="month-year"><?php the_time('m, Y'); ?></span>
					</div>
					<div class="format-box">
						<?php
						switch(get_post_format()) {
							case 'gallery':
								$format_class = 'camera-retro';
								break;
							case 'link':
								$format_class = 'link';
								break;
							case 'image':
								$format_class = 'picture';
								break;
							case 'quote':
								$format_class = 'quote-left';
								break;
							case 'video':
								$format_class = 'film';
								break;
							case 'audio':
								$format_class = 'headphones';
								break;
							case 'chat':
								$format_class = 'comments-alt';
								break;
							default:
								$format_class = 'book';
								break;
						}
						?>
						<i class="icon-<?php echo $format_class; ?>"></i>
					</div>
				</div>
				<?php endif; ?>
				<?php
				if(Salamander::getData('featured_images')):
				if(Salamander::getData('legacy_posts_slideshow')) {
					get_template_part('legacy-slideshow');
				} else {
					get_template_part('new-slideshow');
				}
				endif;
				?>
				<div class="post-content-container">
					<?php if(Salamander::getData('blog_layout') == 'Timeline'): ?>
					<div class="timeline-circle"></div>
					<div class="timeline-arrow"></div>
					<?php endif; ?>
					<?php if(Salamander::getData('blog_layout') != 'Large' && Salamander::getData('blog_layout') != 'Medium Alternate' && Salamander::getData('blog_layout') != 'Grid'  && Salamander::getData('blog_layout') != 'Timeline'): ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php endif; ?>
					<?php if(Salamander::getData('blog_layout') == 'Large'): ?>
					<div class="date-and-formats">
						<div class="date-box">
							<span class="date"><?php the_time('j'); ?></span>
							<span class="month-year"><?php the_time('m, Y'); ?></span>
						</div>
						<div class="format-box">
							<?php
							switch(get_post_format()) {
								case 'gallery':
									$format_class = 'camera-retro';
									break;
								case 'link':
									$format_class = 'link';
									break;
								case 'image':
									$format_class = 'picture';
									break;
								case 'quote':
									$format_class = 'quote-left';
									break;
								case 'video':
									$format_class = 'film';
									break;
								case 'audio':
									$format_class = 'headphones';
									break;
								case 'chat':
									$format_class = 'comments-alt';
									break;
								default:
									$format_class = 'book';
									break;
							}
							?>
							<i class="icon-<?php echo $format_class; ?>"></i>
						</div>
					</div>
					<?php endif; ?>
					<div class="post-content">
						<?php if(Salamander::getData('blog_layout') == 'Large' || Salamander::getData('blog_layout') == 'Medium'  || Salamander::getData('blog_layout') == 'Grid' || Salamander::getData('blog_layout') == 'Timeline'): ?>
						<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php if(Salamander::getData('post_meta')): ?>
						<?php if(Salamander::getData('blog_layout') == 'Grid' || Salamander::getData('blog_layout') == 'Timeline'): ?>
						<p class="single-line-meta"><?php if(!Salamander::getData('post_meta_author')): ?><?php echo __('By', 'salamander'); ?> <?php the_author_posts_link(); ?><span class="sep">|</span><?php endif; ?><?php if(!Salamander::getData('post_meta_date')): ?><?php the_time(Salamander::getData('date_format')); ?><span class="sep">|</span><?php endif; ?></p>
						<?php else: ?>
						<p class="single-line-meta"><?php if(!Salamander::getData('post_meta_author')): ?><?php echo __('By', 'salamander'); ?> <?php the_author_posts_link(); ?><span class="sep">|</span><?php endif; ?><?php if(!Salamander::getData('post_meta_date')): ?><?php the_time(Salamander::getData('date_format')); ?><span class="sep">|</span><?php endif; ?><?php if(!Salamander::getData('post_meta_cats')): ?><?php the_category(', '); ?><span class="sep">|</span><?php endif; ?><?php if(!Salamander::getData('post_meta_comments')): ?><?php comments_popup_link(__('0 Comments', 'salamander'), __('1 Comment', 'salamander'), '% '.__('Comments', 'salamander')); ?><span class="sep">|</span><?php endif; ?></p>
						<?php endif; ?>
						<?php endif; ?>
						<?php endif; ?>
						<div class="content-sep"></div>
						<?php
						if(Salamander::getData('content_length') == 'Excerpt') {
							// $stripped_content = tf_content( Salamander::getData('excerpt_length_blog'), Salamander::getData('strip_html_excerpt') );
							// echo $stripped_content;
							the_excerpt();
						} else {
							the_content('');
						}
						?>
					</div>
					<div style="clear:both;"></div>
					<?php if(Salamander::getData('post_meta')): ?>
					<div class="meta-info">
						<?php if(Salamander::getData('blog_layout') == 'Grid' || Salamander::getData('blog_layout') == 'Timeline'): ?>
						<?php if(Salamander::getData('blog_layout') != 'Large' && Salamander::getData('blog_layout') != 'Medium'): ?>
						<div class="alignleft">
							<?php if(!Salamander::getData('post_meta_read')): ?><a href="<?php the_permalink(); ?>" class="read-more"><?php echo __('Read More', 'salamander'); ?></a><?php endif; ?>
						</div>
						<?php endif; ?>
						<div class="alignright">
							<?php if(!Salamander::getData('post_meta_comments')): ?><?php comments_popup_link('<i class="icon-comments"></i>&nbsp;'.__('0', 'salamander'), '<i class="icon-comments"></i>&nbsp;'.__('1', 'salamander'), '<i class="icon-comments"></i>&nbsp;'.'%'); ?><?php endif; ?>
						</div>
						<?php else: ?>
						<?php if(Salamander::getData('blog_layout') != 'Large' && Salamander::getData('blog_layout') != 'Medium'): ?>
						<div class="alignleft">
							<?php if(!Salamander::getData('post_meta_author')): ?><?php echo __('By', 'salamander'); ?> <?php the_author_posts_link(); ?><span class="sep">|</span><?php endif; ?><?php if(!Salamander::getData('post_meta_date')): ?><?php the_time(Salamander::getData('date_format')); ?><span class="sep">|</span><?php endif; ?><?php if(!Salamander::getData('post_meta_cats')): ?><?php the_category(', '); ?><span class="sep">|</span><?php endif; ?><?php if(!Salamander::getData('post_meta_comments')): ?><?php comments_popup_link(__('0 Comments', 'salamander'), __('1 Comment', 'salamander'), '% '.__('Comments', 'salamander')); ?><span class="sep">|</span><?php endif; ?>
						</div>
						<?php endif; ?>
						<div class="alignright">
							<?php if(!Salamander::getData('post_meta_read')): ?><a href="<?php the_permalink(); ?>" class="read-more"><?php echo __('Read More', 'salamander'); ?></a><?php endif; ?>
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php
			$prev_post_timestamp = $post_timestamp;
			$prev_post_month = $post_month;
			$post_count++;
			endwhile;
			?>
		</div>
		<?php //themefusion_pagination($pages = '', $range = 2); ?>
			</div>
		</div>
	</div>
	<?php wp_reset_query(); ?>
<?php get_footer(); ?>
