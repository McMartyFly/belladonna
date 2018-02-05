<?php
/*
Name: 			Contact Form
Written by: 	Okler Themes - (http://www.okler.net)
Version: 		4.5.0
*/

session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));

header('Content-type: application/json');

// Step 1 - Enter your email address below.
$to = 'webmaster.philbergerjr@gmail.com';

// Step 2 - Enable if the server requires SMTP authentication. (true/false)
$enablePHPMailer = true;

$subject = 'Website Volunteer Notice';

if(isset($_POST['email'])) {

	$name = $_POST['name'];
	$email = $_POST['email'];

	$fields = array(
		0 => array(
			'text' => 'Name',
			'val' => $_POST['name']
		),
		1 => array(
			'text' => 'Email address',
			'val' => $_POST['email']
		),
		2 => array(
			'text' => 'Message',
			'val' => $_POST['message']
		),
		3 => array(
			'text' => 'phone number',
			'val' => $_POST['phone']
		)
	);

	$message = "";

	foreach($fields as $field) {
		$message .= $field['text'].": " . htmlspecialchars($field['val'], ENT_QUOTES) . "<br>\n";
	}

	// Simple Mail
	if(!$enablePHPMailer) {

		$headers = '';
		$headers .= 'From: ' . $name . ' <' . $email . '>' . "\r\n";
		$headers .= "Reply-To: " .  $email . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

		if (mail($to, $subject, $message, $headers)){
			$arrResult = array ('response'=>'success');
		} else{
			$arrResult = array ('response'=>'error');
		}

	// PHP Mailer Library - Docs: https://github.com/PHPMailer/PHPMailer
	} else {

		include("php-mailer/PHPMailerAutoload.php");

		$mail = new PHPMailer;

		
		$mail->SMTPDebug = 0;                                 // Debug Mode

		// Step 3 - If you don't receive the email, try to configure the parameters below:

		$mail->Host = 'smtp.fatcow.com';				  // Specify main and backup server
		$mail->SMTPAuth = true;                             // Enable SMTP authentication
		//$mail->Username = 'agent@idesignmobileapps.com';               // SMTP username
		//$mail->Password = '';                         // SMTP password
		$mail->SMTPSecure = 'tls';                          // Enable encryption, 'ssl' also accepted
		$mail->Port = 587;   								  // TCP port to connect to

		$mail->From = $email;
		$mail->FromName = $_POST['name'];
		$mail->AddAddress($to);								  // Add a recipient
		$mail->AddReplyTo($email, $name);

		$mail->IsHTML(true);                                  // Set email format to HTML

		$mail->CharSet = 'UTF-8';

		$mail->Subject = $subject;
		$mail->Body    = $message;

		if(!$mail->Send()) {
		   $arrResult = array ('response'=>'error');
		}

		$arrResult = array ('response'=>'success');

	}

	echo json_encode($arrResult);

} else {

	$arrResult = array ('response'=>'error');
	echo json_encode($arrResult);

}
?>
