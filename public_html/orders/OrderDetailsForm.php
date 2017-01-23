<?php
/*
 * Created by IntelliJ IDEA.
 * User: jbowd
 * Date: 8/30/16
 * Time: 1:50 AM
 * This page requires that several variables be set.  
 */
$_SESSION["resellername"];
$_SESSION["resellerba1"];
$_SESSION["city"];
$_SESSION["state"];
$_SESSION["zipcode"];
$_SESSION["spcode"];
	$_SESSION["totalMonthly"];
$_SESSION["totalNonRecurring"];
$_SESSION["endusername"];
$_SESSION["emergaddress1"];
$_SESSION["emergaddress2"];
$_SESSION["emergcity"];
$_SESSION["emergstate"];
$_SESSION["emergzipcode"];
$_SESSION["cmtelephone"];
$_SESSION["customertimezone"];
$_SESSION["requestedbuilt"];
$_SESSION["requestedinservice"];
$_SESSION["addtoexistingcustomer"];
$_SESSION["emergprovisionrequired"];
$_SESSION["emergaddress1"];
$_SESSION["emergaddress2"];
$_SESSION["emergcity"];
$_SESSION["emergstate"];
$_SESSION["emergzipcode"];
$_SESSION["emergphonenumber"];
$_SESSION["orderdetails"];
?>
<html>
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
              <img id="image" src="http://www.redrocktelecom.com/assets/images/Redrocklogo.jpg" alt="Red Rock"/>
            </div>
		</div>
		<div style="clear:both"></div>
		<div id="customer">
            <div id="customer-title" style="font-size: 20px; font-weight: bold; float: left;"><?php echo nl2br("' .	test_input($_SESSION["resellername"]) . ' \n
            		' .	test_input($_SESSION["resellerba1"]) . ' \n ' .	test_input($_SESSION["city"]) . ' ' .	test_input($_SESSION["state"]) . ', ' .	test_input($_SESSION["zipcode"]) . '");?> </div>
            <table id="meta" style="margin-top: 1px; width: 300px; float: right;">
                <tr>
                    <td class="meta-head" style="text-align: left; background: #eee;">Invoice #</td>
                    <td><div id="orderno">' . $orderNumber . '</div></td>
                </tr>
                <tr>
                    <td class="meta-head" style="text-align: left; background: #eee;">Date</td>
                    <td><div id="date">'.  date("m/d/y") .'</div></td>
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
			<?php
            	$result = $orderUtils->getResellerItems($_SESSION["spcode"]);
                while($row  = $result->fetch_array()){
                    $itemName = $row["USOC"];
            	    $quantity = $_SESSION[$itemName];
            	    $description = $row["Description"] ;
            	    $monthly = $row["Recurring_Price"];
					$nonRecurring = $row["One_Time_Charge"];
					if($quantity > 0){
						$html .= '<tr>';
						$html .= '<td class="item-name"><div class="delete-wpr" style="width: 80px; height: 50px;">' . $itemName . '</div></td>';
						$html .= '<td class="description"><div style="width: 300px; width: 100%; height: 100%;">' .$description . '</div></td>';
						$html .= '<td><div class="cost" style="width: 80px; height: 50px;">' . $quantity . '</div></td>';
						$html .= '<td><div class="cost" style="width: 80px; height: 50px;">' . $monthly . '</div></td>';
						$html .= '<td><div class="cost" style="width: 80px; height: 50px;">' . $nonRecurring . '</div></td>';
						$html .= '</tr>';
						echo $html;
					}
				}
			?>
		 <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line" style="border-right: 0; text-align: right;">Monthly Recurring Charge:</td>
		      <td class="total-value" style="border-left: 0; padding: 10px;"><div id="subtotal" style="height: 20px; background: none;" >' . $_SESSION["totalMonthly"] . '<br></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line" style="border-right: 0; text-align: right;">Non-Recurring Charge:</td>
		      <td class="total-value" style="border-left: 0; padding: 10px;"><div id="total" style="height: 20px; background: none;">' . $_SESSION["totalNonRecurring"] . '</div></td>
		  </tr>
		</table>
		<h3>Customer Information:</h3>
		<table id= "customer" style="clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black;">
			<tr class="customer-row">
				<td class="customer-name"><div class="delete-wpr" style="width: 100%; height: 50px;">Name: ' . 	test_input($_SESSION["endusername"]) . '</div></td>
			</tr>
			<tr class = "customer-row">
				<td class="customer-address"><div class="delete-wpr" style="width: 100%; height: 50px;">Address: ' . 	test_input($_SESSION["emergaddress1"]) . ' '
						. test_input($_SESSION["emergaddress2"]) . ' ' . 	test_input($_SESSION["emergcity"]) . ', ' . 	test_input($_SESSION["emergstate"]) . ', ' . 	test_input($_SESSION["emergzipcode"]) . '</div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-btn"><div class="delete-wpr" style="width: 100%; height: 50px;">Billing Telephone Number: ' . 	test_input($_SESSION["cmtelephone"]) . '</div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-time-zone"><div class="delete-wpr" style="width: 100%; height: 50px;">Customer Time Zone:' . 	test_input($_SESSION["customertimezone"]) . '</div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-requested-built"><div class="delete-wpr" style="width: 100%; height: 50px;">Requested Built/Service Provisioned Date:
						' . 	test_input($_SESSION["requestedbuilt"]) . ' </div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-requested-service"><div class="delete-wpr" style="width: 100%; height: 50px;">Requested In Service/ Effective Billing Date:
								' . 	test_input($_SESSION["requestedinservice"]) . '</div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-existing"><div class="delete-wpr" style="width: 100%; height: 50px;">Add To Existing Customer: ' . 	test_input($_SESSION["addtoexistingcustomer"]) . '</div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-emergprovisionrequired"><div class="delete-wpr" style="width: 100%; height: 50px;">Does this order require that 911 be provisioned per the data provided below?:
			 ' . 	test_input($_SESSION["emergprovisionrequired"]) . ' </div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-emergaddress"><div class="delete-wpr" style="width: 100%; height: 50px;">Service/911 Address: ' . 	test_input($_SESSION["emergaddress1"]) . '
						' . 	test_input($_SESSION["emergaddress2"]) . ' ' . 	test_input($_SESSION["emergcity"]) . ', ' . 	test_input($_SESSION["emergstate"]) . ', ' . 	test_input($_SESSION["emergzipcode"]) . '</div></td>
			</tr>
			<tr class="customer-row">
				<td class= "customer-emergphonenumber"><div class="delete-wpr" style="width: 100%; height: 50px;"> Emergency Phone Number: ' . test_input($_SESSION["emergphonenumber"]) . '</div></td>
			</tr>
		</table>
		<h3>Order Details:</h3>
			<table id= "orderdetails" style="clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black;">
				<tr class= "order-row">
					<td class="order-details"><div class="delete-wpr" style="width: 100%; height: 50px;">' . 	test_input($_SESSION["orderdetails"]) . '</div></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>