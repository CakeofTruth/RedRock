<?php 
	$pagetitle = "Contact Us";
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');
?>
<body>
	<h1>Red Rock Telecommunications</h1>
	<a href="index.html"> <img id="logo" src="<?php $root ?>/assets/images/Redrocklogo.jpg" alt="logo"/></a>
	<?php include 'menu.php' ?>
	<div class= "description"><h2>Contact Us</h2> </div>
	<div class="content">
		<p> Address: 3719 E La Salle St. <br>
					 Phoenix, AZ, 85040 <br>
			Front Desk: (602)-802-8400 <br>
			Customer Service: (602)-802-8450
		 </p>
	</div>
<?php include $root . '/main/footer.php'?>