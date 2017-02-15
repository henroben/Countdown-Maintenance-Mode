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
				<tr>
					<th scope="row">
						<label for="cdmm_settings[target_date]">
							<?php _e('Maintenance End Date', 'cdmm_domain'); ?>
						</label>
					</th>
					<td>
						<input name="cdmm_settings[target_date]" id="cdmm_settings[target_date]" type="datetime-local" value="<?php echo $cdmm_options['target_date']; ?>">
						<p class="description">
							<?php _e('Enter a go live date to enable the countdown, clear date to remove countdown.', 'cdmm_domain'); ?>
						</p>
					</td>
				</tr>

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
							<img style="max-width:200px; background: #cccccc;" src="<?php echo esc_url( $cdmm_options['logo_image_url'] ); ?>" />
						</div>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="cdmm_settings[message]">
							<?php _e('Maintenance Message', 'cdmm_domain'); ?>
						</label>
					</th>
					<td>
						<input name="cdmm_settings[message]" id="cdmm_settings[message]" type="text" class="widefat" value="<?php echo $cdmm_options['message']; ?>">
						<p class="description">
							<?php _e('Enter a message', 'cdmm_domain'); ?>
						</p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="cdmm_settings[background_image_url]">
							<?php _e('Background Image', 'cdmm_domain'); ?>
						</label>
					</th>
					<td>
						<input name="cdmm_settings[background_image_url]" id="cdmm_settings[background_image_url]" type="hidden" class="widefat background_image_url" value="<?php echo $cdmm_options['background_image_url']; ?>">
						<input id="upload_background" type="button" class="button" value="<?php _e( 'Upload', 'cdmm_domain' ); ?>" />
						<?php if ( '' != $cdmm_options['background_image_url'] ): ?>
							<input id="delete_background_button" name="cdmm_settings[background_image_url]" type="submit" class="button" value="<?php _e( '', 'cdmm_domain' ); ?>" />
						<?php endif; ?>
						<p class="description">
							<?php _e('Upload a background image', 'cdmm_domain'); ?>
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
							<img style="max-width:200px;" src="<?php echo esc_url( $cdmm_options['background_image_url'] ); ?>" />
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="cdmm_settings[enable_form]">
							<?php _e('Enable Subscriber Form', 'cdmm_domain'); ?>
						</label>
					</th>
					<td>
						<input name="cdmm_settings[enable_form]" id="cdmm_settings[enable_form]" type="checkbox" value="1" <?php checked('1', $cdmm_options['enable_form']); ?> >
						<p>
							<?php _e('Enable a subscriber form for users to request notifications, messages will be sent to the admin email address [' . get_option('admin_email') . ']', 'cdmm_domain'); ?>
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
