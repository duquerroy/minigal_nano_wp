<?php


$options = get_option('minigal_nano_wp_filters_settings');

if (is_array($options)) {
	foreach ($options as $key => $value) {
		$$key = $value;
	}
}


?>
<p><label for="thumb_size">
	<input type="text" id="thumb_size" value="<?= isset($thumb_size)? $thumb_size:"" ?>" name="minigal_nano_wp_filters_settings[thumb_size]" placeholder="250" /> <?php _e('Thumb Size (px), you must delete thumbs folder (wp-content/uploads/thumbs)', 'minigal-nano-wp'); ?>
</label></p>
<p><label for="label_max_length">
	<input type="text" id="label_max_length" value="<?= isset($label_max_length)? $label_max_length:"" ?>" name="minigal_nano_wp_filters_settings[label_max_length]" placeholder="250" /> <?php _e('Label Max Length', 'minigal-nano-wp'); ?>
</label></p>

<p><?php _e('Display Exif', 'minigal-nano-wp'); ?></p>
<p><label for="filter-sortdir-files-select">
	<select name="minigal_nano_wp_filters_settings[display_exif]" id="filter-display-exif-select">
		<option value="0" <?php if( $display_exif == 0) { echo 'selected'; } ?>><?php _e('No', 'minigal-nano-wp'); ?></option>
		<option value="1" <?php if( $display_exif == 1) { echo 'selected'; } ?>><?php _e('Yes', 'minigal-nano-wp'); ?></option>
	</select>
</label></p>


<p><?php _e('Display Filename', 'minigal-nano-wp'); ?></p>
<p><label for="filter-sortdir-files-select">
	<select name="minigal_nano_wp_filters_settings[display_filename]" id="filter-display-filename-select">
		<option value="0" <?php if( $display_filename == 0) { echo 'selected'; } ?>><?php _e('No', 'minigal-nano-wp'); ?></option>
		<option value="1" <?php if( $display_filename == 1) { echo 'selected'; } ?>><?php _e('Yes', 'minigal-nano-wp'); ?></option>
	</select>
</label></p>

