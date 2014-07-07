<div id="shrtcodes-form-wrapper" style="display: none;">
	<div id="shortcodes-form">
		<div class="form-group">
	    <label for="shortcode-type">Choose Shortcode</label>
			<select name="shortcode_type" id="shortcode-type" class="form-control">
				<?php foreach ($list as $key => $value) : ?>
				<option value="<?php print $key; ?>"><?php print $value; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div id="shortcode-data">
		</div>
		<hr>
		<div class="form-group">
			<button name="add" id="insert" class="button button-primary button-large">Insert Shortcode</button>
		</div>
	</div>
</div>
