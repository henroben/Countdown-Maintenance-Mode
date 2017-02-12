<?php
$cdmm_options = get_option('cdmm_settings');

// get plugin settings
//$cdmm_enable_maintenance_mode = $cdmm_options['enable'];
function cdmm_set_mode() {
	if(!current_user_can('edit_themes') || !is_user_logged_in()){
		// Get site settings
		$site_language = get_bloginfo('language');
		$site_charset = get_bloginfo('charset');
		$site_name = get_bloginfo('name');
		$cdmm_options = get_option('cdmm_settings');
		$targetDate = $cdmm_options['target_date'];
		$message = $cdmm_options['message'];
		$background_image = $cdmm_options['background_image_url'];
		$recipient = 'henro_ben@yahoo.co.uk';
		$subject = 'Message from Maintenance Form';

		echo '<script>console.log(\'' . $background_image . '\');</script>';

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
		            <div class="center-wrapper">
		                <div class="logo">
		                    <svg
		                   xmlns="http://www.w3.org/2000/svg"
		                   version="1.0"
		                   width="750"
		                   height="900"
		                   viewBox="0 0 750 900"
		                   id="Layer_1"
		                   xml:space="preserve"><defs
		                   id="defs11" />
		                    <g id="Face">
		                        <path d="M 375,8.5 C 226.5,8.5 21.5,102.2 21.5,346 C 21.5,346.8 21.5,347.7 21.5,348.5 C 23.2,591.2 270.1,891.5 375,891.5 C 480.3,891.5 728.5,589.8 728.5,346 C 728.5,102.2 523.5,8.5 375,8.5 z M 57,367.5 C 230,367.5 355,489.5 355,672.5 C 174,672.5 57,555.5 57,367.5 z M 699,367.5 C 699,555.5 579.6,672.5 395,672.5 C 395,489.5 522.5,367.5 699,367.5 z"
		                       id="path4" />
		                    </g>
		                    <g id="Eyes" style="opacity: 0;">
								<path d="M678.492,386.56c0,163.884-104.083,265.874-265.002,265.874C413.49,492.909,524.635,386.56,678.492,386.56z"/>
								<path d="M76.122,387.56c150.808,0,259.772,106.35,259.772,265.874C178.113,653.434,76.122,551.442,76.122,387.56z"/>
							</g>
		                </svg>
		                </div>';
						if($targetDate) {
							echo '
		                <div id="countdown" class="row">
		                    <div class="col-xs-1"></div>
		                    <div class="col-xs-2 time">
		                        <span id="weeks">00</span>
		                        <div class="time-type">WEEKS</div>
		                    </div>
		                    <div class="col-xs-2 time">
		                        <span id="days">00</span>
		                        <div class="time-type">DAYS</div>
		                    </div>
		                    <div  class="col-xs-2 time">
		                        <span id="hours">00</span>
		                        <div class="time-type">HOURS</div>
		                    </div>
		                    <div class="col-xs-2 time">
		                        <span id="minutes">00</span>
		                        <div class="time-type">MINS</div>
		                    </div>
		                    <div class="col-xs-2 time">
		                        <span id="seconds">00</span>
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
		                </div>
		                <div class="row">
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
		                </div>
		            </div>
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