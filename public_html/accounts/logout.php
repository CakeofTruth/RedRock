<?php

	$_SESSION["loggedin"] = 0;
	session_start();
	session_destroy();
	include($_SERVER ["DOCUMENT_ROOT"] . "/main/header.php");
	echo "<script> window.location = '/' </script>";

?>
