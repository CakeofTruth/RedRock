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
echo "<br><br>";
?>

<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "potato";
$dbname = "RedRock_Cake";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
else{
	echo 'Connection successful <br>';
}

$sqlInsertString = generateSqlString();

echo 'Executing: ' . $sqlInsertString . '<br>';

if (mysqli_query($conn, $sqlInsertString )) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sqlInsertString . "<br>" . mysqli_error($conn);
}

$conn->close();

function generateSqlString(){
	$sql = 'INSERT INTO Accounts (Username, Password, Reseller_ID,First_Name,Last_Name,email) VALUES(';
	$sql = $sql . "'" . test_input($_POST["username"]) . "',";
	$sql = $sql . "'" . test_input($_POST["password"]) . "',";
	$sql = $sql . "1,";
	$sql = $sql . "'" . test_input($_POST["firstName"]) . "',";
	$sql = $sql . "'" . test_input($_POST["lastName"]) . "',";
	$sql = $sql . "'" . test_input($_POST["emailAddress"]) . "')";
	
	return $sql;
}

?>