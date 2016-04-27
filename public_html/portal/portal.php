<?php 
$pagetitle = "Portal";
include ($_SERVER ["DOCUMENT_ROOT"] . '/portal/portalheader.php');
?>
	<div class="slogan"></div>
		<h2>Welcome <?php echo $accountRow["First_Name"]; echo " " . $accountRow["Last_Name"]?></h2>
	<!--div class="content">Approver status: <?php $_SESSION["Approver"]?></div-->
	
<?php 
function generateAccountsSelectString ($Acct_No) {
	$sql = "Select Email ,First_Name, Last_Name, Acct_No FROM Accounts
			WHERE Acct_No = '" . $Acct_No . "'";
	return $sql;
}
?>
</body>
</html>