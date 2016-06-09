
<link rel='stylesheet' id='custom-css' href='/css/contactform.css' type='text/css' media='all' />
<div id="contact-form">
	<form action="reset_password.php?pwh=<?php echo $hash ?>" method="POST">
		<table>
		<tr><td>New Password: <input type="password" name="password" required/></td></tr>
		<tr><td><?php echo $passwordError; ?></td></tr>
		<tr><td>Confirm Password: <input type="password" name="passwordConfirm" required/></td>
		<tr><td><?php echo $passwordMatchError; ?></td></tr>
		<tr><td><input type ="submit"></td></tr>
		</table>
	</form>
</div>