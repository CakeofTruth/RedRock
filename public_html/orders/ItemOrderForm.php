<?php 
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');
	if ( empty ( $_POST )) {
		echo  "<script> window.location = 'PlaceOrder.php' </script>";
	}
		
	include_once $root . '/classes/DBUtils.php';
	include_once $root . '/classes/OrderUtils.php';
	//Generate the attachmentString and Attachment Directory String 
	$orderUtils = new OrderUtils();
	$result = $orderUtils->getResellerItems($_POST["spcode"]);
	if ($result->num_rows == 0) {
		echo "didn't find any product information";
	}
	$attachmentID = uniqid();
	mkdir($_SERVER["DOCUMENT_ROOT"] . '/tmp/orderData/' . $attachmentID, 0777);
	$uploaddir = $_SERVER["DOCUMENT_ROOT"] . '/tmp/orderData/' . $attachmentID . '/';
    //echo "uploaded to: " . $uploaddir;
	$attachmentString = generateAttachmentString($uploaddir);
	
	setOrderSessionVariables($attachmentString, $attachmentID);
		
?>
<!DOCTYPE html>
<html>
	<head>
	<title> Red Rock Ordering System </title>
	<link rel='stylesheet' id='custom-css' href='/css/customerorderform.css'
	type='text/css' media='all' />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<style>
	h1 {
		text-align: center;
	}
		table {
		margin: 0 auto;
		table-layout: fixed;
	}
	
		#box {
		border: 6px solid #800000;
		padding: 5px;
		background-color:#FBDED6;
		width: 75%;
		margin: 0 auto;
		}
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
		background-color:#FBDED6;
		margin: 25px auto;
		table-layout: fixed;
		text-align: center;
	}
	table {
		width: 90%;
	}
	#submit-button {
    	width: 100px;
    	background-color:#333;
    	color:#FFF;
    	border:none;
    	margin-top: 25px;
    	margin-bottom:25px;
    	margin-right:25px;
    	background-color:#9F000F;
    	-moz-border-radius:8px;
	}
 
	#submit-button:hover {
    	background-color: #A6CFDD;
	}
 
	#submit-button:active {
	    position:relative;
	    top:1px;
	}
	.buttonHolder{
		text-align: center;
	}
	input[type="number"] {
		position:relative;
		width: 25%;
	}
	</style>
	</head>
	<body>
	<h1> Item Ordering </h1>
		<div id="box">
		<form action="/orders/numberdetails.php" method="post">	
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
			<div class ="buttonHolder">
			<input type="submit" value="Next" id="submit-button">
			</div>
		</form>
		</div>
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
		document.getElementById("totalMonthly").outerHTML = '<td><input id="totalMonthly" name="totalMonthly" value"' + formatInDollars(totalMonthly) + '" readonly/></td>';
		document.getElementById("totalNonRecurring").outerHTML = '<td><input id="totalNonRecurring" name="totalNonRecurring" value"' + formatInDollars(totalNonRecurring) + '" readonly/></td>';
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
	
</script>

<?php
	function generateAttachmentString($uploaddir){
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
		return $attachmentsString;
	}

	function setOrderSessionVariables($attachmentString, $attachmentDir){
		$_SESSION['resellername'] = test_input($_POST['resellername']);
		$_SESSION['resellerba1'] = test_input($_POST['resellerba1']);
		$_SESSION['resellerba2'] = test_input($_POST['resellerba2']);
		$_SESSION['resellercity'] = test_input($_POST['resellercity']);
		$_SESSION['resellerstate'] = test_input($_POST['resellerstate']);
		$_SESSION['resellerzipcode'] = test_input($_POST['resellerzipcode']);
		$_SESSION['resellertelephonenumber'] = test_input($_POST['resellertelephonenumber']);
		$_SESSION['emailaddress'] = test_input($_POST['emailaddress']);
		$_SESSION['accountnumber'] = test_input($_POST['accountnumber']);
		$_SESSION['spcode'] = test_input($_POST['spcode']);
		$_SESSION['resellercn'] = test_input($_POST['resellercn']);
		$_SESSION['contactTelephone'] = test_input($_POST['contactTelephone']);
		$_SESSION['endusername'] = test_input($_POST['endusername']);
		$_SESSION['address1'] = test_input($_POST['address1']);
		$_SESSION['address2'] = test_input($_POST['address2']);
		$_SESSION['city'] = test_input($_POST['city']);
		$_SESSION['state'] = test_input($_POST['state']);
		$_SESSION['zipcode'] = test_input($_POST['zipcode']);
		$_SESSION['cmtelephone'] = test_input($_POST['cmtelephone']);
		$_SESSION['resellerrefid'] = test_input($_POST['resellerrefid']);
		$_SESSION['requestedbuilt'] = test_input($_POST['requestedbuilt']);
		$_SESSION['requestedinservice'] = test_input($_POST['requestedinservice']);
		$_SESSION['orsooner'] = test_input($_POST['orsooner']);
		$_SESSION['addtoexistingcustomer'] = test_input($_POST['addtoexistingcustomer']);
		$_SESSION['customertimezone'] = test_input($_POST['customertimezone']);
		$_SESSION['emergprovisionrequired'] = test_input($_POST['emergprovisionrequired']);
		$_SESSION['emergaddress1'] = test_input($_POST['emergaddress1']);
		$_SESSION['emergaddress2'] = test_input($_POST['emergaddress2']);
		$_SESSION['emergcity'] = test_input($_POST['emergcity']);
		$_SESSION['emergstate'] = test_input($_POST['emergstate']);
		$_SESSION['emergzipcode'] = test_input($_POST['emergzipcode']);
		$_SESSION['emergphonenumber'] = test_input($_POST['emergphonenumber']);
		$_SESSION['orderdetails'] = test_input($_POST['orderdetails']);
		$_SESSION['attachmentString'] = $attachmentString;
		$_SESSION['attachmentDir'] = $attachmentDir;
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
?>