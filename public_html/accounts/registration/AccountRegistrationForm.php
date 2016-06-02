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
	$resellername = $_POST ["resellerName"];
	$resellerba1 = $_POST ["resellerBA1"];
	$resellerba2 = $_POST ["resellerBA2"];
	$city = $_POST ["city"];
	$state = $_POST ["state"];
	$zipcode = $_POST ["zipCode"];
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
	<label>First Name:<span class="required">*</span></label><input type="text" name="firstName" value="" required>
	<label>Last Name:<span class="required">*</span></label><input type="text" name="firstName" value="" required>
	<label>Username:<span class="required">*</span></label><input type="text" name="username" value="" required>
	<label>Password:<span class="required">*</span></label><input type="password" name="password" required></td><td><?php echo $passwordError; ?>
	<label>Password Confirm:<span class="required">*</span></label><input type="password" name="passwordConfirm" 
	required></td><td><?php echo $passwordMatchError; ?>
	<label>Reseller Company Name:<span class="required">*</span></label><input type="text" name="resellerName" 
	value="" required>
	<label>Reseller Billing Address 1:<span class="required">*</span></label><input type="text" name="resellerBA1" 
	value="" required>
	<label>Reseller Billing Address 2:</label><input type="text" name="resellerBA2" value="">
	<label>City:<span class="required">*</span></label><input type="text" name="city" value="" required>
	<label>State:<span class="required">*</span></label><select name="state" required>
			<?php 
				if(!empty($_POST)  && !empty($state) ){ 
					echo "<option value=". $state ." selected=selected >".$state ."</option>"; 
				}
			?>
					<option value="Alabama">AL</option>
					<option value="Alaska">AK</option>
					<option value="Arizona" >AZ</option>
					<option value="Arkansas">AR</option>
					<option value="California">CA</option>
					<option value="Colorado">CO</option>
					<option value="Connecticut">CT</option>
					<option value="Delaware">AL</option>
					<option value="District of Columbia">DC</option>
					<option value="Florida">FL</option>
					<option value="Georgia">GA</option>
					<option value="Hawaii">HI</option>
					<option value="Idaho">ID</option>
					<option value="Illinois">IL</option>
					<option value="Indiana">IN</option>
					<option value="Iowa">IA</option>
					<option value="Kansas">KS</option>
					<option value="Kentucky">KY</option>
					<option value="Louisiana">LA</option>
					<option value="Maine">ME</option>
					<option value="Maryland">MD</option>
					<option value="Massachusetts">MA</option>
					<option value="Michigan">MI</option>
					<option value="Minnesota">MN</option>
					<option value="Mississippi">MS</option>
					<option value="Missouri">MO</option>
					<option value="Montana">MT</option>
					<option value="Nebraska">NE</option>
					<option value="Nevada">NV</option>
					<option value="New Hampshire">NH</option>
					<option value="New Jersey">NJ</option>
					<option value="New Mexico">NM</option>
					<option value="New York">NY</option>
					<option value="North Carolina">NC</option>
					<option value="North Dakota">ND</option>
					<option value="Ohio">OH</option>
					<option value="Oklahoma">OK</option>
					<option value="Oregon">OR</option>
					<option value="Pennsylvania">PA</option>
					<option value="Rhode Island">RI</option>
					<option value="South Carolina">SC</option>
					<option value="South Dakota">SD</option>
					<option value="Tennessee">TN</option>
					<option value="Texas">TX</option>
					<option value="Utah">UT</option>
					<option value="Vermont">VT</option>
					<option value="Virginia">VA</option>
					<option value="Washington">WA</option>
					<option value="West Virginia">WV</option>
					<option value="Wisconsin">WI</option>
					<option value="Wyoming">WY</option>
				</select>
		<label>Zip Code:<span class="required">*</span></label><input type="text" name="zipCode" value=""required>
		<label>Contact Telephone Number:<span class="required">*</span></label><input type="text" name="telephoneNumber" value="" required>
		<label>Email Address:<span class="required">*</span></label><input type="email" name="emailAddress" value="" required>
		<?php echo $emailError; ?>
		<label>Service Provider Code:<span class="required">*</span></label><input type="text" name="spCode" 
		value="" maxlength="4" required><?php echo $spcodeError; ?>
	<input type="submit" value="Submit"> <input type="hidden" value="false">
	<p id="req-field-desc"><span class="required">*</span> indicates a required field</p>
</form>
</div>
<?php
include ($_SERVER ["DOCUMENT_ROOT"] . '/main/footer.php');
?>
</body>
</html>
