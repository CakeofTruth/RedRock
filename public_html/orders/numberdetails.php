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
include ($_SERVER ["DOCUMENT_ROOT"] . '/portal/portalheader.php');
include_once $root . '/classes/DBUtils.php';

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
			<div class ="buttonHolder">
			<input type="submit" value="Submit" id="submit-button">
</form>
</div>

<script>
var intTextBox = 0;
	function addElement() {
		intTextBox++;
		var objNewDiv = document.createElement('div');
		objNewDiv.setAttribute('id', 'div_' + intTextBox);
		objNewDiv.innerHTML = 'Phone Number ' + intTextBox + ': <input type= "text" id="tb_' + intTextBox + '" name="portednumber_' + intTextBox + '" />'
		+ '911?: <input type = "checkbox" id="911_' + intTextBox + '" name="portnumber911_' + intTextBox + '" />' + 'BTN?: <input type = "checkbox" id="BTN_' + intTextBox + '" name="btnumber_' + intTextBox + '" />' ;
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
