<?php
/**
 * Century_Toolkit install setup
 *
 * @package Century_Toolkit
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

/**
 * Main Century_Toolkit_Install Class.
 *
 * @class Century_Toolkit
 */
final class Century_Toolkit_Install
{

    public static function install()
    {
        if (!is_blog_installed()) {
            return;
        }
        add_option('century_toolkit_plugin_do_activation_redirect', true);
        update_option('century_toolkit_version', CENTURY_TOOLKIT_VERSION);


        // Check if we are not already running this routine.
        if ('yes' === get_transient('century_toolkit_installing')) {
            return;
        }

        // If we made it till here nothing is running yet, lets set the transient now.
        set_transient('century_toolkit_installing', 'yes', MINUTE_IN_SECONDS * 10);
        self::create_files();


        delete_transient('century_toolkit_installing');

    }

    public static function create_files()
    {
        // Bypass if filesystem is read-only and/or non-standard upload system is used.
        if (apply_filters('century_toolkit_install_skip_create_files', false)) {
            return;
        }

        // Install files and folders for uploading files and prevent hotlinking.
        $upload_dir = wp_upload_dir();

        $download_method = get_option('century_toolkit_file_download_method', 'force');

        $files = array(
            array(
                'base' => $upload_dir['basedir'] . '/century-toolkit-upload',
                'file' => 'index.html',
                'content' => '',
            ),
            array(
                'base' => CENTURY_TOOLKIT_UPLOAD_DIR,
                'file' => '.htaccess',
                'content' => 'deny from all',
            ),
            array(
                'base' => CENTURY_TOOLKIT_UPLOAD_DIR,
                'file' => 'century-toolkit-dynamic.css',
                'content' => "// YATRI DYNAMIC CSS CONTENT GOES HERE\n",
            ),
            array(
                'base' => CENTURY_TOOLKIT_UPLOAD_DIR,
                'file' => 'index.html',
                'content' => '',
            ),
        );

        if ('redirect' !== $download_method) {
            $files[] = array(
                'base' => $upload_dir['basedir'] . '/century-toolkit-upload',
                'file' => '.htaccess',
                'content' => '',
            );
        }

        $has_created_dir = false;
        foreach ($files as $file) {
            if (wp_mkdir_p($file['base']) && !file_exists(trailingslashit($file['base']) . $file['file'])) {
                $file_handle = @fopen(trailingslashit($file['base']) . $file['file'], 'w'); // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged, WordPress.WP.AlternativeFunctions.file_system_read_fopen
                if ($file_handle) {
                    fwrite($file_handle, $file['content']); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fwrite
                    fclose($file_handle); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fclose
                    if (!$has_created_dir) {
                        $has_created_dir = true;
                    }
                }
            }
        }
        if ($has_created_dir) {
            update_option('century_toolkit_upload_dir_created', 'yes');
        }


    }


}