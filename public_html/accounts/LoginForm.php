<?php
$pagetitle = "Red Rock Telecommunications Login Page";
include ($_SERVER ["DOCUMENT_ROOT"] . 'main/header.php');
?>
<div class="description">
	<h1>Login Form</h1>
	<p>Please enter your username and password to login</p>
</div>
<?php
if (isset ( $msg )) {
	echo '<div class="statusmsg">' . $msg . '</div>';
}
?>
<!--  
	<div id="login">
		<form action="" method="post">
		<label for="username">userame:</label>
		<input type="text" name="username" value="" />
		<label for="password">password:</label>
		<input type="password" name="password" value="" />
		
		<input type="submit" class="submit_button" value="sign up" />
	*/</form>
	-->
<!-- Trying to decide which form style is better -->
<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
	method="post">
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
	<a href="AccountRegistrationForm.php">Create a New Account</a> <a
		href="forgot_password.php">Forgot Your Password?</a>
</div>

<?php
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	$username = test_input ( $_POST ["username"] );
	$password = validate_password ( $_POST ["password"] );
}
?>
<!-- link for password reset (change, forgot_password, reset_password, reset) is  http://www.dreamincode.net/forums/topic/370692-reset-password-system/-->
<!-- link for email verification of accounts (verify and login) is  http://code.tutsplus.com/tutorials/how-to-implement-email-verification-for-new-members--net-3824-->

<?php
include ($_SERVER ["DOCUMENT_ROOT"] . 'main/footer.php');
?>