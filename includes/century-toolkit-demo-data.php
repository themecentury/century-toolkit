<?php
add_filter('century_toolkit_demos_data', 'century_toolkit_demo_data_config');

function century_toolkit_demo_data_config(){

    $config_data = array();

    $activate_theme = get_template();
    $transient_slug = 'century_toolkit_theme_data_'.$activate_theme;
    $config_data = get_transient( $transient_slug );
    $author_name = apply_filters( 'century_toolkit_data_author_name', 'themecentury' );
    $global_file_location = 'https://raw.githubusercontent.com/'.$author_name.'/demo/master/';
    $default_demo_path = $global_file_location.$activate_theme.'/';
    $demo_file_location = apply_filters( 'century_toolkit_demo_path', $default_demo_path, $activate_theme );

    if(!$config_data){

        $request = wp_remote_get( $demo_file_location.'config.json' );
        $json_data = wp_remote_retrieve_body($request);
        $config_data = ($json_data) ? json_decode($json_data, true ) : array();

        set_transient( $transient_slug, $config_data, DAY_IN_SECONDS );

    }

    if(!$config_data){
        return;
    }

    foreach($config_data as $demo_key => $demo_details ){
        $config_data[$demo_key]['xml_file'] = $demo_file_location.'/'.$demo_key.'/content.xml';
        $config_data[$demo_key]['widgets_file'] = $demo_file_location.'/'.$demo_key.'/widgets.wie';
        $config_data[$demo_key]['screenshot'] = $demo_file_location.'/'.$demo_key.'/screenshot.png';
        $config_data[$demo_key]['theme_settings'] = $demo_file_location.'/'.$demo_key.'/customizer.dat';
    }

    return $config_data;

}