<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TCY_Theme_Demo_BlogMagazine_Free extends TCY_Theme_Demo{

	public static function import_files(){

		$demo_server_url = 'https://raw.githubusercontent.com/themecentury/demo/master/';
		$demo_url = 'https://demo.dinesh-ghimire.com.np/';
		$buy_now_url = 'https://dinesh-ghimire.com.np/downloads/blogmagazine-pro-premium-wordpress-plugin/';

		if( !function_exists('is_plugin_active') ){
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		$disable_premium_demo = true;
		if( function_exists('is_plugin_active') && is_plugin_active('blogmagazine-pro/blogmagazine-pro.php') ){
			$disable_premium_demo = false;
		}

		$demo_urls  = array(
			array(
				'import_file_name'           => esc_html__('BlogMagazine - Default', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'blogmagazine/default/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'blogmagazine/default/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'blogmagazine/default/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'blogmagazine/default/screenshot.png',
				'demo_url'                   => $demo_url . 'wpthemes/blogmagazine/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			),
			array(
				'is_premium_demo'			=> $disable_premium_demo,
				'premium_buy_now_url'		=> $buy_now_url,
				'import_file_name'           => esc_html__('BlogMagazine Pro - Default', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'blogmagazine-pro/default/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'blogmagazine-pro/default/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'blogmagazine-pro/default/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'blogmagazine-pro/default/screenshot.png',
				'demo_url'                   => $demo_url . 'wpplugins/blogmagazine-pro/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			),
			array(
				'is_premium_demo'			=> $disable_premium_demo,
				'premium_buy_now_url'		=> $buy_now_url,
				'import_file_name'           => esc_html__('BlogMagazine Pro - Dark Mode', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'blogmagazine-pro/darkmode/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'blogmagazine-pro/darkmode/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'blogmagazine-pro/darkmode/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'blogmagazine-pro/darkmode/screenshot.png',
				'demo_url'                   => $demo_url . 'wpplugins/blogmagazine-pro-dark-mode/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			),
		);	

		return $demo_urls;

	}

	public static function after_import( $selected_import ) {


	}

}
