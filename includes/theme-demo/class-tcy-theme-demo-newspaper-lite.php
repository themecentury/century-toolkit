<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TCY_Theme_Demo_Newspaper_Lite extends TCY_Theme_Demo{

	public static function import_files(){
		$buy_now_url = 'https://themecentury.com/downloads/newspaper-plus-premium-wordpress-theme/?ref=import-demo-content';
		$demo_server_url = 'https://raw.githubusercontent.com/themecentury/demo/master/';
		$demo_url = 'https://demo.themecentury.com/wpthemes/';
		$demo_urls  = array(
			array(
				'import_file_name'           => esc_html__('Default News', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'newspaper-lite/default/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'newspaper-lite/default/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'newspaper-lite/default/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'newspaper-lite/default/screenshot.png',
				'demo_url'                   => $demo_url . 'newspaper-lite/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'century-toolkit' ),
			),
			array(
				'import_file_name'           => esc_html__('Arabic News(RTL)', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'newspaper-lite/arabic/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'newspaper-lite/arabic/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'newspaper-lite/arabic/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'newspaper-lite/arabic/screenshot.png',
				'demo_url'                   => $demo_url . 'newspaper-lite-rtl',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'century-toolkit' ),
			),
			array(
				'is_premium_demo'			=> true,
				'premium_buy_now_url'		=> $buy_now_url,
				'import_file_name'           => esc_html__('Default News - Pro', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'newspaper-plus/default/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'newspaper-plus/default/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'newspaper-plus/default/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'newspaper-plus/default/screenshot.png',
				'demo_url'                   => $demo_url . 'newspaper-plus/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'century-toolkit' ),
			),
			array(
				'is_premium_demo'			=> true,
				'premium_buy_now_url'		=> $buy_now_url,
				'import_file_name'           => esc_html__('Sports News', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'newspaper-plus/sports/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'newspaper-plus/sports/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'newspaper-plus/sports/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'newspaper-plus/sports/screenshot.png',
				'demo_url'                   => $demo_url . 'newspaper-plus-sports/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'century-toolkit' ),
			),
			array(
				'is_premium_demo'			=> true,
				'premium_buy_now_url'		=> $buy_now_url,
				'import_file_name'           => esc_html__('Arabic (RTL)', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'newspaper-plus/arabic/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'newspaper-plus/arabic/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'newspaper-plus/arabic/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'newspaper-plus/arabic/screenshot.png',
				'demo_url'                   => $demo_url . 'newspaper-plus-rtl/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'century-toolkit' ),
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

		$all_featured_sliders = get_option( 'widget_newspaper_lite_featured_slider' );
		foreach( $all_featured_sliders as $widget_index => $featured_slider_widget ){
			if ( isset( $featured_slider_widget['newspaper_lite_featured_category'] ) ) {
				$featured_blocks = $all_featured_sliders[ $widget_index ]['newspaper_lite_featured_category'];
				$all_featured_sliders[ $widget_index ]['newspaper_lite_featured_category'] = self::filter_category($featured_blocks);
			}
			if ( isset( $featured_slider_widget['newspaper_lite_slider_category'] ) ) {
				$slider_category = $all_featured_sliders[ $widget_index ]['newspaper_lite_slider_category'];
				$all_featured_sliders[ $widget_index ]['newspaper_lite_slider_category'] = self::filter_category($slider_category);
			}
		}
		update_option( 'widget_newspaper_lite_featured_slider', $all_featured_sliders );

		$all_block_grids = get_option( 'widget_newspaper_lite_block_grid' );
		foreach( $all_block_grids as $widget_index => $block_grid ){
			if ( isset( $block_grid['newspaper_lite_block_cat_id'] ) ) {
				$category_block_list = $all_block_grids[ $widget_index ]['newspaper_lite_block_cat_id'];
				$all_block_grids[ $widget_index ]['newspaper_lite_block_cat_id'] = self::filter_category($category_block_list);
			}
		}
		update_option( 'widget_newspaper_lite_block_grid', $all_block_grids );

		$all_block_column = get_option( 'widget_newspaper_lite_block_column' );
		foreach( $all_block_column as $widget_index => $single_widget ){
			if ( isset( $single_widget['newspaper_lite_block_cat_id'] ) ) {
				$category_block_list = $all_block_column[ $widget_index ]['newspaper_lite_block_cat_id'];
				$all_block_column[ $widget_index ]['newspaper_lite_block_cat_id'] = self::filter_category($category_block_list);
			}
		}
		update_option( 'widget_newspaper_lite_block_column', $all_block_column );

		$all_block_list = get_option( 'widget_newspaper_lite_block_list' );
		foreach( $all_block_list as $widget_index => $single_widget ){
			if ( isset( $single_widget['newspaper_lite_block_cat_id'] ) ) {
				$category_block_list = $all_block_list[ $widget_index ]['newspaper_lite_block_cat_id'];
				$all_block_list[ $widget_index ]['newspaper_lite_block_cat_id'] = self::filter_category($category_block_list);
			}
		}
		update_option( 'widget_newspaper_lite_block_list', $all_block_list );

		$all_block_layout = get_option( 'widget_newspaper_lite_block_layout' );
		foreach( $all_block_layout as $widget_index => $single_widget ){
			if ( isset( $single_widget['newspaper_lite_block_cat_id'] ) ){
				$category_block_list = $all_block_layout[ $widget_index ]['newspaper_lite_block_cat_id'];
				$all_block_layout[ $widget_index ]['newspaper_lite_block_cat_id'] = self::filter_category($category_block_list);
			}
		}
		update_option( 'widget_newspaper_lite_block_layout', $all_block_layout );

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
		$front_page_id = get_page_by_path( 'home' );
		$blog_page_id  = get_page_by_path( 'blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		update_option( 'themecentury_themes', $installed_demos );

	}

	public static function filter_category($category){
		$return_val = array();
		if(is_array($category)){
			foreach($category as $key=>$term_id){
				if( $term_id && term_exists( $term_id, 'category' ) ){
					$return_val[] = $term_id;
				}
			}
			return ($return_val) ? $return_val : '';
		}
		$term_id = absint($category);
		if( $term_id && term_exists( $term_id, 'category' ) ){
			return $term_id;
		}
		return 0;
	}
}

?>