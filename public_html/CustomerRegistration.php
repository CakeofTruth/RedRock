<?php
$usernameERR = "";
$username = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["username"])) {
		$usernameErr = "Name is required";
		} else {
		  $username = test_input ($_POST["username"]);
		  if (!preg_match("/^[a-zA-Z0-9 ]*$/",$username)) {
			$usernameErr = "Only letters and numbers allowed";
			}
		}
	if (empty($_POST["password"])) {
     $password = "";
   } else {
     $password = test_input($_POST["password"]);
   }
	}
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
echo $username;
echo "<br>";
echo $password;
echo "<br>";
?>