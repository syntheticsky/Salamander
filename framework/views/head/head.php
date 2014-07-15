<!-- W3TC-include-js-head -->
<script type="text/javascript" src="https://maps.google.com/maps/api/js?v=3.exp&amp;sensor=false&amp;language=<?php print substr(get_locale(), 0, 2); ?>"></script>
<!-- include googlefonts -->
<?php if (Salamander::getData('google_body') && Salamander::getData('google_body') != 'Select Font'): ?>
<link href='http://fonts.googleapis.com/css?family=<?php print urlencode(Salamander::getData('google_body')); ?>:300,400,400italic,500,600,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese' rel='stylesheet' type='text/css' />
<?php endif; ?>

<?php if (Salamander::getData('google_nav') && Salamander::getData('google_nav') != 'Select Font'): ?>
<link href='http://fonts.googleapis.com/css?family=<?php print urlencode(Salamander::getData('google_nav')); ?>:300,400,400italic,500,600,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese' rel='stylesheet' type='text/css' />
<?php endif; ?>

<?php if (Salamander::getData('google_headings') && Salamander::getData('google_headings') != 'Select Font'): ?>
<link href='http://fonts.googleapis.com/css?family=<?php print urlencode(Salamander::getData('google_headings')); ?>:300,400,400italic,500,600,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese' rel='stylesheet' type='text/css' />
<?php endif; ?>

<?php if (Salamander::getData('google_footer_headings') && Salamander::getData('google_footer_headings') != 'Select Font'): ?>
<link href='http://fonts.googleapis.com/css?family=<?php print urlencode(Salamander::getData('google_footer_headings')); ?>:300,400,400italic,500,600,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese' rel='stylesheet' type='text/css' />
<?php endif; ?>

<!-- Styleshhet -->
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file://
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
-->
<!--[if lt IE 9]>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" />
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<?php
  if (Salamander::getData('responsive')) :
    $ipad = (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'iPad');
    if (!$ipad || !Salamander::getData('ipad_potrait')) :
?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<?php
    endif;
?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/media.css" />
<?php if (!Salamander::getData('ipad_potrait')) : ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ipad.css" />
<?php else : ?>
<style type="text/css">
  @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait) {
    #wrapper .ei-slider {
      width:100% !important;
    }
  }
  @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) {
    #wrapper .ei-slider {
      width:100% !important;
    }
  }
</style>
<?php endif; ?>
<?php
  else:
?>
<style type="text/css">
  @media only screen and (min-device-width : 768px) and (max-device-width : 1024px) {
    #wrapper .ei-slider {
      width:100% !important;
    }
  }
</style>
<?php if((bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPhone')) : ?>
<style type="text/css">
  @media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
    #wrapper .ei-slider {
      width:100% !important;
    }
  }
</style>
<?php endif; ?>
<?php
  endif;
?>
