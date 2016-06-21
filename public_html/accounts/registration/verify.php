<?php
	$pagetitle = "Red Rock > Sign up";
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');
	include_once $root . '/classes/DBUtils.php';
if(!empty($_GET['email']) && !empty($_GET['hash'])){
	// Verify data
	$email = $_GET['email']; // Set email variable
	$hash = $_GET['hash']; // Set hash variable
	}
	$dbutil = new DBUtils();
	$conn = $dbutil->getDBConnection();
	$searchString = "SELECT Email, Hash, Active FROM Accounts WHERE Email ='" .$email."' AND hash='".$hash."' AND active='0'";
	$search = $conn->query($searchString);
	$match  = mysqli_num_rows($search);

	if($match > 0){
		$updateString = "UPDATE Accounts SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'";
		$update = mysqli_query($conn,$updateString); 
		echo '<div class="statusmsg">Your account has been activated, you can now login!</div>';
		//echo "<script> document.ready(window.setTimeout(location.href = '" . $root . "/accounts/login.php',5000)); </script>";
		//echo "<script> window.location = '/accounts/login.php' </script>";
		echo '<a href="/accounts/login.php"/>Click here to login</a>';
	}else{
		echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
	}
?>
</body>
</html>
