<?php

final class Century_Toolkit
{

    private static $_instance = null;


    public static function instance()
    {
        if (is_null(self::$_instance))
            self::$_instance = new self();
        return self::$_instance;
    }


    public function __construct(){

        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }

    private function define($name, $value)
    {
        if (!defined($name)) {
            define($name, $value);
        }
    }

    private function define_constants()
    {
        $upload_dir = wp_upload_dir(null, false);


        $this->define('CENTURY_TOOLKIT_ABSPATH', dirname(CENTURY_TOOLKIT_FILE) . '/');
        $this->define('CENTURY_TOOLKIT_BASENAME', plugin_basename(CENTURY_TOOLKIT_FILE));
        $this->define('CENTURY_TOOLKIT_UPLOAD_DIR', $upload_dir['basedir'] . '/century-toolkit-upload/');
        $this->define('CENTURY_TOOLKIT_DYNAMIC_CSS_PATH', CENTURY_TOOLKIT_UPLOAD_DIR . 'century-toolkit-dynamic.css');
        $this->define('CENTURY_TOOLKIT_DYNAMIC_CSS_URI', $upload_dir['baseurl'] . '/century-toolkit-upload/century-toolkit-dynamic.css');


    }

    public function includes()
    {
        include_once CENTURY_TOOLKIT_ABSPATH . 'includes/class-century-toolkit-install.php';

        include_once CENTURY_TOOLKIT_ABSPATH . 'includes/century-toolkit-demo-data.php';
        include_once CENTURY_TOOLKIT_ABSPATH . 'includes/panel/demos.php';

    }


    public function init_hooks()
    {
        register_activation_hook(CENTURY_TOOLKIT_FILE, array('Century_Toolkit_Install', 'install'));

        add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

    }


    public function load_plugin_textdomain(){
        $current_folder_path = dirname(plugin_basename(__FILE__));
        load_plugin_textdomain('century-toolkit', false, dirname($current_folder_path) . '/languages/');
    }

    /**
     * Cloning is forbidden.
     *
     * @since 1.0.0
     */
    public function __clone()
    {
        _doing_it_wrong(__FUNCTION__, __( 'Cheatin&#8217; huh?', 'century-toolkit' ), '1.0.0');
    }

    /**
     * Unserializing instances of this class is forbidden.
     *
     * @since 1.0.0
     */
    public function __wakeup()
    {
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'century-toolkit'), '1.0.0');
    }

}