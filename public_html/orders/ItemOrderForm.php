<?php 
	
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');
	if ( empty ( $_POST )) {
		echo  "<script> window.location = 'PlaceOrder.php' </script>";
	}
		
	include_once $root . '/classes/DBUtils.php';
	include_once $root . '/classes/OrderUtils.php';
	$orderUtils = new OrderUtils();
	$result = $orderUtils->getResellerItems($_POST["spcode"]);
	if ($result->num_rows == 0) {
		echo "didn't find any product information";
	}
	$attachmentID = uniqid();
	mkdir($_SERVER["DOCUMENT_ROOT"] . '/tmp/orderData/' . $attachmentID, 0777);
	$uploaddir = $_SERVER["DOCUMENT_ROOT"] . '/tmp/orderData/' . $attachmentID . '/';
    //echo "uploaded to: " . $uploaddir;
	$attachmentsString = "";
	for($i=0;$i<count($_FILES['uploads']['name']);$i++){
		$tmplocation = $_FILES['uploads']['tmp_name'][$i];	
		$destination = $uploaddir . $_FILES['uploads']['name'][$i];	
		//echo "destination: " . $destination . "<br>";
		if(move_uploaded_file($tmplocation ,$destination)){
			if(empty($attachmentsString)){
				$attachmentsString .= basename($destination);
			}
			else{
				$attachmentsString .= "," . basename($destination);
			}
		}
	}
	//echo $attachmentsString;
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
	<h4> Red Rock Ordering System </h4>
		<img src= "\assets\images\Redrocklogo.jpg" style= "float:left;"/>
		<form action="/orders/OrderConfirm.php" method="post">	
		<table id="ItemOrderTable">
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
						$USOCdescription= $row["USOC"] . "description";
						$rowhtml = '<tr>'
							. '<td> <input type="number" min="0" name="' . $row["USOC"] . '" id="' . $row["USOC"] . '" onchange="updateAmount(this)" > </td>'
							. '<td>' . $row["USOC"] . "</td>" 
							. '<td name="'. $USOCdescription . '">' . $row["Description"] . "</td>"
							. '<td>' . $row["Recurring_Price"] . "</td>"
							. '<td>' . $row["One_Time_Charge"] . "</td>" 
							. '</tr>';
						echo $rowhtml;
					}
				?>
			<tr>
				<td></td>
				<td></td>
				<td>Total Cost:</td>
				<td id="totalMonthly" name="totalMonthly"></td>
				<td id="totalNonRecurring" name="totalNonRecurring"></td>
			</tr>
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
			<input type="hidden" name="accountnumber" value="<?php echo $_POST["accountnumber"]; ?>">
			<input type="hidden" name="spcode" value="<?php echo $_POST["spcode"]; ?>">
			<input type="hidden" name="endusername" value="<?php echo $_POST["endusername"]; ?>">
			<input type="hidden" name="address1" value="<?php echo $_POST["address1"]; ?>">
			<input type="hidden" name="address2" value="<?php echo $_POST["address2"]; ?>">
			<input type="hidden" name="cmtelephone" value="<?php echo $_POST["cmtelephone"]; ?>">
			<input type="hidden" name="resellerrefid" value="<?php echo $_POST["resellerrefid"]; ?>">
			<input type="hidden" name="requestedbuilt" value="<?php echo $_POST["requestedbuilt"]; ?>">
			<input type="hidden" name="requestedinservice" value="<?php echo $_POST["requestedinservice"]; ?>">
			<input type="hidden" name="orsooner" value="<?php $_POST["orsooner"]; ?>">
			<input type="hidden" name="addtoexistingcustomer" value="<?php $_POST["addtoexistingcustomer"]; ?>">
			<input type="hidden" name="customertimezone" value="<?php echo $_POST["customertimezone"]; ?>">
			<input type="hidden" name="emergprovisionrequired" value="<?php echo $_POST["emergprovisionrequired"]; ?>">
			<input type="hidden" name="emergaddress1" value="<?php echo $_POST["emergaddress1"]; ?>">
			<input type="hidden" name="emergaddress2" value="<?php echo $_POST["emergaddress2"]; ?>">
			<input type="hidden" name="emergcity" value="<?php echo $_POST["emergcity"]; ?>">
			<input type="hidden" name="emergstate" value="<?php echo $_POST["emergstate"]; ?>">
			<input type="hidden" name="emergzipcode" value="<?php echo $_POST["emergzipcode"]; ?>">
			<input type="hidden" name="emergphonenumber" value="<?php echo $_POST["emergphonenumber"]; ?>">
			<input type="hidden" name="orderdetails" value="<?php echo $_POST["orderdetails"]; ?>">
			<input type="hidden" name="attachments" value="<?php echo $attachmentsString; ?>">
			<input type="hidden" name="attachmentDir" value="<?php echo $attachmentID; ?>">
			<input type="submit" value="Submit">
		</form>
	</body>
</html>


<script>
	function updateAmount(object){
		var name = object.id;
		var value = object.value;
		var amount = document.getElementById(name).value = value;
		//document.getElementById(name).value = value;
		updateCost();
	}
	function updateCost(){
		var table = document.getElementById("ItemOrderTable");
		var rowCount = table.rows.length;
		var totalMonthly = 0;
		var totalNonRecurring = 0;
		var cellLength = table.rows[0].cells.length;
		for (var r = 1; r < rowCount; r++) {
			var usoc = table.rows[r].cells[1].innerHTML;
			if(document.getElementById(usoc) != null){
				var amount = document.getElementById(usoc).value; 
				var monthly = parseItemCostString(table.rows[r].cells[cellLength-2].innerHTML);
				var nonRecurring = parseItemCostString(table.rows[r].cells[cellLength-1].innerHTML);
				//console.log(usoc + ": " + monthly + ", " + nonRecurring);
				totalMonthly = totalMonthly + (amount*monthly);
				totalNonRecurring = totalNonRecurring + (amount*nonRecurring);
			}	
		}
		document.getElementById("totalMonthly").outerHTML = '<td><input id="totalMonthly" name="totalMonthly" value"' + formatInDollars(totalMonthly) + '"/></td>';
		document.getElementById("totalNonRecurring").outerHTML = '<td><input id="totalNonRecurring" name="totalNonRecurring" value"' + formatInDollars(totalNonRecurring) + '"/></td>';
		document.getElementById("totalMonthly").value = formatInDollars(totalMonthly);
		document.getElementById("totalNonRecurring").value = formatInDollars(totalNonRecurring);
	}
	function formatInDollars(amount){
		var str = "$" + amount.toFixed(2);
		return str;
	}
	function parseItemCostString(str){
		if(str === "Included"){
			return 0;
		}
		return str.match(/\d+\.\d+/) // "3"
	}
	function test_input($data) {
		if(empty($data)){
			return "";
		}
		$data = trim ( $data );
		$data = stripslashes ( $data );
		$data = htmlspecialchars ( $data );
		$data = addslashes( $data );
	
		return $data;
	}
</script>