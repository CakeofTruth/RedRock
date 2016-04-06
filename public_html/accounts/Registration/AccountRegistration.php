<?php
include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');
if (empty ( $_POST )){
	include("AccountRegistrationForm.php"); 
}else{
	include_once $root . '/classes/DBUtils.php';

$username = $password = $passwordconfirm = $resellername = $resellerba1 = $resellerba2 
= $city = $state = $zipcode = $telephonenumber =$emailaddress = $spcode = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName= test_input($_POST["firstName"]);
  $lastName= test_input($_POST["lastName"]);
  $username = test_input($_POST["username"]);
  $password = validate_password($_POST["password"]);
  $passwordconfirm = matches_password($_POST["passwordConfirm"]);
  $resellername = test_input ($_POST["resellerName"]);
  $resellerba1 = test_input ($_POST["resellerBA1"]);
  $resellerba2 = test_input ($_POST["resellerBA2"]);
  $city = test_input ($_POST["city"]);
  $state = test_input ($_POST["state"]);
  $zipcode = test_input ($_POST["zipCode"]);
  $telephonenumber = test_input ($_POST["telephoneNumber"]);
  $emailaddress = test_input($_POST["emailAddress"]);
  $spcode = test_input($_POST["spCode"]);
}

$email = $_POST['emailAddress'];
echo 'Email is: ' . $email;
if(!preg_match("/^[_a-z0-9-]+(\.[a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)){
	$msg ='The email you have entered is invalid, please try again.';
}else{
	$msg = 'Your account has been created, <br/> please activate it by clicking 
			the link that has been sent to your email.';
}

echo '<div class="statusmsg">'.$msg.'</div>'; // Display our message and wrap it with a div with the class "statusmsg".

$plusSalt = $email . rand(0,1000);

$hash = hash("sha512", $plusSalt);

echo $hash . '<br>';

$dbutil = new DBUtils();
$conn = $dbutil->getDBConnection();

$accountInsertString = generateAccountInsertString($hash);

echo $accountInsertString . '<br>';

if (mysqli_query($conn, $accountInsertString)) {
	$customerID = $conn -> insert_id;
}

$resellerInsertString = generateResellerInsertString();

if (mysqli_query($conn, $resellerInsertString )) {
// 	echo "New record created successfully";
	$resellerID = $conn -> insert_id;
// 	echo "Inserted record  " . $lastinsert . ' into Accounts Table.<br>';
} else {
 	echo "Error: " . $resellerInsertString . "<br>" . mysqli_error($conn);
}


$conn->close();

$to = $email;
$subject = 'Signup | Verification';
$message = '
	Thank you for signing up! Your account has been created.  You can login with the 
	following credentials after you have activated your account by clicking the url below.
		
------------------------
Username: '.$username.'
Password: '.$password.'
------------------------
	Please click this ink to activate your account:
	http://www.redrocktelecom.com/verify.php?email='.$email.'&hash='.$hash.'
	';
$headers = 'From:noreply@redrocktelecom.com'  . "\r\n";
mail($to, $subject,$message, $headers);
echo "Mail Sent!";

//echo "<script> window.location = 'login.php' </script>";
}

/*******************************************************************************************
 *  								Functionssssss
 ********************************************************************************************/
function generateResellerInsertString(){
	$sql = "INSERT INTO Resellers (Serv_Prov_CD,Address1,Address2,City,State,Zip,Phone,Company_Name) VALUES(";
	$sql = $sql . "'" . test_input($_POST["spCode"]) . "',";
	$sql = $sql . "'" . test_input($_POST["resellerBA1"]) . "',";
	$sql = $sql . "'" . test_input($_POST["resellerBA2"]) . "',";
	$sql = $sql . "'" . test_input($_POST["city"]) . "',";
	$sql = $sql . "'" . test_input($_POST["state"]) . "',";
	$sql = $sql . "'" . test_input($_POST["zipCode"]) . "',";
	$sql = $sql . "'" . test_input($_POST["telephoneNumber"]) . "',";
	$sql = $sql . "'" . test_input($_POST["resellerName"]) . "')";
	return $sql;
}

function generateAccountInsertString($hash){
	$sql = 'INSERT INTO Accounts (Username, Password, Serv_Prov_CD, First_Name, Last_Name, Email,hash) VALUES(';
	$sql = $sql . "'" . test_input($_POST["username"]) . "',";
	$sql = $sql . "'" . test_input($_POST["password"]) . "',";
	$sql = $sql . "'" . test_input($_POST["spCode"]) . "',";
	$sql = $sql . "'" . test_input($_POST["firstName"]) . "',";
	$sql = $sql . "'" . test_input($_POST["lastName"]) . "',";
	$sql = $sql . "'" . test_input($_POST["emailAddress"]) . "',";
	$sql = $sql . "'" . $hash . "')" ;
	return $sql;
}

function matches_password($confirm){
	if(strcmp($confirm, $password)){
		echo 'The passwords match<br>';
	}
	else{
		echo 'Passwords do not match';
	}
	return $confirm;
}
function validate_password($password){
	if(preg_match('/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])/', $password)) {
		echo 'Your password doesn\'t suck<br>';
	}
	else{
		echo 'Please create a password that is 8-15 characters and includes at least one uppercase letter, 
				one lowercase letter, one number and one special character.<br>';
	}
	return $password;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>