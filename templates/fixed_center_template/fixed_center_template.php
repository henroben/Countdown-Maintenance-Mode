<!DOCTYPE html>
<html lang="<?php echo $site_language; ?>">
<head>
	<meta charset="'. $site_charset . '">
	<title><?php echo $site_name; ?> is currently undergoing maintenance</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo plugins_url() ?>/countdown-maintenance-mode/templates/fixed_center_template/css/fixed-center-template.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="<?php echo plugins_url() ?>/countdown-maintenance-mode/js/jquery.interactive_bg.js"></script>
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
		if($enable_animation) {
			echo '<div class="wrapper bg" data-ibg-bg="' . $background_image . '" >';
			if($overlay){
				echo '<div class="overlay" style="background-image: url(' . plugins_url() . '/countdown-maintenance-mode/img/overlay/' . $overlay . '.png); opacity: ' . $overlay_opacity . ';"></div>';
			}
			echo '</div>';
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
	echo '<div class="row">
		<div class="col-xs-1"></div>
		<form action="' . plugins_url() . '/countdown-maintenance-mode/includes/countdown-maintenance-mode-mailer.php" id="maintenance-form" method="post">
			<div class="col-xs-7 no-padding">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
						<input class="form-control left-radius" type="text" placeholder="Please enter your email address" id="email" name="email">
					</div>
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
	if($social_media) {
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
		})
	</script>';
	}
	echo '</body>
</html>';