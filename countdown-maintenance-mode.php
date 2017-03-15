<?php
/**
 * Plugin Name: Countdown Maintenance Mode
 * Description: Put your site into maintenance mode with a countdown timer
 * Version: 1.5
 * Author: Benjamin Mercer
 *
 **/

// Exit if Accessed Directly
if(!defined('ABSPATH')){
	exit;
}

// Global Options Variable
$default_values = array(
	'enable'                    =>  0, // enable maintenance mode
	'enable_active_background'  =>  1, // enable background effects
	'background_effect'         =>  'Interactive Background Image', // default effect
	'blur_amount'               =>  '20', // default blur amount
	'is_additive'               =>  0, // is additive for halftone effect
	'target_date'               =>  '', // countdown date, blank for default
	'message'                   =>  'Relax, we\'ll be back soon... please fill in the form if you\'d like to be notified when we\'re back online ', // default message
	'enable_form'               =>  1, // enable subscriber form by default
	'logo_image_url'            =>  plugins_url() . '/countdown-maintenance-mode/img/logo.png', // default logo
	'background_image_url'      =>  plugins_url() . '/countdown-maintenance-mode/img/wall.jpg', // default background
	'overlay'                   =>  'Black Dots', // enable overlay by default
	'overlay_opacity'           =>  2, // default opacity setting
	'template'                  =>  'Full Width', // default template
	'countdown_font'            => 'Roberto Mono', // default countdown font
	'info_background_color'     => '#333333', // default background colour
	'countdown_background_color'    =>  '#444444', // default countdown background colour
	'text_color'                =>  '#ffffff', // default text colour
	'enable_social_media'       =>  0, // social media off by default
	'facebook'                  =>  '',
	'twitter'                   =>  '',
	'linkedin'                  =>  '',
	'instagram'                 =>  '',
	'youtube'                   =>  ''
);

$cdmm_options = get_option('cdmm_settings', $default_values);

// Load Scripts
require_once(plugin_dir_path(__FILE__) . '/includes/countdown-maintenance-mode-scripts.php');

// Load content
require_once(plugin_dir_path(__FILE__).'/includes/countdown-maintenance-mode-content.php');

// Check if admin
if(is_admin()){
	// Load Settings
	require_once(plugin_dir_path(__FILE__) . '/includes/countdown-maintenance-mode-settings.php');

}