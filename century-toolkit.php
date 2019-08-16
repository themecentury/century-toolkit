<?php
/*
Plugin Name: Century ToolKit
Plugin URI: https://wordpress.org/plugins/century-toolkit/
Description: Demo importer for ThemeCentury themes.
Version: 1.0.3
Author: ThemeCentury Team
Author URI: https://themecentury.com/
License: GPL3
License URI: http://www.gnu.org/licenses/gpl.html
Text Domain: century-toolkit
*/

// Block direct access to the main plugin file.
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define TCY_TOOLKIT_FILE.
if ( ! defined( 'TCY_TOOLKIT_FILE' ) ) {
	define( 'TCY_TOOLKIT_FILE', __FILE__ );
}

// Include the main WooCommerce class.
if ( ! class_exists( 'ThemeCentury_Demo_Importer' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-century-toolkit.php';
}

/**
 * Main instance of ThemeCentury_Demo_Importer.
 *
 * Returns the main instance of TET to prevent the need to use globals.
 *
 * @since 1.0.0
 * @return ThemeCentury_Demo_Importer
 */
function century_toolkit() {
	return ThemeCentury_Demo_Importer::instance();
}

// Global for backwards compatibility.
$GLOBALS['century-toolkit'] = century_toolkit();