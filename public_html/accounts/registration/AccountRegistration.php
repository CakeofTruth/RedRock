<?php

include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');

$emailError = $passwordError = $passwordMatchError = $spcodeError= ""; 

/*
 *  if the form is empty or there are errors -> $forisvalid = 0. Otherwise, include the form.
 */
$formisvalid = 1;
if (empty ($_POST)){
	$formisvalid = 0;
}else{
	if(!emailIsValid($_POST["emailAddress"])){
		$emailError = 'The email you have entered is invalid, please try again.';
		$formisvalid = 0;
	}
	if(!meetsPasswordRequirements($_POST["password"])){
		$passwordError = 'Please create a password that is 8-15 characters and includes at least one uppercase letter, 
					one lowercase letter, one number and one special character.<br>';
		$formisvalid = 0;
	}
	if(!matches_password($_POST["password"],$_POST["passwordConfirm"])){
		$passwordMatchError = 'Passwords do not match';
		$formisvalid = 0;
	}
	if(!meetsSpcodeRequirements($_POST["spCode"])){
		$spcodeError = 'Please enter the Service Provider Code that has been provided to you by Red Rock Telecommunications Company.  
				If you have not received a Service Provider Code, please reach out to us at support@redrocktelecom.com. <br>';
		$formisvalid = 0;
	}
}


if($formisvalid){
	include_once $root . '/classes/DBUtils.php';
	$dbutil = new DBUtils();
	$conn = $dbutil->getDBConnection();
	$hash = makeHash($_POST["emailAddress"]);
	insertAccount($conn,$hash);
	insertReseller($conn);
	sendVerificationEmail($hash);
	$conn->close ();
	echo "<br>Account Created Successfully!";
} else {
	include ("AccountRegistrationForm.php");
}


/**
 * *****************************************************************************************
 * Functionssssss
 * ******************************************************************************************
 */

function sendVerificationEmail($hash){
	$mail = getMailer();
	
	$to = $_POST["emailAddress"];
	$subject = 'Signup | Verification';
	$message = '

	Thank you for signing up! Your account has been created.  You can login with the 
	following credentials after you have activated your account by clicking the url below.
	<br><br>
	------------------------<br>
	Username: ' . $_POST["username"] . '<br>
	Password: ' . $_POST["password"] . '<br>
	------------------------
	<br><br>
		Please click this link to activate your account:<br>
		' . $_SERVER ["HTTP_HOST"] . '/accounts/registration/verify.php?email=' . $to . '&hash=' . $hash . '
	';

	
	$mail->SetFrom('noreply@redrocktelecom.com', 'Web App');
	$mail->Subject = "Signup | Verification";
	$mail->MsgHTML($message);
	$mail->AddAddress($to, $_POST["firstName"],$_POST["lastName"]);

	if($mail->Send()) {
		echo "Message sent!";
	} else {
		echo "Mailer Error: " . $mail->ErrorInfo;
	}

	//echo "<script> window.location = 'login.php' </script>";

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

function generateResellerInsertString() {
	$sql = "INSERT INTO Resellers (Serv_Prov_CD,Address1,Address2,City,State,Zip,Phone,Company_Name) VALUES(";
	$sql = $sql . "'" . test_input ( $_POST ["spCode"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["resellerBA1"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["resellerBA2"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["city"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["state"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["zipCode"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["telephoneNumber"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["resellerName"] ) . "')";
	return $sql;
}
function generateAccountInsertString($hash) {
	$sql = 'INSERT INTO Accounts (Username, Password, Serv_Prov_CD, First_Name, Last_Name, Email,hash) VALUES(';
	$sql = $sql . "'" . test_input ( $_POST ["username"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["password"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["spCode"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["firstName"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["lastName"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["emailAddress"] ) . "',";
	$sql = $sql . "'" . $hash . "')";
	return $sql;
}
function matches_password($password, $confirm) {
	if (strcmp ( $confirm, $password ) == 0) {
		$passwordMatchError="";
		return 1;
	} 
	return 0;
}
function meetsPasswordRequirements($password) {
	if (preg_match ( '/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])/', $password )) {
		$passwordError ="";
		return 1;
	}
	return 0;
}
function meetsSpcodeRequirements($spcode) {
	$registeredResellers = [
		"HCON" => "HCON",
		"RRTC" => "RRTC",
		"CION" => "CION",
		"CITY" => "CITY",
	];
	if (in_array($spcode, $registeredResellers)) {
		$spcodeError ="";
		return 1;
	}
	return 0;
}
function test_input($data) {
	$data = trim ( $data );
	$data = stripslashes ( $data );
	$data = htmlspecialchars ( $data );
	return $data;
}

function emailIsValid($email) {
	if (preg_match ( "/^[_a-z0-9-]+(\.[a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email )) {
		$emailError="";
		return 1;
	}
	return 0;
}

function makeHash($email){
	
	$plusSalt = $email . rand ( 0, 1000 );
	return hash ( "sha512", $plusSalt );
}

function insertAccount($conn,$hash){
	
	$accountInsertString = generateAccountInsertString ( $hash );

	if (mysqli_query ( $conn, $accountInsertString )) {
		//$customerID = $conn->insert_id;
		$conn->insert_id;
	}

}

function insertReseller($conn){
	
	$resellerInsertString = generateResellerInsertString ();

	if (mysqli_query ( $conn, $resellerInsertString )) {
		// echo "New record created successfully";
		$resellerID = $conn->insert_id;
		// echo "Inserted record " . $lastinsert . ' into Accounts Table.<br>';
	} else {
		// echo "Error: " . $resellerInsertString . "<br>" . mysqli_error($conn);
	}
}

?>