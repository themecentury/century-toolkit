<?php
/**
 * Install demos page
 *
 * @package Century_Toolkit
 * @category Core
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Start Class
class Century_Toolkit_Install_Demos
{

    /**
     * Start things up
     */
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_page'), 10);
    }

    /**
     * Add sub menu page for the custom CSS input
     *
     * @since 1.0.0
     */
    public function add_page()
    {

        $title = esc_html__('Import Demos', 'century-toolkit');

        add_theme_page(
            $title,
            $title,
            'manage_options',
            'century-toolkit-install-demos',
            array($this, 'create_admin_page')
        );
    }

    /**
     * Settings page output
     *
     * @since 1.0.0
     */
    public function create_admin_page(){

        // Theme branding
        //$brand = century_toolkit_theme_branding();
        ?>

        <div class="century-toolkit-demo-wrap wrap">

            <h2><?php //echo esc_attr( $brand );
                ?><?php esc_attr_e('Import Demo Contents', 'century-toolkit'); ?></h2>

            <div class="theme-browser rendered">

                <?php
                // Vars
                $demos = Century_Toolkit_Demos::get_demos_data();
                $categories = Century_Toolkit_Demos::get_demo_all_categories($demos); ?>

                <?php if (!empty($categories)) : ?>
                    <div class="century-toolkit-header-bar">
                        <nav class="century-toolkit-navigation">
                            <ul>
                                <li class="active">
                                    <a href="#all" class="century-toolkit-navigation-link"><?php esc_html_e('All', 'century-toolkit'); ?></a>
                                </li>
                                <?php foreach ($categories as $key => $name) : ?>
                                    <li><a href="#<?php echo esc_attr($key); ?>"
                                           class="century-toolkit-navigation-link"><?php echo esc_html($name); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </nav>
                        <div clas="century-toolkit-search">
                            <input type="text" class="century-toolkit-search-input" name="century-toolkit-search" value=""
                                   placeholder="<?php esc_html_e('Search demos...', 'century-toolkit'); ?>">
                        </div>
                    </div>
                <?php endif; ?>

                <div class="themes wp-clearfix">

                    <?php

                    if($demos){

                        foreach ($demos as $demo_slug => $demo_details) {

                            $demo_link = (isset($demo_details['demo_link'])) ? $demo_details['demo_link'] : '';
                            $screenshot = isset($demo_details['screenshot']) ? $demo_details['screenshot'] : '';
                            $demo_name = isset($demo_details['demo_name']) ? $demo_details['demo_name'] : $demo_slug;
                            // Vars
                            $item_categories = Century_Toolkit_Demos::get_demo_item_categories($demo_details); ?>

                            <div class="theme-wrap" data-categories="<?php echo esc_attr($item_categories); ?>"
                               data-name="<?php echo esc_attr(strtolower($demo_slug)); ?>">

                               <div class="theme century-toolkit-open-popup" data-demo-id="<?php echo esc_attr($demo_slug); ?>">

                                <div class="theme-screenshot">
                                    <img src="<?php echo esc_url($screenshot); ?>"/>

                                    <div class="select-theme">
                                        <span><?php esc_html_e('Start Import', 'century-toolkit'); ?></span>
                                    </div>

                                    <div class="demo-import-loader preview-all preview-all-<?php echo esc_attr($demo_slug); ?>"></div>

                                    <div class="demo-import-loader preview-icon preview-<?php echo esc_attr($demo_slug); ?>">
                                        <i class="custom-loader"></i></div>
                                    </div>
                                    <div class="theme-id-container">
                                        <h2 class="theme-name" id="<?php echo esc_attr($demo_slug); ?>">
                                            <span><?php echo ucwords($demo_name); ?></span></h2>
                                            <div class="theme-actions">
                                                <a class="button button-primary"
                                                href="<?php echo esc_url($demo_link); ?>"
                                                target="_blank"><?php esc_html_e('Live Preview', 'century-toolkit'); ?></a>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            <?php } 

                        }else{
                            ?>
                            <div class="notice notice-warning">
                                <p><?php echo esc_html__( 'Sorry demo content could not found. Please check your internet connection or please use our official WordPress theme for demo import.', 'century-toolkit' ); ?></p>
                            </div>
                            <?php

                        }
                        ?>
                </div>

            </div>

        </div>

    <?php }
}

new Century_Toolkit_Install_Demos();