<?php
// Check if admin
if(is_admin()){
	// Add Scripts
	function cdmm_add_admin_scripts(){
		wp_enqueue_style('cdmm-admin-style', plugins_url().'/countdown-maintenance-mode/css/style-admin.css');
		wp_register_script( 'cdmm-upload',  plugins_url().'/countdown-maintenance-mode/js/cdmm_upload.js', array('jquery','media-upload','thickbox') );

		// enqueue scripts for media library
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');

		// enqueue script for color picker
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script('wp-color-picker');

		wp_enqueue_script('cdmm-upload');
	}

	add_action('admin_init', 'cdmm_add_admin_scripts');
}

// Add Scripts
function cdmm_add_scripts(){
	wp_enqueue_style('cdmm-main-style', plugins_url().'/countdown-maintenance-mode/css/style.css');
	wp_enqueue_script('cdmm-background', plugins_url().'/countdown-maintenance-mode/js/jquery.interactive_bg.js');
	wp_enqueue_script('cdmm-main-scripts', plugins_url().'/countdown-maintenance-mode/js/main.js');

}

add_action('wp_enqueue_scripts', 'cdmm_add_scripts');