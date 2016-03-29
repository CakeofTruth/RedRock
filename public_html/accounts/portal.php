<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Welcome $</title>
<link rel="stylesheet" href="portal.css">
<link rel="icon"
	type="image/png"
	href="assets\images\Redrockfavicon.png">
</head>
<body>
<?php
$servername = "localhost:3306";
$dbusername = "root";
$dbpassword = "Redrock123";
$dbname = "redrock";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
else{
		echo 'Connection successful <br>';
}
?>
<div id="menu">
<ul>
<li><a href="portal.php"><font color="#21B6A8">Home</font></a></li>
<li><a href="orderform.html"><font color="#21B6A8">Place an Order</font></a></li>
</ul>
</div>
<button id="myBtn"><?php $firstName $lastName ?></button>
<div id= "Account_Info" class="modal">
<div class="modal-content">
	<div class="modal-header">
	<span class="close">x</span>
	<h2>Account Information</h2>
	</div>
	<div class="modal-body">
	<p><?php $firstname $lastName ?><p>
	<p><?php $username ?><p>
	<p><a href="change_password.php">Change Your Password</a></p>
</div>
</div>
<script>
	var modal = document.getElementById('Account_Info');
	var btn = document.getElementByID("myBtn");
	var span = document.getElementsByClassName("close")[0];
	btn.onclick = function() {
		modal.style.display = "block";
	}
	span.onclick = function() {
		modal.style.display = "block";
	}
	span.onclick = function () {
		modal.style.display = "none";
	}
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
</script>
</div>
<div class="content">
<?php
$result = mysqli("SELECT * FROM accounts WHERE email= '$email' and password ='$password' LIMIT 1");
if(mysqli_num_rows($result) >0){
		$row = mysqli_fetch_array($result, MYSQL_ASSOC); //wtf is mysql_assoc and do i actually need it here
		$firstName = $row["First_Name"];
		$lastName = $row["Last_Name"];
		echo"Welcome";
		echo $firstname; echo $lastname;
}else{
		echo 'wrong password/username combo';
}
?>
</div>
</body>
</html>
