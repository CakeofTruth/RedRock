<!DOCTYPE html>
<html>
<head>
<title>Customer Order Form</title>
<link rel='stylesheet' id='custom-css' href='/css/customerorderform.css'
	type='text/css' media='all' />

</head>
<body>
<?php
include ($_SERVER ["DOCUMENT_ROOT"] . '/portal/portalheader.php');
include_once $root . '/classes/DBUtils.php';
$resellerSelect = generateResellersSelectString ( $_SESSION ["Serv_Prov_CD"] );
$dbutils = new DBUtils ();
$conn = $dbutils->getDBConnection ();
$resellerResult = $conn->query ( $resellerSelect );
if ($resellerResult->num_rows > 0) {
	$resellerRow = $resellerResult->fetch_assoc ();
} else {
	echo "Reseller not found";
}
?>
		<!--<label for='uploaded_file'>Select A File To Upload:</label>
		input type="file" name="uploaded_file"-->
	<div id="order-form" class="clearfix">
		<h4>Customer Order Form</h4>
		<form action="/orders/PlaceOrder.php" method="post"
			enctype="multipart/form-data">
			<button type="button" class="accordion">Reseller Company Information</button>
				<div class="panel">
					<p><label for="name">Reseller Name:</label> <input type="text" name="resellername"
					value="<?php echo $resellerRow["Company_Name"];?>" readonly> </p>
					<p><label for="resellerba1">Reseller Billing Address 1:</label> <input type="text" name="resellerba1"
					value="<?php echo $resellerRow["Address1"];?>" readonly> </p> 
					<p><label for="resellerba2">Reseller Billing Address 2:</label> <input type="text" name="resellerba2"
					value="<?php echo $resellerRow["Address2"];?>" readonly></p> 
					<p><label for="city">City:</label> <input type="text" name="resellercity" value="<?php echo $resellerRow["City"];?>" readonly></p> 
					<p><label for="state">State:</label> <input type="text" name="resellerstate" value="<?php echo $resellerRow["State"];?>" readonly></p> 
					<p><label for="zipcode">Zip Code:</label> <input type="text" name="resellerzipcode" value="<?php echo $resellerRow["Zip"];?>" readonly></p>
					<p><label for="telephonenumber">Telephone Number:</label> <input type="text" name="resellertelephonenumber" 
					value="<?php echo $resellerRow["Phone"];?>" readonly></p> 
					<p><label for="emailaddress">Email Address:</label> <input type="email" name="emailaddress" 
					value="<?php echo $_SESSION["User_Email"];?>" readonly></p>
					<p><label for="accountnumber">Account Number: </label> <input type="text" name="accountnumber"
					value="<?php if(isset($_SESSION["Acct_No"])){echo $_SESSION["Acct_No"];}?>" readonly></p> 
					<p><label for="spcode">Service Provider Code: </label> <input type="text" name="spcode"
					value="<?php if(isset($resellerRow["Serv_Prov_CD"])){echo $resellerRow["Serv_Prov_CD"];}?>" readonly></p>
				</div>
			<button type="button" class="accordion">Contact Information:</button>
				<div class="panel">
					<p><label for="endusercn">End User Contact Name: <span class="required" style="color:red;">*</span></label> 
					<input type="text" name="endusercn" required></p>
					<p><label for="enduseremail">End User Contact Email: <span class="required" style="color:red;">*</span></label> 
					<input type="tel" name="enduseremail" required></p>
				
				</div>
			<button type="button" class="accordion">Customer Information:</button>
				<div class="panel">
					<p><label for="endusername">End User Customer Name: <span class="required" style="color:red;">*</span></label> 
					<input type="text" name="endusername" value="<?php if(isset($_POST["endusername"])){echo $_POST["endusername"];}?>" required> </p>
					<p><label for="address1">Billing Address 1: <span class="required" style="color:red;">*</span></label> 
					<input type="text" name="address1" value="<?php if(isset($_POST["address1"])){echo $_POST["address1"];}?>" required></p> 
					<p><label for="address2">Billing Address 2: </label> <input type="text" name="address2" 
					value="<?php if(isset($_POST["address2"])){echo $_POST["address2"];}?>"></p>
					<p><label for="city">City: <span class="required" style="color:red;">*</span></label> <input type="text" name="city"
					value="<?php if(isset($_POST["city"])){echo $_POST["city"];}?>" required></p>
					<p><label for="state">State: <span class="required" style="color:red;">*</span></label>
						<select name="state" required>
							<option value="Alabama">AL</option> <option value="Alaska">AK</option> <option value="Arizona">AZ</option> <option value="Arkansas">AR</option> <option value="California">CA</option> <option value="Colorado">CO</option> <option value="Connecticut">CT</option> <option value="Delaware">AL</option> <option value="District of Columbia">DC</option> <option value="Florida">FL</option> <option value="Georgia">GA</option> <option value="Hawaii">HI</option> <option value="Idaho">ID</option> <option value="Illinois">IL</option> <option value="Indiana">IN</option> <option value="Iowa">IA</option> <option value="Kansas">KS</option> <option value="Kentucky">KY</option> <option value="Louisiana">LA</option> <option value="Maine">ME</option> <option value="Maryland">MD</option> <option value="Massachusetts">MA</option> <option value="Michigan">MI</option> <option value="Minnesota">MN</option> <option value="Mississippi">MS</option> <option value="Missouri">MO</option> <option value="Montana">MT</option> <option value="Nebraska">NE</option> <option value="Nevada">NV</option> <option value="New Hampshire">NH</option> <option value="New Jersey">NJ</option> <option value="New Mexico">NM</option> <option value="New York">NY</option> <option value="North Carolina">NC</option> <option value="North Dakota">ND</option> <option value="Ohio">OH</option> <option value="Oklahoma">OK</option> <option value="Oregon">OR</option> <option value="Pennsylvania">PA</option> <option value="Rhode Island">RI</option> <option value="South Carolina">SC</option> <option value="South Dakota">SD</option> <option value="Tennessee">TN</option> <option value="Texas">TX</option> <option value="Utah">UT</option> <option value="Vermont">VT</option> <option value="Virginia">VA</option> <option value="Washington">WA</option> <option value="West Virginia">WV</option> <option value="Wisconsin">WI</option> <option value="Wyoming">WY</option>
						</select>
					</p> 
					<p><label for="zipcode">Zip Code: <span class="required" style="color:red;">*</span></label>
					<input type="text" name="zipcode" value="<?php if(isset($_POST["zipcode"])){echo $_POST["zipcode"];}?>" required></p> 
					<p><label for="cmtelephone">Billing Telephone Number: <span class="required" style="color:red;">*</span></label> 
					<input type="text" name="cmtelephone" value="<?php if(isset($_POST["cmtelephone"])){echo $_POST["cmtelephone"];}?>"></p>
					<p><label for="resellerrefid">Reseller Reference ID: </label> <input type="text" name="resellerrefid"
					value="<?php if(isset($_POST["resellerrefid"])){echo $_POST["resellerrefid"];}?>"></p>
					<p><label for="requestedbuilt">Requested Built/Service Provisioned Date: <span class="required" style="color:red;">*</span>
					</label> <input type="date" name="requestedbuilt" required></p> 
					<p><label for="requestedinservice">Requested In Service/Effective Billing Date: <span class="required" style="color:red;">*</span>
					</label> <input type="date" name="requestedinservice" required></p> 
					<p><label for="orsooner">Or Sooner:</label> Yes<input type="radio" name="orsooner" value="Yes" checked="checked" /> No<input
					type="radio" name="orsooner" value="No" /></p> 
					<p><label for="addtoexistingcustomer"> Add to Existing Customer:</label> Yes<input type="radio" name="addtoexistingcustomer" 
					value="Yes"> No<input type="radio" name="addtoexistingcustomer" value="No" checked="checked"></p> 
					<p><label for="customertimezone"> Customer Time Zone:</label> 
						<select name="customertimezone">
							<option value="Customer Time Zone">Customer Time Zone</option>
							<option value="Eastern Time Zone">Eastern Time Zone</option>
							<option value="Central Time Zone">Central Time Zone</option>
							<option value="Mountain Time Zone" selected>Mountain Time Zone</option>
							<option value="Arizona Time Zone">Arizona Time Zone</option>
							<option value="Pacific Time Zone">Pacific Time Zone</option>
							<option value="Alaska Time Zone">Alaska Time Zone</option>
							<option value="Hawaii-Aleutian Time Zone">Hawaii-Aleutian Time Zone</option>
						</select>
					</p>
					</div>
				<button type="button" class="accordion">Service/911 Address:</button>
					<div class="panel">
						<p><label for="emergprovisionrequired">Does this order require that 911 be provisioned per the data provided below?
						<span class="required" style="color:red;">*</span></label> Yes<input type="radio" name="emergprovisionrequired"
						value="Yes" checked="checked"> No<input type="radio" name="emergprovisionrequired" value="No"></p> 
						<p><label for="emergaddress1">Service/911 Address 1:</label> <input type="text" name="emergaddress1"
						value="<?php if(isset($_POST["emergaddress1"])){echo $_POST["emergaddress1"];}?>"></p>
						<p><label for="emergaddress2"> Service/911 Address 2:</label> <input type="text" name="emergaddress2"
						value="<?php if(isset($_POST["emergaddress2"])){echo $_POST["emergaddress2"];}?>"></p>
						<p><label for="emergcity">City:</label> <input type="text" name="emergcity" 
						value="<?php if(isset($_POST["emergcity"])){echo $_POST["emergcity"];}?>"></p>
						<p><label for="emergstate">State:</label> 
							<select name="emergstate">
								<option value=""></option><option value="Alabama">AL</option> <option value="Alaska">AK</option> <option value="Arizona">AZ</option> <option value="Arkansas">AR</option> <option value="California">CA</option> <option value="Colorado">CO</option> <option value="Connecticut">CT</option> <option value="Delaware">AL</option> <option value="District of Columbia">DC</option> <option value="Florida">FL</option> <option value="Georgia">GA</option> <option value="Hawaii">HI</option> <option value="Idaho">ID</option> <option value="Illinois">IL</option> <option value="Indiana">IN</option> <option value="Iowa">IA</option> <option value="Kansas">KS</option> <option value="Kentucky">KY</option> <option value="Louisiana">LA</option> <option value="Maine">ME</option> <option value="Maryland">MD</option> <option value="Massachusetts">MA</option> <option value="Michigan">MI</option> <option value="Minnesota">MN</option> <option value="Mississippi">MS</option> <option value="Missouri">MO</option> <option value="Montana">MT</option> <option value="Nebraska">NE</option> <option value="Nevada">NV</option> <option value="New Hampshire">NH</option> <option value="New Jersey">NJ</option> <option value="New Mexico">NM</option> <option value="New York">NY</option> <option value="North Carolina">NC</option> <option value="North Dakota">ND</option> <option value="Ohio">OH</option> <option value="Oklahoma">OK</option> <option value="Oregon">OR</option> <option value="Pennsylvania">PA</option> <option value="Rhode Island">RI</option> <option value="South Carolina">SC</option> <option value="South Dakota">SD</option> <option value="Tennessee">TN</option> <option value="Texas">TX</option> <option value="Utah">UT</option> <option value="Vermont">VT</option> <option value="Virginia">VA</option> <option value="Washington">WA</option> <option value="West Virginia">WV</option> <option value="Wisconsin">WI</option> <option value="Wyoming">WY</option>
							</select> 
						<p><label for="emergzipcode">Zip Code:</label> <input type="text" name="emergzipcode"
						value="<?php if(isset($_POST["emergzipcode"])){echo $_POST["emergzipcode"];}?>"></p>
						<p><label for="emergphonenumber"> 911 Phone Number:<span class="required" style="color:red;">*</span></label>
						<input type="text" name="emergphonenumber" value="<?php if(isset($_POST["emergphonenumber"]))
						{echo $_POST["emergphonenumber"];}?>"></p>
					</div>
				<button type="button" class="accordion">Order Details and Attachments:</button>
					<div class="panel">
						<label for="message">Order Details <span class="required" style="color:red;">*</span></label>
						<textarea id="contact-form" class="form textarea" value="<?php echo $_POST["orderdetails"]?>"
						rows="10" cols="100" id="orderdetails" name="orderdetails"
						placeholder="Your message must be greater than 20 characters" data-minlength="20" 
						></textarea>
					
						<p><label for= "uploads[]" style= "color: red;"><strong>Files must be less than 5 Mb.</strong></label>
						<span id="loading"></span> <input type="file" name="uploads[]" multiple="multiple" /> 
					</div>
				<input type="submit" name="submit" value="Next" id="submit-button"/><?php if(isset($attachmentError)){
                														echo '<span class="error">' . $attachmentError . '</span>';}?>
				<p id="req-field-desc"> <span class="required" style="color:red;">*</span> indicates a required field</p>
		</form>
	</div>
	<!-- End contact-form div -->
	<!-- Accordion opening source http://www.w3schools.com/howto/howto_js_accordion.asp -->
	<!-- Footer Section -->
	<div class="footer_wrapper" id="contact">
  <div class="container">
    <div class="service_wrapper">
      <div class="row">
        <div class="col-lg-4">
          <div class="service_block">
          <h3 class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp; color: #888888;">About Us</h3>
           <p class="animated fadeInDown wow animated" style="visibility:visible; animation:fadeInDown; color: #337ab7;"> Red Rock Telecommunications is a built from scratch Cloud solutions company delivering resilient communications networks with the latest generation Avaya and Metaswitch technology. </p>
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
<!-- Footer Section -->
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
    }
}
</script>
</body>
</html>
<?php
function generateResellersSelectString($reseller) {
	$sql = "SELECT `Serv_Prov_CD`, `Address1`, `Address2`, `City`, `State`, `Zip`, `Phone`, `Company_Name`, `Tier` FROM `Resellers`  
			WHERE SERV_PROV_CD = '" . $reseller . "'";		
	return $sql;
}
function generateAccountsSelectString ($Acct_No) {
	$sql = "Select Email ,First_Name, Last_Name, Acct_No FROM Accounts
			WHERE Acct_No = '" . $Acct_No . "'";
	return $sql;
}

?>
</body>