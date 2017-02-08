<?php 
	include ($_SERVER ["DOCUMENT_ROOT"] . '/portal/portalheader.php');
	include_once $root . '/classes/OrderUtils.php';

    //Grab all the submitted items from the previous form (ItemOrderForm.php) and add them to the session variables.
	$orderUtils = new OrderUtils();
	$result = $orderUtils->getResellerItems($_SESSION['spcode']);
	while($row  = $result->fetch_array()){
			
		$itemName = $row["USOC"];
		$_SESSION[$itemName] = $_POST[$itemName];
	}
		
	$_SESSION['totalMonthly'] = $_POST['totalMonthly'];
	$_SESSION['totalNonRecurring'] = $_POST['totalNonRecurring'];
	
?>
<html>
<head>
<title>Input Number Details</title>
<link rel='stylesheet' id='custom-css' href='/css/customerorderform.css'
	type='text/css' media='all' />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<style>
*, *:before, *:after
{
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
}

html, body
{
    width: 100%;
    height: 100%;
    
    margin: 0;
    padding: 0;
}

body
{
    font-size: 14px;
    /* Helvetica/Arial-based sans serif stack */
    font-family: Frutiger, "Frutiger Linotype", Univers, Calibri, "Gill Sans", "Gill Sans MT", "Myriad Pro", Myriad, "DejaVu Sans Condensed", "Liberation Sans", "Nimbus Sans L", Tahoma, Geneva, "Helvetica Neue", Helvetica, Arial, sans-serif;

}

.flexbox-parent
{
    width: 100%;
    height: 100%;

    display: flex;
    flex-direction: column;
    
    justify-content: flex-start; /* align items in Main Axis */
    align-items: stretch; /* align items in Cross Axis */
    align-content: stretch; /* Extra space in Cross Axis */
}

.flexbox-item
{
    padding: 8px;
}
.flexbox-item-grow
{
    flex: 1; /* same as flex: 1 1 auto; */
}
.fill-area
{
    
    display: flex;
    flex-direction: row;
    
    justify-content: flex-start; /* align items in Main Axis */
    align-items: stretch; /* align items in Cross Axis */
    align-content: stretch; /* Extra space in Cross Axis */
    
}
.fill-area-content
{
    padding-top: 0%;
    padding-bottom: 10%;
    /* Needed for when the area gets squished too far and there is content that can't be displayed */
    overflow: auto; 
}
</style>
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
<div class="flexbox-parent">
<div class="flexbox-item fill-area content flexbox-item-grow">
        <div class="fill-area-content flexbox-item-grow">
<div id="order-form" class="clearfix">
<form action="/orders/OrderConfirm.php" method="post">
<p>
<label for="porting">Will you be porting any numbers?</label>
		<input type="radio" name="porting" id="yesport" value="Yes"/> Yes
		<input type="radio" name="porting" id="noport" value="No" checked="checked"/> No
		<div id="div1" style="display:none" >
		<a href="javascript:void(0);" onclick="addElement();">Add</a>
    	<a href="javascript:void(0);" onclick="removeElement();">Remove</a>
				<div id="content"></div>
		</div>
</p>


				<div id="div2">
				<p><label for="newnumberquantity"> How many new numbers will you need?</label> 
					<input type="text" name="newnumberquantity" value=""></p>
				<p><label for="newnumberac">What area code do you need?</label>
		 			<input type="text" name="newnumberac" value="">					
				<p><label for= "emergnewnumber">Do you want one of the new numbers to be 911 provisioned?</label><br>
					Yes<input type= "radio" name="emergnewnumber" id="yes-911new" value="yes">No<input type= "radio"
					name="emergnewnumber" id="no-911new" value="no"></p>
				</div>
				<div id="div3" >
				<p><label for="vtnquantity"> How many virtual numbers will you need?</label>
				<input type="text" name="vtnquantity" value=""></p>
				</div>
				<div class ="buttonHolder">
				<input type="submit" value="Submit" id="submit-button">
				</div>
			</form>
			</div>
	</div>
	</div>
<!-- footer section -->
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
<!-- Footer Section -->	
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
	+ '911?: <input type = "checkbox" id="portnumber911_' + intTextBox + '" name="portnumber911_' + intTextBox + '"value="yes" />' + 'BTN?: <input type = "checkbox" id="btnumber_' + intTextBox + '" name="btnumber_' + intTextBox + '" value="yes"/>' ;
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
</div>
</body>
</html>