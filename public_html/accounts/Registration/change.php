<?php
	$host = "107.180.46.223";
	$dbusername = "redrock";
	$dbpassword = "@dm!nP@$$1001";
	$dbname = "RedRock";
try { 
	$conn = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $dbusername, $dbpassword);
	}
catch(PDOException $ex){
			$msg = "Failed to connect to the database";
	}
if (isset($_POST["ForgotPassword"])) {
	
	if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		$Email = $_POST["emailAddress"];
	}else{
		echo "email is not valid";
		exit;
	}
}
	$query = $conn->prepare('SELECT Email FROM accounts WHERE Email=:email');
	$query->bindPARAM(':email', $emailAddress);
	$query->execute();
	$userExists = $query->fetch(PDO::FETCH_ASSOC);
	$conn = null;
	
if($userExists["emailAddress"]) {
	$salt= "45467D%^*BBDS42@#RFVBNM78979835!DVBNKL";
	$password = hash('sha512', $salt.$userExists["email"]);
	$pwurl = "www.redrocktelecom.com/reset_password.php?q=".$password;
	$mailbody ="Dear User,\n\n You (or someone else) entered this email address when trying to change the password of a Red Rock Telecommunications account. \n\n
				If you are a Red Rock Telecommunications customer, please click the link below.  If you cannot click it, please paste it into your web browser's address bar. \n\n
				If you are not a Red Rock Telecommunications cutomer, please ignore this email. \n\n Best Regards, \n Red Rock Telecommunications Customer Service Team";
	mail($userExists["emailAddress"], "www.redrocktelecom.com - Password Reset, $mailbody");
	echo "Your password recovery key has been sent to your e-mail address,";
}
	else {
		echo "No user with that e-mail address exists.";
}
?>