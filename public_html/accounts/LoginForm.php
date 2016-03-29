<!DOCTYPE html>
<html>
<head>
<title>Red Rock Telecommunications Login Page</title>
</head>
<body>
	<div id="login">
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
	</div>
	<div id="newaccount">
		<a href="AccountRegistration.php">Create a New Account</a>
	</div>
</body>

<?php
$username = $password = "";
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	$username = test_input ( $_POST ["username"] );
	$password = validate_password ( $_POST ["password"] );
}
?>

