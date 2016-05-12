<?php 

include_once $root . '/classes/DBUtils.php';
class OrderUtils{
	function getResellerItems($spcode){
		$sql = "select RP.USOC as USOC, P.Description as Description, P.One_Time_Charge as One_Time_Charge, P.Recurring_Price as Recurring_Price
		from Products P join ResellerProducts RP on P.USOC = RP.USOC
		where RP.Reseller =\"" . $spcode . "\"";
			
		$dbutils = new DBUtils();
		$conn = $dbutils->getDBConnection();
		return $conn->query ( $sql);
	}
}
?>