<?php
$cdmm_options = get_option('cdmm_settings');
// get user settings

function cdmm_set_mode() {
	if(!current_user_can('edit_theme_options') || !is_user_logged_in()){
		// Get site & plugin settings
		$site_language = get_bloginfo('language');
		$site_charset = get_bloginfo('charset');
		$site_name = get_bloginfo('name');
		$cdmm_options = get_option('cdmm_settings');
		$targetDate = isset($cdmm_options['target_date']) ? $cdmm_options['target_date'] : null;
		$message = isset($cdmm_options['message']) ? $cdmm_options['message'] : null;
		$background_image = isset($cdmm_options['background_image_url']) ? $cdmm_options['background_image_url'] : null;
		$logo_image = isset($cdmm_options['logo_image_url']) ? $cdmm_options['logo_image_url'] : null;
		$enable_form = isset($cdmm_options['enable_form']) ? $cdmm_options['enable_form'] : null;
		$recipient = get_option('admin_email');
		$subject = 'Message from Maintenance Form';
		$wrapper_color = isset($cdmm_options['info_background_color']) ? $cdmm_options['info_background_color'] : null;
		$text_color = isset($cdmm_options['text_color']) ? $cdmm_options['text_color'] : '#cccccc';
		$time_color = isset($cdmm_options['countdown_background_color']) ? $cdmm_options['countdown_background_color'] : '#dddddd';
		$countdown_font = isset($cdmm_options['countdown_font']) ? $cdmm_options['countdown_font'] : 'Roberto Mono';
		$template = isset($cdmm_options['template']) ? $cdmm_options['template'] : 'Fixed Center';
		$enable_animation = isset($cdmm_options['enable_active_background']) ? $cdmm_options['enable_active_background'] : null;
		$overlay = isset($cdmm_options['overlay']) ? $cdmm_options['overlay'] : null;
		if($overlay == 'None') {
			$overlay = null;
		} else {
			$overlay = strtolower($overlay);
			$overlay = preg_replace('/\s+/', '-', $overlay);
			$overlay_opacity = isset($cdmm_options['overlay_opacity']) ? ($cdmm_options['overlay_opacity'] / 10) : '0.3';
		}

		// check to see if background image has been set, if not, use default
		if(!$background_image) {
			$background_image = plugins_url() . '/countdown-maintenance-mode/img/wall.jpg';
		}
		header("Content-Type: text/html");

		if($template) {
			switch($template) {
				case 'Fixed Center':
					include('/../templates/generic_template.php');
					break;
				case 'Full Width':
					include('/../templates/full_width_template.php');
					break;
			}
		} else {
			// load in default template
			include('/../templates/generic_template.php');
		}
		die();
	}
}

if($cdmm_options['enable']) {
	add_action( 'send_headers', 'cdmm_set_mode' );
}