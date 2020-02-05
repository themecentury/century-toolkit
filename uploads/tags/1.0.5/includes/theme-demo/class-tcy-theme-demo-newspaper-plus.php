<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TCY_Theme_Demo_Newspaper_Plus extends TCY_Theme_Demo {

	public static function import_files() {

		$demo_server_url = 'https://raw.githubusercontent.com/themecentury/demo/master/newspaper-plus/';
		$demo_url = 'https://demo.themecentury.com/wpthemes/newspaper-plus/';
		$demo_urls  = array(
			array(
				'import_file_name'           => 'Newspaper Plus',
				'import_file_url'            => $demo_server_url . 'default/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'default/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'default/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'default/screenshot.png',
				'demo_url'                   => $demo_url . '',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			),
			array(
				'import_file_name'           => esc_html__('Sports News', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'sports/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'sports/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'sports/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'sports/screenshot.png',
				'demo_url'                   => $demo_url . 'newspaper-plus-sports/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'century-toolkit' ),
			),
			array(
				'import_file_name'           => esc_html__('Arabic (RTL)', 'century-toolkit'),
				'import_file_url'            => $demo_server_url . 'arabic/content.xml',
				'import_widget_file_url'     => $demo_server_url . 'arabic/widgets.wie',
				'import_customizer_file_url' => $demo_server_url . 'arabic/customizer.dat',
				'import_preview_image_url'   => $demo_server_url . 'arabic/screenshot.png',
				'demo_url'                   => $demo_url . 'newspaper-plus-rtl/',
				//'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'century-toolkit' ),
			),
		);
		return $demo_urls;

	}

	public static function after_import( $selected_import ) {

		// Assign front page and posts page (blog page).
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

		$all_post_carousel = get_option( 'widget_newspaper_lite_post_carousel' );
		foreach( $all_post_carousel as $widget_index => $single_widget ){
			if ( isset( $single_widget['newspaper_lite_carousel_category'] ) ){
				$post_carousel_category = $all_post_carousel[ $widget_index ]['newspaper_lite_carousel_category'];
				$all_post_carousel[ $widget_index ]['newspaper_lite_carousel_category'] = self::filter_category($post_carousel_category);
			}
		}
		update_option( 'widget_newspaper_lite_post_carousel', $all_post_carousel );

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

		$front_page_id = get_page_by_path( 'home' );
		$blog_page_id  = get_page_by_path( 'blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );

		// Assign front page and posts page (blog page).
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