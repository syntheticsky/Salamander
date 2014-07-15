<script type="text/javascript" language="javascript">
jQuery.noConflict();
jQuery(document).ready(function($)
{
	// COLOR Picker
	$('.colorSelector').each(function()
	{
		var replica = this; //cache a copy of the this variable for use inside nested function
		$(this).ColorPicker(
		{
				color: '<?php if(isset($color)) print $color; ?>',
				onShow: function (pkr)
				{
					$(pkr).fadeIn(500);
					return false;
				},
				onHide: function (pkr)
				{
					$(pkr).fadeOut(500);
					return false;
				},
				onChange: function (hsb, hex, rgb)
				{
					$(replica).children('div').css('backgroundColor', '#' + hex);
					$(replica).next('input').attr('value','#' + hex);
				}
		});
	}); //end color picker
}); //end doc ready
var tb_pathToImage = "<?php print SITE_URL . '/' . WPINC . '/js/thickbox/loadingAnimation.gif'; ?>";
var tb_closeImage = "<?php print SITE_URL . '/' . WPINC . '/js/thickbox/tb-close.png'; ?> ";
</script>
<link rel="stylesheet" href="<?php print SITE_URL . '/' . WPINC . '/js/thickbox/thickbox.css'; ?>" type="text/css" media="screen" />

<div class="wrapper" id="container">
	<div id="actions-save" class="actions-save">
		<div class="actions-save-save">Options Updated</div>
	</div>
	<div id="actions-reset" class="actions-save">
		<div class="actions-save-reset">Options Reset</div>
	</div>

	<div id="actions-fail" class="actions-save">
		<div class="actions-save-fail">Error!</div>
	</div>

	<span style="display: none;" id="hooks"><?php print json_encode($headerClassesArray); ?></span>
	<form id="options-form" method="post" action="<?php print esc_attr( $_SERVER['REQUEST_URI'] ) ?>" enctype="multipart/form-data" >
		<input type="hidden" id="reset" value="<?php if(isset($_REQUEST['reset'])) print $_REQUEST['reset']; ?>" />
		<input type="hidden" id="security" name="security" value="<?php print wp_create_nonce('ajax_nonce'); ?>" />
		<div id="header">
			<div class="logo">
				<h3><?php print THEMENAME; ?></h3>
				<span><?php print ('v'. THEMEVERSION); ?></span>
			</div>
			<div id="no-js">Warning - This options panel will not work properly without javascript!</div>
			<div class="icon-option"></div>
			<div class="clear"></div>
  	</div>
		<div id="actions-top">
			<a>
				<div id="options-to-list" class="options-expand">Expand</div>
			</a>
			<img style="display:none" src="<?php print ASSETS_DIR; ?>images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
			<button id="options-save-upper" type="button" name="save" class="button-primary">
				<?php print __('Save All Changes', 'optionsframework');?>
			</button>
		</div>
		<div id="options-content">
			<div id="tab-nav">
				<ul>
				  <?php print $optionsMachine['menu']; ?>
				</ul>
			</div>
			<div id="tab-content">
	  		<?php print $optionsMachine['inputs']; /* Settings */ ?>
	  	</div>
			<div class="clear"></div>
		</div>
		<div class="actions">
			<img style="display:none" src="<?php print ASSETS_DIR; ?>images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
			<button id ="options-save" type="button" name="save" class="button-primary"><?php print __('Save All Changes', 'optionsframework');?></button>
			<button id ="options-reset" type="button" class="button submit-button reset-button" ><?php print __('Options Reset', 'optionsframework');?></button>
			<img style="display:none" src="<?php print ASSETS_DIR; ?>images/loading-bottom.gif" class="ajax-reset-loading-img ajax-loading-img-bottom" alt="Working..." />
		</div>
	</form>
	<div style="clear:both;"></div>
</div><!--wrapper-->
