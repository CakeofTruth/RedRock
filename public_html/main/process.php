<?php
if( isset($_POST) ){
	 
	//form validation vars
	$formok = true;
	$errors = array();
	 
	//sumbission data
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$date = date('d/m/Y');
	$time = date('H:i:s');
	 
	//form data
	$name = $_POST['name'];
	$email = $_POST['email'];
	$telephone = $_POST['telephone'];
	$inquiry = $_POST['inquiry'];
	$message = $_POST['message'];
	
}
	//validate name is not empty
	if(empty($name)){
		$formok = false;
		$errors[] = "You have not entered a name";
	}
	
	//validate email address is not empty
	if(empty($email)){
		$formok = false;
		$errors[] = "You have not entered an email address";
		//validate email address is valid
	}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$formok = false;
		$errors[] = "You have not entered a valid email address";
	}
	
	//validate message is not empty
	if(empty($message)){
		$formok = false;
		$errors[] = "You have not entered a message";
	}
	
	//validate message is greater than 20 charcters
	elseif(strlen($message) < 20){
		$formok = false;
		$errors[] = "Your message must be greater than 20 characters";
	}
	
	//send email if all is ok
	if($formok){

		$mail = getMailer();
		
		$recipient = (empty($_POST['enquiry'])) ? 'default' : $_POST['enquiry'];
		$email_addresses = array('a' => 'gpaduganan@redrocktelecom.com', 'b'=> 'sales@redrocktelecom.com', 'c'=>'support@redrocktelecom.com',
				'd'=> 'ops@redrocktelecom.com');
		if(array_key_exists($recipient, $email_addresses)) {
			$recipient = $email_addresses[$recipient];
		}
		else {
			$recipient = $email_addresses['default'];
		}
		
// 		$headers = "From: noreply@redrocktelecom.com" . "\r\n";
// 		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		$emailbody = "<p>You have recieved a new message from the inquiries form on your website.</p>
		<p><strong>Name: </strong> {$name} </p>
		<p><strong>Email Address: </strong> {$email} </p>
		<p><strong>Telephone: </strong> {$telephone} </p>
		<p><strong>inquiry: </strong> {$inquiry} </p>
		<p><strong>Message: </strong> {$message} </p>
		<p>This message was sent from the IP Address: {$ipaddress} on {$date} at {$time}</p>";
		 
		$mail->SetFrom('noreply@redrocktelecom.com', 'Web App');
		$mail->Subject = "Contact Us Submission";
		$mail->MsgHTML($emailbody);
		$mail->AddAddress($recipient);
		
		if($mail->Send()) {
			echo "Message sent!";
		} else {
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
	}
	
	//what we need to return back to our form
	$returndata = array(
			'posted_form_data' => array(
					'name' => $name,
					'email' => $email,
					'telephone' => $telephone,
					'enquiry' => $enquiry,
					'message' => $message
			),
			'form_ok' => $formok,
			'errors' => $errors
	);
	
	//if this is not an ajax request
	if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest'){
		 
		//set session variables
		session_start();
		$_SESSION['cf_returndata'] = $returndata;
		 
		//redirect back to form
		header('location: ' . $_SERVER['HTTP_REFERER']);
	
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
?>