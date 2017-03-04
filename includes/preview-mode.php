<?php
$param = $_GET['options'];
$base = $_GET['base'];
$param = urldecode($param);
$cdmm_options = json_decode($param, true);
	// Get site settings
	$site_language = 'en';
	$site_charset = '';
	$site_name = 'Preview';

	// Get and escape plugin settings so can be passed straight to template files
//	$targetDate = $_GET['targetdate'];
//	$message = $_GET['message'];
//	$background_image = $_GET['background'];
//	$logo_image = $_GET['logo'];
//	$enable_form = $_GET['enableform'];
//	$recipient = '';
//	$subject = 'Message from Maintenance Form';
//	$wrapper_color = $_GET['backgroundcolour'];
//	$text_color = $_GET['textcolour'];
//	$time_color = $_GET['timecolour'];
//	$countdown_font = $_GET['font'];
//	$template = $_GET['template'];
//	$enable_animation = $_GET['animation'];
//	$overlay = $_GET['overlay'];
//	$enable_social_media = $_GET['enablesm'];
//	if(!empty($_GET['facebook'])) { $social_media['facebook'] = $_GET['facebook']; }
//	if(!empty($cdmm_options['twitter'])) { $social_media['twitter'] = esc_url($cdmm_options['twitter']); }
//	if(!empty($cdmm_options['linkedin'])) { $social_media['linkedin'] = esc_url($cdmm_options['linkedin']); }
//	if(!empty($cdmm_options['instagram'])) { $social_media['instagram'] = esc_url($cdmm_options['instagram']); }
//	if(!empty($cdmm_options['youtube'])) { $social_media['youtube'] = esc_url($cdmm_options['youtube']); }
$targetDate = isset($cdmm_options['target_date']) ? $cdmm_options['target_date'] : null;
$message = isset($cdmm_options['message']) ? $cdmm_options['message'] : null;
$background_image = isset($cdmm_options['background_image_url']) ? $cdmm_options['background_image_url'] : null;
$logo_image = isset($cdmm_options['logo_image_url']) ? $cdmm_options['logo_image_url'] : null;
$enable_form = isset($cdmm_options['enable_form']) ? $cdmm_options['enable_form'] : null;
$recipient = '';
$subject = 'Message from Maintenance Form';
$wrapper_color = isset($cdmm_options['info_background_color']) ? $cdmm_options['info_background_color'] : null;
$text_color = isset($cdmm_options['text_color']) ? $cdmm_options['text_color'] : '#cccccc';
$time_color = isset($cdmm_options['countdown_background_color']) ? $cdmm_options['countdown_background_color'] : '#dddddd';
$countdown_font = isset($cdmm_options['countdown_font']) ? $cdmm_options['countdown_font'] : 'Roberto Mono';
$template = isset($cdmm_options['template']) ? $cdmm_options['template'] : 'Fixed Center';
$enable_animation = isset($cdmm_options['enable_active_background']) ? $cdmm_options['enable_active_background'] : null;
$background_effect = isset($cdmm_options['background_effect']) ? $cdmm_options['background_effect'] : 'None';
$blur_amount = isset($cdmm_options['blur_amount']) ? $cdmm_options['blur_amount'] : '25';
$is_additive = isset($cdmm_options['is_additive']) ? $cdmm_options['is_additive'] : null;
$overlay = isset($cdmm_options['overlay']) ? $cdmm_options['overlay'] : null;
$enable_social_media = isset($cdmm_options['enable_social_media']) ? $cdmm_options['enable_social_media'] : null;
if(!empty($cdmm_options['facebook'])) { $social_media['facebook'] = $cdmm_options['facebook']; }
if(!empty($cdmm_options['twitter'])) { $social_media['twitter'] = $cdmm_options['twitter']; }
if(!empty($cdmm_options['linkedin'])) { $social_media['linkedin'] = $cdmm_options['linkedin']; }
if(!empty($cdmm_options['instagram'])) { $social_media['instagram'] = $cdmm_options['instagram']; }
if(!empty($cdmm_options['youtube'])) { $social_media['youtube'] = $cdmm_options['youtube']; }
$preview = true;

	// check if overlay set
	if($overlay == 'None') {
		$overlay = null;
	} else {
		// overlay name == image-name, so convert to lowercase and replace ' ' with '-'
		$overlay = strtolower($overlay);
		$overlay = preg_replace('/\s+/', '-', $overlay);
		$overlay_opacity = ($cdmm_options['overlay_opacity'] / 10);
	}

	// check to see if background image has been set, if not, use default
	if($background_image == 'Delete') {
		$background_image = $base . '/countdown-maintenance-mode/img/wall.jpg';
	}

	header("Content-Type: text/html");

	// Check which template has been selected, if none selected then use default
	if($template) {
		switch($template) {
			case 'Fixed Center':
				include(dirname( __FILE__ ) . '../../templates/fixed_center_template/fixed_center_template.php');
				break;
			case 'Full Width':
				include(dirname( __FILE__ ) . '../../templates/full_width_template/full_width_template.php');
				break;
		}
	} else {
		// load in default template
		include(dirname( __FILE__ ) . '../../templates/fixed_center_template/fixed_center_template.php');
	}
	exit();