<?php
if($preview == true) {
	function plugins_url() {
		return '../..';
	}
}
?>
<!DOCTYPE html>
<html lang="<?php echo $site_language; ?>">
<head>
	<meta charset="'. $site_charset . '">
	<title><?php echo $site_name; ?> is currently undergoing maintenance</title>
	<link rel="stylesheet" href="<?php echo plugins_url() ?>/countdown-maintenance-mode/css/bootstrap.min.css">
	<?php if($enable_social_media): ?>
		<link rel="stylesheet" href="<?php echo plugins_url() ?>/countdown-maintenance-mode/css/font-awesome-4.7.0/css/font-awesome.min.css">
	<?php endif; ?>
	<link rel="stylesheet" href="<?php echo plugins_url() ?>/countdown-maintenance-mode/templates/fixed_center_template/css/fixed-center-template.css">
	<script src="<?php echo plugins_url() ?>/countdown-maintenance-mode/js/jquery.min.js"></script>
	<?php
		switch($background_effect) {
			case 'None':
				break;
			case 'Interactive Background Image':
				echo '<script src="' . plugins_url() . '/countdown-maintenance-mode/js/jquery.interactive_bg.js"></script>';
				break;
			case 'Blur Background Image':
				echo '<script src="' . plugins_url() . '/countdown-maintenance-mode/js/vector.js"></script>';
				echo '<script src="' . plugins_url() . '/countdown-maintenance-mode/js/background-blur.min.js"></script>';
				break;
			case 'Halftone Background Image':
				echo '<script src="' . plugins_url() . '/countdown-maintenance-mode/js/vector.js"></script>';
				echo '<script src="' . plugins_url() . '/countdown-maintenance-mode/js/particle.js"></script>';
				echo '<script src="' . plugins_url() . '/countdown-maintenance-mode/js/breathing-halftone.js"></script>';
				break;
		}
	?>
	<script src="<?php echo plugins_url() ?>/countdown-maintenance-mode/js/main.js"></script>
	<?php
	if($countdown_font) {
		switch($countdown_font) {
			case 'Roberto Mono':
				echo '<link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">';
				break;
			case 'Share Tech Mono':
				echo '<link href="https://fonts.googleapis.com/css?family=Share+Tech+Mono" rel="stylesheet">';
				break;
			case 'Nova Mono':
				echo '<link href="https://fonts.googleapis.com/css?family=Nova+Mono" rel="stylesheet">';
				break;
			case 'Fira Mono':
				echo '<link href="https://fonts.googleapis.com/css?family=Fira+Mono" rel="stylesheet">';
				break;
		}
	} else {
		// set default font family
		$countdown_font = 'Roberto Mono';
	} ?>
	</head>
	<body>
		<script>
			var target_date = "<?php echo $targetDate; ?>";
		</script>
		<?php
		if($enable_animation || $background_effect != 'None') {
			switch($background_effect) {
				case 'Interactive Background Image':
					echo '<div class="wrapper bg" data-ibg-bg="' . $background_image . '" >';
					if($overlay){
						echo '<div class="overlay" style="background-image: url(' . plugins_url() . '/countdown-maintenance-mode/img/overlay/' . $overlay . '.png); opacity: ' . $overlay_opacity . ';"></div>';
					}
					echo '</div>';
					break;
				case 'Blur Background Image':
					if($overlay){
						echo '<div class="overlay" style="background-image: url(' . plugins_url() . '/countdown-maintenance-mode/img/overlay/' . $overlay . '.png); opacity: ' . $overlay_opacity . ';"></div>';
					}
					echo '<div id="blur-background" class="bg"></div>';
					break;
				case 'Halftone Background Image':
					if($overlay){
						echo '<div class="overlay" style="background-image: url(' . plugins_url() . '/countdown-maintenance-mode/img/overlay/' . $overlay . '.png); opacity: ' . $overlay_opacity . ';"></div>';
					}
					echo '<img id="breathing-halftone" class="halftone" src="' . $background_image . '" data-src="' . $background_image . '" />';
					break;
				default:
					if($overlay){
						echo '<div class="overlay" style="background-image: url(' . plugins_url() . '/countdown-maintenance-mode/img/overlay/' . $overlay . '.png); opacity: ' . $overlay_opacity . ';"></div>';
					}
					echo '<div class="image-background" style="background: url(' . $background_image . ') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"></div>';
					break;
			}

		} else {
			if($overlay){
				echo '<div class="overlay" style="background-image: url(' . plugins_url() . '/countdown-maintenance-mode/img/overlay/' . $overlay . '.png); opacity: ' . $overlay_opacity . ';"></div>';
			}
			echo '<div class="image-background" style="background: url(' . $background_image . ') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"></div>';
		} ?>
		<div class="container">
			<div class="center-wrapper"
			<?php $style = 'style="';
				if(isset($wrapper_color)) {
					$style .= 'background-color:' . $wrapper_color . '; ';
				}
				if(isset($text_color)) {
					$style .= 'color:' . $text_color . ';';
				}
				$style .= '"';
				echo $style . ' >';

				if($logo_image) {
					echo '<div class="logo">';
					echo '<img src="' . $logo_image . '" title="' . $site_name . '"' . ' alt="' . $site_name . '">';
					echo '</div>';
				}
				if($targetDate) {
					echo '
					<div id="countdown" class="row" style="font-family: \'' . $countdown_font . '\', monospace;">
					<div class="col-xs-1"></div>
						<div class="col-xs-2 time" ';
						if(isset($wrapper_color)) {
							echo 'style="background-color:' . $time_color . ';"';
						}
					echo '>';
					echo '<span id="weeks">00</span>
				<div class="time-type">WEEKS</div>
			</div>
			<div class="col-xs-2 time" ';
	if(isset($wrapper_color)) {
	echo 'style="background-color:' . $time_color . ';"';
	}
	echo '>';
	echo '<span id="days">00</span>
	<div class="time-type">DAYS</div>
	</div>
	<div class="col-xs-2 time" ';
		if(isset($wrapper_color)) {
		echo 'style="background-color:' . $time_color . ';"';
		}
	echo '>';
	echo '<span id="hours">00</span>
		<div class="time-type">HOURS</div>
	</div>
	<div class="col-xs-2 time" ';
	if(isset($wrapper_color)) {
	echo 'style="background-color:' . $time_color . ';"';
	}
	echo '>';
	echo '<span id="minutes">00</span>
	<div class="time-type">MINS</div>
	</div>
	<div class="col-xs-2 time" ';
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
		include(dirname( __FILE__ ) . '/includes/form.php');
	}
	if($enable_social_media) {
		echo '
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 social-media">';
				foreach ($social_media as $key => $value) {
					echo '<a href="' . $value . '" title="Find us on ' . $key . '"><span class="fa-stack fa-lg">
				  		<i class="fa fa-square-o fa-stack-2x"></i>
				  		<i class="fa fa-' . $key . ' fa-stack-1x"></i>
					</span></a>';
				}
			echo '</div>
			<div class="col-xs-1"></div>
		</div>
		';
	}
	echo '</div>
	</div>';
	if($enable_animation) {
		switch($background_effect) {
			case 'None':
				break;
			case 'Interactive Background Image':
				echo '
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
						});
					</script>';
				break;
			case 'Blur Background Image':
				echo '
					<script>
						$(document).ready(function(){
							$("#blur-background").backgroundBlur({
							    imageURL : "' . $background_image . '",
							    blurAmount : ' . $blur_amount . ',
							    imageClass : "bg-blur",
							    duration: 1000, // If the image needs to be faded in, how long that should take
							    endOpacity : 1 // Specify the final opacity that the image will have
							});
						});
					</script>';
				break;
				break;
			case 'Halftone Background Image':
				echo '
					<script>
				        window.onload = function() {
				            var img = document.querySelector("#breathing-halftone");
				            var halftone = window.halftone = new BreathingHalftone( img, {
				                 dotSize: 1/40,
				                 dotSizeThreshold: 0.1,
				                // oscAmplitude: 0.3
				                // oscPeriod: 2
				                // initVelocity: 0.01,
				                isAdditive: ';
									if($is_additive) {
										echo 'true';
									} else {
										echo 'false';
									}
									echo ',
				                // isRadial: true,
				                // friction: 0.2,
				                // isChannelLens: false,
								// channels: [ \'green\', \'blue\' ],
				                // channels: [ \'lum\' ],
				                // hoverDiameter: 0.3,
				                // hoverForce: -0.02,
				                // activeDiameter: 0.6,
				                // activeForce: 0.01
				            })
				        };
				</script>';
				break;
		}

	}
	echo '</body>
</html>';