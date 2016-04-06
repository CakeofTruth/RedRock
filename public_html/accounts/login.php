<?php
	$pagetitle = "Login";
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');
	include_once $root . '/classes/DBUtils.php';
	include 'LoginForm.php';
	
	if (isset ( $msg )) {
		echo '<div class="statusmsg">' . $msg . '</div>';
	}
	//If both username and password are present
	if (!(empty($_POST['username']) || empty($_POST['password']))) { 
		AttemptSignIn ($_POST['username'],$_POST['password']);
	}

function AttemptSignIn($username,$password) {
	$username = test_input($username);	
	$password = test_input($password);	

	$selectString = generateSelectString ($username,$password);
		
	$dbutils = new DBUtils();
	$conn = $dbutils->getDBConnection();

	$result = $conn->query ( $selectString );
	echo $selectString;
	if ($result->num_rows > 0) {
		// output data of each row
		$row = $result->fetch_assoc () ;
		
		if($row["Active"] > 0){
			session_start (); 
			setSessionVariables($row);
	 		echo "<script> window.location = '" . $root . "/portal/portal.php' </script>";
		}
		else{
			echo "Account is inactive. Check your email!";
		}

	} else {
		echo "Username and Password Combination not recognized, please try again.";
	}
}



function generateSelectString($username,$password) {
	$sql = "SELECT Username, Password, First_Name, Last_Name, Approver, Active FROM Accounts 
			where username = '" . $username . "' and password = '" . $password . "' and Active='1'";
	return $sql;
}

function setSessionVariables($row){
	$_SESSION["username"] = $row["Username"];
	$_SESSION["First_Name"] = $row["First_Name"];
	$_SESSION["Last_Name"] = $row["Last_Name"];
	$_SESSION["Approver"] = $row["Approver"];
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
