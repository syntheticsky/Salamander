<?php get_header(); ?>
<?php print Salamander::getHtml('header'); ?>
	<?php
	$layout_type = $content_css = $sidebar_css = '';
	if(Salamander::getData('layout_type') == 'fluid')
	{
		$layout_type = '-fluid';
	}

	// if(class_exists('Woocommerce')) {
	// 	if(is_cart() || is_checkout() || is_account_page() || is_page(get_option('woocommerce_thanks_page_id'))) {
	// 		$content_css = 'width:100%';
	// 		$sidebar_css = 'display:none';
	// 	}
	// }
	?>
	<div class="container<?php print $layout_type; ?>">
		<div class="row<?php print $layout_type; ?>">
		 		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<?php if(have_posts()): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php global $data; if(!Salamander::getData('featured_images_pages') && has_post_thumbnail()): ?>
			<div class="image">
				<?php the_post_thumbnail('blog-large'); ?>
			</div>
			<?php endif; ?>
			<div class="post-content">
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div>
			<?php if(class_exists('Woocommerce')): ?>
			<?php if(Salamander::getData('comments_pages') && !is_cart() && !is_checkout() && !is_account_page() && !is_page(get_option('woocommerce_thanks_page_id'))): ?>
				<?php wp_reset_query(); ?>
				<?php comments_template(); ?>
			<?php endif; ?>
			<?php else: ?>
			<?php if(Salamander::getData('comments_pages')): ?>
				<?php wp_reset_query(); ?>
				<?php comments_template(); ?>
			<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>

			</div>
		</div>
	</div>
	<aside id="sidebar"><?php $salamander->getSidebar(); ?></aside>
<?php get_footer(); ?>
