<?php
//	Create menu link
function cdmm_options_menu_link() {
	add_options_page(
		'Countdown Maintenance Mode Options', // Section title
		'Maintenance Mode', // Menu link title
		'manage_options', // Compatibility
		'cdmm-options', // Menu slug
		'cdmm_options_content' // function to display content
	);
}

//	Create Options Page Content
function cdmm_options_content() {
	// Init Options Global
	global $cdmm_options;

	function fontToClass($value) {
		$class = strtolower($value);
		$class = preg_replace('/\s+/', '-', $class);
		return $class;
	}

	ob_start(); ?>
	<div class="wrap">
		<div class="bootstrap-wrapper">
			<div class="row">
				<div class="col-md-12">
					<h2><?php _e('Countdown Maintenance Mode Settings', 'cdmm_domain'); ?></h2>
					<p>
						<?php _e('Settings for the Countdown Maintenance Mode plugin', 'cdmm_domain'); ?>
					</p>
				</div>
			</div>
			<form method="post" action="options.php">
				<?php settings_fields('cdmm_settings_group'); ?>
				<div class="col-md-12">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#basic">Basic Settings</a></li>
						<li><a data-toggle="tab" href="#images">Logo &amp; Images</a></li>
						<li><a data-toggle="tab" href="#templates">Templates &amp; Colours</a></li>
						<li><a data-toggle="tab" href="#socialmedia">Social Media</a></li>
						<li><a data-toggle="tab" href="#preview">Preview</a></li>
					</ul>
					<div class="tab-content">
						<div id="basic" class="tab-pane fade in active">
							<h3>Basic Settings</h3>
							<hr>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[enable]">
										<?php _e('Enable Maintenance Mode', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-9">
									<input name="cdmm_settings[enable]" id="cdmm_settings[enable]" type="checkbox" value="1" <?php checked('1', $cdmm_options['enable']); ?>  >
									<p>
										<?php _e('Put site into maintenance mode, only logged in Administrators will be able to view the site.', 'cdmm_domain'); ?>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[enable_active_background]">
										<?php _e('Enable Background Effect', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-9">
									<input name="cdmm_settings[enable_active_background]" id="cdmm_settings[enable_active_background]" type="checkbox" value="1" <?php checked('1', isset($cdmm_options['enable_active_background']) ? $cdmm_options['enable_active_background'] : ''); ?> >
									<p>
										<?php _e('Enable background image effect', 'cdmm_domain'); ?>
									</p>
								</div>
							</div>
							<div class="row background-effect">
								<div class="col-md-3">
									<label for="cdmm_settings[background_effect]">
										<?php _e('Select Background Effect', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-6">
									<select name="cdmm_settings[background_effect]" id="cdmm_settings[background_effect]" class="form-control background-effect-select">
										<?php
										$option_values = array(
											'None',
											'Interactive Background Image',
											'Blur Background Image',
											'Halftone Background Image'
										);
										foreach($option_values as $key => $value) {
											if($value == $cdmm_options['background_effect']) {
												?>
												<option selected><?php echo $value; ?></option>
												<?php
											} else {
												?>
												<option><?php echo $value; ?></option>
												<?php
											}
										}
										?>
									</select>
								</div>
								<div class="col-md-3">
									<p id="background-effect-description">
										<?php _e('Select background image effect', 'cdmm_domain'); ?>
									</p>
								</div>
							</div>
							<div class="row background-blur">
								<div class="col-md-3">
									<label for="cdmm_settings[blur_amount]">
										<?php _e('Set Blur Amount', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-6">
									<input type="range" name="cdmm_settings[blur_amount]" id="cdmm_settings[blur_amount]" min="0" max="100" value="<?php if(!empty($cdmm_options['blur_amount'])){ echo $cdmm_options['blur_amount']; } ?>">
								</div>
								<div class="col-md-3">
									<p>
										<?php _e('Adjust the amount of background blur', 'cdmm_domain'); ?>
									</p>
								</div>
							</div>
							<div class="row background-halftone">
								<div class="col-md-3">
									<label for="cdmm_settings[is_additive]">
										<?php _e('Is Additive', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-1">
									<input name="cdmm_settings[is_additive]" id="cdmm_settings[is_additive]" type="checkbox" value="1" <?php checked('1', isset($cdmm_options['is_additive']) ? $cdmm_options['is_additive'] : ''); ?> >
								</div>
								<div class="col-md-8">
									<p>
										<?php _e('Set if additive, checked for 3 colour dots with dark background, unchecked for white background and black dots. Warning: checked version is more resource hungry, if preview background is blank, try closing some tabs', 'cdmm_domain'); ?>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[target_date]">
										<?php _e('Maintenance End Date', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-9">
									<input name="cdmm_settings[target_date]" id="cdmm_settings[target_date]" type="datetime-local" value="<?php echo $cdmm_options['target_date']; ?>" class="date-picker">
									<p class="description">
										<?php _e('Enter a go live date to enable the countdown, clear date to remove countdown. Format YY-MM-DD HH:MM', 'cdmm_domain'); ?>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[message]">
										<?php _e('Maintenance Message', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-9">
									<input name="cdmm_settings[message]" id="cdmm_settings[message]" type="text" class="widefat" value="<?php if(!empty($cdmm_options['message'])){ echo $cdmm_options['message']; } ?>">
									<p class="description">
										<?php _e('Enter a message', 'cdmm_domain'); ?>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[enable_form]">
										<?php _e('Enable Subscriber Form', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-9">
									<input name="cdmm_settings[enable_form]" id="cdmm_settings[enable_form]" type="checkbox" value="1" <?php checked('1', isset($cdmm_options['enable_form']) ? $cdmm_options['enable_form'] : ''); ?> >
									<p>
										<?php _e('Enable a subscriber form for users to request notifications, messages will be sent to the admin email address [' . get_option('admin_email') . ']', 'cdmm_domain'); ?>
									</p>
								</div>
							</div>
						</div>
						<div id="images" class="tab-pane fade">
							<h3>Image Options</h3>
							<hr>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[logo_image_url]">
										<?php _e('Upload Logo', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-3">
									<input name="cdmm_settings[logo_image_url]" id="cdmm_settings[logo_image_url]" type="hidden" class="widefat logo_image_url" value="<?php echo $cdmm_options['logo_image_url']; ?>">
									<input id="upload_logo" type="button" class="btn btn-primary" value="<?php _e( 'Upload', 'cdmm_domain' ); ?>" />
									<?php if ( 'Delete' != $cdmm_options['logo_image_url'] ): ?>
<!--										<input id="delete_logo_button" name="cdmm_settings[logo_image_url]" type="submit" class="button" value="--><?php //_e( '', 'cdmm_domain' ); ?><!--" />-->
										<input id="cdmm_settings[logo_image_url]" name="cdmm_settings[logo_image_url]" type="submit" class="btn btn-danger" value="<?php _e( 'Delete', 'cdmm_domain' ); ?>" />
									<?php endif; ?>
								</div>
								<div class="col-md-6">
									<div id="upload_logo_preview">
										<img style="max-width:200px; background: #cccccc;" src="<?php if($cdmm_options['logo_image_url'] != 'Delete') { echo esc_url( $cdmm_options['logo_image_url'] ); } ?>" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[background_image_url]">
										<?php _e('Background Image', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-3">
									<input name="cdmm_settings[background_image_url]" id="cdmm_settings[background_image_url]" type="hidden" class="widefat background_image_url" value="<?php if(!empty($cdmm_options['background_image_url'])){ echo $cdmm_options['background_image_url']; } ?>">
									<input id="upload_background" type="button" class="btn btn-primary" value="<?php _e( 'Upload', 'cdmm_domain' ); ?>" />
									<?php if ( 'Delete' != $cdmm_options['background_image_url'] ): ?>
<!--										<input id="delete_background_button" name="cdmm_settings[background_image_url]" type="submit" class="button" value="--><?php //_e( '', 'cdmm_domain' ); ?><!--" />-->
										<input id="cdmm_settings[background_image_url]" name="cdmm_settings[background_image_url]" type="submit" class="btn btn-danger" value="<?php _e( 'Delete', 'cdmm_domain' ); ?>" />
									<?php endif; ?>
								</div>
								<div class="col-md-6">
									<div id="upload_background_preview">
										<img style="max-width:200px;" src="<?php if($cdmm_options['background_image_url'] != 'Delete') { echo esc_url( $cdmm_options['background_image_url'] ); } ?>" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[overlay]">
										<?php _e('Background Overlay Pattern', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-5">
									<select name="cdmm_settings[overlay]" id="cdmm_settings[overlay]" class="form-control">
										<?php
										$option_values = array(
											'None',
											'Black Dots',
											'White Dots',
											'Black Squares',
											'White Squares',
											'Black Small Checks',
											'White Small Checks',
											'Black Medium Checks',
											'White Medium Checks',
											'Black Large Checks',
											'White Large Checks',
											'Black Vertical Stripes',
											'White Vertical Stripes',
											'Black Vertical Lines',
											'White Vertical Lines',
											'Black Horizontal Stripes',
											'White Horizontal Stripes',
											'Black Horizontal Lines',
											'White Horizontal Lines',
											'Black Criss Cross',
											'White Criss Cross',
											'Black Diagonal Lines',
											'White Diagonal Lines',
											'Black Fly Screen',
											'White Fly Screen',
											'Black Plus Signs',
											'White Plus Signs',
											'Black Zig Zag',
											'White Zig Zag',
											'Black Broken Lines',
											'White Broken Lines'
										);
										foreach($option_values as $key => $value) {
											if($value == $cdmm_options['overlay']) {
												?>
												<option class="<?php echo $value; ?>" selected><?php echo $value; ?></option>
												<?php
											} else {
												?>
												<option class="<?php echo $value; ?>"><?php echo $value; ?></option>
												<?php
											}
										}
										?>
									</select>
								</div>
								<div class="col-md-4">
									<p class="description">
										<?php _e('Select an overlay pattern for the background image', 'cdmm_domain'); ?>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[overlay_opacity]">
										<?php _e('Overlay Pattern Opacity', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-5">
									<input type="range" name="cdmm_settings[overlay_opacity]" id="cdmm_settings[overlay_opacity]" min="0" max="10" value="<?php if(!empty($cdmm_options['overlay_opacity'])){ echo $cdmm_options['overlay_opacity']; } ?>">
								</div>
								<div class="col-md-4">
									<p class="description">
										<?php _e('Select the overlay pattern opacity', 'cdmm_domain'); ?>
									</p>
								</div>
							</div>
						</div>
						<div id="templates" class="tab-pane fade">
							<h3>Templates, Colours and Fonts</h3>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[template]">
										<?php _e('Select Template', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-9">
									<select name="cdmm_settings[template]" id="cdmm_settings[template]" class="form-control">
										<?php
										$option_values = array(
											'Fixed Center',
											'Full Width'
										);
										foreach($option_values as $key => $value) {
											if($value == $cdmm_options['template']) {
												?>
												<option selected><?php echo $value; ?></option>
												<?php
											} else {
												?>
												<option><?php echo $value; ?></option>
												<?php
											}
										}
										?>
									</select>
									<p class="description">
										<?php _e('Select the maintenance page template', 'cdmm_domain'); ?>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[countdown_font]">
										<?php _e('Number Font', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-9">
									<select name="cdmm_settings[countdown_font]" id="cdmm_settings[countdown_font]" class="form-control">
										<?php
										$option_values = array(
											'Roberto Mono',
											'Share Tech Mono',
											'Nova Mono',
											'Fira Mono'
										);
										foreach($option_values as $key => $value) {
											if($value == $cdmm_options['countdown_font']) {
												?>
												<option class="<?php echo fontToClass($value); ?>" selected><?php echo $value; ?></option>
												<?php
											} else {
												?>
												<option class="<?php echo fontToClass($value); ?>"><?php echo $value; ?></option>
												<?php
											}
										}
										?>
									</select>
									<p class="description">
										<?php _e('Select a font for the Countdown numerals', 'cdmm_domain'); ?>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[info_background_color]">
										<?php _e('Wrapper Background', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-9">
									<input name="cdmm_settings[info_background_color]" id="cdmm_settings[info_background_color]"
									       type="text" class="info-background-color" value="<?php echo (isset($cdmm_options['info_background_color']) && $cdmm_options['info_background_color'] != '' ) ? $cdmm_options['info_background_color'] : '#333333'; ?>">
									<p class="description">
										<?php _e('Enter a background colour for the Countdown Wrapper Panel', 'cdmm_domain'); ?>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[countdown_background_color]">
										<?php _e('Countdown Background', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-9">
									<input name="cdmm_settings[countdown_background_color]" id="cdmm_settings[countdown_background_color]" type="text" class="countdown-background-color" value="<?php echo (isset($cdmm_options['countdown_background_color']) && $cdmm_options['countdown_background_color'] != '' ) ? $cdmm_options['countdown_background_color'] : '#444444'; ?>" >
									<p class="description">
										<?php _e('Enter a background colour for the Countdown Number Panels', 'cdmm_domain'); ?>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[text_color]">
										<?php _e('Text Colour', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-9">
									<input name="cdmm_settings[text_color]" id="cdmm_settings[text_color]"
									       type="text" class="text-color" value="<?php echo (isset($cdmm_options['text_color']) && $cdmm_options['text_color'] != '' ) ? $cdmm_options['text_color'] : '#ffffff'; ?>">
									<p class="description">
										<?php _e('Enter a text colour for the Countdown Wrapper Panel', 'cdmm_domain'); ?>
									</p>
								</div>
							</div>
						</div>
						<div id="socialmedia" class="tab-pane fade">
							<h3>Social Media</h3>
							<hr>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[enable_social_media]">
										<?php _e('Enable Social Media Icons', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-6">
									<input name="cdmm_settings[enable_social_media]" id="cdmm_settings[enable_social_media]" type="checkbox" value="1" <?php checked('1', isset($cdmm_options['enable_form']) ? $cdmm_options['enable_social_media'] : ''); ?>>
								</div>
								<div class="col-md-3">
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[facebook]">
										<?php _e('Facebook Profile Link', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-6">
									<input name="cdmm_settings[facebook]" id="cdmm_settings[facebook]" type="text" value="<?php if(!empty($cdmm_options['facebook'])){ echo $cdmm_options['facebook']; } ?>" class="widefat">
								</div>
								<div class="col-md-3">
									<p>
										<?php _e('Enter your Facebook profile url'); ?>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[linkedin]">
										<?php _e('LinkedIn Profile Link', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-6">
									<input name="cdmm_settings[linkedin]" id="cdmm_settings[linkedin]" type="text" value="<?php if(!empty($cdmm_options['linkedin'])){ echo $cdmm_options['linkedin']; } ?>" class="widefat">
								</div>
								<div class="col-md-3">
									<p>
										<?php _e('Enter your LinkedIn profile url'); ?>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[twitter]">
										<?php _e('Twitter Profile Link', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-6">
									<input name="cdmm_settings[twitter]" id="cdmm_settings[twitter]" type="text" value="<?php if(!empty($cdmm_options['twitter'])){ echo $cdmm_options['twitter']; } ?>" class="widefat">
								</div>
								<div class="col-md-3">
									<p>
										<?php _e('Enter your Twitter profile url'); ?>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[instagram]">
										<?php _e('Instagram Profile Link', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-6">
									<input name="cdmm_settings[instagram]" id="cdmm_settings[instagram]" type="text" value="<?php if(!empty($cdmm_options['instagram'])){ echo $cdmm_options['instagram']; } ?>" class="widefat">
								</div>
								<div class="col-md-3">
									<p>
										<?php _e('Enter your Instagram account url'); ?>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="cdmm_settings[youtube]">
										<?php _e('YouTube Account Link', 'cdmm_domain'); ?>
									</label>
								</div>
								<div class="col-md-6">
									<input name="cdmm_settings[youtube]" id="cdmm_settings[youtube]" type="text" value="<?php if(!empty($cdmm_options['youtube'])){ echo $cdmm_options['youtube']; } ?>" class="widefat">
								</div>
								<div class="col-md-3">
									<p>
										<?php _e('Enter your YouTube account url'); ?>
									</p>
								</div>
							</div>
						</div>
						<div id="preview" class="tab-pane fade" style="text-align: center;">
							<iframe src="<?php echo plugins_url() . '/countdown-maintenance-mode/includes/preview-mode.php?options=' . urlencode(json_encode($cdmm_options)) . '&base=' . urlencode(plugins_url()); ?>" frameborder="0" style="width: 1024px; height: 576px;"></iframe>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<input type="submit" name="submit" id="submit" class="btn btn-primary btn-block" value="<?php _e('Save Changes', 'cdmm_domain');?>">
						</div>
					</div>
				</div>

		</div>
		</form>
	</div>
	<?php
	echo ob_get_clean();
}

add_action('admin_menu', 'cdmm_options_menu_link');

// Register Settings
function cdmm_register_settings() {
	register_setting('cdmm_settings_group', 'cdmm_settings', 'cdmm_settings_validate');
}

add_action('admin_init', 'cdmm_register_settings');

// Validate Settings
function cdmm_settings_validate($input) {
	$new_input = array();

	foreach( $input as $key => $value ) {

		// Check to see if the current option has a value. If so, process it.
		if( isset( $input[$key] ) ) {
			// Strip all HTML and PHP tags and properly handle quoted strings
			$new_input[$key] = strip_tags( stripslashes( $input[ $key ] ) );
		}

	}

	// Return the array processing any additional functions filtered by this action
	return apply_filters( 'cdmm_settings_validate', $new_input, $input );
}
