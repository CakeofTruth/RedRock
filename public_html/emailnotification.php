<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">


<head>
	
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	
<title>Editable Invoice</title>

</head>
<?php
$root = $_SERVER ["DOCUMENT_ROOT"];
include_once $root . '/classes/DBUtils.php';
include_once $root . '/classes/OrderUtils.php';

if (empty ( $_POST )) {
	echo "Something went wrong with the order.";
}
$orderUtils = new OrderUtils();

$dbutils = new DBUtils();
$conn = $dbutils->getDBConnection ();

$resellerResult = $conn->query ( $resellerSelect );

if ($resellerResult->num_rows > 0) {
	$resellerRow = $resellerResult->fetch_assoc () ;
}
else{
	echo "Reseller not found";
}

$companyName = "HCON";
$orderNumber = "72";
$resellerba1 = "123 Maple St.";
$resellercity = "Phoenix";
$resellerstate = "AZ";
$resellerzip = "85040";
$orderNumber = "123456";
$totalNonRecurring = "$500.00";
$totalMonthly = "$250.00";
$USOC= "WAVY";
$endusername= "LeClaire Estate";
$address1 = "25203 N. Ranch Gate Rd.";
$city = "Scottsdale";
$state = "AZ";
$zipcode = "85255";
$cmtelephone = "(480) 502-0078";
$customertimezone= "Arizona Time Zone";
$requestedbuilt = "7/6/2016";
$requestedinservice = "7/7/2016";
$addtoexistingcustomer= "No";
$emergprovisionrequired= "Yes";
$emergaddress1 = "25203 N. Ranch Gate Rd.";
$emergcity = "Scottsdale";
$emergstate = "AZ";
$emergzipcode = "85255";
$orderdetails = "This is a test message to see if my invoice looks as super badass as I am currently imagining in my head.  My guess is yes.  Woot Woot!"
?>

