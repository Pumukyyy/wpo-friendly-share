<?php

/**
* @link              https://pmkchapaypintura.com
*
* @since             1.0.0
*
* @package           wpo-friendly-share
*
* Plugin Name: WPO friendly Share
* Plugin URI: https://pmkchapaypintura.com
* Description: simples botones para compartir o ser segidos en las redes Sin usar javascript!!.
* Version:  1.0.0
* Author: pedro serrano (pmk)
* Author URI: https://pmkchapaypintura.com/author/pedro/
* License: GNU General Public License v2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
* Requires at least: 4.0
* Tested up to: 5.2.3
* Text Domain: wpo-friendly-share
* Domain Path: /languages
**/

// Si se llama directamente a este archivo, aborta.
defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

//version actual
define( 'WFS_VERSION', '1.0.0' );
define( 'WFS_PATH', plugin_dir_path( __FILE__ ) );
define( 'WFS_URI', plugin_dir_url( __FILE__ ) );

define( 'WFS_ADMIN',plugins_url( 'admin/', __FILE__ ) , true );
define( 'WFS_SLUG', dirname( plugin_basename( __FILE__ ) ) );
define( 'WFS_BASE', plugin_basename( __FILE__ ) );

/*
* Configuracion del plugin
*/
require_once( WFS_PATH . 'admin/wfsConfig.php' );

require_once( WFS_PATH . 'admin/adminRender.php' );

require_once( WFS_PATH . 'public/publicRender.php' );