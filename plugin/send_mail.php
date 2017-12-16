<?php
/* 
OBS: LIBERAR EMAIL PARA USO DE APLICATIVOS POUCO CONFIÁVEIS
 Link da solução: https://stackoverflow.com/questions/20337040/gmail-smtp-debug-error-please-log-in-via-your-web-browser
*/

require '../config/settings.php';



// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

	function send_mail_to($mail_to, $name, $type){

		global $settings;
		$mail = new PHPMailer;

		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = $settings['email'];
		//Password to use for SMTP authentication
		$mail->Password = $settings['password'];
		//Set who the message is to be sent from
		$mail->setFrom($settings['email'], $settings['name']);
		//Set an alternative reply-to address
		$mail->addReplyTo($settings['reply_to_mail'], $settings['reply_to_name']);
		//Set who the message is to be sent to
		$mail->addAddress($mail_to, $name);
		//Set the subject line
		
		$mail->isHTML(true);
		
		if($type == 'prize'){

			$mail->Subject = $settings['email_subject_prize'];
			$mail->Body = $settings['email_body_prize'];
	
		}else if($type == 'point'){
			
			$mail->Subject = $settings['email_subject_point'];
			$mail->Body = $settings['email_body_point'];
				
		}else{
			
			$mail->Subject = "Não definido";
			$mail->Body = "Não definido";
			
		}
		//$mail->AltBody = 'This is a plain-text message body';
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');
		//send the message, check for errors

			
		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
			return false;
		} else {
			echo "Message sent!";
			return true;
			//Section 2: IMAP
			//Uncomment these to save your message in the 'Sent Mail' folder.
			#if (save_mail($mail)) {
			#    echo "Message saved!";
			#}
		}
		 
	}
	
	//send_mail_to("renanfelixrodrigues@gmail.com", "Renan");

	
//----------------------------
//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl') to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);
    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;
}