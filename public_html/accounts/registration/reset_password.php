<?php
	echo '
		<form action="reset.php" method="POST">
		E-Mail Address: <input type="text" name="emailAddress"/><br/>
		New Password: <input type="password" name="password" /><br/>
		Confirm Password: <input type="password" name="confirmpassword" /><br/>
		<input type="hidden" name="q" value="';
	if (isset($_GET["q"])) {
		echo $_GET["q"];
	}
		echo '" /><input type ="submit" name ="ResetPasswordForm" value ="Reset Password" />
		</form>';
?>
