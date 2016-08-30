<?php 
	session_start();
	include ($_SERVER ["DOCUMENT_ROOT"] . '/portal/portalheader.php');
	include_once $root . '/classes/OrderUtils.php';
	
	$orderUtils = new OrderUtils();
	$result = $orderUtils->getResellerItems($_SESSION['spcode']);
	while($row  = $result->fetch_array()){
			
		$itemName = $row["USOC"];
		echo '<input type="hidden" name="' . $itemName . '" value="' . $_POST[$itemName] . '">';
	}
	
		
	$_SESSION['totalMonthly'] = $_POST['totalMonthly'];
	$_SESSION['totalNonRecurring'] = $_POST['totalNonRecurring'];
	$_SESSION['reselleritems'] = $result;
	
//source for array session variables http://stackoverflow.com/questions/10337782/how-to-create-variables-and-assign-them-values-within-a-for-each-loop-in-php


?>
<!DOCTYPE html>
<html>
<head>
<title>Input number details</title>
<link rel='stylesheet' id='custom-css' href='/css/customerorderform.css'
	type='text/css' media='all' />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>
<body>
<?php
$orderUtils = new OrderUtils();
if ( empty ( $_POST )) {
	echo  "<script> window.location = 'PlaceOrder.php' </script>";
}
include_once $root . '/classes/DBUtils.php';
include_once $root . '/classes/OrderUtils.php';

?>
<div id="order-form" class="clearfix">
<form action="/orders/OrderConfirm.php" method="post">

<label for="porting">Will you be porting any numbers?<span class="required" style="color:red;">*</span>
			</label> Yes<input type="radio" name="porting" id="yes"
				value="2"> No<input type="radio"
				name="porting" id="porting-no" value="No">
				<br>
				<div class="yesport">
    			<a href="javascript:void(0);" onclick="addElement();">Add</a>
    			<a href="javascript:void(0);" onclick="removeElement();">Remove</a>
				<div id="content"></div>

</div>
<label for="newnumbers">Do you need any new numbers?<span class="required" style="color:red;">*</span>
			</label> Yes<input type="radio" name="newnumbers" id="yes"
				value="2"> No<input type="radio"
				name="newnumbers" id="no" value="1">
				<div class="yesnew">
<label for="newnumberquantity"> How many new numbers will you need?</label> <input
				type="text" name="newnumberquantity"
				value="">
<label for="newnumberac">What area code do you need?</label>
		 <input type="text" name="newnumberac" value="">					
<label for= "emergnewnumber">Do you want one of the new numbers to be 911 provisioned?<span class="required" 
style="color:red;">*</span></label>Yes<input type= "radio" name="emergnewnumber" id="yes-911new" value="yes">No<input type= "radio"
name="emergnewnumber" id="no-911new" value="no">
</div>	
<br>
<label for="virtualnumbers">Will you need any virtual numbers<span class="required" style="color:red;">*</span>
</label> Yes<input type="radio" name="virtualnumbers" id="VirtualNumbers-yes"
				value="2"> No<input type="radio"
				name="virtualnumbers" id="VirtualNumbers-no" value="1">
				<br>
				<div class="yesvtn">
<label for="vtnquantity"> How many numbers will you need?</label> <input
				type="text" name="vtnquantity"
				value="">
				</div>
<?php 
/*
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
			<?php
				//Add the Reseller Items to the Post
	*/?>
			<div class ="buttonHolder">
				<input type="hidden" name="totalMonthly" value="<?php echo $_POST["totalMonthly"]; ?>">
				<input type="hidden" name="totalNonRecurring" value="<?php echo $_POST["totalNonRecurring"]; ?>">
			<input type="submit" value="Submit" id="submit-button">
			</div>
</form>
</div>

<script>
var intTextBox = 0;
	function addElement() {
		intTextBox++;
		var objNewDiv = document.createElement('div');
		objNewDiv.setAttribute('id', 'div_' + intTextBox);
		objNewDiv.innerHTML = 'Phone Number ' + intTextBox + ': <input type= "text" id="tb_' + intTextBox + '" name="portednumber_' + intTextBox + '" />'
		+ '911?: <input type = "checkbox" id="portnumber911_' + intTextBox + '" name="portnumber911_' + intTextBox + '" />' + 'BTN?: <input type = "checkbox" id="btnumber_' + intTextBox + '" name="btnumber_' + intTextBox + '" />' ;
		document.getElementById('content').appendChild(objNewDiv);
	};
	function removeElement() {
	    if(0 < intTextBox) {
	        document.getElementById('content').removeChild(document.getElementById('div_' + intTextBox));
	        intTextBox--;
	    } else {
	        alert("No phone number to remove");
	    };
	};
	$('input[name="porting"]').on('change', function() {
		$('.yesport')
			.toggle(+this.value === 2 && this.checked);
	}).change();
	$('input[name="newnumbers"]').on('change', function() {
		$('.yesnew')
			.toggle(+this.value === 2 && this.checked);
	}).change();
	$('input[name="virtualnumbers"]').on('change', function() {
		$('.yesvtn')
			.toggle(+this.value === 2 && this.checked);
	}).change();
	//http://stackoverflow.com/questions/27546071/how-to-toggle-div-visibility-using-radio-buttons source for above snippet.

</script>
</body>
</html>
