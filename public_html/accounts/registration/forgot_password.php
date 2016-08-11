<?php 
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');
?>
	<form action="change.php" method="POST">
	E-mail Address: <input type="text" name="ForgotPasswordEmail"/><input type="submit"/>
	</form> 
	
<?php 
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/footer.php');
?>