<?php

$automagic = get_option('minigal_nano_wp_filters_customize');

if (is_array($automagic)) {
	foreach ($automagic as $key => $value) {
		$$key = $value;
	}
}

?>

<p><label for="gallery_width">
	<input type="text" id="gallery_width" value="<?= isset($gallery_width)? $gallery_width:"" ?>" name="minigal_nano_wp_filters_customize[gallery_width]" placeholder="100%" /> <?php _e('Gallery width', 'minigal-nano-wp'); ?>
</label></p>

<p><label for="label_noimages">
	<input type="text" id="label_noimages" value="<?= isset($label_noimages)? $label_noimages:""; ?>" name="minigal_nano_wp_filters_customize[label_noimages]" placeholder="No images... yet !" /> <?php _e('Label No Images', 'minigal-nano-wp'); ?>
</label></p>

<p><label for="label_noimages_advice">
	<input type="text" id="label_noimages_advice" value="<?= isset($label_noimages_advice)? $label_noimages_advice:"" ; ?>" name="minigal_nano_wp_filters_customize[label_noimages_advice]" placeholder="Use your FTP to upload some picture !" /> <?php _e('Label No Images Advice', 'minigal-nano-wp'); ?>
</label></p>

<p><label for="label_loading">
	<input type="text" id="label_loading" value="<?= isset($label_loading)? $label_loading:""; ?>" name="minigal_nano_wp_filters_customize[label_loading]" placeholder="Loading..." /> <?php _e('Label Loading', 'minigal-nano-wp'); ?>
</label></p>

<p><label for="label_home">
	<input type="text" id="label_home" value="<?= isset($label_home)? $label_home:""; ?>" name="minigal_nano_wp_filters_customize[label_home]" placeholder="Home" /> <?php _e('Label Home', 'minigal-nano-wp'); ?>
</label></p>

<p><label for="breadcrumb_separator">
	<input type="text" id="breadcrumb_separator" value="<?= isset($breadcrumb_separator)? $breadcrumb_separator:""; ?>" name="minigal_nano_wp_filters_customize[breadcrumb_separator]" placeholder=">" /> <?php _e('Breadcrumb Separator', 'minigal-nano-wp'); ?>
</label></p>

<p><label for="color_button_top">
	<input type="text" id="color_button_top" value="<?= isset($color_button_top)? $color_button_top:""; ?>" name="minigal_nano_wp_filters_customize[color_button_top]" placeholder="#FFF" /> <?php _e('Color button top', 'minigal-nano-wp'); ?>
</label></p>

<p><label for="background_color_button_top">
	<input type="text" id="background_color_button_top" value="<?= isset($background_color_button_top)? $background_color_button_top:""; ?>" name="minigal_nano_wp_filters_customize[background_color_button_top]" placeholder="#000" /> <?php _e('Background color button top', 'minigal-nano-wp'); ?>
</label></p>

<p><?php _e('Template', 'minigal-nano-wp'); ?></p>
<p><label for="filter-templatefile-select">
	<select name="minigal_nano_wp_filters_customize[templatefile]" id="filter-templatefile-select">
		<?php
		$current_dir = plugin_dir_path(dirname(dirname(dirname(__FILE__))) ) . 'templates/';
		$handle = opendir($current_dir);
		while (false !== ($file = readdir($handle))) {
			if ($file !== "." && $file !== ".."){
				$file = explode('.', $file);
				var_dump($file[0]);
		?>

				<option value= <?php echo $file[0] ?> <?php if( (is_array($automagic) && in_array($file[0], $automagic)) ){ echo 'selected'; } ?>><?php echo $file[0] ?></option>
		<?php
			}

		}
		?>
	</select>
</label></p>


