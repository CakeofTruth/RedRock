<?php 
	
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');

	if ( empty ( $_POST )) {
		echo  "<script> window.location = 'PlaceOrder.php' </script>";
	}
		
	include_once $root . '/classes/DBUtils.php';

	$result = getResellerItems($_POST["spcode"]);

	if ($result->num_rows == 0) {
		echo "didn't find any product information";
	}

?>
<!DOCTYPE html>
<html>
	<head>
	<title> Red Rock Ordering System </title>
	<style>
	h1 {
		font-size: 50px; 
		number-align: center;
	}
	table {
		margin: 0 auto;
	}
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}
	table {
		width: 70%;
	}
	th {
    height: 20px;
	}
	tr:hover {
	background-color: #ff8080
	}
	tr:nth-child(even) {
	background-color: #B3C6FF
	}
	</style>
	</head>
	<body>
	<h1> Red Rock Ordering System </h1>
		<img src= " C:\Users\Rae\Pictures\RedRockLogo.jpg" style= "float:left;"/>
		<form action="OrderConfirm.php" method="post">	
		<table>
			<thead>
				<tr>
					<th> Amount </th>
					<th> USOC </th>
					<th> Description </th>
					<th> MRC </th>
					<th> NRC </th>
				</tr>
			</thead>
			<tbody>
				<?php 
					while($row  = $result->fetch_array()){

						$rowhtml = '<tr>'
							. '<td> <input type="number" name="' . $row["USOC"] . '"> </td>'
							. '<td>' . $row["USOC"] . "</td>" 
							. '<td>' . $row["Description"] . "</td>"
							. '<td>' . $row["One_Time_Charge"] . "</td>" 
							. '<td>' . $row["Recurring_Price"] . "</td>"
							. '</tr>';
						echo $rowhtml;
					}
				

				?>
			</table>
			<input type="hidden" name="resellername" value="<?php echo $_POST["resellername"]; ?>">
			<input type="hidden" name="resellerba1" value="<?php echo $_POST["resellerba1"]; ?>">
			<input type="hidden" name="resellerba2" value="<?php echo $_POST["resellerba2"]; ?>">
			<input type="hidden" name="city" value="<?php echo $_POST["city"]; ?>">
			<input type="hidden" name="state" value="<?php echo $_POST["state"]; ?>">
			<input type="hidden" name="zipcode" value="<?php echo $_POST["zipcode"]; ?>">
			<input type="hidden" name="telephonenumber" value="<?php echo $_POST["telephonenumber"]; ?>">
			<input type="hidden" name="emailaddress" value="<?php echo $_POST["emailaddress"]; ?>">
			<input type="hidden" name="resellercn" value="<?php echo $_POST["resellercn"]; ?>">
			<input type="hidden" name="salesrep" value="<?php echo $_POST["salesrep"]; ?>">
			<input type="hidden" name="accountnumber" value="<?php echo $_POST["accountnumber"]; ?>">
			<input type="hidden" name="spcode" value="<?php echo $_POST["spcode"]; ?>">
			<input type="hidden" name="endusername" value="<?php echo $_POST["endusername"]; ?>">
			<input type="hidden" name="cmtelephone" value="<?php echo $_POST["cmtelephone"]; ?>">
			<input type="hidden" name="resellerrefid" value="<?php echo $_POST["resellerrefid"]; ?>">
			<input type="hidden" name="requestedbuilt" value="<?php echo $_POST["requestedbuilt"]; ?>">
			<input type="hidden" name="requestedinservice" value="<?php echo $_POST["requestedinservice"]; ?>">
			<input type="hidden" name="orsooner" value="<?php echo $_POST["orsooner"]; ?>">
			<input type="hidden" name="addtoexistingcustomer" value="<?php echo $_POST["addtoexistingcustomer"]; ?>">
			<input type="hidden" name="customertimezone" value="<?php echo $_POST["customertimezone"]; ?>">
			<input type="hidden" name="emergprovisionrequired" value="<?php echo $_POST["emergprovisionrequired"]; ?>">
			<input type="hidden" name="emergaddress1" value="<?php echo $_POST["emergaddress1"]; ?>">
			<input type="hidden" name="emergaddress2" value="<?php echo $_POST["emergaddress2"]; ?>">
			<input type="hidden" name="emergcity" value="<?php echo $_POST["emergcity"]; ?>">
			<input type="hidden" name="emergstate" value="<?php echo $_POST["emergstate"]; ?>">
			<input type="hidden" name="emergzipcode" value="<?php echo $_POST["emergzipcode"]; ?>">
			<input type="hidden" name="emergphonenumber" value="<?php echo $_POST["emergphonenumber"]; ?>">
			<input type="hidden" name="orderdetails" value="<?php echo $_POST["orderdetails"]; ?>">
			<input type="submit" value="Submit">
		</form>
	</body>
</html>


<?php 
	function getResellerItems($spcode){
		$sql = "select RP.USOC as USOC, P.Description as Description, P.One_Time_Charge as One_Time_Charge, P.Recurring_Price as Recurring_Price
		from Products P join ResellerProducts RP on P.USOC = RP.USOC
		where RP.Reseller =\"" . $spcode . "\"";
			
		$dbutils = new DBUtils();
		$conn = $dbutils->getDBConnection();
		return $conn->query ( $sql);
	}
?>