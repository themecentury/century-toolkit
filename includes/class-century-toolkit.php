<?php
/**
 * ThemeCentury_Demo_Importer setup
 *
 * @author   ThemeCentury
 * @category API
 * @package  ThemeCentury_Demo_Importer
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main ThemeCentury_Demo_Importer Class.
 *
 * @class ThemeCentury_Demo_Importer
 * @version    1.0.0
 */
final class ThemeCentury_Demo_Importer {

	/**
	 * ThemeCentury_Demo_Importer version.
	 *
	 * @var string
	 */
	public $version = '1.2.5';

	/**
	 * The single instance of the class.
	 *
	 * @var ThemeCentury_Demo_Importer
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	/**
	 * Main ThemeCentury_Demo_Importer Instance.
	 *
	 * Ensures only one instance of ThemeCentury_Demo_Importer is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see TET()
	 * @return ThemeCentury_Demo_Importer - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'century-toolkit' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'century-toolkit' ), '1.0.0' );
	}

	/**
	 * Auto-load in-accessible properties on demand.
	 *
	 * @param mixed $key Key name.
	 *
	 * @return mixed
	 */
	public function __get( $key ) {
		if ( in_array( $key, array( '' ), true ) ) {
			return $this->$key();
		}
	}

	/**
	 * ThemeCentury_Demo_Importer Constructor.
	 */
	public function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();

		do_action( 'themecentury_toolkit_loaded' );
	}

	/**
	 * Hook into actions and filters.
	 *
	 * @since 1.0.0
	 */
	private function init_hooks() {
		//register_activation_hook( TCY_TOOLKIT_FILE, array( 'TCY_Install', 'install' ) );
		register_shutdown_function( array( $this, 'log_errors' ) );
		add_action( 'after_setup_theme', array( $this, 'include_template_functions' ), 11 );
		add_action( 'init', array( $this, 'init' ), 0 );
	}

	/**
	 * Ensures fatal errors are logged so they can be picked up in the status report.
	 *
	 * @since 1.0.0
	 */
	public function log_errors() {

	}

	/**
	 * Define WC Constants.
	 */
	private function define_constants() {
		$upload_dir = wp_upload_dir( null, false );

		$this->define( 'TCY_ABSPATH', dirname( TCY_TOOLKIT_FILE ) . '/' );
		$this->define( 'TCY_PLUGIN_BASENAME', plugin_basename( TCY_TOOLKIT_FILE ) );
		$this->define( 'TCY_VERSION', $this->version );
		$this->define( 'CENTURY_TOOLKIT_VERSION', $this->version );
		$this->define( 'TCY_LOG_DIR', $upload_dir['basedir'] . '/mg-logs/' );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param string $name Constant name.
	 * @param string|bool $value Constant value.
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin, ajax, cron or frontend.
	 *
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin' :
				return is_admin();
			case 'ajax' :
				return defined( 'DOING_AJAX' );
			case 'cron' :
				return defined( 'DOING_CRON' );
			case 'frontend' :
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

	/**
	 * Check the active theme.
	 *
	 * @since 1.0.0
	 *
	 * @param  string $theme Theme slug to check.
	 *
	 * @return bool
	 */
	private function is_active_theme( $theme ) {
		return get_template() === $theme;
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	public function includes() {
		/**
		 * Class autoloader.
		 */
		include_once( TCY_ABSPATH . 'includes/class-tcy-autoloader.php' );

		/**
		 * Abstract classes.
		 */
		include_once( TCY_ABSPATH . 'includes/abstracts/abstract-tcy-theme-demo.php' ); // TCY_Data for CRUD.
		/**
		 * Core classes.
		 */
		include_once( TCY_ABSPATH . 'includes/tcy-core-functions.php' );
		include_once( TCY_ABSPATH . 'includes/class-tcy-ajax.php' );


		if ( $this->is_request( 'admin' ) ) {
			include_once( TCY_ABSPATH . 'includes/admin/class-tcy-admin.php' );
		}

		if ( $this->is_request( 'frontend' ) ) {
			$this->frontend_includes();
		}
	}

	/**
	 * Include required frontend files.
	 */
	public function frontend_includes() {

	}

	/**
	 * Function used to Init ThemeCentury_Demo_Importer Template Functions - This makes them pluggable by plugins and themes.
	 */
	public function include_template_functions() {
	}

	/**
	 * Init ThemeCentury_Demo_Importer when WordPress Initialises.
	 */
	public function init() {
		// Before init action.
		do_action( 'before_themecentury_toolkit_init' );

		// Set up localisation.
		$this->load_plugin_textdomain();

		// Init action.
		do_action( 'themecentury_toolkit_init' );
	}

	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
	 *
	 * Locales found in:
	 *      - WP_LANG_DIR/century-toolkit/century-toolkit-LOCALE.mo
	 *      - WP_LANG_DIR/plugins/century-toolkit-LOCALE.mo
	 */
	public function load_plugin_textdomain() {
		$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
		$locale = apply_filters( 'plugin_locale', $locale, 'century-toolkit' );

		unload_textdomain( 'century-toolkit' );
		load_textdomain( 'century-toolkit', WP_LANG_DIR . '/century-toolkit/century-toolkit-' . $locale . '.mo' );
		load_plugin_textdomain( 'century-toolkit', false, plugin_basename( dirname( TCY_TOOLKIT_FILE ) ) . '/i18n/languages' );
	}

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', TCY_TOOLKIT_FILE ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( TCY_TOOLKIT_FILE ) );
	}

	/**
	 * Get the template path.
	 *
	 * @return string
	 */
	public function template_path() {
		return apply_filters( 'themecentury_toolkit_template_path', 'century-toolkit/' );
	}

	/**
	 * Get Ajax URL.
	 *
	 * @return string
	 */
	public function ajax_url() {
		return admin_url( 'admin-ajax.php', 'relative' );
	}
}
