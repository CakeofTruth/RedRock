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

	<body>
	<h4> Order History </h4>
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
						$address = $orderUtils->generateAddressString($row["Address_1"], $row["Address_2"], $row["City"], $row["State"], $row["Zip"]);
						$rowhtml = '<tr>'
								. '<td>' . $row["Order_No"] . "</td>"
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
