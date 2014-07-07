<input class="<?php print $hide; ?> upload of-input" name="<?php print $id; ?>" id="<?php print $id; ?>_upload" value="<?php print $value; ?>" />
<div class="upload_button_div">
  <span class="button media_upload_button" id="<?php print $id; ?>" rel="<?php print $int; ?>">Upload</span>
  <span class="button mlu_remove_button <?php print $hide; ?>" id="reset_<?php print $id; ?>" title="<?php print $id; ?>">Remove</span>
</div>
<div class="screenshot">
<?php if (!empty($upload)) : ?>
  <a class="of-uploaded-image" href="<?php print $upload; ?>">';
    <img class="of-option-image" id="image_<?php print $id; ?>" src="<?php print $upload; ?>" alt="" />
  </a>
<?php endif; ?>
</div>
<div class="clear"></div>
