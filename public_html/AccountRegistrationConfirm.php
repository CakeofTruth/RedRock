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
$servername = "198.71.225.56:3306";
$dbusername = "redrock";
$dbpassword = "@dm!nP@$$1001";
$dbname = "RedRock";

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
	$lastinsert = $conn -> insert_id;
	echo "Inserted record " . $lastinsert . '<br>';
} else {
	echo "Error: " . $sqlInsertString . "<br>" . mysqli_error($conn);
}

$selectString = "select Username, Reseller_ID, First_Name, Last_Name, Email from Accounts";

$result = $conn->query($selectString);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo "Username: " . $row["Username"] . 
			 " Reseller_ID: " . $row["Reseller_ID"] . 
			 " First_Name: " . $row["First_Name"] . 
			 " Last_Name: " . $row["Last_Name"] . 
			 " Email: " . $row["Email"] . 
			 "<br>";
	}
} else {
	echo "0 results";
}


$conn->close();

function generateSqlString(){
	$sql = 'INSERT INTO Accounts (Username, Password, Serv_Prov_CD, First_Name, Last_Name, Email) VALUES(';
	$sql = $sql . "'" . test_input($_POST["username"]) . "',";
	$sql = $sql . "'" . test_input($_POST["password"]) . "',";
	$sql = $sql . "'" . test_input($_POST["Serv_Prov_CD"]) . "',";
	$sql = $sql . "'" . test_input($_POST["firstName"]) . "',";
	$sql = $sql . "'" . test_input($_POST["lastName"]) . "',";
	$sql = $sql . "'" . test_input($_POST["emailAddress"]) . "')";
	
	return $sql;
}

?>