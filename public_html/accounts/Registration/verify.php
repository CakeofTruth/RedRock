<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Red Rock > Sign up</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">
        <h3>Red Rock > Sign up</h3>
    </div>
<div id="wrap">
	<?php
	mysqli_connect("localhost:85", "root", "Redrock123") or die(mysqli_error());
	mysqli_select_db("accounts") or die(mysqli_error());
	?>
</div>
<?php 
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
	// Verify data
	$Email = mysql_escape_string($_GET['emailAddress']); // Set email variable
	$hash = mysql_escape_string($_GET['hash']); // Set hash variable
	}
	$search = mysql_query("SELECT emailAddress, hash, active FROM accounts WHERE emailAddress='"
			.$Email."' AND hash='".$hash."' AND active='0'") or die(mysql_error());
	$match  = mysqli_num_rows($search);
	echo $match;
	if($match > 0){
		mysql_query("UPDATE users SET active='1' WHERE emailAddress='".$Email."' 
				AND hash='".$hash."' AND active='0'") or die(mysql_error());
		echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
		}else{
			echo '<div class="statusmsg">The url is either invalid 
			or you already have activated your account.</div>';
		}else{
		}echo '<div class="statusmsg">Invalid approach,
				please use the link that has been send to your email.</div>';
}
?>
</body>
</html>
