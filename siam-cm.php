<?php
/**
 * Plugin Name: Siam Call Marker API
 * Description: Siam Call Marker API: nana & application tests & siam-tours.com
 * Version: 0.2
 * Author: Mulli Bahr
 */
if ( ! defined( 'ABSPATH' ) ) {
	die('no direct access'); // Exit if accessed directly.
}

include_once  plugin_dir_path(__FILE__) . "inc/send-request.php" ;
// For Nana Form uncomments the following 2 lines
//include_once  plugin_dir_path(__FILE__) . "inc/siam-cm-forms.php" ;
//add_action( 'elementor_pro/forms/new_record', 'handle_siam_cm_forms', 10, 2 );
// For Siam Tours.com uncomments the following 2 lines
include_once  plugin_dir_path(__FILE__) . "inc/siam-tours-cm-forms.php" ;
add_action( 'elementor_pro/forms/new_record', 'handle_siam_tours_cm_forms', 10, 2 ); // new list & new mappings

