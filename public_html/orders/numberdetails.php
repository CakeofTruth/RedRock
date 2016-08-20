<!DOCTYPE html>
<html>
<head>
<title>Input number details</title>
<link rel='stylesheet' id='custom-css' href='/css/customerorderform.css'
	type='text/css' media='all' />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
			</label> Yes<input type="radio" name="porting" id="porting-yes"
				value="Yes"> No<input type="radio"
				name="porting" id="porting-no" value="No">
				<br>
				<div class="reveal-if-active">
    			<a href="javascript:void(0);" onclick="addElement();">Add</a>
    			<a href="javascript:void(0);" onclick="removeElement();">Remove</a>
				<div id="content"></div>
					
<label for= "btn"> Which number is the BTN? <span class="required" style="color:red;">*</span></label>
<br>
</div>
</div>
<label for="newnumbers">Do you need any new numbers?<span class="required" style="color:red;">*</span>
			</label> Yes<input type="radio" name="newnumbers" id="newnumbers-yes"
				value="Yes"> No<input type="radio"
				name="newnumbers" id="newnumbers-no" value="No">
				<div class="reveal-if-active">
<label for="newnumberquantity"> How many new numbers will you need?</label> <input
				type="text" name="newnumberquantity"
				value="">
<label for="newnumberac">What area code do you need?</label>
		 <input type="text" name="newnumberac" value="">				
			</div>	
<label for= "emergphonenumber">Which number will be your 911 number?<span class="required" style="color:red;">*</span></label>
<br>
<label for="virtualnumbers">Will you need any virtual numbers<span class="required" style="color:red;">*</span>
</label> Yes<input type="radio" name="virtualnumbers" id="virtualnumbers-yes"
				value="Yes"> No<input type="radio"
				name="virtualnumbers" id="virtualnumbers-no" value="No">
				<br>
				<div class="reveal-if-active">
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
		objNewDiv.innerHTML = 'Phone Number ' + intTextBox + ': <input type= "text" id="tb_' + intTextBox + '" name="tb_' + intTextBox + '" />';
		document.getElementById('content').appendChild(objNewDiv);
	}
	function removeElement() {
	    if(0 < intTextBox) {
	        document.getElementById('content').removeChild(document.getElementById('div_' + intTextBox));
	        intTextBox--;
	    } else {
	        alert("No phone number to remove");
	    }
	}
	$(document).ready(function() {
		$("#hide").click(function() {
			$("p").hide();
		});
	});
	function generate () {
		var a = parseInt(document.getElementById("numberdetail").value);
		var numbers = document.getElementById("ch");

		for (i=0; i < a; i++) {
			var input = document.createElement("input");
			numbers.appendChild(input);
		}
	}
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
</script>
</body>
</html>
