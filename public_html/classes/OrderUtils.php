<?php 

include_once $root . '/classes/DBUtils.php';
class OrderUtils{

	/**
	 * This method returns the Items correlated to each Reseller, for use in the Item Order Form and Order Insert 
	 * 
	 * @param $spcode
	 * @return bool|mysqli_result
	 */
	function getResellerItems($spcode){
		$sql = "select USOC, Description, One_Time_Charge, Recurring_Price
		from Products P where Serv_Prov_CD =\"" . $spcode . "\"";
			
		$dbutils = new DBUtils();
		$conn = $dbutils->getDBConnection();
		return $conn->query ( $sql);
	}

	/**
	 * This function returns the top level order details used by the Order History Page.
	 * 
	 * @param $user
	 * @return bool|mysqli_result
	 */
	function getOrdersByUser($user){
		$sql = "SELECT o.Order_No, c.End_User_Name, c.Address_1, c.Address_2, c.City, c.State, c.Zip, o.Request_Built, o.Request_Service 
				FROM `Orders` o join Customers c on o.Customer_ID = c.Customer_ID 
				where Res_Cont_Name = '" . $user . "'";

		$dbutils = new DBUtils();
		$conn = $dbutils->getDBConnection();
		return $conn->query ($sql);
			
	}

	/**
	 * Attempts to return a user friendly address Stamp. 
	 * 
	 * @param $address1
	 * @param $address2
	 * @param $city
	 * @param $state
	 * @param $zip
	 * @return string
	 */
	function generateAddressString($address1,$address2,$city,$state,$zip){
		$string = $address1 . "<br>"
				. $address2 . "<br>"
				. $city . "," . $state . "," . $zip;
		return $string;
	}
}
?>