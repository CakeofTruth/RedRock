<!DOCTYPE html>
<html>
<head>
<title>Red Rock Telecommunications Login Page</title>
</head>
<body>
	<div id="login">
	<form action= "login.php>" method="post">
		<table>
			<tr>
				<td> Username: </td>
				<td>  <input type="text" name="username"> </td>
			</tr>	
			<tr>
				<td> Password: </td>
				<td>  <input type="text" name="password"> </td>
			</tr>	
		</table>
		<input type="submit" value="Submit">	
	</form>
	</div>
		<div id="newaccount">
	 <a href="AccountRegistration.php">Create a New Account</a>
	</div>
</body>
<?php
$username = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $username = test_input($_POST["username"]);
 $password = validate_password($_POST["password"]);
}
?>
<?php	
	function matches_password($confirm){
	if(strcmp($confirm, $password)){
		echo 'The password matches';
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
		echo 'Your password sucks.';
	}
	return $password;
}
?>

<?php
$servername = "198.71.225.56:3306";
$dbusername = "redrock";
$dbpassword = "@dm!nP@$$1001";
$dbname = "RedRock";

$con=mysql_connect($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
else{
	echo 'Connection successful <br>';
}

$Username = $_POST['username']; 
$Password = $_POST['password']; 
function SignIn() 
{ 
session_start(); //starting the session for user profile page 
if(!empty($_POST['username'])) //checking the 'user' name which is from Sign-In.html, is it empty or have some text 
	{ 
	$query = mysql_query("SELECT * FROM Username where username = '$_POST[username]' AND password = '$_POST[password]'") or die(mysql_error()); 
	$row = mysql_fetch_array($query) or die(mysql_error()); 
	if(!empty($row['Username']) AND !empty($row['password'])) 
	{ 
		$_SESSION['Username'] = $row['password']; 
		echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE..."; 
	} 
	else 
	{ 
		echo "SORRY... YOU ENTERD WRONG USERNAME OR PASSWORD... PLEASE TRY AGAIN..."; 
	} 
}
} 
if(isset($_POST['submit'])) 
{ 
	SignIn(); 
} 
?>