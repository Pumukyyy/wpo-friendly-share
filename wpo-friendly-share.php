<?php

/**
* WPO friendly Share
**
* @since             1.0.0 9-10-19
*
* @package           wpo_friendly_share
*
* @author     Pumukyyy
*
* @license    GPL-2.0 +
*
* @link       https://github.com/Pumukyyy/wpo-friendly-share
*
* @copyright 2019 Pumukyyy, Pmk Wewb Dev
*
* Plugin Name: WPO friendly Share
* Plugin URI: https://github.com/Pumukyyy/wpo-friendly-share
* Description: Simples botones para compartir o ser seguidos en las redes sin usar javascript!!.
* Version:  1.1.0
* Author: Pumukyyy
* Author URI: https://github.com/Pumukyyy
* License: GNU General Public License v2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
* Requires at least: 4.6
* Tested up to: 5.2.3
* Text Domain: wpo-friendly-share 
* Domain Path: /languages
**/

// Si se llama directamente a este archivo, aborta.
defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

//version actual
define( 'WFS_VERSION', '1.1.0' );
define( 'WFS_PATH', plugin_dir_path( __FILE__ ) );
define( 'WFS_URI', plugin_dir_url( __FILE__ ) );

define( 'WFS_ADMIN',plugins_url( 'admin/', __FILE__ ) , true );
define( 'WFS_SLUG', dirname( plugin_basename( __FILE__ ) ) );
define( 'WFS_BASE', plugin_basename( __FILE__ ) );

/*
* Configuracion del plugin
*/
if ( is_admin() ) {
	require_once( WFS_PATH . 'admin/wfs-config.php' );

	require_once( WFS_PATH . 'admin/admin-render.php' );

	require_once( WFS_PATH . 'admin/deactivation.php' );

	if ( 1 == get_option( 'wfs-options-delete-all' ) ) {

		register_deactivation_hook(__FILE__, 'wfs_remove_options' );
	}

	function wfs_add_options() {
	  update_option( 'wfs-options-after-post', 1);
	    
	}

	register_activation_hook( __FILE__, 'wfs_add_options' );
	
} else {

	require_once( WFS_PATH . 'public/public-render.php' );
}

require_once( WFS_PATH . 'assets/social-icons.php' );

function wfs_load_textdomain() {
    load_plugin_textdomain( 'wpo-friendly-share', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'wfs_load_textdomain' );
