<?php

class Ad125x125Widget extends WP_Widget {

  public function __construct()
  {
    $widget_ops = array('classname' => 'ad-125-125', 'description' => __('Add 125x125 ads.', 'salamander'));

    $control_ops = array('id_base' => 'ad-125x125-widget');

    $this->WP_Widget('ad-125x125-widget', 'Salamander: 125x125 Ads', $widget_ops, $control_ops);
  }

  public function widget($args, $instance)
  {
    extract($args);

    ?>
    <div class="ads-125 <?php print Salamander::classes('data', 'layout_type', 'row'); ?>">
      <div class="col-lg-16 col-md-16">
    <?php
    $ads = array(1, 2, 3, 4);
    $count = 1;
    ?>
<?php foreach($ads as $ad) : ?>
  <?php if($instance['ad_125_img_' . $ad] && $instance['ad_125_link_' . $ad]) : ?>
    <?php if ($count == 1 || $count == 3) : ?>
      <div class="<?php print Salamander::classes('data', 'layout_type', 'row'); ?>">
    <?php endif; ?>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
          <span class="hold"><a href="<?php echo $instance['ad_125_link_' . $ad]; ?>"><img src="<?php echo $instance['ad_125_img_' . $ad]; ?>" alt="" width="123" height="123" /></a></span>
        </div>
    <?php if ($count == 2 || $count == 4) : ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>
  <?php $count++; ?>
<?php endforeach; ?>
      </div>
    </div>
  <?php
  }

  public function update($new_instance, $old_instance)
  {
    $instance = $old_instance;

    $instance['ad_125_img_1'] = $new_instance['ad_125_img_1'];
    $instance['ad_125_link_1'] = $new_instance['ad_125_link_1'];
    $instance['ad_125_img_2'] = $new_instance['ad_125_img_2'];
    $instance['ad_125_link_2'] = $new_instance['ad_125_link_2'];
    $instance['ad_125_img_3'] = $new_instance['ad_125_img_3'];
    $instance['ad_125_link_3'] = $new_instance['ad_125_link_3'];
    $instance['ad_125_img_4'] = $new_instance['ad_125_img_4'];
    $instance['ad_125_link_4'] = $new_instance['ad_125_link_4'];

    return $instance;
  }

  public function form($instance)
  {
    $defaults = array(
      'ad_125_img_1' => '',
      'ad_125_link_1' => '',
      'ad_125_img_2' => '',
      'ad_125_link_2' => '',
      'ad_125_img_3' => '',
      'ad_125_link_3' => '',
      'ad_125_img_4' => '',
      'ad_125_link_4' => '',
    );
    $instance = wp_parse_args((array) $instance, $defaults); ?>
    <p><strong>Ad 1</strong></p>
    <p>
      <label for="<?php echo $this->get_field_id('ad_125_img_1'); ?>">Image Ad Link:</label>
      <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('ad_125_img_1'); ?>" name="<?php echo $this->get_field_name('ad_125_img_1'); ?>" value="<?php echo $instance['ad_125_img_1']; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('ad_125_link_1'); ?>">Ad Link:</label>
      <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('ad_125_link_1'); ?>" name="<?php echo $this->get_field_name('ad_125_link_1'); ?>" value="<?php echo $instance['ad_125_link_1']; ?>" />
    </p>
    <p><strong>Ad 2</strong></p>
    <p>
      <label for="<?php echo $this->get_field_id('ad_125_img_2'); ?>">Image Ad Link:</label>
      <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('ad_125_img_2'); ?>" name="<?php echo $this->get_field_name('ad_125_img_2'); ?>" value="<?php echo $instance['ad_125_img_2']; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('ad_125_link_2'); ?>">Ad Link:</label>
      <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('ad_125_link_2'); ?>" name="<?php echo $this->get_field_name('ad_125_link_2'); ?>" value="<?php echo $instance['ad_125_link_2']; ?>" />
    </p>
    <p><strong>Ad 3</strong></p>
    <p>
      <label for="<?php echo $this->get_field_id('ad_125_img_3'); ?>">Image Ad Link:</label>
      <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('ad_125_img_3'); ?>" name="<?php echo $this->get_field_name('ad_125_img_3'); ?>" value="<?php echo $instance['ad_125_img_3']; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('ad_125_link_3'); ?>">Ad Link:</label>
      <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('ad_125_link_3'); ?>" name="<?php echo $this->get_field_name('ad_125_link_3'); ?>" value="<?php echo $instance['ad_125_link_3']; ?>" />
    </p>
    <p><strong>Ad 4</strong></p>
    <p>
      <label for="<?php echo $this->get_field_id('ad_125_img_4'); ?>">Image Ad Link:</label>
      <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('ad_125_img_4'); ?>" name="<?php echo $this->get_field_name('ad_125_img_4'); ?>" value="<?php echo $instance['ad_125_img_4']; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('ad_125_link_4'); ?>">Ad Link:</label>
      <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('ad_125_link_4'); ?>" name="<?php echo $this->get_field_name('ad_125_link_4'); ?>" value="<?php echo $instance['ad_125_link_4']; ?>" />
    </p>
  <?php
  }
}