<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php bloginfo('name'); ?> <?php wp_title(' | ', true, 'left'); ?></title>

  <?php wp_head(); ?>
  <?php print Salamander::getHtml('head'); ?>
  <?php print Salamander::getHtml('favicon'); ?>
  <?php // print Salamander::getHtml('javascripts'); ?>
  <?php // print Salamander::getHtml('css'); ?>

  <style type="text/css">
    <?php print $data['custom_css']; ?>
  </style>
  <style type="text/css" id="ss"></style>
  <link rel="stylesheet" id="style_selector_ss" href="#" />
  <!-- Google analitics -->
  <?php print Salamander::getData('google_analytics'); ?>

  <?php print Salamander::getData('head_after'); ?>
</head>
<body <?php body_class(strtolower(Salamander::getData('scheme_type'))); ?>>
  <div id="wrapper">
