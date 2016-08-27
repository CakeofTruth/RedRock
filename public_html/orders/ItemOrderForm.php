<?php 
	session_start();
		
		$_SESSION['resellername'] = $_POST['resellername'];
		$_SESSION['resellerba1'] = $_POST['resellerba1'];
		$_SESSION['resellerba2'] = $_POST['resellerba2'];
		$_SESSION['resellercity'] = $_POST['resellercity'];
		$_SESSION['resellerstate'] = $_POST['resellerstate'];
		$_SESSION['resellerzipcode'] = $_POST['resellerzipcode'];
		$_SESSION['resellertelephonenumber'] = $_POST['resellertelephonenumber'];
		$_SESSION['emailaddress'] = $_POST['emailaddress'];
		$_SESSION['accountnumber'] = $_POST['accountnumber'];
		$_SESSION['spcode'] = $_POST['spcode'];
		$_SESSION['resellercn'] = $_POST['resellercn'];
		$_SESSION['contactTelephone'] = $_POST['contactTelephone'];
		$_SESSION['endusername'] = $_POST['endusername'];
		$_SESSION['address1'] = $_POST['address1'];
		$_SESSION['address2'] = $_POST['address2'];
		$_SESSION['city'] = $_POST['city'];
		$_SESSION['state'] = $_POST['state'];
		$_SESSION['zipcode'] = $_POST['zipcode'];
		$_SESSION['cmtelephone'] = $_POST['cmtelephone'];
		$_SESSION['resellerrefid'] = $_POST['resellerrefid'];
		$_SESSION['requestedbuilt'] = $_POST['requestedbuilt'];
		$_SESSION['requestedinservice'] = $_POST['requestedinservice'];
		$_SESSION['orsooner'] = $_POST['orsooner'];
		$_SESSION['addtoexistingcustomer'] = $_POST['addtoexistingcustomer'];
		$_SESSION['emergprovisionrequired'] = $_POST['emergprovisionrequired'];
		$_SESSION['emergaddress1'] = $_POST['emergaddress1'];
		$_SESSION['emergaddress2'] = $_POST['emergaddress2'];
		$_SESSION['emergcity'] = $_POST['emergcity'];
		$_SESSION['emergstate'] = $_POST['emergstate'];
		$_SESSION['emergzipcode'] = $_POST['emergzipcode'];
		$_SESSION['emergphonenumber'] = $_POST['emergphonenumber'];
		$_SESSION['orderdetails'] = $_POST['orderdetails'];
		$_SESSION['uploads[]'] = $_POST['uploads[]'];
		//$_SESSION['attachmentDir'] = $_POST['attachmentDir'];
//http://www.html-form-guide.com/php-form/php-order-form.html source for session variables	
		
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');
	if ( empty ( $_POST )) {
		echo  "<script> window.location = 'PlaceOrder.php' </script>";
	}
		
	include_once $root . '/classes/DBUtils.php';
	include_once $root . '/classes/OrderUtils.php';


	//Generate the attachmentString and Attachemnt Directory String 
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
	<link rel='stylesheet' id='custom-css' href='/css/customerorderform.css'
	type='text/css' media='all' />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<!-- <style>
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
	</style> -->
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
	<?php /*
			<input type="hidden" name="endusername" value="<?php echo $_POST["endusername"]; ?>">
            <input type="hidden" name="orderdetails" value="<?php echo $_POST ["orderdetails"]; ?>">
            <input type="hidden" name="spcode" value="<?php echo $_POST ["spcode"] ; ?>">
            <input type="hidden" name="resellercn" value="<?php echo $_POST ["resellercn"] ; ?>">
            <input type="hidden" name="resellerrefid" value="<?php echo $_POST ["resellerrefid"] ; ?>">
            <input type="hidden" name="requestedbuilt" value="<?php echo $_POST ["requestedbuilt"] ; ?>">
            <input type="hidden" name="requestedinservice" value="<?php echo $_POST ["requestedinservice"] ; ?>">
            <input type="hidden" name="orsooner" value="<?php echo $_POST ["orsooner"] ; ?>">
			<input type="hidden" name="addtoexistingcustomer" value="<?php echo $_POST ["addtoexistingcustomer"] ; ?>">
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
			<input type="hidden" name="attachments" value="<?php echo $_POST["attachments"] ?>">
			<input type="hidden" name="attachmentDir" value="<?php echo $_POST["attachmentDir"]; ?>">
	*/ 	?>	
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