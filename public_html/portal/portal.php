<?php 
$pagetitle = "Portal";
include ($_SERVER ["DOCUMENT_ROOT"] . '/portal/portalheader.php');

?>
	<div class="slogan"></div>
		<h2>Welcome, <?php echo $_SESSION["First_Name"]; echo " " . $_SESSION["Last_Name"]?></h2>
		<h2> ResellerID: <?php echo $_SESSION["Serv_Prov_CD"];?></h2>
</body>
</html>