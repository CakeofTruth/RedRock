<?php
$pagetitle = "Red Rock Telecommunications Login Page";
?>
<div class="description">
	<h1>Login Form</h1>
	<p>Please enter your username and password to login</p>
</div>

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
	<a href="/accounts/Registration/AccountRegistrationForm.php">Create a New Account</a> 
	<a href="/accounts/Registration/forgot_password.php">Forgot Your Password?</a>
</div>


<?php
include ($_SERVER ["DOCUMENT_ROOT"] . '/main/footer.php');
?>