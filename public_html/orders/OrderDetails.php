<?php
/**
 * This page is linked off of the Order History page and contains the details for a particular order
 * 
 * User: jbowd
 * Date: 8/24/16
 * Time: 9:24 PM
 */
include_once ($_SERVER ["DOCUMENT_ROOT"] . '/portal/portalheader.php');
include_once $root . '/classes/DBUtils.php';
include_once $root . '/classes/OrderUtils.php';

$orderUtils = new OrderUtils();
$dbutils = new DBUtils();
$conn = $dbutils->getDBConnection ();

if(isset($_GET["orderNumber"])){
   //check if order belongs to whoever's logged in
    $orderNumber = $_GET["orderNumber"];
    if(isThisYourOrder($orderNumber,$_SESSION["Acct_No"],$conn) OR $_SESSION["Approver"] == "1"){
        echo "Include dat page yo <br>";
       /* setDetailVariables();
        echo $var1 . "<br>";
        echo $var2 . "<br>";
        echo $var3 . "<br>";
        echo $var4 . "<br>"; */
    }
    else{
        echo "You do not have access to view order number: " . $orderNumber . "<br>";
        echo '<a href= "/orders/OrderHistory.php">Return Order History</a>';
    }
}


function setDetailVariables(){
    $var1 = "Hey Hey";
    $var2 = "you you";
    $var3 = "I don't like your girlfriend";
}

$orderDisplay = $orderUtils->createOrderDisplay($orderNumber);
echo $orderNumber;
$row = $orderDisplay->fetch_array ();
echo $row["Serv_Prov_CD"];
echo $row["Reseller_Ref_ID"];
echo $row["Order_Details"];

