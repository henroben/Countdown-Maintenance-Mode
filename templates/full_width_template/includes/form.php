<?php
echo '
	<div class="row">
		<form action="' . plugins_url() . '/countdown-maintenance-mode/includes/countdown-maintenance-mode-mailer.php" id="maintenance-form" method="post">
			<div class="col-xs-8 col-sm-8 col-md-8 no-padding">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon" style="color: ' . $text_color . '; background-color: ' . $time_color . '; border-color: ' . $time_color . ';"><i class="fa fa-envelope-o fa-fw"></i></span>
						<input class="form-control left-radius" type="text" placeholder="Please enter your email address" id="email" name="email">
					</div>
					<input type="hidden" name="recipient" value="' . $recipient . '">
					<input type="hidden" name="subject" value="' . $subject . '">
				</div>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 no-padding">
				<div class="form-group">
					<style>
						.btn-primary, .btn-primary:focus, .btn-primary:active, .btn-primary:visited {
							background-color: ' . $time_color .';
							border-color: ' . $time_color .'; }
						.btn-primary:hover {
							background-color: ' . colourCreator($time_color, -20) .';
							border-color: ' . colourCreator($time_color, -20) .'; }
						.btn-primary:active:focus {
							background-color: ' . colourCreator($time_color, -30) .';
							border-color: ' . colourCreator($time_color, -30) .'; }    
					</style>
					<input type="submit" class="btn btn-primary btn-block right-radius" name="subscriber_submit" value="SEND">
				</div>
			</div>
		</form>
	</div>
	<div class="row no-padding">
		<div class="col-xs-12 no-padding">
			<div id="form-msg"></div>
		</div>
	</div>';