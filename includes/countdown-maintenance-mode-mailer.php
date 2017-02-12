<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {
	// Get POST data
	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
	$recipient = $_POST['recipient'];
	$subject = $_POST['subject'];

	// Validation
	if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		// Send error
		http_response_code(400);
		echo 'Please fill out all fields.';
		exit;
	}

	// Build email
	$message = "Email: $email\n\n";

	// Build headers
	$headers = "From: <$email>";

	// Send email
	if(mail($recipient, $subject, $message, $headers)) {
		http_response_code(200);
		echo "You are now subscribed";
	} else {
		http_response_code(500);
		echo "There was a problem sending your mail";
	}

} else {
	http_response_code(403);
	echo "Invalid request";
}