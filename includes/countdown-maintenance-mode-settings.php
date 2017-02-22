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
		<h2><?php _e('Countdown Maintenance Mode Settings', 'cdmm_domain'); ?></h2>
		<p>
			<?php _e('Settings for the Countdown Maintenance Mode plugin', 'cdmm_domain'); ?>
		</p>
		<form method="post" action="options.php">
			<?php settings_fields('cdmm_settings_group'); ?>
			<table class="form-table">
				<tbody>
					<!-- Enable or disable Maintenance Mode -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[enable]">
								<?php _e('Enable Maintenance Mode', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input name="cdmm_settings[enable]" id="cdmm_settings[enable]" type="checkbox" value="1" <?php checked('1', $cdmm_options['enable']); ?> >
							<p>
								<?php _e('Put site into maintenance mode, only logged in Administrators will be able to view the site.', 'cdmm_domain'); ?>
							</p>
						</td>
					</tr>
					<!-- Enable or disable Interactive Background -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[enable_active_background]">
								<?php _e('Enable Interactive Background', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input name="cdmm_settings[enable_active_background]" id="cdmm_settings[enable_active_background]" type="checkbox" value="1" <?php checked('1', isset($cdmm_options['enable_active_background']) ? $cdmm_options['enable_active_background'] : ''); ?> >
							<p>
								<?php _e('Enable background image animation on mouse move, using interactive_bg.js', 'cdmm_domain'); ?>
							</p>
						</td>
					</tr>
					<!-- Select date/time for countdown -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[target_date]">
								<?php _e('Maintenance End Date', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input name="cdmm_settings[target_date]" id="cdmm_settings[target_date]" type="datetime-local" value="<?php echo $cdmm_options['target_date']; ?>">
							<p class="description">
								<?php _e('Enter a go live date to enable the countdown, clear date to remove countdown. Format DD/MM/YYYY HH:MM', 'cdmm_domain'); ?>
							</p>
						</td>
					</tr>
					<!-- Select Templage -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[template]">
								<?php _e('Select Template', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
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
						</td>
					</tr>
					<!-- Pick Text Colour -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[text_color]">
								<?php _e('Text Colour', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input name="cdmm_settings[text_color]" id="cdmm_settings[text_color]"
							       type="text" class="text-color" value="<?php echo (isset($cdmm_options['text_color']) && $cdmm_options['text_color'] != '' ) ? $cdmm_options['text_color'] : '#ffffff'; ?>">
							<p class="description">
								<?php _e('Enter a text colour for the Countdown Wrapper Panel', 'cdmm_domain'); ?>
							</p>
						</td>
					</tr>
					<!-- Font Family Selection -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[countdown_font]">
								<?php _e('Number Font', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
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
						</td>
					</tr>
					<!-- Select Panel Background Colour -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[info_background_color]">
								<?php _e('Wrapper Background', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input name="cdmm_settings[info_background_color]" id="cdmm_settings[info_background_color]"
							       type="text" class="info-background-color" value="<?php echo (isset($cdmm_options['info_background_color']) && $cdmm_options['info_background_color'] != '' ) ? $cdmm_options['info_background_color'] : '#333333'; ?>">
							<p class="description">
								<?php _e('Enter a background colour for the Countdown Wrapper Panel', 'cdmm_domain'); ?>
							</p>
						</td>
					</tr>
					<!-- Select Countdown background colour -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[countdown_background_color]">
								<?php _e('Countdown Background', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input name="cdmm_settings[countdown_background_color]" id="cdmm_settings[countdown_background_color]" type="text" class="countdown-background-color" value="<?php echo (isset($cdmm_options['countdown_background_color']) && $cdmm_options['countdown_background_color'] != '' ) ? $cdmm_options['countdown_background_color'] : '#444444'; ?>" >

							<p class="description">
								<?php _e('Enter a background colour for the Countdown Number Panels', 'cdmm_domain'); ?>
							</p>
						</td>
					</tr>
					<!-- Upload Logo -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[logo_image_url]">
								<?php _e('Upload Logo', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input name="cdmm_settings[logo_image_url]" id="cdmm_settings[logo_image_url]" type="hidden" class="widefat logo_image_url" value="<?php echo $cdmm_options['logo_image_url']; ?>">
							<input id="upload_logo" type="button" class="button" value="<?php _e( 'Upload', 'cdmm_domain' ); ?>" />
							<?php if ( '' != $cdmm_options['logo_image_url'] ): ?>
								<input id="delete_logo_button" name="cdmm_settings[logo_image_url]" type="submit" class="button" value="<?php _e( '', 'cdmm_domain' ); ?>" />
							<?php endif; ?>
							<p class="description">
								<?php _e('Upload a logo', 'cdmm_domain'); ?>
							</p>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="upload_logo_preview">
								<?php _e('Logo Preview', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<div id="upload_logo_preview">
								<img style="max-width:200px; background: #cccccc;" src="<?php if(!empty($cdmm_options['logo_image_url'])) { echo esc_url( $cdmm_options['logo_image_url'] ); } ?>" />
							</div>
						</td>
					</tr>
					<!-- Countdown message text -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[message]">
								<?php _e('Maintenance Message', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input name="cdmm_settings[message]" id="cdmm_settings[message]" type="text" class="widefat" value="<?php if(!empty($cdmm_options['message'])){ echo $cdmm_options['message']; } ?>">
							<p class="description">
								<?php _e('Enter a message', 'cdmm_domain'); ?>
							</p>
						</td>
					</tr>
					<!-- Upload Background Image -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[background_image_url]">
								<?php _e('Background Image', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input name="cdmm_settings[background_image_url]" id="cdmm_settings[background_image_url]" type="hidden" class="widefat background_image_url" value="<?php if(!empty($cdmm_options['background_image_url'])){ echo $cdmm_options['background_image_url']; } ?>">
							<input id="upload_background" type="button" class="button" value="<?php _e( 'Upload', 'cdmm_domain' ); ?>" />
							<?php if ( '' != $cdmm_options['background_image_url'] ): ?>
								<input id="delete_background_button" name="cdmm_settings[background_image_url]" type="submit" class="button" value="<?php _e( '', 'cdmm_domain' ); ?>" />
							<?php endif; ?>
							<p class="description">
								<?php _e('Upload a background image', 'cdmm_domain'); ?>
							</p>
						</td>
					</tr>

					<!-- Select Background Overlay -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[overlay]">
								<?php _e('Background Overlay Pattern', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
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
							<p class="description">
								<?php _e('Select an overlay pattern for the background image', 'cdmm_domain'); ?>
							</p>
						</td>
					</tr>

					<!-- Select Overlay Opacity -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[overlay_opacity]">
								<?php _e('Overlay Pattern Opacity', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input type="range" name="cdmm_settings[overlay_opacity]" id="cdmm_settings[overlay_opacity]" min="0" max="10" value="<?php if(!empty($cdmm_options['overlay_opacity'])){ echo $cdmm_options['overlay_opacity']; } ?>">
							<p class="description">
								<?php _e('Select the overlay pattern opacity', 'cdmm_domain'); ?>
							</p>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label for="upload_background_preview">
								<?php _e('Image Preview', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<div id="upload_background_preview">
								<img style="max-width:200px;" src="<?php if(!empty($cdmm_options['background_image_url'])) { echo esc_url( $cdmm_options['background_image_url'] ); } ?>" />
							</div>
						</td>
					</tr>
					<!-- Enable Contact Form -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[enable_form]">
								<?php _e('Enable Subscriber Form', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input name="cdmm_settings[enable_form]" id="cdmm_settings[enable_form]" type="checkbox" value="1" <?php checked('1', isset($cdmm_options['enable_form']) ? $cdmm_options['enable_form'] : ''); ?> >
							<p>
								<?php _e('Enable a subscriber form for users to request notifications, messages will be sent to the admin email address [' . get_option('admin_email') . ']', 'cdmm_domain'); ?>
							</p>
						</td>
					</tr>
					<!-- Enable Social Media Icons -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[enable_social_media]">
								<?php _e('Enable Social Media Icons', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input name="cdmm_settings[enable_social_media]" id="cdmm_settings[enable_social_media]" type="checkbox" value="1" <?php checked('1', isset($cdmm_options['enable_form']) ? $cdmm_options['enable_social_media'] : ''); ?>>
							<p>
								<?php _e('Enable linked social media icons'); ?>
							</p>
						</td>
					</tr>
					<!-- Facebook Profile -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[facebook]">
								<?php _e('Facebook Profile Link', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input name="cdmm_settings[facebook]" id="cdmm_settings[facebook]" type="text" value="<?php if(!empty($cdmm_options['linkedin'])){ echo $cdmm_options['linkedin']; } ?>" class="widefat">
							<p>
								<?php _e('Enter your Facebook profile url'); ?>
							</p>
						</td>
					</tr>
					<!-- Linkedin Profile -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[linkedin]">
								<?php _e('LinkedIn Profile Link', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input name="cdmm_settings[linkedin]" id="cdmm_settings[linkedin]" type="text" value="<?php if(!empty($cdmm_options['linkedin'])){ echo $cdmm_options['linkedin']; } ?>" class="widefat">
							<p>
								<?php _e('Enter your LinkedIn profile url'); ?>
							</p>
						</td>
					</tr>
					<!-- Twitter Profile -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[twitter]">
								<?php _e('Twitter Profile Link', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input name="cdmm_settings[twitter]" id="cdmm_settings[twitter]" type="text" value="<?php if(!empty($cdmm_options['twitter'])){ echo $cdmm_options['twitter']; } ?>" class="widefat">
							<p>
								<?php _e('Enter your Twitter profile url'); ?>
							</p>
						</td>
					</tr>
					<!-- Instagram Profile -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[instagram]">
								<?php _e('Instagram Profile Link', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input name="cdmm_settings[instagram]" id="cdmm_settings[instagram]" type="text" value="<?php if(!empty($cdmm_options['instagram'])){ echo $cdmm_options['instagram']; } ?>" class="widefat">
							<p>
								<?php _e('Enter your Instagram account url'); ?>
							</p>
						</td>
					</tr>
					<!-- YouTube Profile -->
					<tr>
						<th scope="row">
							<label for="cdmm_settings[youtube]">
								<?php _e('YouTube Account Link', 'cdmm_domain'); ?>
							</label>
						</th>
						<td>
							<input name="cdmm_settings[youtube]" id="cdmm_settings[youtube]" type="text" value="<?php if(!empty($cdmm_options['youtube'])){ echo $cdmm_options['youtube']; } ?>" class="widefat">
							<p>
								<?php _e('Enter your YouTube account url'); ?>
							</p>
						</td>
					</tr>
				</tbody>
			</table>
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes', 'cdmm_domain');?>">
			</p>
		</form>
	</div>
	<?php
	echo ob_get_clean();
}

add_action('admin_menu', 'cdmm_options_menu_link');

// Register Settings
function cdmm_register_settings() {
	register_setting('cdmm_settings_group', 'cdmm_settings');
}

add_action('admin_init', 'cdmm_register_settings');
