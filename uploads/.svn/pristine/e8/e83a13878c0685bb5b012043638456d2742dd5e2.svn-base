<?php
/**
 * ThemeCenturyToolKit Admin
 *
 * @class    TCY_Admin
 * @author   ThemeCentury
 * @category Admin
 * @package  ThemeCenturyToolKit/Admin
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * TCY_Admin class.
 */
class TCY_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		if ( version_compare( phpversion(), '5.3.2', '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notices' ) );
		} else {
			$this->includes();

			TCY_Main::getInstance();
		}

	}

	public function admin_notices() {
		$message = sprintf( esc_html__( 'The %2$sCentury ToolKit%3$s plugin requires %2$sPHP 5.3.2+%3$s to run properly. Please contact your hosting company and ask them to update the PHP version of your site to at least PHP 5.3.2.%4$s Your current version of PHP: %2$s%1$s%3$s', 'century-toolkit' ), phpversion(), '<strong>', '</strong>', '<br>' );

		printf( '<div class="notice notice-error"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}

	public function includes() {

		include_once( dirname( __FILE__ ) . '/class-tcy-admin-demo-config.php' );
	}
}

return new TCY_Admin();
