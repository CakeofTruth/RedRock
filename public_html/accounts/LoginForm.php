<?php
$pagetitle = "Red Rock Telecommunications Login Page";
?>
<link rel='stylesheet' id='custom-css' href='/css/contactform.css'
	type='text/css' media='all' />

<div id="contact-form">
	<div class="description">
		<h2>Login Form</h2>
		<p>Please enter your username and password to login</p>
	</div>
	<form action="/accounts/login.php" method="post">
		<label>Username:</label><input type="text" name="username" <?php if(isset($_POST["username"])) {echo 'value="' . $_POST["username"] . '"';}?>>
		<label>Password:</label><input type="password" name="password">
		<input type="submit" value="Submit">
	</form>
	<div id="newaccount">
		<a href="/accounts/registration/AccountRegistration.php">Create a New Account</a> <br> 
		<a href="/accounts/registration/forgot_password.php">Forgot Your Password?</a>
	</div>
</div>

<?php
include ($_SERVER ["DOCUMENT_ROOT"] . '/main/footer.php');
?>