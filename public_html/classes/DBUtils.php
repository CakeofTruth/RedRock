<?php
class DBUtils {

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