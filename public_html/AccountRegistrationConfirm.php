<?php
$username = $password = $passwordconfirm = $resellername = $resellerba1 = $resellerba2 
= $city = $state = $zipcode = $telephonenumber =$emailaddress = $spcode = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName= test_input($_POST["firstName"]);
  $lastName= test_input($_POST["lastName"]);
  $username = test_input($_POST["username"]);
  $password = validate_password($_POST["password"]);
  $passwordconfirm = matches_password($_POST["passwordConfirm"]);
  $resellername = test_input ($_POST["resellerName"]);
  $resellerba1 = test_input ($_POST["resellerBA1"]);
  $resellerba2 = test_input ($_POST["resellerBA2"]);
  $city = test_input ($_POST["city"]);
  $state = test_input ($_POST["state"]);
  $zipcode = test_input ($_POST["zipCode"]);
  $telephonenumber = test_input ($_POST["telephoneNumber"]);
  $emailaddress = test_input($_POST["emailAddress"]);
  $spcode = test_input($_POST["spCode"]);
}

function matches_password($confirm){
	if(strcmp($confirm, $password)){
		echo 'The password matches';
	}
	else{
		echo 'Passwords do not match';
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
/*
$servername = "198.71.225.56:3306";
$dbusername = "redrock";
$dbpassword = "@dm!nP@$$1001";
$dbname = "RedRock";
*/
$servername = "localhost:3306";
$dbusername = "root";
$dbpassword = "Redrock123";
$dbname = "redrock";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
else{
// 	echo 'Connection successful <br>';
}

$accountInsertString= generateAccountInsertString();

if (mysqli_query($conn, $accountInsertString)) {
// 	echo "New record created successfully";
	$customerID = $conn -> insert_id;
// 	echo "Inserted record  " . $lastinsert . ' into Accounts Table.<br>';
} else {
// 	echo "Error: " . $accountInsertString. "<br>" . mysqli_error($conn);
}

$resellerInsertString = generateResellerInsertString();

if (mysqli_query($conn, $resellerInsertString )) {
// 	echo "New record created successfully";
	$customerID = $conn -> insert_id;
// 	echo "Inserted record  " . $lastinsert . ' into Accounts Table.<br>';
} else {
// 	echo "Error: " . $resellerInsertString . "<br>" . mysqli_error($conn);
}

echo "<script> window.location = 'login.php' </script>";

$conn->close();

function generateResellerInsertString(){
	$sql = "INSERT INTO Resellers (Serv_Prov_CD,Address1,Address2,City,State,Zip,Phone,Company_Name) VALUES(";
	$sql = $sql . "'" . test_input($_POST["spCode"]) . "',";
	$sql = $sql . "'" . test_input($_POST["resellerBA1"]) . "',";
	$sql = $sql . "'" . test_input($_POST["resellerBA2"]) . "',";
	$sql = $sql . "'" . test_input($_POST["city"]) . "',";
	$sql = $sql . "'" . test_input($_POST["state"]) . "',";
	$sql = $sql . "'" . test_input($_POST["zipCode"]) . "',";
	$sql = $sql . "'" . test_input($_POST["telephoneNumber"]) . "',";
	$sql = $sql . "'" . test_input($_POST["resellerName"]) . "')";

	return $sql;
}

function generateAccountInsertString(){
	$sql = 'INSERT INTO Accounts (Username, Password, Serv_Prov_CD, First_Name, Last_Name, Email) VALUES(';
	$sql = $sql . "'" . test_input($_POST["username"]) . "',";
	$sql = $sql . "'" . test_input($_POST["password"]) . "',";
	$sql = $sql . "'" . test_input($_POST["spCode"]) . "',";
	$sql = $sql . "'" . test_input($_POST["firstName"]) . "',";
	$sql = $sql . "'" . test_input($_POST["lastName"]) . "',";
	$sql = $sql . "'" . test_input($_POST["emailAddress"]) . "')";
	
	return $sql;
}

?>