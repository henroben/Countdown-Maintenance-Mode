<?php
if($preview == true) {
	function plugins_url() {
		return '../..';
	}
}
function colourCreator($colour, $per)
{
	$colour = substr( $colour, 1 ); // Removes first character of hex string (#)
	$rgb = ''; // Empty variable
	$per = $per/100*255; // Creates a percentage to work with. Change the middle figure to control colour temperature

	if  ($per < 0 ) // Check to see if the percentage is a negative number
	{
		// DARKER
		$per =  abs($per); // Turns Neg Number to Pos Number
		for ($x=0;$x<3;$x++)
		{
			$c = hexdec(substr($colour,(2*$x),2)) - $per;
			$c = ($c < 0) ? 0 : dechex($c);
			$rgb .= (strlen($c) < 2) ? '0'.$c : $c;
		}
	}
	else
	{
		// LIGHTER
		for ($x=0;$x<3;$x++)
		{
			$c = hexdec(substr($colour,(2*$x),2)) + $per;
			$c = ($c > 255) ? 'ff' : dechex($c);
			$rgb .= (strlen($c) < 2) ? '0'.$c : $c;
		}
	}
	return '#'.$rgb;
}
?>
<!DOCTYPE html>
<html lang="<?php echo $site_language; ?>">
	<head>
		<meta charset="'. $site_charset . '">
		<title><?php echo $site_name; ?> is currently undergoing maintenance</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo plugins_url() ?>/countdown-maintenance-mode/css/bootstrap.min.css">
		<?php if($enable_social_media): ?>
			<link rel="stylesheet" href="<?php echo plugins_url() ?>/countdown-maintenance-mode/css/font-awesome-4.7.0/css/font-awesome.min.css">
		<?php endif; ?>
		<link rel="stylesheet" href="<?php echo plugins_url() ?>/countdown-maintenance-mode/templates/full_width_template/css/full-width-template.css">
		<?php if($targetDate): ?>
			<link rel="stylesheet" href="<?php echo plugins_url() ?>/countdown-maintenance-mode/css/TimeCircles.css">
		<?php endif; ?>
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
		<?php if($targetDate): ?>
			<script src="<?php echo plugins_url() ?>/countdown-maintenance-mode/js/TimeCircles.js"></script>
		<?php endif; ?>
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
			echo '<link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">';
		} ?>
	</head>
	<body>
		<?php
			if($enable_animation) {
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
			}
		?>
		<div class="full-width-wrapper">

		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 logo">
					<img src="<?php echo $logo_image; ?>" alt="<?php echo $site_name; ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8 message">
					<h2 style="color: <?php echo $text_color; ?>"><?php echo $message; ?></h2>
				</div>
				<div class="col-md-2"></div>
			</div>
			<?php if($targetDate): ?>
				<div class="row">
					<div class="col-md-12">
						<div class="hidden-xs col-md-2"></div>
						<div class="col-xs-12 col-md-8">
							<div id="DateCountdown" data-date="<?php echo $targetDate; ?>" style="width: <?php if($preview) { echo '600px'; } else { echo "100%"; } ?>; height: auto; padding: 0px; box-sizing: border-box; color: <?php echo $text_color; ?>"></div>
						</div>
						<div class="hidden-xs col-md-2"></div>
					</div>
				</div>
			<?php endif; ?>
			<div class="row">
				<div class="col-sm-1 col-md-2"></div>
				<div class="col-sm-10 col-md-8">
					<?php
						if($enable_form) {
							include(dirname( __FILE__ ) . '/includes/form.php');
						}
					?>
				</div>
				<div class="col-sm-1 col-md-2"></div>
			</div>
			<?php
			if($enable_social_media) {
				echo '
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8 social-media" style="color: ' . $text_color . ';">';
						foreach ($social_media as $key => $value) {
							echo '<a href="' . $value . '" title="Find us on ' . $key . '"><span class="fa-stack fa-lg">
						        <i class="fa fa-square-o fa-stack-2x"></i>
						        <i class="fa fa-' . $key . ' fa-stack-1x"></i>
							</span></a>';
						}
						echo '</div>
					<div class="col-md-2"></div>
				</div>';
			}
			?>
		</div>
		</div>

		<?php
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
		?>
		<script>
			$("#DateCountdown").TimeCircles({
				animation: "ticks",
				circle_bg_color: "rgba(255,255,255,0.3)",
				direction: "Counter-clockwise",
				time: {
					Days: { color: "<?php echo $time_color; ?>" },
					Hours: { color: "<?php echo $time_color; ?>" },
					Minutes: { color: "<?php echo $time_color; ?>" },
					Seconds: { color: "<?php echo $time_color; ?>" }
				}
			});
		</script>
	</body>
</html>