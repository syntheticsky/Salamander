    <?php if (Salamander::getData('favicon')): ?>
    <link rel="shortcut icon" href="<?php print Salamander::getData('favicon'); ?>" type="image/x-icon" />
    <?php endif; ?>

    <?php if (Salamander::getData('iphone_icon')): ?>
    <!-- For iPhone -->
    <link rel="apple-touch-icon-precomposed" href="<?php print Salamander::getData('iphone_icon'); ?>">
    <?php endif; ?>

    <?php if (Salamander::getData('iphone_icon_retina')): ?>
    <!-- For iPhone 4 Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php print Salamander::getData('iphone_icon_retina'); ?>">
    <?php endif; ?>

    <?php if (Salamander::getData('ipad_icon')): ?>
    <!-- For iPad -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php print Salamander::getData('ipad_icon'); ?>">
    <?php endif; ?>

    <?php if (Salamander::getData('ipad_icon_retina')): ?>
    <!-- For iPad Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php print Salamander::getData('ipad_icon_retina'); ?>">
    <?php endif; ?>
