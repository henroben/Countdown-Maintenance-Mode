<?php
/**
 * Plugin Name: Countdown Maintenance Mode
 * Description: Put your site into maintenance mode with a countdown timer
 * Version: 1.2
 * Author: Benjamin Mercer
 *
 **/

// Exit if Accessed Directly
if(!defined('ABSPATH')){
	exit;
}

// Global Options Variable
$cdmm_options = get_option('cdmm_settings');

// Load Scripts
require_once(plugin_dir_path(__FILE__) . '/includes/countdown-maintenance-mode-scripts.php');

// Load content
require_once(plugin_dir_path(__FILE__).'/includes/countdown-maintenance-mode-content.php');

// Check if admin
if(is_admin()){
	// Load Settings
	require_once(plugin_dir_path(__FILE__) . '/includes/countdown-maintenance-mode-settings.php');

}