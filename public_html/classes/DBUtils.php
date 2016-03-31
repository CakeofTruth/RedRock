<?php
class DBUtils {

/*
=======
>>>>>>> 3eb5cbade5b74286553ff4e49d5014446ee7f1ee:public_html/AccountRegistrationConfirm.php
$servername = "198.71.225.56:3306";
$dbusername = "redrock";
$dbpassword = "@dm!nP@$$1001";
$dbname = "RedRock";
<<<<<<< HEAD:public_html/accounts/Registration/AccountRegistrationConfirm.php
*/

	function getDBConnection() {
		$servername = "localhost:3306";
		$dbname = "Redrock_Cake";
		$dbusername = "root";
		$dbpassword = "Redrock123";
		
		// Create connection
		$conn = new mysqli ( $servername, $dbusername, $dbpassword, $dbname );
		// Check connection
		if ($conn->connect_error) {
			die ( "Connection failed: " . $conn->connect_error );
		} else {
			return $conn;
		}
	}
}
?>