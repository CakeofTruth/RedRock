<?php 
	include ($_SERVER ["DOCUMENT_ROOT"] . '/portal/portalheader.php');
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
		<form action="/orders/PortedNumbers.php" method="post">
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
<!-- Footer Section -->
<div class="footer_wrapper" id="contact">
  <div class="container">
    <div class="service_wrapper">
      <div class="row">
        <div class="col-lg-4">
          <div class="service_block">
          <h3 class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp; color: #888888;">About Us</h3>
           <p class="animated fadeInDown wow animated" style="visibility:visible; animation:fadeInDown; color: #8b0000"> Red Rock Telecommunications is a built from scratch Cloud solutions company delivering resilient communications networks with the latest generation Avaya and Metaswitch technology. </p>
          </div>
        </div>
        <div class="col-lg-4 borderLeft">
          <div class="service_block">
            <h3 class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp; color: #888888;">Navigation</h3>
            <p class="animated fadeInDown wow animated" style="visibility:visible; animation:fadeInDown;"></p>
            <ul id="menu-widget-footer" class="menu" style="list-style: none; padding-left: 0;">

                                <li class="menu-item menu-item-type-post_type">
                                    <a href="/main/whycloud.php">Why the Cloud?</a>
                                </li>

                                <li class="menu-item menu-item-type-post_type">
                                    <a href="/main/mobileintegration.php">Mobile Integration</a>
                                </li>

                                <li class="menu-item menu-item-type-post_type">
                                    <a href="/main/contactcenter.php">Contact Center</a>
                                </li>

                                
                                <li class="menu-item menu-item-type-custom">
                                    <a href="/main/contactus.php">Get in Touch</a>
                                </li>

                                <li class="menu-item menu-item-type-custom">
                                    <a href="/accounts/login.php">Resources</a>
                                </li>
                            </ul>
            </div>
            </div>
            <div class="col-lg-4 borderLeft">
          <div class="service_block">
            <h3 class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp; color: #888888;">Contact Us</h3>
            <p class="animated fadeInDown wow animated" style="visibility:visible; animation:fadeInDown;">
            <a href="https://www.google.com/maps/place/3719+E+La+Salle+St,+Phoenix,+AZ+85040/@33.3965694,-112.0023446,17z/data=
            !4m5!3m4!1s0x872b0fa0817dfa69:0x9e48d73f5106c6fa!8m2!3d33.3965649!4d-112.0001559!6m1!1e1">Address: 3719 E La Salle St. Phoenix, AZ, 85040</a></p>
            <p><a href="tel:6028028400">Front Desk: (602)802-8400 </a></p>
            <p><a href="tel:6028028450">Customer Service: (602)802-8450</a></p>
            <p><a href="mailto:redrock@redrocktelecom.com?Subject=More%20Information" target="_top">
												Email: redrock@redrocktelecom.com</a></p>
            </div>
            </div>
      </div>
	   </div>
      <div class="footer_bottom"><span>Copyright 2016, Template by <a href="http://webthemez.com">WebThemez.com</a>. </span> </div>
  </div>
</div>
		<script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/jquery-scrolltofixed.js"></script>
        <script type="text/javascript" src="/js/jquery.nav.js"></script>
        <script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="/js/jquery.isotope.js"></script>
        <script type="text/javascript" src="/js/wow.js"></script>
        <script type="text/javascript" src="/js/custom.js"></script>
<!--        <script src="/contact/jqBootstrapValidation.js"></script>-->
<!--        <script src="/contact/contact_me.js"></script>-->
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
		$_SESSION['endusercn'] = test_input($_POST['endusercn']);
		$_SESSION['enduseremail'] = test_input($_POST['enduseremail']);
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