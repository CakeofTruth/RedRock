<?php

if (empty ( $_POST )) {
	$firstName = "firstName";
	$lastName = "lastName";
	$username = "username";
	$password = "password";
	$passwordconfirm = "passwordconfirm";
	$resellername = "resellername";
	$resellerba1 = "resellerba1";
	$resellerba2 = "resellerba2";
	$city = "city";
	$state = "state";
	$zipcode = "zipcode";
	$telephoneNumber = "telephoneNunmber";
	$emailAddress = "emailAddress";
	$spcode = "spCode";
}else{
	$firstName = $_POST ["firstName"];
	$lastName = $_POST ["lastName"];
	$username = $_POST ["username"];
	$password = $_POST ["password"];
	$passwordconfirm = $_POST ["passwordConfirm"];
	$telephoneNumber = $_POST ["telephoneNumber"];
	$emailAddress = $_POST ["emailAddress"];
	$spcode = $_POST ["spCode"];
}
?>

<link rel='stylesheet' id='custom-css' href='/css/contactform.css'
	type='text/css' media='all' />

<div id="contact-form">
	<div class="description">
<h1>Account Registration</h1>
<h2>Customer Information</h2>
	</div>
<form action="/accounts/registration/AccountRegistration.php" method="post">
	<label>First Name:<span class="required">*</span></label><input type="text" name="firstName" value="<?php if(isset($_POST["firstName"])){ echo $_POST["firstName"];}?>" required>
	<label>Last Name:<span class="required">*</span></label><input type="text" name="lastName" value="<?php if(isset($_POST["lastName"])){ echo $_POST["lastName"];}?>" required>
	<label>Username:<span class="required">*</span></label><input type="text" name="username" value="<?php if(isset($_POST["username"])){ echo $_POST["username"];}?>" required>
	<label>Password:<span class="required">*</span></label><input type="password" name="password" required><?php echo $passwordError; ?> 
	<label>Password Confirm:<span class="required">*</span></label><input type="password" name="passwordConfirm" required><?php echo $passwordMatchError; ?>
	<label>Contact Telephone Number:<span class="required">*</span></label><input type="text" name="telephoneNumber" value="<?php if(isset($_POST["telephoneNumber"])){ echo $_POST["telephoneNumber"];}?>" required>
	<label>Email Address:<span class="required">*</span></label><input type="email" name="emailAddress" value="<?php if(isset($_POST["emailAddress"])){ echo $_POST["emailAddress"];}?>" required>
	<?php echo $emailError; ?>
	<label>Service Provider Code:<span class="required">*</span></label><input type="text" name="spCode" value="" maxlength="4" required><?php echo $spcodeError; ?>
	<input type="submit" value="Submit"> <input type="hidden" value="false">
	<p id="req-field-desc"><span class="required">*</span> indicates a required field</p>
</form>
</div>
<?php
include ($_SERVER ["DOCUMENT_ROOT"] . '/main/footer.php');
?>
</body>
</html>
