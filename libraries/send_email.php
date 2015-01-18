<?php

/**
*
* @author  Antonio de la Rosa <webmaster@web-t-sys.com>
* @file
* @package ExtraUtils
*
*
*/

//Now, we use swiftmailer.

function send_mail($email, $subject, $message, $content_type='plain', $bcc='', $attachments=array())
{

	$portal_name=html_entity_decode(PhangoVar::$portal_name);
	
	switch(PhangoVar::$mailer_type)
	{
	
	default:
	
		$header = "From:" .$portal_name."<".PhangoVar::$portal_email.">\r\n";
		$header .= "Reply-To:".PhangoVar::$portal_email."\r\n";
		$header .= "Content-Type: text/".$content_type."; charset=UTF-8"."\r\n";
		$header .= "X-Mailer: PHP5";

		if($bcc!='')
		{

			$bcc="\r\nBcc: ".$bcc;

		}

		$header .= $bcc;
		
		if(!mail($email  , $subject  , $message  , $header))
		{

			return 0;

		}

		return 1;
		
	break;
	
	case 'swiftmailer':
		
		//require_once PhangoVar::$base_path.'libraries/mailers/swiftmailer/lib/swift_required.php';
		load_libraries(array('lib/swift_required'), PhangoVar::$addons_composer_path.'/swiftmailer/swiftmailer/');
		
		// Transport
		
		if( defined('SMTP_HOST') && defined('SMTP_USER') && defined('SMTP_PASS') )
		{
		
			if(!defined('SMTP_PORT'))
			{
			
				define('SMTP_PORT', 25);
			
			}
		
			$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT)->setUsername(SMTP_USER)->setPassword(SMTP_PASS);
			
			if(defined('SMTP_ENCRIPTION'))
			{
			
				$transport->setEncryption(SMTP_ENCRIPTION);
			
			}
			
		}
		else
		{
		
			$transport = Swift_SmtpTransport::newInstance();
		
		}
		
		//mailer
		
		$mailer = Swift_Mailer::newInstance($transport);
		
		//message
		
		$mail_set = Swift_Message::newInstance();
		
		$mail_set->setSubject($subject);
		// Set the From address with an associative array
		
		if(!defined('SMTP_SENDER'))
		{
		
			define('SMTP_SENDER', PhangoVar::$portal_email);
		
		}
		
		$mail_set->setFrom(array(SMTP_SENDER => $portal_name));
		// Set the To addresses with an associative array
		$mail_set->setTo(array($email));
		// Give it a body
		$mail_set->setBody($message);
		
		$mail_set->setContentType('text/'.$content_type);
		
		if($bcc!='')
		{
		
			$arr_bcc=explode(',', $bcc);
		
		
		
			$mail_set->setBcc($arr_bcc);
			
		}
		
		$mail_set->setReplyTo(array(SMTP_SENDER));
		
		// Optionally add any attachments
		
		foreach($attachments as $attachment)
		{
		
			$mail_set->attach(Swift_Attachment::fromPath($attachment));
			
		}

		
		//echo $mailer->send($mail_set);
		
		$failures=array();
		
		if(!$mailer->send($mail_set, $failures))
		{
			
			return 0;
		
		}
		
		foreach($failures as $email_fail)
		{
		
			if($email_fail==$email)
			{
			
				return 0;
			
			}
		
		}
		
		return 1;
		
		// And optionally an alternative body
		//->addPart('<q>Here is the message itself</q>', 'text/html')
		
	
	break;
	
	case 'custom':
	
		require_once PhangoVar::$base_path.'libraries/mailers/custom/mailer.php';
		
		return set_mailer($email, $subject, $message, $content_type, $bcc, $attachments);
	
	break;
	
	}

}

?>

