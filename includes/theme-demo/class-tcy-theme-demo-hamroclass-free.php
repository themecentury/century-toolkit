<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TCY_Theme_Demo_HamroClass_Free extends TCY_Theme_Demo{

	public static function import_files(){

		$demo_server_url = 'https://raw.githubusercontent.com/themecentury/demo/master/';
		$demo_url = 'https://demo.themecentury.com/';
		$buy_now_url = 'https://themecentury.com/downloads/hamroclass-pro-premium-wordpress-plugin/?ref=import-demo-content';

		if( !function_exists('is_plugin_active') ){
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		$disable_premium_demo = true;
		if( function_exists('is_plugin_active') && is_plugin_active('hamroclass-pro/hamroclass-pro.php') ){
			$disable_premium_demo = false;
		}

		$demo_urls  = array(
			array(
				'import_file_name'           => esc_html__('HamroClass - Default', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'hamroclass/default/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'hamroclass/default/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'hamroclass/default/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'hamroclass/default/screenshot.png',
				'demo_url'                   => $demo_url . 'wpthemes/hamroclass/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			),
			array(
				'import_file_name'           => esc_html__('HamroClass - Blog', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'hamroclass/blog/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'hamroclass/blog/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'hamroclass/blog/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'hamroclass/blog/screenshot.png',
				'demo_url'                   => $demo_url . 'wpthemes/hamroclass-blog/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			),
			array(
				'import_file_name'           => esc_html__('HamroClass - Hamro News', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'hamroclass/magazine/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'hamroclass/magazine/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'hamroclass/magazine/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'hamroclass/magazine/screenshot.png',
				'demo_url'                   => $demo_url . 'wpthemes/hamroclass-magazine/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			),
			array(
				'import_file_name'           => esc_html__('HamroClass - RTL', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'hamroclass/arabic/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'hamroclass/arabic/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'hamroclass/arabic/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'hamroclass/arabic/screenshot.png',
				'demo_url'                   => $demo_url . 'wpthemes/hamroclass-rtl/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			),
			array(
				'is_premium_demo'			=> $disable_premium_demo,
				'premium_buy_now_url'		=> $buy_now_url,
				'import_file_name'           => esc_html__('HamroClass Pro - Default', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'hamroclass-pro/default/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'hamroclass-pro/default/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'hamroclass-pro/default/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'hamroclass-pro/default/screenshot.png',
				'demo_url'                   => $demo_url . 'wpplugins/hamroclass-pro/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			),
			array(
				'is_premium_demo'			=> $disable_premium_demo,
				'premium_buy_now_url'		=> $buy_now_url,
				'import_file_name'           => esc_html__('HamroClass Pro - Kindergarten', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'hamroclass-pro/kindergarten/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'hamroclass-pro/kindergarten/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'hamroclass-pro/kindergarten/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'hamroclass-pro/kindergarten/screenshot.png',
				'demo_url'                   => $demo_url . 'wpplugins/hamroclass-pro-kindergarten/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			),
			array(
				'is_premium_demo'			=> $disable_premium_demo,
				'premium_buy_now_url'		=> $buy_now_url,
				'import_file_name'           => esc_html__('HamroClass Pro - Dark Mode', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'hamroclass-pro/darkmode/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'hamroclass-pro/darkmode/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'hamroclass-pro/darkmode/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'hamroclass-pro/darkmode/screenshot.png',
				'demo_url'                   => $demo_url . 'wpplugins/hamroclass-pro-darkmode/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			),
			array(
				'is_premium_demo'			=> $disable_premium_demo,
				'premium_buy_now_url'		=> $buy_now_url,
				'import_file_name'           => esc_html__('HamroClass Pro - University', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'hamroclass-pro/university/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'hamroclass-pro/university/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'hamroclass-pro/university/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'hamroclass-pro/university/screenshot.png',
				'demo_url'                   => $demo_url . 'wpplugins/hamroclass-pro-university/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			),
			array(
				'is_premium_demo'			=> $disable_premium_demo,
				'premium_buy_now_url'		=> $buy_now_url,
				'import_file_name'           => esc_html__('HamroClass Pro - Arabic', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'hamroclass-pro/arabic/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'hamroclass-pro/arabic/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'hamroclass-pro/arabic/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'hamroclass-pro/arabic/screenshot.png',
				'demo_url'                   => $demo_url . 'wpplugins/hamroclass-pro-arabic/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			),
			array(
				'is_premium_demo'			=> $disable_premium_demo,
				'premium_buy_now_url'		=> $buy_now_url,
				'import_file_name'           => esc_html__('HamroClass Pro - EDU Magazine', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'hamroclass-pro/magazine/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'hamroclass-pro/magazine/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'hamroclass-pro/magazine/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'hamroclass-pro/magazine/screenshot.png',
				'demo_url'                   => $demo_url . 'wpplugins/hamroclass-pro-magazine/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			),
			array(
				'is_premium_demo'			=> $disable_premium_demo,
				'premium_buy_now_url'		=> $buy_now_url,
				'import_file_name'           => esc_html__('HamroClass Pro - Blog', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'hamroclass-pro/blog/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'hamroclass-pro/blog/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'hamroclass-pro/blog/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'hamroclass-pro/blog/screenshot.png',
				'demo_url'                   => $demo_url . 'wpplugins/hamroclass-pro-blog/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			),

		);	

		return $demo_urls;

	}

	public static function after_import( $selected_import ) {

		$installed_demos  = get_option( 'themecentury_themes', array() );
		$import_file_name = isset( $selected_import['import_file_name'] ) ? $selected_import['import_file_name'] : '';
		if ( ! empty( $import_file_name ) ) {
			array_push( $installed_demos, $import_file_name );
		}

		$installed_demos = array_unique( $installed_demos );

		// SET Menus
		$new_theme_locations = get_registered_nav_menus();

		foreach ( $new_theme_locations as $location_key => $location ) {

			$menu = get_term_by( 'name', $location, 'nav_menu' );

			if ( isset( $menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'primary' => $menu->term_id,
					)
				);
			}
		}

		// Assign front page and posts page (blog page).
		$front_page_id = get_id_by_slug( 'home' );
		$blog_page_id  = get_id_by_slug( 'blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		update_option( 'themecentury_themes', $installed_demos );

	}

}
