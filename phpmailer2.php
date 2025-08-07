<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
function sendmail($tomail, $totmailname , $subject, $message)
{
	$loginid 	= "mayur.ackplus@gmail.com";
	$password 	= "tamfixbnffoldybz";
	$smtpserver = "smtp.gmail.com";
	$smtpport 	= 465;
	$mailsender = "OnlineAuction";
	// Load Composer's autoloader
	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
		//Server settings
		$mail->SMTPDebug = false; // SMTP::DEBUG_SERVER; // Enable verbose debug output
		$mail->isSMTP();          // Send using SMTP
		$mail->Host       = "smtp.gmail.com"; // Set the SMTP server to send through
		$mail->SMTPAuth   = true;  // Enable SMTP authentication
		$mail->Username   = "mayur.ackplus@gmail.com"; // SMTP username
		$mail->Password   ="tamfixbnffoldybz";  // SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail->Port       = 456;
		// TCP port to connect to

		//Recipients
		$mail->setFrom("mayur.ackplus@gmail.com");
		$mail->addAddress($tomail, $totmailname);     // Add a recipient
		$mail->addAddress($tomail);               // Name is optional
		$mail->addReplyTo($tomail, $totmailname);
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		// Attachments
	  //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	  //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		// Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $message;
		$mail->AltBody = 'Mail Receieved';

		$mail->send();
			//echo 'Message has been sent';
	} 
	catch (Exception $e) 
	{
		echo "Message could not be sent. Mailer Error: {
			$mail->ErrorInfo}";
	}
}
sendmail("mayur.ackplus@gmail.com", "Student Projects" , "My subject title", "My message");
?>