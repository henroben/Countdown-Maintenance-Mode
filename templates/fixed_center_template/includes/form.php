<?php
echo '
	<div class="row">
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