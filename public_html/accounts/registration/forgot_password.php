<!DOCTYPE html>
<html>
<head>
<title>Forgot Your Password?</title>
</head>
<?php
include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');
?>
<link rel='stylesheet' id='custom-css' href='/css/contactform.css'
	type='text/css' media='all' />
<body>
<div id="contact-form">
	<div class="description">
	<h2>Forgot Your Password?</h2>
	</div>
	<form action="change.php" method="post">
	
		<label>E-mail Address:</label><input type="text" name="emailAddress"/>
		<input type="submit" name="ForgotPassword" value="Request Reset" />
	</form>
</div>
<?php
include ($_SERVER ["DOCUMENT_ROOT"] . '/main/footer.php');
?>