<?php
	$root = $_SERVER["DOCUMENT_ROOT"];
	$pagetitle = "About Us";
	include 'header.php';
?>
<!DOCTYPE html>
<html>
<body>
	<h1>Red Rock Telecommunications</h1>
	<a href="index.html"> <img id="logo" src="<?php $root ?>/assets/images/Redrocklogo.jpg" alt="logo"/></a>
	<?php include 'menu.php' ?>
	<div class="description"><h2>About Us</h2></div>
	<div class="content">
		<p> Red Rock Telecommunications is the first company in the world to combine the power of Metaswitch with the voice 
		 and video features of Avaya.  This allows us to be the sole provider of an all IP based communication solution. Red 
		 Rock delivers reliable high quality hosted PBX, SIP Trunking, voice to text capabilities, mobile device integration,
		 and much more. </p>
	</div>	
	<div id="resources" style="text-align: center;">
		<a href="login.php"><span style= "color: black; position: fixed; bottom: 0pt;">Resources</span></a>
	</div>
</body>
</html>