<p><?php _e('Folder Color', 'minigal-nano-wp'); ?></p>
<p><label for="filter-folder-color-select">
	<select name="minigal_nano_wp_filters_customize[folder_color]" id="filter-folder-color-select">
		<option value="black" <?php if( (is_array($automagic) && in_array('black', $automagic)) ){ echo 'selected'; } ?>><?php _e('Black', 'minigal-nano-wp'); ?></option>
		<option value="blue" <?php if(is_array($automagic) && in_array('blue', $automagic)){ echo 'selected'; } ?>><?php _e('Blue', 'minigal-nano-wp'); ?></option>
		<option value="green" <?php if(is_array($automagic) && in_array('green', $automagic)){ echo 'selected'; } ?>><?php _e('Green', 'minigal-nano-wp'); ?></option>
		<option value="grey" <?php if(is_array($automagic) && in_array('grey', $automagic)){ echo 'selected'; } ?>><?php _e('Grey', 'minigal-nano-wp'); ?></option>
		<option value="purple" <?php if(is_array($automagic) && in_array('purple', $automagic)){ echo 'selected'; } ?>><?php _e('Purple', 'minigal-nano-wp'); ?></option>
		<option value="vista" <?php if(is_array($automagic) && in_array('vista', $automagic)){ echo 'selected'; } ?>><?php _e('Vista', 'minigal-nano-wp'); ?></option>
	</select>
</label></p>


<p><?php _e('Sorting Folders', 'minigal-nano-wp'); ?></p>
<p><label for="filter-sorting-folders-select">
	<select name="minigal_nano_wp_filters_customize[sorting_folders]" id="filter-sorting-folders-select">
		<option value="name" <?php if( (is_array($automagic) && in_array('name', $automagic)) ){ echo 'selected'; } ?>><?php _e('Name', 'minigal-nano-wp'); ?></option>
		<option value="date" <?php if(is_array($automagic) && in_array('date', $automagic)){ echo 'selected'; } ?>><?php _e('Date', 'minigal-nano-wp'); ?></option>
	</select>
</label></p>


<p><?php _e('Sorting Files', 'minigal-nano-wp'); ?></p>
<p><label for="filter-sorting-files-select">
	<select name="minigal_nano_wp_filters_customize[sorting_files]" id="filter-sorting-files-select">
		<option value="name" <?php if( (is_array($automagic) && in_array('name', $automagic)) ){ echo 'selected'; } ?>><?php _e('Name', 'minigal-nano-wp'); ?></option>
		<option value="date" <?php if(is_array($automagic) && in_array('date', $automagic)){ echo 'selected'; } ?>><?php _e('Date', 'minigal-nano-wp'); ?></option>
		<option value="size" <?php if(is_array($automagic) && in_array('size', $automagic)){ echo 'selected'; } ?>><?php _e('Size', 'minigal-nano-wp'); ?></option>
	</select>
</label></p>

<p><?php _e('Sortdir Folders', 'minigal-nano-wp'); ?></p>
<p><label for="filter-sortdir-folders-select">
	<select name="minigal_nano_wp_filters_customize[sortdir_folders]" id="filter-sortdir-folders-select">
		<option value="SORT_ASC" <?php if( (is_array($automagic) && in_array('SORT_ASC', $automagic)) ){ echo 'selected'; } ?>><?php _e('Asc', 'minigal-nano-wp'); ?></option>
		<option value="SORT_DESC" <?php if(is_array($automagic) && in_array('SORT_DESC', $automagic)){ echo 'selected'; } ?>><?php _e('Desc', 'minigal-nano-wp'); ?></option>
	</select>
</label></p>

<p><?php _e('Sortdir Files', 'minigal-nano-wp'); ?></p>
<p><label for="filter-sortdir-files-select">
	<select name="minigal_nano_wp_filters_customize[sortdir_files]" id="filter-sortdir-files-select">
		<option value="SORT_ASC" <?php if( (is_array($automagic) && in_array('SORT_ASC', $automagic)) ){ echo 'selected'; } ?>><?php _e('Asc', 'minigal-nano-wp'); ?></option>
		<option value="SORT_DESC" <?php if(is_array($automagic) && in_array('SORT_DESC', $automagic)){ echo 'selected'; } ?>><?php _e('Desc', 'minigal-nano-wp'); ?></option>
	</select>
</label></p>


<p><?php _e('Mediabox Css', 'minigal-nano-wp'); ?></p>
<p><label for="filter-mediabox-css-select">
	<select name="minigal_nano_wp_filters_customize[mediabox_css]" id="filter-mediabox-css-select">
		<option value="mediaboxBlack" <?php if( (is_array($automagic) && in_array('mediaboxBlack', $automagic)) ){ echo 'selected'; } ?>><?php _e('Black', 'minigal-nano-wp'); ?></option>
		<option value="mediaboxWhite" <?php if(is_array($automagic) && in_array('mediaboxWhite', $automagic)){ echo 'selected'; } ?>><?php _e('White', 'minigal-nano-wp'); ?></option>
	</select>
</label></p>

