<!DOCTYPE html>
<html>
<head>
<title>Red Rock Telecommunications Login Page</title>
</head>
<body>
	<?php 
		mysqli_connect("localhost:85", "RedRock", "Redrock123") or die(mysqli_error());
		mysqli_select_db("accounts") or die(mysqli_error());
		if(isset($_POST['username']) && !empty($_POST['username']) AND isset($_POST['password']) && !empty($_POST['password'])){
		$username = mysqli_escape_string($_POST['username']);
		$password = mysqli_escape_string(md5($_POST['password']));
		
		$search = mysqli_query("SELECT username, password, active FROM accounts WHERE username='".$username."' AND password='".$password."' AND active='1'")
		or die(mysqli_error());
		$match = mysqli_num_rows ($search);
			if($match > 0){
				$msg = 'Login Complete! Thank you!';
			}else{
				$msg = 'Login Failed! Please make sure that you entered the correct details and that you have activated your account';
			}
		}
		
	?>
	<div class ="description">
	<h1> Login Form</h1>
	<p> Please enter your username and password to login </p>
	</div>
	<?php 
		if(isset($msg)){
			echo '<div class="statusmsg">'.$msg.'</div>';
		}
	?>
	<!--  
	<div id="login">
		<form action="" method="post">
		<label for="username">Userame:</label>
		<input type="text" name="username" value="" />
		<label for="password">Password:</label>
		<input type="password" name="password" value="" />
		
		<input type="submit" class="submit_button" value="Sign up" />
	*/</form>
	-->
	<!-- Trying to decide which form style is better -->
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="username"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="text" name="password"></td>
				</tr>
			</table>
			<input type="submit" value="Submit">
		</form>
	<div id="newaccount">
		<a href="AccountRegistrationForm.php">Create a New Account</a>
		<a href="forgot_password.php">Forgot Your Password?</a>
	</div>
</body>

<?php
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	$username = test_input ( $_POST ["username"] );
	$password = validate_password ( $_POST ["password"] );
}
?>
<!-- link for password reset (change, forgot_password, reset_password, reset) is  http://www.dreamincode.net/forums/topic/370692-reset-password-system/-->
<!-- link for email verification of accounts (verify and login) is  http://code.tutsplus.com/tutorials/how-to-implement-email-verification-for-new-members--net-3824-->
