<?php
/**
 * Created by IntelliJ IDEA.
 * User: jbowd
 * Date: 8/23/16
 * Time: 8:42 PM
 */
include_once ($_SERVER ["DOCUMENT_ROOT"] . '/portal/portalheader.php');
include_once $root . '/classes/OrderUtils.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Order History</title>
<link rel='stylesheet' id='custom-css' href='/css/customerorderform.css'
	type='text/css' media='all' />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>
<body>
	<h1> Order History </h1>
		<div id="box">
		<table id="ItemOrderTable">
			<thead>
				<tr>
					<th> Order Number </th>
					<th> End User </th>
					<th> End User Address</th>
					<th> Requested Built Date</th>
					<th> Requested In Service Date</th>
				</tr>
				<?php
					
					$orderUtils = new OrderUtils();
					$fullname = $_SESSION["First_Name"] . " " . $_SESSION["Last_Name"];
					$orders = $orderUtils->getOrdersByUser($fullname);
					while($row  = $orders->fetch_array()){
						$orderNo = $row["Order_No"];
						$address = $orderUtils->generateAddressString($row["Address_1"], $row["Address_2"], $row["City"], $row["State"], $row["Zip"]);
						$rowhtml = '<tr>'
								. '<td><a href="/orders/orderDetails.php?orderNumber=' . $orderNo . '">' . $orderNo .  '</a></td>'
								. '<td>' . $row["End_User_Name"] . "</td>"
								. '<td>' . $address . "</td>"
								. '<td>' . $row["Request_Built"] . "</td>"
								. '<td>' . $row["Request_Service"] . "</td>"
								. '</tr>';
						echo $rowhtml;
					}
				?>
			</thead>
			<tbody>
		</table>
		</div>
	</body>
</html>


<?php
include $_SERVER ["DOCUMENT_ROOT"] . '/main/footer.php';
