<?php
add_filter('century_toolkit_demos_data', 'century_toolkit_demo_data_config');

function century_toolkit_demo_data_config(){

    $activate_theme = get_template();
    $author_name = apply_filters( 'century_toolkit_data_author_name', 'themecentury' );
    $global_file_location = 'https://raw.githubusercontent.com/'.$author_name.'/demo/master/';
    $default_demo_path = $global_file_location.$activate_theme.'/';
    $demo_file_location = apply_filters( 'century_toolkit_demo_path', $default_demo_path, $activate_theme );
    $request = wp_remote_get( $demo_file_location.'config.json' );
    $json_data = wp_remote_retrieve_body($request);
    $config_data = array();
    if($json_data){
        $config_data = json_decode($json_data, true );    
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