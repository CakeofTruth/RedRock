<?php

// $servername = "198.71.225.56:3306";
// $dbusername = "redrock";
// $dbpassword = "@dm!nP@$$1001";
// $dbname = "RedRock";
echo "This is the login confirm page!<br>";

SignIn ();

function SignIn() {
	session_start (); 
	if (! empty ( $_POST ['username'] )) { 
		
		$selectString = generateSelectString ();
		
		$conn = getDBConnection();

		$result = $conn->query ( $selectString );
		if ($result->num_rows > 0) {
			// output data of each row
			$row = $result->fetch_assoc () ;
			echo "Welcome, " . $row ["First_Name"] . " " . $row ["Last_Name"];
 			echo "<script> window.location = 'CustomerOrderForm.html' </script>";
		} else {
			echo "Username and Password Combination not recognized, try again.";
		}
	} else {
		echo "How did you get here without a POST?";
	}
}

function getDBConnection() {
	$servername = "localhost";
	$dbusername = "root";
	$dbpassword = "potato";
	$dbname = "RedRock_Cake";
	
	// Create connection
	$conn = new mysqli ( $servername, $dbusername, $dbpassword, $dbname );
	// Check connection
	if ($conn->connect_error) {
		die ( "Connection failed: " . $conn->connect_error );
	} else {
		return $conn;
	}
}
function generateSelectString() {
	$sql = "SELECT Username, Password, First_Name, Last_Name FROM Accounts 
			where username = '" . $_POST ['username'] . "' and password = '" . $_POST ['password'] . "'";
	return $sql;
}

if (isset ( $_POST ['submit'] )) {
	SignIn ();
}
?>