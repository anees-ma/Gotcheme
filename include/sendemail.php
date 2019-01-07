<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$toemails = array();

// Form Processing Messages
$message_success = 'We <strong>successfully</strong> received your message and will get back you soon.';

// Add this only if you use reCaptcha with your Contact Forms
$recaptcha_secret = ''; // Your reCaptcha Secret

$mail = new PHPMailer();

// If you intend you use SMTP, add your SMTP Code after this Line


if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	if( $_POST['template-contactform-email'] != '' ) {

		$name = isset( $_POST['template-contactform-name'] ) ? $_POST['template-contactform-name'] : '';
		$email = isset( $_POST['template-contactform-email'] ) ? $_POST['template-contactform-email'] : '';
		$phone = isset( $_POST['template-contactform-phone'] ) ? $_POST['template-contactform-phone'] : '';
		$message = isset( $_POST['template-contactform-message'] ) ? $_POST['template-contactform-message'] : '';
		$sname=$name;
		$semail=$email;
	
		$subject='Website Visitor';

		$botcheck = $_POST['template-contactform-botcheck'];

		if( $botcheck == '' ) {

			$mail->SetFrom( $email , $name );
			$mail->AddReplyTo( $email , $name );
			$mail->AddAddress('info@gotcheme.com' , 'Gotche Chemicals ' );
			$mail->Subject = $subject;

			$name = isset($name) ? "Name: $name<br><br>" : '';
			$email = isset($email) ? "Email: $email<br><br>" : '';
			$phone = isset($phone) ? "Phone: $phone<br><br>" : '';
			$message = isset($message) ? "Message: $message<br><br>" : '';

			$referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>This Form was submitted from: ' . $_SERVER['HTTP_REFERER'] : '';

			$body = "$name $email $phone $message";

			// Runs only when File Field is present in the Contact Form
			//if ( isset( $_FILES['template-contactform-file'] ) && $_FILES['template-contactform-file']['error'] == UPLOAD_ERR_OK ) {
				//$mail->IsHTML(true);
				//$mail->AddAttachment( $_FILES['template-contactform-file']['tmp_name'], $_FILES['template-contactform-file']['name'] );
		//	}

			// Runs only when reCaptcha is present in the Contact Form
			if( isset( $_POST['g-recaptcha-response'] ) ) {
				$recaptcha_response = $_POST['g-recaptcha-response'];
				$response = file_get_contents( "https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $recaptcha_response );

				$g_response = json_decode( $response );

				if ( $g_response->success !== true ) {
					echo '{ "alert": "error", "message": "Captcha not Validated! Please Try Again." }';
					die;
				}
			}

			// Uncomment the following Lines of Code if you want to Force reCaptcha Validation

			// if( !isset( $_POST['g-recaptcha-response'] ) ) {
			// 	echo '{ "alert": "error", "message": "Captcha not Submitted! Please Try Again." }';
			// 	die;
			// }

			$mail->MsgHTML( $body );
			$sendEmail = $mail->Send();

			if( $sendEmail == true ):
				echo '{ "alert": "success", "message": "' . $message_success . '" }';
				
				
				
			$mail->ClearReplyTos();
			$mail->SetFrom('info@gotcheme.com' , 'Gotche Chemicals');
			$mail->AddReplyTo('info@gotcheme.com' , 'Gotche Chemicals');
			$mail->AddAddress($semail , $sname );
            
            $mail->Subject = 'Acknowledgement';
            
            $body="		<p>Dear ".$sname.",</p>
                        <p style='padding-top:15px;'>Thank you for visiting Gotche Middle East website. We have received your query and our Sales Department will be in touch with you soon.</p>
						<p style='padding-top:15px;'>Thanks & Regards,</p>
						<p><b>Gotche Middle East Team</b></p>";
            
            $mail->MsgHTML( $body );
			$sendEmailAck = $mail->Send();
				
				
				
			else:
				echo '{ "alert": "error", "message": "Email <strong>could not</strong> be sent due to some Unexpected Error. Please Try Again later.<br /><br /><strong>Reason:</strong><br />' . $mail->ErrorInfo . '" }';
			endif;
		} else {
			echo '{ "alert": "error", "message": "Bot <strong>Detected</strong>.! Clean yourself Botster.!" }';
		}
	} else {
		echo '{ "alert": "error", "message": "Please <strong>Fill up</strong> all the Fields and Try Again." }';
	}
} else {
	echo '{ "alert": "error", "message": "An <strong>unexpected error</strong> occured. Please Try Again later." }';
}

?>