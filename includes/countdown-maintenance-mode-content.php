<?php

/*
 * Get and escape all settings for plugin, then pass through to relevant template file
 */

function cdmm_set_mode() {
	if(!current_user_can('edit_theme_options') || !is_user_logged_in()){

		// Get site settings
		$site_language = get_bloginfo('language');
		$site_charset = get_bloginfo('charset');
		$site_name = get_bloginfo('name');

		// Get and escape plugin settings so can be passed straight to template files
		$cdmm_options = get_option('cdmm_settings');
		$targetDate = isset($cdmm_options['target_date']) ? esc_attr($cdmm_options['target_date']) : null;
		$message = isset($cdmm_options['message']) ? sanitize_text_field($cdmm_options['message']) : null;
		$background_image = isset($cdmm_options['background_image_url']) ? esc_url($cdmm_options['background_image_url']) : null;
		$logo_image = isset($cdmm_options['logo_image_url']) ? esc_url($cdmm_options['logo_image_url']) : null;
		$enable_form = isset($cdmm_options['enable_form']) ? esc_attr($cdmm_options['enable_form']) : null;
		$recipient = esc_html(get_option('admin_email'));
		$subject = 'Message from Maintenance Form';
		$wrapper_color = isset($cdmm_options['info_background_color']) ? esc_attr($cdmm_options['info_background_color']) : null;
		$text_color = isset($cdmm_options['text_color']) ? esc_attr($cdmm_options['text_color']) : '#cccccc';
		$time_color = isset($cdmm_options['countdown_background_color']) ? esc_attr($cdmm_options['countdown_background_color']) : '#dddddd';
		$countdown_font = isset($cdmm_options['countdown_font']) ? esc_attr($cdmm_options['countdown_font']) : 'Roberto Mono';
		$template = isset($cdmm_options['template']) ? esc_attr($cdmm_options['template']) : 'Fixed Center';
		$enable_animation = isset($cdmm_options['enable_active_background']) ? esc_attr($cdmm_options['enable_active_background']) : null;
		$background_effect = isset($cdmm_options['background_effect']) ? esc_attr($cdmm_options['background_effect']) : 'None';
		$blur_amount = isset($cdmm_options['blur_amount']) ? esc_attr($cdmm_options['blur_amount']) : '25';
		$is_additive = isset($cdmm_options['is_additive']) ? esc_attr($cdmm_options['is_additive']) : null;
		$overlay = isset($cdmm_options['overlay']) ? esc_attr($cdmm_options['overlay']) : null;
		$enable_social_media = isset($cdmm_options['enable_social_media']) ? esc_attr($cdmm_options['enable_social_media']) : null;
		if(!empty($cdmm_options['facebook'])) { $social_media['facebook'] = esc_url($cdmm_options['facebook']); }
		if(!empty($cdmm_options['twitter'])) { $social_media['twitter'] = esc_url($cdmm_options['twitter']); }
		if(!empty($cdmm_options['linkedin'])) { $social_media['linkedin'] = esc_url($cdmm_options['linkedin']); }
		if(!empty($cdmm_options['instagram'])) { $social_media['instagram'] = esc_url($cdmm_options['instagram']); }
		if(!empty($cdmm_options['youtube'])) { $social_media['youtube'] = esc_url($cdmm_options['youtube']); }

		// check if overlay set
		if($overlay == 'None') {
			$overlay = null;
		} else {
			// overlay name == image-name, so convert to lowercase and replace ' ' with '-'
			$overlay = strtolower($overlay);
			$overlay = preg_replace('/\s+/', '-', $overlay);
			$overlay_opacity = isset($cdmm_options['overlay_opacity']) ? (esc_attr($cdmm_options['overlay_opacity']) / 10) : '0.3';
		}

		// check to see if background image has been set, if not, use default
		if(!$background_image) {
			$background_image = plugins_url() . '/countdown-maintenance-mode/img/wall.jpg';
		}

		header("Content-Type: text/html");

		// Check which template has been selected, if none selected then use default
		if($template) {
			switch($template) {
				case 'Fixed Center':
					include_once(dirname( __FILE__ ) . '../../templates/fixed_center_template/fixed_center_template.php');
					break;
				case 'Full Width':
					include_once(dirname( __FILE__ ) . '../../templates/full_width_template/full_width_template.php');
					break;
			}
		} else {
			// load in default template
			include_once(dirname( __FILE__ ) . '../../countdown-maintenance-mode/templates/fixed_center_template/fixed_center_template.php');
		}
		exit();
	}
}

if($cdmm_options['enable']) {
	add_action( 'send_headers', 'cdmm_set_mode' );
}