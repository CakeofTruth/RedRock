<?php
	$pagetitle = "Red Rock > Sign up";
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');
	include_once $root . '/classes/DBUtils.php';
if(!empty($_GET['email']) && !empty($_GET['hash'])){
	// Verify data
	$email = $_GET['email']; // Set email variable
	$hash = $_GET['hash']; // Set hash variable
	echo 'Email: ' . $email . '<br>';
	echo 'hash: ' . $hash;
	}
	$dbutil = new DBUtils();
	$conn = $dbutil->getDBConnection();
	$searchString = "SELECT Email, Hash, Active FROM accounts WHERE Email ='" .$email."' AND hash='".$hash."' AND active='0'";
	$search = mysqli_query($conn,$searchString);
	$match  = mysqli_num_rows($search);

	echo "Match value: " . $match . '<br>';
	if($match > 0){
		$updateString = "UPDATE Accounts SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'";
		echo $updateString . '<br>';
		$update = mysqli_query($conn,$updateString); 
		echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
	}else{
		echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
	}
?>
</body>
</html>
