
<!-- Header Section -->
<?php
	$root = $_SERVER ["DOCUMENT_ROOT"];

	$pagetitle = "Login";
	$root = $_SERVER ["DOCUMENT_ROOT"];
	if(empty($_SESSION['exists'])){
		//Handle new sessions here
		$_SESSION["loggedin"] = 0;
		$_SESSION['exists'] = true;
	}
	include_once $root . '/classes/DBUtils.php';
	if($_SESSION["loggedin"]){
	 		echo "<script> window.location = '/portal/portal.php' </script>";
	}
	else{
		if (!(empty($_POST['username']) || empty($_POST['password']))) { 
			AttemptSignIn ($_POST['username'],$_POST['password']);
		}
		include 'LoginForm.php';
	}
	
	//If both username and password are present

function AttemptSignIn($username,$password) {
	$username = test_input($username);	
	$password = test_input($password);	

	$selectString = generateSelectString ($username,$password);
		
	$dbutils = new DBUtils();
	$conn = $dbutils->getDBConnection();

	$result = $conn->query ( $selectString );
	if ($result->num_rows > 0) {
		// output data of each row
		$row = $result->fetch_assoc () ;
		
		if($row["Active"] > 0){
			setSessionVariables($row);
	 		echo "<script> window.location = '/portal/portal.php' </script>";
		}
		else{
			echo "Account is inactive. Check your email!";
		}

	} else {
		echo "Username and Password Combination not recognized, please try again.";
	}
}



function generateSelectString($username,$password) {
	$sql = "SELECT Username, Password, First_Name, Last_Name, Approver, Serv_Prov_CD, Active, Email, Acct_No FROM Accounts 
			where username = '" . $username . "' and password = '" . $password . "' and Active='1'";
	return $sql;
}

function setSessionVariables($row){
	$_SESSION["Username"] = $row["Username"];
	$_SESSION["First_Name"] = $row["First_Name"];
	$_SESSION["Last_Name"] = $row["Last_Name"];
	$_SESSION["Approver"] = $row["Approver"];
	$_SESSION["Serv_Prov_CD"] = $row["Serv_Prov_CD"];
	$_SESSION["User_Email"] = $row["Email"];
	$_SESSION["Acct_No"] = $row["Acct_No"];
	$_SESSION["loggedin"] = true;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
/* Footer */
?>

