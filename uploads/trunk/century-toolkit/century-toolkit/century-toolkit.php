<?php
/**
 * Plugin Name:       Century ToolKit
 * Plugin URI:        https://wordpress.org/plugins/century-toolkit
 * Description:       Century ToolKit is specially developed for themecentury themes. This plugin help to import demo content and related settings.
 * Version:           1.1.0
 * Author:            themecentury
 * Author URI:        https://themecentury.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       century-toolkit
 * Domain Path:       /languages
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define CENTURY_TOOLKIT_PLUGIN_FILE.
if (!defined('CENTURY_TOOLKIT_FILE')) {
    define('CENTURY_TOOLKIT_FILE', __FILE__);
}

// Define CENTURY_TOOLKIT_VERSION.
if (!defined('CENTURY_TOOLKIT_VERSION')) {
    define('CENTURY_TOOLKIT_VERSION', '1.1.0');
}

// Define CENTURY_TOOLKIT_PLUGIN_URI.
if (!defined('CENTURY_TOOLKIT_PLUGIN_URI')) {
    define('CENTURY_TOOLKIT_PLUGIN_URI', plugins_url('', CENTURY_TOOLKIT_FILE) . '/');
}

// Define CENTURY_TOOLKIT_PLUGIN_DIR.
if (!defined('CENTURY_TOOLKIT_PLUGIN_DIR')) {
    define('CENTURY_TOOLKIT_PLUGIN_DIR', plugin_dir_path(CENTURY_TOOLKIT_FILE) );
}

// Include the main Century_Toolkit class.
if (!class_exists('Century_Toolkit')) {
    include_once dirname(__FILE__) . '/includes/class-century-toolkit.php';
}

/**
 * Main instance of Century_Toolkit.
 *
 * Returns the main instance of Century_Toolkit to prevent the need to use globals.
 *
 * @since 1.0.0
 * @return Century_Toolkit
 */
if(!function_exists('century_toolkit_instance')):

	function century_toolkit_instance(){

		return Century_Toolkit::instance();

	}

endif;

// Global for backwards compatibility.
$GLOBALS['century-toolkit-instance'] = century_toolkit_instance();