while ($row = $orderDisplay->fetch_array()){
	$rowhtml = '
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
			  </tr>';
			$result = $orderUtils->getResellerItems($row["Serv_Prov_CD"]);
			while($row  = $result->fetch_array()){
				$itemName = $row["USOC"];
				$quantity = $row[$itemName];
				$description = $row["Description"] ;
				$monthly = $row["Recurring_Price"];
				$nonRecurring = $row["One_Time_Charge"];
				if($quantity > 0){
					$rowhtml .= '<tr>';
					$rowhtml .= '<td class="item-name"><div class="delete-wpr" style="width: 80px; height: 50px;">' . $itemName . '</div></td>';
					$rowhtml .= '<td class="description"><div style="width: 300px; width: 100%; height: 100%;">' .$description . '</div></td>';
					$rowhtml .= '<td><div class="cost" style="width: 80px; height: 50px;">' . $quantity . '</div></td>';
					$rowhtml .= '<td><div class="cost" style="width: 80px; height: 50px;">' . $monthly . '</div></td>';
					$rowhtml .= '<td><div class="cost" style="width: 80px; height: 50px;">' . $nonRecurring . '</div></td>';
					$rowhtml .= '</tr>';
				}
			}
			 $rowhtml .= '<tr>
			      <td colspan="2" class="blank"> </td>
			      <td colspan="2" class="total-line" style="border-right: 0; text-align: right;">Monthly Recurring Charge:</td>
			      <td class="total-value" style="border-left: 0; padding: 10px;"><div id="subtotal" style="height: 20px; background: none;" >' . $row["totalMonthly"] . '<br></div></td>
			  </tr>
			  <tr>
			      <td colspan="2" class="blank"> </td>
			      <td colspan="2" class="total-line" style="border-right: 0; text-align: right;">Non-Recurring Charge:</td>
			      <td class="total-value" style="border-left: 0; padding: 10px;"><div id="total" style="height: 20px; background: none;">' . $row["totalNonRecurring"] . '</div></td>
			  </tr>
			</table>
			<h3 style="text-align:center;">Customer Information:</h3>
			<table id= "customer" style="clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black;">
				<tr class="customer-row">
					<td class="customer-name"><div class="delete-wpr" style="width: 100%; height: 50px;">Name: ' . 	$row["End_User_Name"] . '</div></td>
				</tr>
				<tr class = "customer-row">
					<td class="customer-address"><div class="delete-wpr" style="width: 100%; height: 50px;">Address: ' . 	$row["Address_1"] . ' '
							. $row["Address_2"] . ' ' . 	$row["City"] . ', ' . 	$row["State"] . ', ' . $Row["Zip"] . '</div></td>
				</tr>
				<tr class= "customer-row">
					<td class="customer-btn"><div class="delete-wpr" style="width: 100%; height: 50px;">Billing Telephone Number: ' . 	$_SESSION["cmtelephone"] . '</div></td>
				</tr>
				<tr class= "customer-row">
					<td class="customer-time-zone"><div class="delete-wpr" style="width: 100%; height: 50px;">Customer Time Zone:' . 	$_SESSION["customertimezone"] . '</div></td>
				</tr>
				<tr class= "customer-row">
					<td class="customer-requested-built"><div class="delete-wpr" style="width: 100%; height: 50px;">Requested Built/Service Provisioned Date:
							' . 	$_SESSION["requestedbuilt"] . ' </div></td>
				</tr>
				<tr class= "customer-row">
					<td class="customer-requested-service"><div class="delete-wpr" style="width: 100%; height: 50px;">Requested In Service/ Effective Billing Date:
									' . 	$_SESSION["requestedinservice"] . '</div></td>
				</tr>
				<tr class= "customer-row">
					<td class="customer-existing"><div class="delete-wpr" style="width: 100%; height: 50px;">Add To Existing Customer: ' . 	$_SESSION["addtoexistingcustomer"] . '</div></td>
				</tr>
				<tr class= "customer-row">
					<td class="customer-emergprovisionrequired"><div class="delete-wpr" style="width: 100%; height: 50px;">Does this order require that 911 be provisioned per the data provided below?:
				 ' . 	$_SESSION["emergprovisionrequired"] . ' </div></td>
				</tr>
				<tr class= "customer-row">
					<td class="customer-emergaddress"><div class="delete-wpr" style="width: 100%; height: 50px;">Service/911 Address: ' . 	$_SESSION["emergaddress1"] . '
							' . 	$_SESSION["emergaddress2"] . ' ' . 	$_SESSION["emergcity"] . ', ' . 	$_SESSION["emergstate"] . ', ' . 	$_SESSION["emergzipcode"] . '</div></td>
				</tr>
				<tr class="customer-row">
					<td class= "customer-emergphonenumber"><div class="delete-wpr" style="width: 100%; height: 50px;"> Emergency Phone Number: ' . $_SESSION["emergphonenumber"] . '</div></td>
				</tr>
			</table>
			<h3 style="text-align:center;">Order Details:</h3>
				<table id= "orderdetails" style="clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black;">
					<tr class= "order-row">
						<td class="order-details"><div class="delete-wpr" style="width: 100%; height: 50px;">' . 	$_SESSION["orderdetails"] . '</div></td>
					</tr>
				</table>
			<h3 style="text-align:center;">Number Details:</h3>
			<h4 style="text-align:center;">Ported Numbers:<h4>
					<table id="items" style="clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black;">
						<tr class = "customer-row">
							<th style="background: #eee; border: 1px solid black; border-collapse: collapse;" >New Number</th>
							<th style="background: #eee; border: 1px solid black; border-collapse: collapse;">911 provision</th>
							<th style="background: #eee; border: 1px solid black; border-collapse: collapse;">Billing Telephone Number</th>
						</tr>';
					$result = $orderUtils->getNumberDetails($orderNumber);
					while($row  = $result->fetch_array()){
						$newnumber = $_SESSION["Ported_Number"];
						$nineoneone = $_SESSION["Is911"];
						$btnumber = $_SESSION["IsBT"] ;
						$rowhtml .= '<tr style="border: 1px solid black; border-collapse: collapse;" >';
						$rowhtml .= '<td  style="border: 1px solid black; border-collapse: collapse;" class="item-name"><div class="delete-wpr" style="width: 100px; height: 50px;">' . $newnumber . '</div></td>';
						$rowhtml .= '<td  style="border: 1px solid black; border-collapse: collapse;" class="description"><div style="width: 50px; width: 100%; height: 100%; text-align: center; ">' .$nineoneone . '</div></td>';
						$rowhtml .= '<td style="border: 1px solid black; border-collapse: collapse;" ><div class="cost" style="width: 50px; height: 50px; text-align: center;">' . $btnumber . '</div></td>';
						$rowhtml .= '</tr>';
					}
				$rowhtml .=' </table>
				<h4 style="text-align:center;">New Numbers: </h4>';
	
	            $newNumbersQT = $row["newnumberquantity"];
	            if(strlen($newNumbersQT) == 0){
	               $newNumbersQT = "0";
	            }
				$rowhtml .= '<table id= "numberdetails" style="clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black;">
				    <tr>
						<td class="customer-porting"><div class="delete-wpr" style="width: 100%; height: 50px;">New numbers : ' . 	$newNumbersQT . '</div></td>
					</tr>
				    <tr class="customer-row">
						<td class="customer-porting"><div class="delete-wpr" style="width: 100%; height: 50px;">New number area code: ' . 	$row["New_Number_AC"] . '</div></td>
					</tr>
				    <tr class="customer-row">
						<td class="customer-porting"><div class="delete-wpr" style="width: 100%; height: 50px;">New number 911 provisioned: ' . 	$row["emergnewnumber"] . '</div></td>
					</tr>';
	
	            $vtnQuantity = $row["VTN_Quantity"];
	            if(strlen($vtnQuantity) == 0){
	               $vtnQuantity = "0";
	            }
	
	            $rowhtml .= '<tr class="customer-row">
						<td class="customer-porting"><div class="delete-wpr" style="width: 100%; height: 50px;">New virtual numbers: ' . $vtnQuantity . '</div></td>
					</tr>';
				$rowhtml .= '</table> </div> </div> </body> </html>';
	    echo $rowhtml;
	}

	function unsetSessionVariable ($sessionVariableName) {
		unset($GLOBALS['_SESSION'][$sessionVariableName]);
	}
/**
 * Returns a yes if there is an order with that number and that account number in the database
 * 
 * @param $orderNo
 * @param $accountNo
 * @param $conn
 * @return bool
 */
function isThisYourOrder($orderNo,$accountNo,$conn){
    $sql = "SELECT 1 FROM `Orders` where Order_No = " . $orderNo .
    " and Acct_No =" . $accountNo;
    $result = $conn->query($sql);

    return ($result->num_rows > 0);
}




include $_SERVER ["DOCUMENT_ROOT"] . '/main/footer.php';
