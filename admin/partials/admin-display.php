<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin/partials
 */
?>
<div class="wrap">
	<h2><?php _e('Minigal Nano WP', 'minigal-nano-wp'); ?></h2>
	<h2 class="nav-tab-wrapper">
		<?php
	    $tabs = array(
		    'basic' => __('Basic options', 'minigal-nano-wp'),
		    'advanced' => __('Advanced options', 'minigal-nano-wp'),
		    'help' => __('Help', 'minigal-nano-wp'),
		    'about' => __('About', 'minigal-nano-wp')
	    );
	    //set current tab
	    $tab = ( isset($_GET['tab']) ? $_GET['tab'] : 'basic' );
	    ?>
	    <?php foreach( $tabs as $key => $value ): ?>
	    	<a class="nav-tab <?php if( $tab == $key ){ echo 'nav-tab-active'; } ?>" href="<?php echo admin_url() ?>options-general.php?page=minigal_nano_wp_option_page&tab=<?php echo $key; ?>"><?php echo $value; ?></a>
	    <?php endforeach; ?>
	</h2>

	<div class="minigal-nano-wp-tabs">
		<?php if( $tab == 'basic' ): ?>

			<?php flush_rewrite_rules(); ?>
		    <form method="post" action="options.php">
				<?php settings_fields('basic-settings'); ?>
				<?php do_settings_sections('basic-settings'); ?>
				<?php submit_button('Save Changes'); ?>
		    </form>

		<?php elseif( $tab == 'advanced' ): ?>

			<?php flush_rewrite_rules(); ?>
			<form method="post" action="options.php">
				<?php settings_fields('advanced-minigal-nano-wp-filters'); ?>
				<?php do_settings_sections('advanced-minigal-nano-wp-filters'); ?>
				<?php submit_button('Save Changes'); ?>
		    </form>

		<?php elseif( $tab == 'help' ): ?>

			<?php include plugin_dir_path( dirname( __FILE__ ) ) . 'partials/help/help.php'; ?>

		<?php else: ?>

			<?php include plugin_dir_path( dirname( __FILE__ ) ) . 'partials/about/about.php'; ?>

	   <?php endif; ?>
	</div>
</div>
