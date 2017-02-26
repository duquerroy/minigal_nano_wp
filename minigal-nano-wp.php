<?php

/*
  Plugin Name: Minigal Nano Wp
  Plugin URI: http://
  Description:
  Author: Gilles Duquerroy
  Author URI:
  Text Domain: minigal-nano-wp
  Version: 0.1

  https://github.com/sebsauvage/MinigalNano
  MinigalNano is a very simple image gallery. It adheres to the KISS principle and is very easy to install. MinigalNano does not have a web admin interface: You just upload your images in the photo folder on your server (using FTP, SFTP...). It only requires php and GD (no database, no special libraries like PEAR or ImageMagick).

  MinigalNano uses a javascript Lightbox (Use left/right arrows for navigation), but it degrades gracefully if javascript is disabled.

  MinigalNano is based on Thomas Rybak's version which seems to have been abandonned in 2010. It adds new themes and icons, use more modern html/css, updates JS libs, and wants to be more community pull-friendly for the future.

  MinigalNano is licensed under the GNU AFFERO GENERAL PUBLIC LICENSE v3 (https://gnu.org/licenses/agpl-3.0.txt).

  Icons used are from the Nitrux project and licensed under the Creative Commons Attribution-NonCommercial-NoDerivatives International 4.0 License (https://creativecommons.org/licenses/by-nc-nd/4.0/).

  Licenced under the GNU GPL:

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_minigal_nano_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-minigal-nano-wp-activator.php';
	Minigal_Nano_Wp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_minigal_nano_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-minigal-nano-wp-deactivator.php';
	Minigal_Nano_Wp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_minigal_nano_wp' );
register_deactivation_hook( __FILE__, 'deactivate_minigal_nano_wp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-minigal-nano-wp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_minigal_nano_wp() {

	$plugin = new Minigal_Nano_Wp();
	$plugin->run();

}
run_minigal_nano_wp();
