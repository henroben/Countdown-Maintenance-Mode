<!DOCTYPE html>
<html lang="<?php echo $site_language; ?>">
	<head>
		<meta charset="'. $site_charset . '">
		<title><?php echo $site_name; ?> is currently undergoing maintenance</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<link rel="stylesheet" href="<?php echo plugins_url() ?>/countdown-maintenance-mode/templates/full_width_template/css/full-width-template.css">
		<link rel="stylesheet" href="<?php echo plugins_url() ?>/countdown-maintenance-mode/css/TimeCircles.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="<?php echo plugins_url() ?>/countdown-maintenance-mode/js/jquery.interactive_bg.js"></script>
		<script src="<?php echo plugins_url() ?>/countdown-maintenance-mode/js/main.js"></script>
		<script src="<?php echo plugins_url() ?>/countdown-maintenance-mode/js/TimeCircles.js"></script>
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
				if($overlay){
					echo '<div class="overlay" style="background-image: url(' . plugins_url() . '/countdown-maintenance-mode/img/overlay/' . $overlay . '.png); opacity: ' . $overlay_opacity . ';"></div>';
				}
				echo '<div class="wrapper bg" data-ibg-bg="' . $background_image . '" ></div>';
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
				<div class="col-md-8">
					<h2 style="color: <?php echo $text_color; ?>"><?php echo $message; ?></h2>
				</div>
				<div class="col-md-2"></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div id="DateCountdown" data-date="<?php echo $targetDate; ?>" style="width: 100%; height: auto; padding: 0px; box-sizing: border-box; color: <?php echo $text_color; ?>"></div>
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<?php
						if($enable_form) {
							echo '<div class="row">
								<form action="' . plugins_url() . '/countdown-maintenance-mode/includes/countdown-maintenance-mode-mailer.php" id="maintenance-form" method="post">
									<div class="col-xs-12 col-md-8 no-padding">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon" style="color: ' . $text_color . '; background-color: ' . $time_color . '; border-color: ' . $time_color . ';"><i class="fa fa-envelope-o fa-fw"></i></span>
												<input class="form-control left-radius" type="text" placeholder="Please enter your email address" id="email" name="email">
											</div>
											<input type="hidden" name="recipient" value="' . $recipient . '">
											<input type="hidden" name="subject" value="' . $subject . '">
										</div>
									</div>
									<div class="col-xs-12 col-md-4 no-padding">
										<div class="form-group">
											<input type="submit" class="btn btn-primary btn-block right-radius" name="subscriber_submit" value="SEND" style="background-color: ' . $time_color .'; border-color: ' . $time_color .';">
										</div>
									</div>
								</form>
							</div>
							<div class="row no-padding">
								<div class="col-xs-12 no-padding">
									<div id="form-msg"></div>
								</div>
							</div>';
						}
					?>
				</div>
				<div class="col-md-2"></div>
			</div>
			<?php
			if($social_media) {
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
			echo '<script>
					$(document).ready(function(){
						$(".bg").interactive_bg({
							contain: true,
							wrapContent: true
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