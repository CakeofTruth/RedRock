
	<form action="reset_password.php?pwh=<?php echo $hash ?>" method="POST">
		<table>
		<tr><td>New Password: <input type="password" name="password" required/></td><td><?php echo $passwordError; ?></td></tr>
		<tr><td>Confirm Password: <input type="password" name="passwordConfirm" required/></td><td><?php echo $passwordMatchError; ?></td></tr>
		<tr><td><input type ="submit"></td></tr>
		</table>
	</form>