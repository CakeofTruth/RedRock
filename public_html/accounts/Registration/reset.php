<?php
	$host = "107.180.46.223";
	$dbusername = "redrock";
	$dbpassword = "@dm!nP@$$1001";
	$dbname = "RedRock";
try{
	$conn = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
}
	catch(PDOException $ex)
	{
		$msg = "Failed to connect to the database";
	}
if (isset($_POST["ResetPasswordForm"]))
{
	$email = $_POST["emailAddress"];
	$password = $_POST["password"];
	$confirmpassword = $_POST["confirmpassword"];
	$hash = $_POST["q"];
	$salt ="45467D%^*BBDS42@#RFVBNM78979835!DVBNKL";
	$resetkey = hash('sha512',$salt.$email);
	if ($resetkey == $hash)
	{
		if($password == $confirmpassword)
		{
			$password = hash('sha512',$salt.$password);
			$query=$conn->prepare('UPDATE Accounts SET Password = :password WHERE Email = :email');
			$query->bindParam(':password', $password);
			$query->bindParam(':email', $email);
			$query->execute();
			$conn = null;
			echo "Your password has been successfully reset.";
		}
		else 
			echo "Your password reset key is invalid.";
	}
}
?>