<?php
// define variables and set to empty values
//$Reseller_Name = $password =$password_confirm= $Reseller_Billing_Address_1 = $Reseller_Billing_Address_2 = $City =$State =$Zip_Code = $Telephone_Number = $Email_Address = $Service_Provider_Code = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Username = test_input($_POST["Username"]);
  $Password = validate_password($_POST["Password"]);
  $Password_Confirm = matches_password($_POST["Password_Confirm"]);
  $Reseller_Name = test_input ($_POST["Reseller_Name"]);
  $Reseller_Billing_Address_1 = test_input ($_POST["Reseller_Billing_Address_1"]);
  $Reseller_Billing_Address_2 = test_input ($_POST["Reseller_Billing_Address_2"]);
  $City = test_input ($_POST["City"]);
  $State = test_input ($_POST["State"]);
  $Zip_Code = test_input ($_POST["Zip_Code"]);
  $Telephone_Number = test_input ($_POST["Telephone_Number"]);
  $Email_Address = test_input($_POST["Email_Address"]);
  $Service_Provider_Code = test_input($_POST["Service_Provider_Code"]);
}

function matches_password($confirm){
	if($confirm = $Password){
		echo 'the password matches';
	}
	else{
		echo 'YOU CANT TYPE THE SAME THING TWICE?';
	}
	return $confirm;
}
function validate_password($password){
	if(preg_match('/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])/', $password)) {
		echo 'Your password doesn\'t suck<br>';
	}
	else{
		echo 'Your password sucks.';
	}
	return $password;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<?php
echo "<h2>Your Input:</h2>";
echo $Username;
echo "<br>";
echo $Password;
echo "<br>";
echo $Password_Confirm;
echo "<br>";
echo $Reseller_Name;
echo "<br>";
echo $Reseller_Billing_Address_1;
echo "<br>";
echo $Reseller_Billing_Address_2;
echo "<br>";
echo $City;
echo "<br>";
echo $State;
echo "<br>";
echo $Zip_Code;
echo "<br>";
echo $Telephone_Number;
echo "<br>";
echo $Email_Address;
echo "<br>";
echo $Service_Provider_Code;
?>