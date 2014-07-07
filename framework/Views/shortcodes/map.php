<?php $addresses = explode('|', $address); ?>
<script type='text/javascript'>
	jQuery(document).ready(function($) {
		$('#gmap-<?php print $mapCounter; ?>').goMap({
			address: '<?php print $addresses[0]; ?>',
			zoom: <?php print $zoom; ?>,
			scrollwheel: <?php print $scrollwheel; ?>,
			scaleControl: <?php print $scale; ?>,
			navigationControl: <?php print $zoom_pancontrol; ?>,
			maptype: '<?php print $type; ?>',
	        markers: [
	        	<?php foreach($addresses as $address_string) : ?>
								{
									address: '<?php print $address_string; ?>',
									html: {
										content: '<?php print $address_string; ?>',
										popup: true
									}
								}
						<?php endforeach; ?>
	        ]
		});
	});
</script>

<div class="shortcode-map" id="gmap-<?php print $mapCounter; ?>" style="width: <?php print $width; ?>; height: <?php print $height; ?>;"></div>
