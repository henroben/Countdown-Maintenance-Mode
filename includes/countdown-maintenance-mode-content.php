<?php
$cdmm_options = get_option('cdmm_settings');
// get user settings

function cdmm_set_mode() {
	if(!current_user_can('edit_theme_options') || !is_user_logged_in()){
		// Get site settings
		$site_language = get_bloginfo('language');
		$site_charset = get_bloginfo('charset');
		$site_name = get_bloginfo('name');
		$cdmm_options = get_option('cdmm_settings');
		$targetDate = $cdmm_options['target_date'];
		$message = $cdmm_options['message'];
		$background_image = $cdmm_options['background_image_url'];
		$logo_image = $cdmm_options['logo_image_url'];
		$enable_form = $cdmm_options['enable_form'];
		$recipient = get_option('admin_email');
		$subject = 'Message from Maintenance Form';
		$wrapper_color = $cdmm_options['info_background_color'];
		$text_color = $cdmm_options['text_color'];
		$time_color = $cdmm_options['countdown_background_color'];

		// check to see if background image has been set, if not, use default
		if(!$background_image) {
			$background_image = plugins_url() . '/countdown-maintenance-mode/img/wall.jpg';
		}
			echo '
		<!DOCTYPE html>
		<html lang="' . $site_language . '">
			<head>
			    <meta charset="'. $site_charset . '">
			    <title>' . $site_name . ' is currently undergoing maintenance</title>
			    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
			    <link rel="stylesheet" href="' . plugins_url() . '/countdown-maintenance-mode/css/style.css">
			    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
			    <script src="' . plugins_url() . '/countdown-maintenance-mode/js/jquery.interactive_bg.js"></script>
			    <script src="' . plugins_url() . '/countdown-maintenance-mode/js/main.js"></script>
			</head>
			<body>
				<script>
					var target_date = "' . $targetDate . '";
				</script>
				<div class=" wrapper bg" data-ibg-bg="' . $background_image . '"></div>
		        <div class="container">
		            <div class="center-wrapper" ';
						$style = 'style="';
						if(isset($wrapper_color)) {
			    	        $style .= 'background-color:' . $wrapper_color . ';';
						}
						if(isset($text_color)) {
							$style .= 'color:' . $text_color . ';';
						}
						$style .= '"';
		                echo $style . ' >';

						if($logo_image) {
							echo '<div class="logo">';
								echo '<img src="' . $logo_image . '" title="' . $site_name . '">';
							echo '</div>';
						}
						if($targetDate) {
							echo '
		                <div id="countdown" class="row">
		                    <div class="col-xs-1"></div>
		                    <div class="col-xs-2 time"';
							if(isset($wrapper_color)) {
								echo 'style="background-color:' . $time_color . ';"';
							}
							echo '>';
							echo '<span id="weeks">00</span>
		                        <div class="time-type">WEEKS</div>
		                    </div>
		                    <div class="col-xs-2 time"';
							if(isset($wrapper_color)) {
								echo 'style="background-color:' . $time_color . ';"';
							}
							echo '>';
							echo '<span id="days">00</span>
		                        <div class="time-type">DAYS</div>
		                    </div>
		                    <div  class="col-xs-2 time"';
							if(isset($wrapper_color)) {
								echo 'style="background-color:' . $time_color . ';"';
							}
							echo '>';
							echo '<span id="hours">00</span>
		                        <div class="time-type">HOURS</div>
		                    </div>
		                    <div class="col-xs-2 time"';
							if(isset($wrapper_color)) {
								echo 'style="background-color:' . $time_color . ';"';
							}
							echo '>';
							echo '<span id="minutes">00</span>
		                        <div class="time-type">MINS</div>
		                    </div>
		                    <div class="col-xs-2 time"';
							if(isset($wrapper_color)) {
								echo 'style="background-color:' . $time_color . ';"';
							}
							echo '>';
							echo '<span id="seconds">00</span>
		                        <div class="time-type">SECS</div>
		                    </div>
		                    <div class="col-xs-1"></div>
		                </div>';
						}
		                echo '<div class="row">
		                    <div class="col-xs-1"></div>
		                    <div class="col-xs-10 text">
		                        ' . $message . '
		                    </div>
		                    <div class="col-xs-1"></div>
		                </div>';
						if($enable_form) {
							echo '<div class="row">
			                    <div class="col-xs-1"></div>
			                    <form action="' . plugins_url() . '/countdown-maintenance-mode/includes/countdown-maintenance-mode-mailer.php" id="maintenance-form" method="post">
			                        <div class="col-xs-7 no-padding">
			                            <div class="form-group">
			                                <input class="form-control left-radius" type="text" placeholder="Please enter your email address" id="email" name="email">
			                                <input type="hidden" name="recipient" value="' . $recipient . '">
											<input type="hidden" name="subject" value="' . $subject . '">
			                            </div>
			                        </div>
			                        <div class="col-xs-3 no-padding">
			                            <div class="form-group">
			                                <input type="submit" class="btn btn-primary btn-block right-radius" name="subscriber_submit" value="SEND">
			                            </div>
			                        </div>
			                    </form>
			                    <div class="col-xs-1"></div>
			                </div>
			                <div class="row">
			                    <div class="col-xs-1"></div>
			                    <div class="col-xs-10">
			                        <div id="form-msg"></div>
			                    </div>
			                    <div class="col-xs-1"></div>
			                </div>';
						}
		            echo '</div>
		        </div>
				<script>
			        $(document).ready(function(){
			            $(".bg").interactive_bg({
			                contain: true,
			                wrapContent: false
			            });
			        });
			
			        $(window).resize(function() {
			            $(".wrapper > .ibg-bg").css({
			                width: $(window).outerWidth(),
			                height: $(window).outerHeight()
			            })
			        })
		        </script>
	        </body>
        </html>';
		die();
	}
}

if($cdmm_options['enable']) {
	add_action( 'send_headers', 'cdmm_set_mode' );
}