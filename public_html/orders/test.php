<?php 
	include ($_SERVER ["DOCUMENT_ROOT"] . '/portal/portalheader.php');
	include_once $root . '/classes/OrderUtils.php';
	
	$orderUtils = new OrderUtils();
	$result = $orderUtils->getResellerItems($_SESSION['spcode']);
	while($row  = $result->fetch_array()){
			
		$itemName = $row["USOC"];
		$_SESSION[$itemName] = $_POST[$itemName];
	}
		
	$_SESSION['totalMonthly'] = $_POST['totalMonthly'];
	$_SESSION['totalNonRecurring'] = $_POST['totalNonRecurring'];
	
//source for array session variables http://stackoverflow.com/questions/10337782/how-to-create-variables-and-assign-them-values-within-a-for-each-loop-in-php


?>
<html>
<head>
<title>Input Number Details</title>
<link rel='stylesheet' id='custom-css' href='/css/customerorderform.css'
	type='text/css' media='all' />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("#noport").click(function(){
		$("#div1").hide();
	});
	$("#yesport").click(function(){
		$("#div1").show();
	});
});
$(document).ready(function(){
	$("#nonew").click(function(){
		$("#div2").hide();
	});
	$("#yesnew").click(function(){
		$("#div2").show();
	});
});
$(document).ready(function(){
	$("#vtno").click(function(){
		$("#div3").hide();
	});
	$("#vtyes").click(function(){
		$("#div3").show();
	});
});
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
</script>
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
			</label>
		<input type="radio" name="porting" id="yesport" value="Yes"/> Yes
		<input type="radio" name="porting" id="noport" value="No" checked="checked"/> No
		<div id="div1" style="display:none" >
		<a href="javascript:void(0);" onclick="addElement();">Add</a>
    	<a href="javascript:void(0);" onclick="removeElement();">Remove</a>
				<div id="content"></div>
		</div>
<label for="newnumbers">Do you need any new numbers? </label> 
			Yes<input type="radio" name="newnumbers" id="yesnew" value="Yes"/> 
			No<input type="radio" name="newnumbers" id="nonew" value="No" checked="checked"/>
				<div id="div2" style="display:none">
				<label for="newnumberquantity"> How many new numbers will you need?</label> 
					<input type="text" name="newnumberquantity" value="">
				<label for="newnumberac">What area code do you need?</label>
		 			<input type="text" name="newnumberac" value="">					
				<label for= "emergnewnumber">Do you want one of the new numbers to be 911 provisioned?</label>Yes
					<input type= "radio" name="emergnewnumber" id="yes-911new" value="yes">No<input type= "radio"
					name="emergnewnumber" id="no-911new" value="no">
				</div>
<label for="virtualnumbers">Will you need any virtual numbers </label> 
			Yes<input type="radio" name="virtualnumbers" id="vtyes" value="Yes"> 
			No<input type="radio" name="virtualnumbers" id="vtno" value="No">
				<div id="div3" style="display:none">
				<label for="vtnquantity"> How many numbers will you need?</label> 
				<input type="text" name="vtnquantity" value="">
				</div>
				<div class ="buttonHolder">
				<input type="submit" value="Submit" id="submit-button">
				</div>
			</form>
			</div>
</body>
</html>