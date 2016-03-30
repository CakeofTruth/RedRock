<?php

$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root . '/classes/DBUtils.php';

SignIn ();

function SignIn() {
	session_start (); 
	if (! empty ( $_POST ['username'] )) { 
		
		$selectString = generateSelectString ();
		
		$dbutils = new DBUtils();
		$conn = $dbutils->getDBConnection();

		$result = $conn->query ( $selectString );
		if ($result->num_rows > 0) {
			// output data of each row
			$row = $result->fetch_assoc () ;
			setSessionVariables($row);
			//echo "Hi, " . $_SESSION["First_Name"]  . " " . $_SESSION["Last_Name"];
 			echo "<script> window.location = 'portal.php' </script>";
		} else {
			echo "Username and Password Combination not recognized, please try again.";
		}
	} else {
		echo "How did you get here without a POST?";
	}
}



function generateSelectString() {
	$sql = "SELECT Username, Password, First_Name, Last_Name, Approver FROM Accounts 
			where username = '" . $_POST ['username'] . "' and password = '" . $_POST ['password'] . "'";
	return $sql;
}

function setSessionVariables($row){
	$_SESSION["username"] = $row["Username"];
	$_SESSION["First_Name"] = $row["First_Name"];
	$_SESSION["Last_Name"] = $row["Last_Name"];
	$_SESSION["Approver"] = $row["Approver"];
}

?>
<?php 
		mysqli_connect("localhost:85", "RedRock", "Redrock123") or die(mysqli_error());
		mysqli_select_db("accounts") or die(mysqli_error());
		if(isset($_POST['username']) && !empty($_POST['username']) AND isset($_POST['password']) && !empty($_POST['password'])){
		$username = mysqli_escape_string($_POST['username']);
		$password = mysqli_escape_string(md5($_POST['password']));
		
		$search = mysqli_query("SELECT username, password, active FROM accounts WHERE username='".$username."' AND password='".$password."' AND active='1'")
		or die(mysqli_error());
		$match = mysqli_num_rows ($search);
			if($match > 0){
				$msg = 'Login Complete! Thank you!';
			}else{
				$msg = 'Login Failed! Please make sure that you entered the correct details and that you have activated your account';
			}
		}
		
	?>