<body style="font: 14px/1.4 Georgia, serif;">

	
	<div id="page-wrap" style="width: 800px; margin: 0 auto;">

		
		<div id="header" style="text-align: center"><h1>Red Rock Telecommunications Invoice</h1></div>
		
		
			<div id="identity">
		
            
				<div id="address" style="border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none;">
				Red Rock Telecommunications <br> 3719 E La Salle St. <br> Phoenix, AZ, 85040 <br> Phone: (602)-802-8450</div>

            
					<div id="logo" style="text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; max-height: 100px; overflow: hidden;">

              
						<div id="logoctr" style="display: none; display: block; text-align: right; line-height: 25px; background: #eee; padding: 0 5px;"></div>

              <div id="logohelp" style="text-align: left; display: none; font-style: italic; padding: 10px 5px;">
                <input id="imageloc" type="text" size="50" value="" /><br />
              </div>
              <img id="image" src="/assets/images/redrocklogo.png" alt="Red Rock" />
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">

            <div id="customer-title" style="font-size: 20px; font-weight: bold; float: left;"><?php echo nl2br("$companyName \n  $resellerba1 \n $resellercity $resellerstate, $resellerzip");?> </div>

            <table id="meta" style="margin-top: 1px; width: 300px; float: right;">
                <tr>
                    <td class="meta-head" style="text-align: left; background: #eee;">Invoice #</td>
                    <td><div id="orderno"><?php echo $orderNumber ?></div></td>
                </tr>
                <tr>

                    <td class="meta-head" style="text-align: left; background: #eee;">Date</td>
                    <td><div id="date"><?php echo date("m/d/y");?></div></td>
                </tr>
                <tr>
                    <td class="meta-head" style="text-align: left; background: #eee;">Amount Due</td>
                    <td><div class="due"><?php echo $totalNonRecurring ?></div></td>
                </tr>

            </table>
		
		</div>
		
		<table id="items" style="clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black;">
		
		  <tr>
		      <th style="background: #eee;" >USOC</th>
		      <th style="background: #eee;">Description</th>
		      <th style="background: #eee;">Quantity</th>
		      <th style="background: #eee;">Monthly Recurring Cost</th>
		      <th style="background: #eee;">One Time Cost</th>
		  </tr>
		  
		  <tr class="item-row">
		      <td class="item-name"><div class="delete-wpr" style="width: 80px; height: 50px;"><?php echo $USOC ?></div></td>
		      <td class="description"><div style="width: 300px; width: 100%; height: 50px;">Monthly web updates for http://widgetcorp.com (Nov. 1 - Nov. 30, 2009)</div></td>
		      <td><div class="cost" style="width: 80px; height: 50px;">$650.00</div></td>
		      <td><div class="qty" style="width: 80px; height: 50px;">1</div></td>
		      <td><span class="price" style="width: 80px; height: 50px;">$650.00</span></td>
		  </tr>
		  
		  <tr class="item-row">
		      <td class="item-name" style="border: 0; vertical-align: top; "><div class="delete-wpr" style="position: relative;">SSL Renewals</div></td>
		      <td class="description" style="width: 300px; width: 100%;">Yearly renewals of SSL certificates on main domain and several subdomains</td>
		      <td><div class="cost">$75.00</div></td>
		      <td><div class="qty">3</div></td>
		      <td><span class="price">$225.00</span></td>
		  </tr>
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line" style="border-right: 0; text-align: right;">Monthly Recurring Charge:</td>
		      <td class="total-value" style="border-left: 0; padding: 10px;"><div id="subtotal" style="height: 20px; background: none;" ><?php echo $totalMonthly ?></div></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line" style="border-right: 0; text-align: right;">Non-Recurring Charge:</td>
		      <td class="total-value" style="border-left: 0; padding: 10px;"><div id="total" style="height: 20px; background: none;"><?php echo $totalNonRecurring ?></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank" style="border: 0;"> </td>
		      <td colspan="2" class="total-line balance" style="background: #eee;">Balance Due</td>
		      <td class="total-value balance" style="background: #eee;"><div class="due"><?php echo $totalNonRecurring ?></div></td>
		  </tr>
		
		</table>
		<h3>Customer Information:</h3>
		<table id= "customer" style="clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black;">
			<tr class="customer-row">
				<td class="customer-name"><div class="delete-wpr" style="width: 100%; height: 50px;">Name: <?php echo $endusername ?></div></td>
			</tr>
			<tr class = "customer-row">
				<td class="customer-address"><div class="delete-wpr" style="width: 100%; height: 50px;">Address: <?php echo ("$address1  $city  $state , $zipcode");?></div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-btn"><div class="delete-wpr" style="width: 100%; height: 50px;">Billing Telephone Number: <?php echo $cmtelephone ?></div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-time-zone"><div class="delete-wpr" style="width: 100%; height: 50px;">Customer Time Zone: <?php echo $customertimezone ?></div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-requested-built"><div class="delete-wpr" style="width: 100%; height: 50px;">Requested Built/Service Provisioned Date: <?php echo $requestedbuilt ?></div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-requested-service"><div class="delete-wpr" style="width: 100%; height: 50px;">Requested In Service/ Effective Billing Date: <?php echo $requestedinservice ?></div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-existing"><div class="delete-wpr" style="width: 100%; height: 50px;">Add To Existing Customer: <?php echo $addtoexistingcustomer ?></div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-emergprovisionrequired"><div class="delete-wpr" style="width: 100%; height: 50px;">Does this order require that 911 be provisioned per the data provided below?: 
				<?php echo $emergprovisionrequired ?></div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-emergaddress"><div class="delete-wpr" style="width: 100%; height: 50px;">Service/911 Address: <?php echo ("$emergaddress1  $emergcity  $emergstate , $emergzipcode") ?></div></td>
			</tr>
		</table>
		<h3>Order Details:</h3>
			<table id= "orderdetails" style="clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black;">
				<tr class= "order-row">
					<td class="order-details"><div class="delete-wpr" style="width: 100%; height: 50px;">Name: <?php echo $orderdetails ?></div></td>
				</tr>
			</table>
		<div id="terms">
		  <h5>Terms</h5>
		  <p>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</p>
		</div>
	
	</div>
	
</body>
</html>