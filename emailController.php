<?php


require_once 'vendor/autoload.php';
//require_once 'constants.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465,'ssl'))
  ->setUsername('lewis.rajae1998@gmail.com')
  //I removed my password as I'm actually using my actual GMAIL ACCOUNT
  ->setPassword('')
  ;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);



function sendVerificationEmail($userEmail, $token,$id)
{

global $mailer;

$body = '

</!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="utf-8">
	<title>Verify Email</title>
</head>
<body>
	<div class="wrapper">
		<p>
			You have been successfully registered, Your ID number is '.$id.'. 

		</p>
		<p>
		However, you need to verify your email, Please click on the link below to verify email.

		</p>

		<a href="http://localhost:8081/appliedweb/PROJECT/homepage.php?token='. $token . '">
			Verify your email address
		</a>

</body>
</html>';

// Create a message
$message = (new Swift_Message('Verify Your Email Address'))
  ->setFrom("lewis.rajae1998@gmail.com")
  ->setTo($userEmail)
  ->setBody($body, 'text/html')
  ;

// Send the message
$result = $mailer->send($message);
}
 
function sendPasswordResetLink($userEmail, $token)
{

	global $mailer;

$body = '

</!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="utf-8">
	<title>User Account Password Reset</title>
</head>
<body>
	<div class="wrapper">
		<p>
			You have requested a Password Reset. 

		</p>
		<p>
		 Please click on the link below to reset User Password.

		</p>

		<a href="http://localhost:8081/appliedweb/PROJECT/homepage.php?password-token='. $token . '">
			Password Reset Link
		</a>

</body>
</html>';

// Create a message
$message = (new Swift_Message('Password Reset Link'))
  ->setFrom("lewis.rajae1998@gmail.com")
  ->setTo($userEmail)
  ->setBody($body, 'text/html')
  ;

// Send the message
$result = $mailer->send($message);
	
}




?>