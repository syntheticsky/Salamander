<style type="text/css">
  <?php if($data['primary_color']): ?>
  a:hover,
  #nav ul .current_page_item a, #nav ul .current-menu-item a, #nav ul > .current-menu-parent a,
  .footer-area ul li a:hover,
  .side-nav li.current_page_item a,
  .portfolio-tabs li.active a, .faq-tabs li.active a,
  .project-content .project-info .project-info-box a:hover,
  .about-author .title a,
  span.dropcap,.footer-area a:hover,.copyright a:hover,
  #sidebar .widget_categories li a:hover,
  #main .post h2 a:hover,
  #sidebar .widget li a:hover,
  #nav ul a:hover,
  .date-and-formats .format-box i,
  h5.toggle:hover a,
  .tooltip-shortcode,.content-box-percentage,
  .more a:hover:after,.read-more:hover:after,.pagination-prev:hover:before,.pagination-next:hover:after,
  .single-navigation a[rel=prev]:hover:before,.single-navigation a[rel=next]:hover:after,
  #sidebar .widget_nav_menu li a:hover:before,#sidebar .widget_categories li a:hover:before,
  #sidebar .widget .recentcomments:hover:before,#sidebar .widget_recent_entries li a:hover:before,
  #sidebar .widget_archive li a:hover:before,#sidebar .widget_pages li a:hover:before,
  #sidebar .widget_links li a:hover:before,.side-nav .arrow:hover:after{
    color:<?php echo $data['primary_color']; ?> !important;
  }
  #nav ul .current_page_item a, #nav ul .current-menu-item a, #nav ul > .current-menu-parent a,
  #nav ul ul,#nav li.current-menu-ancestor a,
  .reading-box,
  .portfolio-tabs li.active a, .faq-tabs li.active a,
  .tab-holder .tabs li.active a,
  .post-content blockquote,
  .progress-bar-content,
  .pagination .current,
  .pagination a.inactive:hover,
  #nav ul a:hover{
    border-color:<?php echo $data['primary_color']; ?> !important;
  }
  .side-nav li.current_page_item a{
    border-right-color:<?php echo $data['primary_color']; ?> !important;
  }
  .header-v2 .header-social, .header-v3 .header-social, .header-v4 .header-social,.header-v5 .header-social,.header-v2{
    border-top-color:<?php echo $data['primary_color']; ?> !important;
  }
  h5.toggle.active span.arrow,
  .post-content ul.circle-yes li:before,
  .progress-bar-content,
  .pagination .current,
  .header-v3 .header-social,.header-v4 .header-social,.header-v5 .header-social,
  .date-and-formats .date-box,.table-2 table thead{
    background-color:<?php echo $data['primary_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['header_bg_color']): ?>
  #header,#small-nav{
    background-color:<?php echo $data['header_bg_color']; ?> !important;
  }
  #nav ul a{
    border-color:<?php echo $data['header_bg_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['content_bg_color']): ?>
  #main,#wrapper{
    background-color:<?php echo $data['content_bg_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['footer_bg_color']): ?>
  .footer-area{
    background-color:<?php echo $data['footer_bg_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['footer_border_color']): ?>
  .footer-area{
    border-color:<?php echo $data['footer_border_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['copyright_bg_color']): ?>
  #footer{
    background-color:<?php echo $data['copyright_bg_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['copyright_border_color']): ?>
  #footer{
    border-color:<?php echo $data['copyright_border_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['pricing_box_color']): ?>
  .sep-boxed-pricing ul li.title-row{
    background-color:<?php echo $data['pricing_box_color']; ?> !important;
    border-color:<?php echo $data['pricing_box_color']; ?> !important;
  }
  .pricing-row .exact_price, .pricing-row sup{
    color:<?php echo $data['pricing_box_color']; ?> !important;
  }
  <?php endif; ?>
  <?php if($data['image_gradient_top_color'] && $data['image_gradient_bottom_color']): ?>
  <?php
  $imgr_gtop = avada_hex2rgb($data['image_gradient_top_color']);
  $imgr_gbot = avada_hex2rgb($data['image_gradient_bottom_color']);
  if($data['image_rollover_opacity']) {
    $opacity = $data['image_rollover_opacity'];
  } else{
    $opacity = '1';
  }
  $imgr_gtop_string = 'rgba('.$imgr_gtop[0].','.$imgr_gtop[1].','.$imgr_gtop[2].','.$opacity.')';
  $imgr_gbot_string = 'rgba('.$imgr_gbot[0].','.$imgr_gbot[1].','.$imgr_gbot[2].','.$opacity.')';
  ?>
  .image .image-extras{
    background-image: linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);
    background-image: -o-linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);
    background-image: -moz-linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);
    background-image: -webkit-linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);
    background-image: -ms-linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);

    background-image: -webkit-gradient(
      linear,
      left top,
      left bottom,
      color-stop(0, <?php echo $imgr_gtop_string; ?>),
      color-stop(1, <?php echo $imgr_gbot_string; ?>)
    );

    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $data['image_gradient_top_color']; ?>', endColorstr='<?php echo $data['image_gradient_bottom_color']; ?>');
  }
  .no-cssgradients .image .image-extras{
    background:<?php echo $data['image_gradient_top_color']; ?>;
  }
  <?php endif; ?>
  <?php if($data['button_gradient_top_color'] && $data['button_gradient_bottom_color'] && $data['button_gradient_text_color']): ?>
  #main .reading-box .button,
  #main .continue.button,
  #main .portfolio-one .button,
  #main .comment-submit,
  .button.default{
    color: <?php echo $data['button_gradient_text_color']; ?> !important;
    background-image: linear-gradient(top, <?php echo $data['button_gradient_top_color']; ?> 0%, <?php echo $data['button_gradient_bottom_color']; ?> 100%);
    background-image: -o-linear-gradient(top, <?php echo $data['button_gradient_top_color']; ?> 0%, <?php echo $data['button_gradient_bottom_color']; ?> 100%);
    background-image: -moz-linear-gradient(top, <?php echo $data['button_gradient_top_color']; ?> 0%, <?php echo $data['button_gradient_bottom_color']; ?> 100%);
    background-image: -webkit-linear-gradient(top, <?php echo $data['button_gradient_top_color']; ?> 0%, <?php echo $data['button_gradient_bottom_color']; ?> 100%);
    background-image: -ms-linear-gradient(top, <?php echo $data['button_gradient_top_color']; ?> 0%, <?php echo $data['button_gradient_bottom_color']; ?> 100%);

    background-image: -webkit-gradient(
      linear,
      left top,
      left bottom,
      color-stop(0, <?php echo $data['button_gradient_top_color']; ?>),
      color-stop(1, <?php echo $data['button_gradient_bottom_color']; ?>)
    );
    border:1px solid <?php echo $data['button_gradient_bottom_color']; ?>;

    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $data['button_gradient_top_color']; ?>', endColorstr='<?php echo $data['button_gradient_bottom_color']; ?>');
  }
  .no-cssgradients #main .reading-box .button,
  .no-cssgradients #main .continue.button,
  .no-cssgradients #main .portfolio-one .button,
  .no-cssgradients #main .comment-submit,
  .no-cssgradients .button.default{
    background:<?php echo $data['button_gradient_top_color']; ?>;
  }
  #main .reading-box .button:hover,
  #main .continue.button:hover,
  #main .portfolio-one .button:hover,
  #main .comment-submit:hover,
  .button.default:hover{
    color: <?php echo $data['button_gradient_text_color']; ?> !important;
    background-image: linear-gradient(top, <?php echo $data['button_gradient_bottom_color']; ?> 0%, <?php echo $data['button_gradient_top_color']; ?> 100%);
    background-image: -o-linear-gradient(top, <?php echo $data['button_gradient_bottom_color']; ?> 0%, <?php echo $data['button_gradient_top_color']; ?> 100%);
    background-image: -moz-linear-gradient(top, <?php echo $data['button_gradient_bottom_color']; ?> 0%, <?php echo $data['button_gradient_top_color']; ?> 100%);
    background-image: -webkit-linear-gradient(top, <?php echo $data['button_gradient_bottom_color']; ?> 0%, <?php echo $data['button_gradient_top_color']; ?> 100%);
    background-image: -ms-linear-gradient(top, <?php echo $data['button_gradient_bottom_color']; ?> 0%, <?php echo $data['button_gradient_top_color']; ?> 100%);

    background-image: -webkit-gradient(
      linear,
      left top,
      left bottom,
      color-stop(0, <?php echo $data['button_gradient_bottom_color']; ?>),
      color-stop(1, <?php echo $data['button_gradient_top_color']; ?>)
    );
    border:1px solid <?php echo $data['button_gradient_bottom_color']; ?>;

    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $data['button_gradient_bottom_color']; ?>', endColorstr='<?php echo $data['button_gradient_top_color']; ?>');
  }
  .no-cssgradients #main .reading-box .button:hover,
  .no-cssgradients #main .continue.button:hover,
  .no-cssgradients #main .portfolio-one .button:hover,
  .no-cssgradients #main .comment-submit:hover,
  .no-cssgradients .button.default{
    background:<?php echo $data['button_gradient_bottom_color']; ?>;
  }
  <?php endif; ?>

  <?php
  if((get_option('show_on_front') && get_option('page_for_posts') && is_home()) ||
    (get_option('page_for_posts') && is_archive() && !is_post_type_archive())) {
    $c_pageID = get_option('page_for_posts');
  } else {
    $c_pageID = $post->ID;
  }
  ?>

  <?php if($data['layout'] == 'Boxed'): ?>
  body{
    <?php if(get_post_meta($c_pageID, 'pyre_page_bg_color', true)): ?>
    background-color:<?php echo get_post_meta($c_pageID, 'pyre_page_bg_color', true); ?>;
    <?php else: ?>
    background-color:<?php echo $data['bg_color']; ?>;
    <?php endif; ?>

    <?php if(get_post_meta($c_pageID, 'pyre_page_bg', true)): ?>
    background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_page_bg', true); ?>);
    background-repeat:<?php echo get_post_meta($c_pageID, 'pyre_page_bg_repeat', true); ?>;
      <?php if(get_post_meta($c_pageID, 'pyre_page_bg_full', true) == 'yes'): ?>
      background-attachment:fixed;
      background-position:center center;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      <?php endif; ?>
    <?php elseif($data['bg_image']): ?>
    background-image:url(<?php echo $data['bg_image']; ?>);
    background-repeat:<?php echo $data['bg_repeat']; ?>;
      <?php if($data['bg_full']): ?>
      background-attachment:fixed;
      background-position:center center;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      <?php endif; ?>
    <?php endif; ?>

    <?php if($data['bg_pattern_option'] && $data['bg_pattern'] && !(get_post_meta($c_pageID, 'pyre_page_bg_color', true) || get_post_meta($c_pageID, 'pyre_page_bg', true))): ?>
    background-image:url("<?php echo get_bloginfo('template_directory') . '/images/patterns/' . $data['bg_pattern'] . '.png'; ?>");
    background-repeat:repeat;
    <?php endif; ?>
  }
  #wrapper{
    background:#fff;
    width:1000px;
    margin:0 auto;
  }
  @media only screen and (min-width: 801px) and (max-width: 1014px){
    #wrapper{
      width:auto;
    }
  }
  @media only screen and (min-device-width: 801px) and (max-device-width: 1014px){
    #wrapper{
      width:auto;
    }
  }
  <?php endif; ?>

  <?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg', true)): ?>
  .page-title-container{
    background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_page_title_bar_bg', true); ?>) !important;
  }
  <?php elseif($data['page_title_bg']): ?>
  .page-title-container{
    background-image:url(<?php echo $data['page_title_bg']; ?>) !important;
  }
  <?php endif; ?>

  <?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg_color', true)): ?>
  .page-title-container{
    background-color:<?php echo get_post_meta($c_pageID, 'pyre_page_title_bar_bg_color', true); ?>;
  }
  <?php elseif($data['page_title_bg_color']): ?>
  .page-title-container{
    background-color:<?php echo $data['page_title_bg_color']; ?>;
  }
  <?php endif; ?>

  <?php if($data['page_title_border_color']): ?>
  .page-title-container{border-color:<?php echo $data['page_title_border_color']; ?> !important;}
  <?php endif; ?>

  #header{
    <?php if($data['header_bg_image']): ?>
    background-image:url(<?php echo $data['header_bg_image']; ?>);
    background-repeat:<?php echo $data['header_bg_repeat']; ?>;
      <?php if($data['header_bg_full']): ?>
      background-attachment:fixed;
      background-position:center center;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      <?php endif; ?>
    <?php endif; ?>
  }

  #main{
    <?php if($data['content_bg_image']): ?>
    background-image:url(<?php echo $data['content_bg_image']; ?>);
    background-repeat:<?php echo $data['content_bg_repeat']; ?>;
      <?php if($data['content_bg_full']): ?>
      background-attachment:fixed;
      background-position:center center;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      <?php endif; ?>
    <?php endif; ?>
  }

  <?php if($data['icon_circle_color']): ?>
  .fontawesome-icon.circle-yes{
    background-color:<?php echo $data['icon_circle_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['icon_border_color']): ?>
  .fontawesome-icon.circle-yes{
    border-color:<?php echo $data['icon_border_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['icon_color']): ?>
  .fontawesome-icon{
    color:<?php echo $data['icon_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['title_border_color']): ?>
  .title-sep{
    border-color:<?php echo $data['title_border_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['testimonial_bg_color']): ?>
  .review blockquote q,.post-content blockquote{
    background-color:<?php echo $data['testimonial_bg_color']; ?> !important;
  }
  .review blockquote div:after{
    border-top-color:<?php echo $data['testimonial_bg_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['testimonial_text_color']): ?>
  .review blockquote q,.post-content blockquote{
    color:<?php echo $data['testimonial_text_color']; ?> !important;
  }
  <?php endif; ?>

  <?php
  if(
    $data['custom_font_woff'] && $data['custom_font_ttf'] &&
    $data['custom_font_svg'] && $data['custom_font_eot']
  ):
  ?>
  @font-face {
    font-family: 'MuseoSlab500Regular';
    src: url('<?php echo $data['custom_font_eot']; ?>');
    src:
      url('<?php echo $data['custom_font_eot']; ?>?#iefix') format('eot'),
      url('<?php echo $data['custom_font_woff']; ?>') format('woff'),
      url('<?php echo $data['custom_font_ttf']; ?>') format('truetype'),
      url('<?php echo $data['custom_font_svg']; ?>#MuseoSlab500Regular') format('svg');
      font-weight: 400;
      font-style: normal;
  }
  <?php $custom_font = true; endif; ?>

  <?php
  if($data['google_body'] != 'Select Font') {
    $font = '"'.$data['google_body'].'", Arial, Helvetica, sans-serif !important';
  } elseif($data['standard_body'] != 'Select Font') {
    $font = $data['standard_body'].' !important';
  }
  ?>

  body,#nav ul li ul li a,
  .more,
  .avada-container h3,
  .meta .date,
  .review blockquote q,
  .review blockquote div strong,
  .image .image-extras .image-extras-content h4,
  .project-content .project-info h4,
  .post-content blockquote,
  .button.large,
  .button.small,
  .ei-title h3{
    font-family:<?php echo $font; ?>;
  }
  .avada-container h3,
  .review blockquote div strong,
  .footer-area  h3,
  .button.large,
  .button.small{
    font-weight:bold;
  }
  .meta .date,
  .review blockquote q,
  .post-content blockquote{
    font-style:italic;
  }

  <?php
  if(!$custom_font && $data['google_nav'] != 'Select Font') {
    $nav_font = '"'.$data['google_nav'].'", Arial, Helvetica, sans-serif !important';
  } elseif(!$custom_font && $data['standard_nav'] != 'Select Font') {
    $nav_font = $data['standard_nav'].' !important';
  }
  if(isset($nav_font)):
  ?>

  #nav,
  .side-nav li a{
    font-family:<?php echo $nav_font; ?>;
  }
  <?php endif; ?>

  <?php
  if(!$custom_font && $data['google_headings'] != 'Select Font') {
    $headings_font = '"'.$data['google_headings'].'", Arial, Helvetica, sans-serif !important';
  } elseif(!$custom_font && $data['standard_headings'] != 'Select Font') {
    $headings_font = $data['standard_headings'].' !important';
  }
  if(isset($headings_font)):
  ?>

  #main .reading-box h2,
  #main h2,
  .page-title h1,
  .image .image-extras .image-extras-content h3,
  #main .post h2,
  #sidebar .widget h3,
  .tab-holder .tabs li a,
  .share-box h4,
  .project-content h3,
  h5.toggle a,
  .full-boxed-pricing ul li.title-row,
  .full-boxed-pricing ul li.pricing-row,
  .sep-boxed-pricing ul li.title-row,
  .sep-boxed-pricing ul li.pricing-row,
  .person-author-wrapper,
  .post-content h1, .post-content h2, .post-content h3, .post-content h4, .post-content h5, .post-content h6,
  .ei-title h2, #header .tagline,
  table th{
    font-family:<?php echo $headings_font; ?>;
  }
  <?php endif; ?>

  <?php
  if($data['google_footer_headings'] != 'Select Font') {
    $font = '"'.$data['google_footer_headings'].'", Arial, Helvetica, sans-serif !important';
  } elseif($data['standard_footer_headings'] != 'Select Font') {
    $font = $data['standard_footer_headings'].' !important';
  }
  ?>

  .footer-area  h3{
    font-family:<?php echo $font; ?>;
  }

  <?php if($data['body_font_size']): ?>
  body,#sidebar .slide-excerpt h2, .footer-area .slide-excerpt h2{
    font-size:<?php echo $data['body_font_size']; ?>px;
    <?php
    $line_height = round((1.5 * $data['body_font_size']));
    ?>
    line-height:<?php echo $line_height; ?>px;
  }
  .project-content .project-info h4{
    font-size:<?php echo $data['body_font_size']; ?>px !important;
    <?php
    $line_height = round((1.5 * $data['body_font_size']));
    ?>
    line-height:<?php echo $line_height; ?>px !important;
  }
  <?php endif; ?>

  <?php if($data['body_font_lh']): ?>
  body,#sidebar .slide-excerpt h2, .footer-area .slide-excerpt h2{
    line-height:<?php echo $data['body_font_lh']; ?>px !important;
  }
  .project-content .project-info h4{
    line-height:<?php echo $data['body_font_lh']; ?>px !important;
  }
  <?php endif; ?>

  <?php if($data['nav_font_size']): ?>
  #nav{font-size:<?php echo $data['nav_font_size']; ?>px !important;}
  <?php endif; ?>

  <?php if($data['snav_font_size']): ?>
  .header-social *{font-size:<?php echo $data['snav_font_size']; ?>px !important;}
  <?php endif; ?>

  <?php if($data['breadcrumbs_font_size']): ?>
  .page-title ul li,page-title ul li a{font-size:<?php echo $data['breadcrumbs_font_size']; ?>px !important;}
  <?php endif; ?>

  <?php if($data['side_nav_font_size']): ?>
  .side-nav li a{font-size:<?php echo $data['side_nav_font_size']; ?>px !important;}
  <?php endif; ?>

  <?php if($data['sidew_font_size']): ?>
  #sidebar .widget h3{font-size:<?php echo $data['sidew_font_size']; ?>px !important;}
  <?php endif; ?>

  <?php if($data['footw_font_size']): ?>
  .footer-area h3{font-size:<?php echo $data['footw_font_size']; ?>px !important;}
  <?php endif; ?>

  <?php if($data['copyright_font_size']): ?>
  .copyright{font-size:<?php echo $data['copyright_font_size']; ?>px !important;}
  <?php endif; ?>

  <?php if($data['responsive']): ?>
  #header .avada-row, #main .avada-row, .footer-area .avada-row, #footer .avada-row{ max-width:940px; }
  <?php endif; ?>

  <?php if($data['h1_font_size']): ?>
  .post-content h1{
    font-size:<?php echo $data['h1_font_size']; ?>px !important;
    <?php
    $line_height = round((1.5 * $data['h1_font_size']));
    ?>
    line-height:<?php echo $line_height; ?>px !important;
  }
  <?php endif; ?>

  <?php if($data['h1_font_lh']): ?>
  .post-content h1{
    line-height:<?php echo $data['h1_font_lh']; ?>px !important;
  }
  <?php endif; ?>

  <?php if($data['h2_font_size']): ?>
  .post-content h2,.title h2,#main .post-content .title h2,.page-title h1,#main .post h2 a{
    font-size:<?php echo $data['h2_font_size']; ?>px !important;
    <?php
    $line_height = round((1.5 * $data['h2_font_size']));
    ?>
    line-height:<?php echo $line_height; ?>px !important;
  }
  <?php endif; ?>

  <?php if($data['h2_font_lh']): ?>
  .post-content h2,.title h2,#main .post-content .title h2,.page-title h1,#main .post h2 a{
    line-height:<?php echo $data['h2_font_lh']; ?>px !important;
  }
  <?php endif; ?>

  <?php if($data['h3_font_size']): ?>
  .post-content h3,.project-content h3,#header .tagline{
    font-size:<?php echo $data['h3_font_size']; ?>px !important;
    <?php
    $line_height = round((1.5 * $data['h3_font_size']));
    ?>
    line-height:<?php echo $line_height; ?>px !important;
  }
  <?php endif; ?>

  <?php if($data['h3_font_lh']): ?>
  .post-content h3,.project-content h3,#header .tagline{
    line-height:<?php echo $data['h3_font_lh']; ?>px !important;
  }
  <?php endif; ?>

  <?php if($data['h4_font_size']): ?>
  .post-content h4{
    font-size:<?php echo $data['h4_font_size']; ?>px !important;
    <?php
    $line_height = round((1.5 * $data['h4_font_size']));
    ?>
    line-height:<?php echo $line_height; ?>px !important;
  }
  h5.toggle a,.tab-holder .tabs li a,.share-box h4,.person-author-wrapper{
    font-size:<?php echo $data['h4_font_size']; ?>px !important;
  }
  <?php endif; ?>

  <?php if($data['h4_font_lh']): ?>
  .post-content h4{
    line-height:<?php echo $data['h4_font_lh']; ?>px !important;
  }
  <?php endif; ?>

  <?php if($data['h5_font_size']): ?>
  .post-content h5{
    font-size:<?php echo $data['h5_font_size']; ?>px !important;
    <?php
    $line_height = round((1.5 * $data['h5_font_size']));
    ?>
    line-height:<?php echo $line_height; ?>px !important;
  }
  <?php endif; ?>

  <?php if($data['h5_font_lh']): ?>
  .post-content h5{
    line-height:<?php echo $data['h5_font_lh']; ?>px !important;
  }
  <?php endif; ?>

  <?php if($data['h6_font_size']): ?>
  .post-content h6{
    font-size:<?php echo $data['h6_font_size']; ?>px !important;
    <?php
    $line_height = round((1.5 * $data['h6_font_size']));
    ?>
    line-height:<?php echo $line_height; ?>px !important;
  }
  <?php endif; ?>

  <?php if($data['h6_font_lh']): ?>
  .post-content h6{
    line-height:<?php echo $data['h6_font_lh']; ?>px !important;
  }
  <?php endif; ?>

  <?php if($data['es_title_font_size']): ?>
  .ei-title h2{
    font-size:<?php echo $data['es_title_font_size']; ?>px !important;
    <?php
    $line_height = round((1.5 * $data['es_title_font_size']));
    ?>
    line-height:<?php echo $line_height; ?>px !important;
  }
  <?php endif; ?>

  <?php if($data['es_caption_font_size']): ?>
  .ei-title h3{
    font-size:<?php echo $data['es_caption_font_size']; ?>px !important;
    <?php
    $line_height = round((1.5 * $data['es_caption_font_size']));
    ?>
    line-height:<?php echo $line_height; ?>px !important;
  }
  <?php endif; ?>

  <?php if($data['body_text_color']): ?>
  body,.post .post-content,.post-content blockquote,.tab-holder .news-list li .post-holder .meta,#sidebar #jtwt,.meta,.review blockquote div,.search input,.project-content .project-info h4,.title-row{color:<?php echo $data['body_text_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['h1_color']): ?>
  .post-content h1,.title h1{
    color:<?php echo $data['h1_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['h2_color']): ?>
  .post-content h2,.title h2{
    color:<?php echo $data['h2_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['h3_color']): ?>
  .post-content h3,#sidebar .widget h3,.project-content h3,.title h3,#header .tagline,.person-author-wrapper span{
    color:<?php echo $data['h3_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['h4_color']): ?>
  .post-content h4,.project-content .project-info h4,.share-box h4,.title h4{
    color:<?php echo $data['h4_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['h5_color']): ?>
  .post-content h5,h5.toggle a,.title h5{
    color:<?php echo $data['h5_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['h6_color']): ?>
  .post-content h6,.title h6{
    color:<?php echo $data['h6_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['page_title_color']): ?>
  .page-title h1{
    color:<?php echo $data['page_title_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['headings_color']): ?>
  /*.post-content h1, .post-content h2, .post-content h3,
  .post-content h4, .post-content h5, .post-content h6,
  #sidebar .widget h3,h5.toggle a,
  .page-title h1,.full-boxed-pricing ul li.title-row,
  .project-content .project-info h4,.project-content h3,.share-box h4,.title h2,.person-author-wrapper,#sidebar .tab-holder .tabs li a,#header .tagline,
  .table-1 table th{
    color:<?php echo $data['headings_color']; ?> !important;
  }*/
  <?php endif; ?>

  <?php if($data['link_color']): ?>
  body a,.project-content .project-info .project-info-box a,#sidebar .widget li a, #sidebar .widget .recentcomments, #sidebar .widget_categories li, #main .post h2 a{color:<?php echo $data['link_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['breadcrumbs_text_color']): ?>
  .page-title ul li,.page-title ul li a{color:<?php echo $data['breadcrumbs_text_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['footer_headings_color']): ?>
  .footer-area h3{color:<?php echo $data['footer_headings_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['footer_text_color']): ?>
  .footer-area,.footer-area #jtwt,.copyright{color:<?php echo $data['footer_text_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['footer_link_color']): ?>
  .footer-area a,.copyright a{color:<?php echo $data['footer_link_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['menu_first_color']): ?>
  #nav ul a,.side-nav li a{color:<?php echo $data['menu_first_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['menu_sub_bg_color']): ?>
  #nav ul ul{background-color:<?php echo $data['menu_sub_bg_color']; ?>;}
  <?php endif; ?>

  <?php if($data['menu_sub_color']): ?>
  #wrapper #nav ul li ul li a,.side-nav li li a,.side-nav li.current_page_item li a{color:<?php echo $data['menu_sub_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['es_title_color']): ?>
  .ei-title h2{color:<?php echo $data['es_title_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['es_caption_color']): ?>
  .ei-title h3{color:<?php echo $data['es_caption_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['snav_color']): ?>
  #wrapper .header-social *{color:<?php echo $data['snav_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['sep_color']): ?>
  .sep-single{background-color:<?php echo $data['sep_color']; ?> !important;}
  .sep-double,.sep-dashed,.sep-dotted{border-color:<?php echo $data['sep_color']; ?> !important;}
  .ls-avada, .avada-skin-rev,.clients-carousel .es-carousel li,h5.toggle a,.progress-bar,
  #small-nav,.portfolio-tabs,.faq-tabs,.single-navigation,.project-content .project-info .project-info-box,
  .post .meta-info,.grid-layout .post,.grid-layout .post .content-sep,
  .grid-layout .post .flexslider,.timeline-layout .post,.timeline-layout .post .content-sep,
  .timeline-layout .post .flexslider,h3.timeline-title,.timeline-arrow,
  .counter-box-wrapper,.table-2 table thead,.table-2 tr td,
  #sidebar .widget li a,#sidebar .widget .recentcomments,#sidebar .widget_categories li,
  .tab-holder,.commentlist .the-comment,
  .side-nav,.side-nav li a,h5.toggle.active + .toggle-content,
  .side-nav li.current_page_item li a,.tabs-vertical .tabset,
  .tabs-vertical .tabs-container .tab_content,.page-title-container,.pagination a.inactive{border-color:<?php echo $data['sep_color']; ?>;}
  .side-nav li a{border-color:<?php echo $data['sep_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['form_bg_color']): ?>
  input#s,#comment-input input,#comment-textarea textarea{background-color:<?php echo $data['form_bg_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['form_text_color']): ?>
  input#s,input#s,.placeholder,#comment-input input,#comment-textarea textarea,#comment-input .placeholder,#comment-textarea .placeholder{color:<?php echo $data['form_text_color']; ?> !important;}
  input#s::webkit-input-placeholder,#comment-input input::-webkit-input-placeholder,#comment-textarea textarea::-webkit-input-placeholder{color:<?php echo $data['form_text_color']; ?> !important;}
  input#s:moz-placeholder,#comment-input input:-moz-placeholder,#comment-textarea textarea:-moz-placeholder{color:<?php echo $data['form_text_color']; ?> !important;}
  input#s:-ms-input-placeholder,#comment-input input:-ms-input-placeholder,#comment-textarea textarea:-moz-placeholder{color:<?php echo $data['form_text_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['form_border_color']): ?>
  input#s,#comment-input input,#comment-textarea textarea{border-color:<?php echo $data['form_border_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['menu_sub_sep_color']): ?>
  #wrapper #nav ul li ul li a{border-bottom:1px solid <?php echo $data['menu_sub_sep_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['menu_bg_hover_color']): ?>
  #wrapper #nav ul li ul li a:hover, #wrapper #nav ul li ul li.current-menu-item a{background-color:<?php echo $data['menu_bg_hover_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['tagline_font_color']): ?>
  #header .tagline{
    color:<?php echo $data['tagline_font_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['tagline_font_size']): ?>
  #header .tagline{
    font-size:<?php echo $data['tagline_font_size']; ?>px !important;
    line-height:30px !important;
  }
  <?php endif; ?>

  <?php if($data['page_title_font_size']): ?>
  .page-title h1{
    font-size:<?php echo $data['page_title_font_size']; ?>px !important;
    line-height:normal !important;
  }
  <?php endif; ?>

  <?php if($data['header_border_color']): ?>
  .header-social,#header{
    border-bottom-color:<?php echo $data['header_border_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['dropdown_menu_width']): ?>
  #nav ul ul{
    width:<?php echo $data['dropdown_menu_width']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['page_title_height']): ?>
  .page-title-container{
    height:<?php echo $data['page_title_height']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['sidebar_bg_color']): ?>
  #main #sidebar{
    background-color:<?php echo $data['sidebar_bg_color']; ?>;
  }
  <?php endif; ?>

  <?php if($data['content_width']): ?>
  #main #content{
    width:<?php echo $data['content_width']; ?>%;
  }
  <?php endif; ?>

  <?php if($data['sidebar_width']): ?>
  #main #sidebar{
    width:<?php echo $data['sidebar_width']; ?>%;
  }
  <?php endif; ?>

  <?php if($data['sidebar_padding']): ?>
  #main #sidebar{
    padding-left:<?php echo $data['sidebar_padding']; ?>%;
    padding-right:<?php echo $data['sidebar_padding']; ?>%;
  }
  <?php endif; ?>

  <?php if($data['header_top_bg_color']): ?>
  #wrapper .header-social{
    background-color:<?php echo $data['header_top_bg_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['header_top_first_border_color']): ?>
  #wrapper .header-social .menu > li{
    border-color:<?php echo $data['header_top_first_border_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['header_top_sub_bg_color']): ?>
  #wrapper .header-social .menu .sub-menu{
    background-color:<?php echo $data['header_top_sub_bg_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['header_top_menu_sub_color']): ?>
  #wrapper .header-social .menu .sub-menu li, #wrapper .header-social .menu .sub-menu li a{
    color:<?php echo $data['header_top_menu_sub_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['header_top_menu_bg_hover_color']): ?>
  #wrapper .header-social .menu .sub-menu li a:hover{
    background-color:<?php echo $data['header_top_menu_bg_hover_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['header_top_menu_sub_hover_color']): ?>
  #wrapper .header-social .menu .sub-menu li a:hover{
    color:<?php echo $data['header_top_menu_sub_hover_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['header_top_menu_sub_sep_color']): ?>
  #wrapper .header-social .menu .sub-menu,#wrapper .header-social .menu .sub-menu li{
    border-color:<?php echo $data['header_top_menu_sub_sep_color']; ?> !important;
  }
  <?php endif; ?>

  <?php if($data['accordian_inactive_color']): ?>
  h5.toggle span.arrow{background-color:<?php echo $data['accordian_inactive_color']; ?>;}
  <?php endif; ?>

  <?php if($data['counter_filled_color']): ?>
  .progress-bar-content{background-color:<?php echo $data['counter_filled_color']; ?> !important;border-color:<?php echo $data['counter_filled_color']; ?> !important;}
  .content-box-percentage{color:<?php echo $data['counter_filled_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['counter_unfilled_color']): ?>
  .progress-bar{background-color:<?php echo $data['counter_unfilled_color']; ?>;border-color:<?php echo $data['counter_unfilled_color']; ?>;}
  <?php endif; ?>

  <?php if($data['arrow_color']): ?>
  .more a:after,.read-more:after,#sidebar .widget_nav_menu li a:before,#sidebar .widget_categories li a:before,
  #sidebar .widget .recentcomments:before,#sidebar .widget_recent_entries li a:before,
  #sidebar .widget_archive li a:before,#sidebar .widget_pages li a:before,
  #sidebar .widget_links li a:before,.side-nav .arrow:after,.single-navigation a[rel=prev]:before,
  .single-navigation a[rel=next]:after,.pagination-prev:before,
  .pagination-next:after{color:<?php echo $data['arrow_color']; ?> !important;}
  <?php endif; ?>

  <?php if($data['dates_box_color']): ?>
  .date-and-formats .format-box{background-color:<?php echo $data['dates_box_color']; ?>;}
  <?php endif; ?>

  <?php if($data['carousel_nav_color']): ?>
  .es-nav-prev,.es-nav-next{background-color:<?php echo $data['carousel_nav_color']; ?>;}
  <?php endif; ?>

  <?php if($data['carousel_hover_color']): ?>
  .es-nav-prev:hover,.es-nav-next:hover{background-color:<?php echo $data['carousel_hover_color']; ?>;}
  <?php endif; ?>

  <?php if($data['content_box_bg_color']): ?>
  .content-boxes .col{background-color:<?php echo $data['content_box_bg_color']; ?>;}
  <?php endif; ?>

  <?php if($data['tabs_bg_color'] && $data['tabs_inactive_color']): ?>
  #sidebar .tab-holder,#sidebar .tab-holder .news-list li{border-color:<?php echo $data['tabs_inactive_color']; ?> !important;}
  .pyre_tabs .tabs-container{background-color:<?php echo $data['tabs_bg_color']; ?> !important;}
  body.dark #sidebar .tab-hold .tabs li{border-right:1px solid <?php echo $data['tabs_bg_color']; ?> !important;}
  body.dark #sidebar .tab-hold .tabs li a{background:<?php echo $data['tabs_inactive_color']; ?> !important;border-bottom:0 !important;color:<?php echo $data[body_text_color]; ?> !important;}
  body.dark #sidebar .tab-hold .tabs li a:hover{background:<?php echo $data['tabs_bg_color']; ?> !important;border-bottom:0 !important;}
  body #sidebar .tab-hold .tabs li.active a{background:<?php echo $data['tabs_bg_color']; ?> !important;border-bottom:0 !important;}
  body #sidebar .tab-hold .tabs li.active a{border-top-color:<?php echo $data[primary_color]; ?>!important;}
  <?php endif; ?>

  <?php if($data['social_bg_color']): ?>
  .share-box{background-color:<?php echo $data['social_bg_color']; ?>;}
  <?php endif; ?>

  <?php if($data['timeline_color']): ?>
  .grid-layout .post .flexslider,.timeline-layout .post,.timeline-layout .post .content-sep,
  .timeline-layout .post .flexslider,h3.timeline-title,.grid-layout .post,.grid-layout .post .content-sep{border-color:<?php echo $data['timeline_color']; ?> !important;}
  .align-left .timeline-arrow:before,.align-left .timeline-arrow:after{border-left-color:<?php echo $data['timeline_color']; ?> !important;}
  .align-right .timeline-arrow:before,.align-right .timeline-arrow:after{border-right-color:<?php echo $data['timeline_color']; ?> !important;}
  .timeline-circle,.timeline-title{background-color:<?php echo $data['timeline_color']; ?> !important;}
  .timeline-icon{color:<?php echo $data['timeline_color']; ?>;}
  <?php endif; ?>

  <?php if($data['scheme_type'] == 'Dark'): $avada_color_scheme = 'dark'; ?>
  .meta li{border-color:<?php echo $data['body_text_color']; ?>;}
  .error-image{background-image:url(<?php echo get_template_directory_uri(); ?>/images/404_image_dark.png);}
  .review blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user_dark.png);}
  .review.male blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user_dark.png);}
  .review.female blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user-girl_dark.png);}
  .timeline-layout{background-image:url(<?php echo get_template_directory_uri(); ?>/images/timeline_line_dark.png);}
  .side-nav li a{background-image:url(<?php echo get_template_directory_uri(); ?>/images/side_nav_bg_dark.png);}
  @media only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 13/10), only screen and (min-resolution: 120dpi) {
    .error-image{background-image:url(<?php echo get_template_directory_uri(); ?>/images/404_image_dark@2x.png) !important;}
    .review blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user_dark@2x.png) !important;}
    .review.male blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user_dark@2x.png) !important;}
    .review.female blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user-girl_dark@2x.png) !important;}
    .side-nav li a{background-image:url(<?php echo get_template_directory_uri(); ?>/images/side_nav_bg_dark@2x.png) !important;}
  }
  <?php endif; ?>

  <?php if(is_single() && get_post_meta($c_pageID, 'pyre_fimg_width', true)): ?>
  <?php if(get_post_meta($c_pageID, 'pyre_fimg_width', true) != 'auto' && get_post_meta($c_pageID, 'pyre_width', true) != 'half'): ?>
  #post-<?php echo $c_pageID; ?> .post-slideshow {width:<?php echo get_post_meta($c_pageID, 'pyre_fimg_width', true); ?> !important;}
  <?php else: ?>
  .post-slideshow .flex-control-nav{position:relative;text-align:left;margin-top:10px;}
  <?php endif; ?>
  #post-<?php echo $c_pageID; ?> .post-slideshow img{width:<?php echo get_post_meta($c_pageID, 'pyre_fimg_width', true); ?> !important;}
  <?php endif; ?>

  <?php if(is_single() && get_post_meta($c_pageID, 'pyre_fimg_height', true)): ?>
  #post-<?php echo $c_pageID; ?> .post-slideshow, #post-<?php echo $c_pageID; ?> .post-slideshow img{height:<?php echo get_post_meta($c_pageID, 'pyre_fimg_height', true); ?> !important;}
  <?php endif; ?>

  <?php if(!$data['flexslider_circles']): ?>
  .main-flex .flex-control-nav{display:none !important;}
  <?php endif; ?>

  <?php if(!$data['breadcrumb_mobile']): ?>
  @media only screen and (max-width: 940px){
    .breadcrumbs{display:none !important;}
  }
  @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait){
    .breadcrumbs{display:none !important;}
  }
  <?php endif; ?>

  <?php if(!$data['image_rollover']): ?>
  .image-extras{display:none !important;}
  <?php endif; ?>

  <?php if($data['nav_height']): ?>
  #nav > li > a,#nav li.current-menu-ancestor a{height:<?php echo $data['nav_height']; ?>px;line-height:<?php echo $data['nav_height']; ?>px;}
  #nav > li > a,#nav li.current-menu-ancestor a{height:<?php echo $data['nav_height']; ?>px;line-height:<?php echo $data['nav_height']; ?>px;}

  #nav ul ul{top:<?php echo $data['nav_height']+3; ?>px;}

  <?php if(is_page('header-4') || is_page('header-5')) { ?>
  #nav > li > a,#nav li.current-menu-ancestor a{height:40px;line-height:40px;}
  #nav > li > a,#nav li.current-menu-ancestor a{height:40px;line-height:40px;}

  #nav ul ul{top:43px;}
  <?php } ?>
  <?php endif; ?>

  <?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg_retina', true)): ?>
  @media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {
    .page-title-container {
      background-image: url(<?php echo get_post_meta($c_pageID, 'pyre_page_title_bar_bg_retina', true); ?>) !important;
      -webkit-background-size:cover;
         -moz-background-size:cover;
           -o-background-size:cover;
              background-size:cover;
    }
  }
  <?php elseif($data['page_title_bg_retina']): ?>
  @media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {
    .page-title-container {
      background-image: url(<?php echo $data['page_title_bg_retina']; ?>) !important;
      -webkit-background-size:cover;
         -moz-background-size:cover;
           -o-background-size:cover;
              background-size:cover;
    }
  }
  <?php endif; ?>

  <?php if($data['tfes_slider_width']): ?>
  .ei-slider{width:<?php echo $data['tfes_slider_width']; ?> !important;}
  <?php endif; ?>

  <?php if($data['tfes_slider_height']): ?>
  .ei-slider{height:<?php echo $data['tfes_slider_height']; ?> !important;}
  <?php endif; ?>

  <?php if($data['button_text_shadow']): ?>
  .button{text-shadow:none !important;}
  <?php endif; ?>

  <?php if($data['footer_text_shadow']): ?>
  .footer-area a,.copyright{text-shadow:none !important;}
  <?php endif; ?>

  <?php if($data['tagline_bg']): ?>
  .reading-box{background-color:<?php echo $data['tagline_bg']; ?> !important;}
  <?php endif; ?>

  .isotope .isotope-item {
    -webkit-transition-property: top, left, opacity;
       -moz-transition-property: top, left, opacity;
        -ms-transition-property: top, left, opacity;
         -o-transition-property: top, left, opacity;
            transition-property: top, left, opacity;
  }
</style>
