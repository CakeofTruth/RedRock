<?php
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');

if (isset($_POST["ForgotPasswordEmail"])) {

	include_once $root . '/classes/DBUtils.php';
	include_once $root . '/classes/MailUtils.php';
	$dbutils = new DBUtils();
	$conn = $dbutils->getDBConnection();
	$sql = 'Select Email from accounts where Email = "' . $_POST["ForgotPasswordEmail"] .'"';
	$result = $conn->query ($sql);
	if ($result->num_rows > 0) {
		sendResetEmail($_POST["ForgotPasswordEmail"],$conn);
	}
	echo "A recovery email has been sent! <br> If you need further assisstance, please contact the Red Rock support team at customerservice@redrocktelecom.com";
}

function sendResetEmail($email,$conn){
		
	$mailUtils = new MailUtils();
		
	$from = "noreply@redrocktelecom.com";
	$fromname = "Red Rock Telecom";	
	$subject = "Password Reset";

	$hash = makeHash($email);
	insertPasswordHash($hash, $email, $conn);
	$message ="Dear User, <br><br> A password reset was requested for your account. Please click the following link to reset your password:
			<br><br> " . $_SERVER["HTTP_HOST"] . "/accounts/registration/reset_password.php?pwh=" . $hash . 
			"<br><br> Best Regards, <br> Red Rock Telecommunications Customer Service Team"
	;

	$mailUtils->send($from,$fromname,$email,$subject,$message);

}

function insertPasswordHash($hash,$email,$conn){
	$sql = 'Update Accounts set hash = "' . $hash . '" where Email = "' . $email . '"';
	$conn->query($sql);
}

function makeHash($email){
	$plusSalt = $email . rand ( 0, 1000 );
	return hash ( "sha512", $plusSalt );
}

	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/footer.php');
?>