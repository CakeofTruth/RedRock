<?php
include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');

$emailError = $passwordError = $passwordMatchError = ""; 

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
}


if($formisvalid){
	include_once $root . '/classes/DBUtils.php';
	$dbutil = new DBUtils();
	$conn = $dbutil->getDBConnection();
	insertAccount();
	insertReseller();
	$conn->close ();
	echo "Account Created Successfully!";
} else {
	include ("AccountRegistrationForm.php");
}

// $to = $email;
// $subject = 'Signup | Verification';
// $message = '
// 	Thank you for signing up! Your account has been created.  You can login with the 
// 	following credentials after you have activated your account by clicking the url below.
		
// ------------------------
// Username: ' . $username . '
// Password: ' . $password . '
// ------------------------
// 	Please click this ink to activate your account:
// 	http://www.redrocktelecom.com/verify.php?email=' . $email . '&hash=' . $hash . '
// 	';
// $headers = 'From:noreply@redrocktelecom.com' . "\r\n";
// $didsend = mail ( $to, $subject, $message, $headers );
// echo "Mail Sent status: " . $didsend;

// echo "<script> window.location = 'login.php' </script>";

/**
 * *****************************************************************************************
 * Functionssssss
 * ******************************************************************************************
 */

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

function insertAccount(){
	
	$plusSalt = $email . rand ( 0, 1000 );
	$hash = hash ( "sha512", $plusSalt );
	$accountInsertString = generateAccountInsertString ( $hash );

	if (mysqli_query ( $conn, $accountInsertString )) {
		$customerID = $conn->insert_id;
	}

}

function insertReseller(){
	
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