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
/*$OrderItemsSelect = generateOrderItemsSelectString ( $_SESSION ["OrderItem"] );
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
*/
?>
<div id="order-form" class="clearfix">
<form>
<div>
<div>
<label for="porting">Will you be porting any numbers?<span class="required" style="color:red;">*</span>
			</label> Yes<input type="radio" name="porting" id="yes"
				value="2"> No<input type="radio"
				name="porting" id="porting-no" value="1">
				<br>
				<div class="yesport">
    			<a href="javascript:void(0);" onclick="addElement();">Add</a>
    			<a href="javascript:void(0);" onclick="removeElement();">Remove</a>
				<div id="content"></div>
</div>
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
</label> Yes<input type="radio" name="virtualnumbers" id="virtualnumbers-yes"
				value="2"> No<input type="radio"
				name="virtualnumbers" id="virtualnumbers-no" value="1">
				<br>
				<div class="yesvtn">
<label for="vtnquantity"> How many numbers will you need?</label> <input
				type="text" name="vtnquantity"
				value="">
				</div>
				</div>
</form>
</div>

<script>
var intTextBox = 0;
	function addElement() {
		intTextBox++;
		var objNewDiv = document.createElement('div');
		objNewDiv.setAttribute('id', 'div_' + intTextBox);
		objNewDiv.innerHTML = 'Phone Number ' + intTextBox + ': <input type= "text" id="tb_' + intTextBox + '" name="tb_' + intTextBox + '" />'
		+ '911?: <input type = "checkbox" id="911_' + intTextBox + '" name="911_' + intTextBox + '" />' + 'BTN?: <input type = "checkbox" id="BTN_' + intTextBox + '" name="BTN_' + intTextBox + '" />' ;
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
	/*function toggle_visibility('reveal-if-active') {
		var e = document.getElementById('reveal-if-active');
		if(e.style.display == 'block')
			e.style.display = 'none';
		else
			e.style.display = 'block';
	}
	onclick=toggle_visibility('yes');
	*/
	//http://stackoverflow.com/questions/16308779/how-can-i-hide-show-a-div-when-a-button-is-clicked source for above snippet
	/*
	$(document).ready(function() {
		$('input[type="radio"]').click(function() {
			if(($this).attr('id') == 'yes') {
				$('#reveal-if-active').show();
		}
		else {
			$('#reveal-if-active').hide();
		}
		});
	});
	*/
	/* $(document).ready(function() {
		$("#hide").click(function() {
			$("p").hide();
		});
	});
	var FormStuff = {
			  
			  init: function() {
			    this.applyConditionalRequired();
			    this.bindUIActions();
			  },
			  
			  bindUIActions: function() {
			    $("input[type='radio'], input[type='checkbox']").on("change", this.applyConditionalRequired);
			  },
			  
			  applyConditionalRequired: function() {
			    
			    $(".require-if-active").each(function() {
			      var el = $(this);
			      if ($(el.data("require-pair")).is(":checked")) {
			        el.prop("required", true);
			      } else {
			        el.prop("required", false);
			      }
			    });
			    
			  }
			  
			};

			FormStuff.init();
			*/
</script>
</body>
</html>
