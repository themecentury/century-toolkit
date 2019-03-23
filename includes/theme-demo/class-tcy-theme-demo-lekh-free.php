<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TCY_Theme_Demo_Lekh_Free extends TCY_Theme_Demo{

	public static function import_files(){

		$demo_server_url = 'https://raw.githubusercontent.com/themecentury/demo/master/lekh/';
		$demo_url = 'https://demo.themecentury.com/wpthemes/lekh/';
		$demo_urls  = array(
			array(
				'import_file_name'           => esc_html__('Lekh - Default', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'default/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'default/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'default/customizer.dat',
				'import_preview_image_url'   => 'https://i0.wp.com/themes.svn.wordpress.org/lekh/1.0.0/screenshot.png',
				'demo_url'                   => $demo_url . '',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			)
		);
		return $demo_urls;

	}

	public static function after_import( $selected_import ) {


	}

}
