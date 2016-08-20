<?php 

include_once $root . '/classes/DBUtils.php';
class OrderUtils{
	function getResellerItems($spcode){
		$sql = "select USOC, Description, One_Time_Charge, Recurring_Price
		from Products P where Serv_Prov_CD =\"" . $spcode . "\"";
			
		$dbutils = new DBUtils();
		$conn = $dbutils->getDBConnection();
		return $conn->query ( $sql);
	}
}
?>