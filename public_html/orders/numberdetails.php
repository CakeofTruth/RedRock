<!DOCTYPE html>
<html>
<head>
<title>Input number details</title>
<link rel='stylesheet' id='custom-css' href='/css/customerorderform.css'
	type='text/css' media='all' />

</head>
<body>
<?php
include ($_SERVER ["DOCUMENT_ROOT"] . '/portal/portalheader.php');
include_once $root . '/classes/DBUtils.php';
$OrderItemsSelect = generateOrderItemsSelectString ( $_SESSION ["OrderItem"] );
$dbutils = new DBUtils ();
$conn = $dbutils->getDBConnection ();

$OrderItemsResult = $conn->query ( $OrderItemsSelect );
$numbers = $orderUtils->getOrderItems($_POST["Order_No"]);
if ($result->num_rows == 0) {
	echo "didn't find any product information";
}



if ($OrderItemsResult->num_rows > 0) {
	$resellerRow = $resellerResult->fetch_assoc ();
} else {
	echo "Reseller not found";
}


?>
<label for="porting">Will you be porting any numbers?<span class="required" style="color:red;">*</span>
			</label> Yes<input type="radio" name="porting"
				value="Yes" checked="checked"> No<input type="radio"
				name="porting" value="No">
<label for= "btn"> Which number is the BTN? <span class="required" style="color:red;">*</span></label>
<label for="newnumbers">Do you need any new numbers?<span class="required" style="color:red;">*</span>
			</label> Yes<input type="radio" name="newnumbers"
				value="Yes" checked="checked"> No<input type="radio"
				name="newnumbers" value="No">

<label for= "emergphonenumber">Which number will be your 911 number?<span class="required" style="color:red;">*</span></label>
<script>
	function generate () {
		var a = parseInt(document.getElementById("numberdetail").value);
		var numbers = document.getElementById("ch");

		for (i=0; i < a; i++) {
			var input = document.createElement("input");
			numbers.appendChild(input);
		}
	}
</script>
</head>
<body>
	<h2>Please enter all lines to be ported</h2>
		<form>
			Line <input type="text" id="numberdetail" />
			<input type="button" value="set" onclick="generate()" />
			<div id= "numbers"></div>
		</form>
	<h2>Which number(s) would you like to be used for 911?</h2>
		<select></select>
</body>
</html>
