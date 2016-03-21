<?php
$username = $password = $passwordconfirm = $resellername = $resellerba1 = $resellerba2 = $city = $state = $zipcode = $telephonenumber =$emailaddress = $spcode = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = test_input($_POST["username"]);
  $password = validate_password($_POST["password"]);
  $passwordconfirm = matches_password($_POST["passwordconfirm"]);
  $resellername = test_input ($_POST["resellername"]);
  $resellerba1 = test_input ($_POST["resellerba1"]);
  $resellerba2 = test_input ($_POST["resellerba2"]);
  $city = test_input ($_POST["city"]);
  $state = test_input ($_POST["state"]);
  $zipcode = test_input ($_POST["zipcode"]);
  $telephonenumber = test_input ($_POST["telephonenumber"]);
  $emailaddress = test_input($_POST["emailaddress"]);
  $spcode = test_input($_POST["spcode"]);
}

function matches_password($confirm){
	if($confirm = $password){
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
echo $username;
echo "<br>";
echo $password;
echo "<br>";
echo $passwordconfirm;
echo "<br>";
echo $resellername;
echo "<br>";
echo $resellerba1;
echo "<br>";
echo $resellerba2;
echo "<br>";
echo $city;
echo "<br>";
echo $state;
echo "<br>";
echo $zipcode;
echo "<br>";
echo $telephonenumber;
echo "<br>";
echo $emailaddress;
echo "<br>";
echo $spcode;
?>