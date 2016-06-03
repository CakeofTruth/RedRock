<?php
class MailUtils{



function send($from,$fromname,$to,$subject,$message){
	$mail = $this->getMailer();
	$mail->SetFrom($from,$fromname);
	$mail->Subject = $subject;
	$mail->MsgHTML($message);
	$mail->AddAddress($to);
	
	if($mail->Send()) {
		//echo "Message sent!";
	} else {
		//echo "Mailer Error: " . $mail->ErrorInfo;
	}

}

function getMailer(){
	include_once ($_SERVER ["DOCUMENT_ROOT"] .'/mail/class.phpmailer.php');
	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Host = "email.hostaccount.com";
	$mail->Port = 587;
	$mail->Username = "noreply@redrocktelecom.com";
	$mail->Password = "Telco123!";
	
	return $mail;
}

}
?>
