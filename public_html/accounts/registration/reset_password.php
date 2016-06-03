<?php

include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');
include_once $root . '/classes/DBUtils.php';

$passwordError = $passwordMatchError = "";

	//Check hash validity
	if (isset($_GET["pwh"]) && hashIsValid($_GET["pwh"])) {
		$hash = $_GET["pwh"];
		$formIsValid = 1;
		if(empty($_POST)){
			$formIsValid = 0;
		}
		if(!meetsPasswordRequirements($_POST["password"])){
			$passwordError = 'Please create a password that is at least 8 characters long and includes at least one uppercase letter, 
						one lowercase letter, one number and one special character.<br>';
			$formIsValid = 0;
		}
		if(isset($_POST["passwordConfirm"])){
			if(!matches_password($_POST["password"],$_POST["passwordConfirm"])){
				$passwordMatchError = 'Passwords do not match';
				$formIsValid = 0;
			}
		}else{
			$formIsValid = 0;
		}

		if($formIsValid){
			$email = getEmailFromHash($hash);
			if(updatePassword($email,$_POST["password"])){
				//TODO: send PasswordChangedEmail
				//sendPasswordChangedEmail($email);
				echo "Your password has been updated!";
			}
			else{
				echo "Failed to update password";
			}
		}
		else{
			include ($_SERVER ["DOCUMENT_ROOT"] . '/accounts/registration/passwordForm.php');
		}

	}
	else{
		echo 'This is the password reset page. If you requested a password reset and got here via an email link, 
				please retry, or contact us at customerservice@redrocktelecom.com';
	}
	
function updatePassword($email,$password){
	$sql = 'Update Accounts set Password = "' . $password . '" where Email = "' . $email . '"';
	$dbutils = new DBUtils();
	$conn = $dbutils->getDBConnection();
	$update = mysqli_query($conn,$sql); 
	
	if ($update) {
		return true;	
	}
	return false;
}

	
function getEmailFromHash($hash){
	$sql = 'Select Email from Accounts where hash = "' . $hash . '"';
	$dbutils = new DBUtils();
	$conn = $dbutils->getDBConnection();
	$result = $conn->query ( $sql);
	
	if ($result->num_rows == 1) {
		$row  = $result->fetch_assoc () ;
		return $row["Email"];
	}
	else{
		echo "Error: Multiple Accounts returned for hash.";
	}
	return null;
}

function hashIsValid($hash){
	$sql = 'Select 1 from Accounts where hash = "' . $hash . '"';
	$dbutils = new DBUtils();
	$conn = $dbutils->getDBConnection();
	$result = $conn->query ( $sql);
	if ($result->num_rows > 0) {
		return true;
	}
	return false;
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


	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/footer.php');
?>
