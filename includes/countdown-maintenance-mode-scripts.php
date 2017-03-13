<?php
// Check if admin
if(is_admin()){
	// Add Admin Scripts
	function cdmm_add_admin_scripts(){
		wp_enqueue_style('cdmm-admin-style', plugins_url().'/countdown-maintenance-mode/css/style-admin.css');
		wp_enqueue_style('cdmm-date-time-picker-style', plugins_url().'/countdown-maintenance-mode/css/jquery-ui-timepicker-addon.min.css');
		wp_register_script( 'cdmm-upload',  plugins_url().'/countdown-maintenance-mode/js/cdmm_upload.js', array('jquery','media-upload','thickbox', 'jquery-ui-datepicker') );
		wp_register_script( 'cdmm-admin-bootstrap-js-hack',  plugins_url().'/countdown-maintenance-mode/js/bootstrap-hack.js');
		wp_register_script( 'cdmm-admin-bootstrap-js',  plugins_url().'/countdown-maintenance-mode/js/bootstrap.min.js');
		wp_register_script( 'cdmm-date-time-picker-script',  plugins_url().'/countdown-maintenance-mode/js/jquery-ui-timepicker-addon.min.js');

		// enqueue scripts for media library
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');

		// enqueue scripts for color picker
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script('wp-color-picker');

		// enqueue scripts for date / time picker
		wp_enqueue_style('e2b-admin-ui-css','http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/base/jquery-ui.css',false,"1.9.0",false);
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('cdmm-date-time-picker-script');

		// enqueue scripts to enable bootstrap
		wp_enqueue_script('cdmm-admin-bootstrap-js-hack');
		wp_enqueue_script('cdmm-admin-bootstrap-js');
		wp_enqueue_media();

		// enqueue the rest

		wp_enqueue_script('cdmm-upload');

	}

	add_action('admin_init', 'cdmm_add_admin_scripts');
}

function cdmm_add_scripts(){
	// maintenance page loading after send_headers, so no need to enqueue scripts for frontend,
	// will load within template
}

add_action('wp_enqueue_scripts', 'cdmm_add_scripts');