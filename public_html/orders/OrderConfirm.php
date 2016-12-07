<?php
	
$root = $_SERVER ["DOCUMENT_ROOT"];
include_once ($_SERVER ["DOCUMENT_ROOT"] . '/portal/portalheader.php');
include_once $root . '/classes/DBUtils.php';
include_once $root . '/classes/OrderUtils.php';
include_once $root . '/classes/MailUtils.php';
if (empty ( $_POST )) {
	echo "Something went wrong with the order.";
}
error_reporting(E_ALL ^ E_NOTICE);
$orderUtils = new OrderUtils();
$dbutils = new DBUtils();
$conn = $dbutils->getDBConnection ();
$customerInsertString = generateCustomerInsertString ();
//echo 'Executing: ' . $customerInsertString . '<br>';
//Insert the Customer to the database, then use that Customer ID to generate the Order InsertString.
/*
 * A couple steps here
 * 1) Insert Customer to database
 * 2) Use Customer Id to insert Order String
 * 3) Use the Order Number to Generate the number insert string
 * 4) Send the order notification Email
 * 5) insert the Itemized order to the database
 */
if (mysqli_query ( $conn, $customerInsertString )) {
	//echo "New customer created successfully";
	$customerID = $conn->insert_id;
	//echo "Inserted record " . $customerID . '<br>';
	$orderInsertString = generateOrderInsertString ( $customerID );
	//echo 'Executing: ' . $orderInsertString . '<br>';
	$orderInsertSuccess = mysqli_query ( $conn, $orderInsertString );
	if ($orderInsertSuccess) {
		$orderNumber = $conn->insert_id;
		$numberInsertString = generateNumberInsertString($orderNumber);
        $numberInsertSuccess = false;
        if(strcmp($numberInsertString,"") != 0){
            $numberInsertSuccess = mysqli_query ( $conn, $numberInsertString );
        }
        else{
            $numberInsertSuccess = true;
        }
        //echo "number insert string: " . $numberInsertString . "<br>";
		if($numberInsertSuccess){
            $itemizedInsert = generateItemizedInsertString($orderNumber,$orderUtils);
            //echo "Itemized insert String: " . $itemizedInsert . "<br>";
            if (mysqli_query ( $conn, $itemizedInsert)) {
                sendOrderAlertEmail($orderNumber,$orderUtils);
                echo "<p style= 'align:center';> Order Created Successfully!  </p><br><br>";
                echo '<a href= "/portal/portal.php">Return to portal</a>';
            }
            else{
                echo "Failed to insert Itemized order";
            }

		}
	} else {
		echo "Error inserting Order information: " . mysqli_error ( $conn );
	}
} else {
	echo "Error: " . $customerInsertString . "<br>" . mysqli_error ( $conn );
}
$conn->close ();
//unsetOrderSessionVariables();
/**
 * This function goes through each of the session variables set throught the course of the order and unsets them so they do not overlap with other orders 
 * made during the same login/session.
 */
function unsetOrderSessionVariables(){
	//Have to go through each of the item session variables before the spcode is unset
	include_once $_SERVER ["DOCUMENT_ROOT"] . '/classes/OrderUtils.php';
	$orderUtils = new OrderUtils();
	$result = $orderUtils->getResellerItems($_SESSION['spcode']);
	while($row  = $result->fetch_array()){
		$itemName = $row["USOC"];
		unsetSessionVariable($itemName);
	}
		
	//TODO: Make an array of session variables and loop through it
	unsetSessionVariable('totalMonthly');
	unsetSessionVariable('totalNonRecurring');
	unsetSessionVariable('resellername');
	unsetSessionVariable('resellerba1');
	unsetSessionVariable('resellerba2');
	unsetSessionVariable('resellercity');
	unsetSessionVariable('resellerstate');
	unsetSessionVariable('resellerzipcode');
	unsetSessionVariable('resellertelephonenumber');
	unsetSessionVariable('emailaddress');
	unsetSessionVariable('accountnumber');
	unsetSessionVariable('spcode');
	unsetSessionVariable('resellercn');
	unsetSessionVariable('contactTelephone');
	unsetSessionVariable('endusername');
	unsetSessionVariable('address1');
	unsetSessionVariable('address2');
	unsetSessionVariable('city');
	unsetSessionVariable('state');
	unsetSessionVariable('zipcode');
	unsetSessionVariable('cmtelephone');
	unsetSessionVariable('resellerrefid');
	unsetSessionVariable('requestedbuilt');
	unsetSessionVariable('requestedinservice');
	unsetSessionVariable('orsooner');
	unsetSessionVariable('addtoexistingcustomer');
	unsetSessionVariable('customertimezone');
	unsetSessionVariable('emergprovisionrequired');
	unsetSessionVariable('emergaddress1');
	unsetSessionVariable('emergaddress2');
	unsetSessionVariable('emergcity');
	unsetSessionVariable('emergstate');
	unsetSessionVariable('emergzipcode');
	unsetSessionVariable('emergphonenumber');
	unsetSessionVariable('orderdetails');
	unsetSessionVariable('attachmentString');
	unsetSessionVariable('attachmentDir');
}

function unsetSessionVariable ($sessionVariableName) {
	unset($GLOBALS['_SESSION'][$sessionVariableName]);
}

function generateItemizedInsertString($orderNumber,$orderUtils){
	$sql = 'INSERT INTO OrderItems(Order_No, USOC, Quantity) VALUES';
	$result = $orderUtils->getResellerItems($_SESSION["spcode"]);
	$firstValues = true;
	while($row  = $result->fetch_array()){
		$itemName = $row["USOC"];
		$quantity = $_SESSION[$itemName];
		if($quantity > 0){
			if($firstValues){
				$firstValues = false;
			}else{
				$sql = $sql . ', ';
			}
			$sql = $sql . "('" . $orderNumber . "',"; 
			$sql = $sql . "'" . $itemName . "',"; 
			$sql = $sql . "'" . $quantity. "')"; 
		}
	}
	return $sql;
}

function generateNumberInsertString($orderNumber) {
	$sql = 'INSERT INTO PortedNumbers(Order_No, Ported_Number, IsBT, Is911) VALUES';
	$index = 1;
	$portednumName = "portednumber_" . $index;
	$firstValues = true;
	while(isset($_POST[$portednumName])){
		$portnumber911Name = "portnumber911_" . $index;
		$btnumberName = "btnumber_" . $index;
		
		if($firstValues){
			$firstValues = false;
		}else{
			$sql = $sql . ', ';
		}
		$btValue = $nineOneOneValue = "No";
		if(isset($_POST[$btnumberName]) && $_POST[$btnumberName] =="on"){
			$btValue = "Yes";
		}
		if(isset($_POST[$nineOneOneValue]) && $_POST[$nineOneOneValue] == "on"){
			$nineOneOneValue = "Yes";
		}
		$sql = $sql . "('" . $orderNumber . "',";
		$sql = $sql . "'" . test_input($_POST[$portednumName]) . "',";
		$sql = $sql . "'" . getYesNo($_POST[$btnumberName])  . "',";
		$sql = $sql . "'" . getYesNo($_POST[$portnumber911Name]) . "')";
		$index++;
		$portednumName = "portednumber_" . $index;
	}
    if($firstValues){
        return "";
    }
	return $sql;
}

function getYesNo($value){
    if(strcmp($value,"yes") == 0){
        return "yes";
    }
    else{
        return "no";
    }
}
function generateCustomerInsertString() {
	$sql = 'INSERT INTO Customers (End_User_Name, Cust_Telephone, Address_1, Address_2, City, State, Zip, Emerg_Address_1, Emerg_Address_2, Emerg_City, Emerg_State, Emerg_Zip, Emerg_Phone,Customer_Time_Zone) 
			VALUES(';
	$sql = $sql . "'" . test_input($_SESSION["endusername"]) . "',";
	$sql = $sql . "'" . test_input($_SESSION["cmtelephone"]) . "',";
	$sql = $sql . "'" . test_input($_SESSION["address1"]) ."',";
	$sql = $sql . "'" . test_input($_SESSION["address2"]) ."',";
	$sql = $sql . "'" . test_input($_SESSION["city"]) ."',";
	$sql = $sql . "'" . test_input($_SESSION["state"]) ."',";
	$sql = $sql . "'" . test_input($_SESSION["zipcode"]) ."',";
	$sql = $sql . "'" . test_input($_SESSION["emergaddress1"]) ."',";
	$sql = $sql . "'" . test_input($_SESSION["emergaddress2"]) ."',";
	$sql = $sql . "'" . test_input($_SESSION["emergcity"]) ."',";
	$sql = $sql . "'" . test_input($_SESSION["emergstate"])."',";
	$sql = $sql . "'" . test_input($_SESSION["emergzipcode"]) ."',";
	$sql = $sql . "'" . test_input($_SESSION["emergphonenumber"]) ."',";
	$sql = $sql . "'" . test_input($_SESSION["customertimezone"]) ."')";
	
	return $sql;
}
function generateOrderInsertString($Cust_ID) {
	$sql = 'INSERT INTO Orders (Emerg_Prov_Req, Order_Details, Customer_ID, Serv_Prov_CD, Res_Cont_Name, 
			Reseller_Ref_ID, Request_Built, Request_Service, Or_Sooner, Add_Exist_Cust,
			RequiresPN, New_Number_Qty, New_Number_AC, Emerg_New_Number, VTN_Quantity, Acct_No, Status) VALUES(';
	
	$sql = $sql . "'" . test_input($_SESSION ["emergprovisionrequired"]) . "',";
	$sql = $sql . "'" . addslashes(test_input($_SESSION ["orderdetails"])) . "',";
	$sql = $sql . "'" . $Cust_ID . "',";
	$sql = $sql . "'" . test_input($_SESSION ["spcode"]) . "',";
	$sql = $sql . "'" . test_input($_SESSION ["resellercn"]) . "',";
	$sql = $sql . "'" . test_input($_SESSION ["resellerrefid"]) . "',";
	$sql = $sql . "'" . test_input($_SESSION ["requestedbuilt"]) . "',";
	$sql = $sql . "'" . test_input($_SESSION ["requestedinservice"]) . "',";
	$sql = $sql . "'" . test_input($_SESSION ["orsooner"])  . "',";
	$sql = $sql . "'" . test_input($_SESSION ["addtoexistingcustomer"]) . "',";
	$sql = $sql . "'" . test_input($_POST["porting"]) . "',";
	$sql = $sql . "'" . test_input($_POST["newnumberquantity"]) . "',";
	$sql = $sql . "'" . test_input($_POST["newnumberac"]) . "',";
	$sql = $sql . "'" . test_input($_POST["emergnewnumber"]) . "',";
	$sql = $sql . "'" . test_input($_POST["vtnquantity"]) . "',";
	$sql = $sql . "'" . $_SESSION["Acct_No"] . "',";
	$sql = $sql . "'" . 'Submitted' . "')";
	return $sql;
}
function sendOrderAlertEmail($orderNumber,$orderUtils){
    $message = createOrderMessage($orderNumber,$orderUtils);
    $from = 'noreply@redrocktelecom.com';
    $fromname = 'Web App';
    $subject = 'Red Rock Telecom Order Number: ' . $orderNumber;
    $to = "rachel@redrocktelecom.com," . $_SESSION["User_Email"];
    $mailUtils = new MailUtils();
    $mailUtils->sendWithAttachments($from, $fromname, $to, $subject, $message, $_SESSION['attachmentDir'],$_SESSION["attachmentString"]);
}
function createOrderMessage($orderNumber,$orderUtils){
    	$message = '
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
		  </tr>';
		$result = $orderUtils->getResellerItems($_SESSION["spcode"]);
		while($row  = $result->fetch_array()){
			$itemName = $row["USOC"];
			$quantity = $_SESSION[$itemName];
			$description = $row["Description"] ;
			$monthly = $row["Recurring_Price"];
			$nonRecurring = $row["One_Time_Charge"];
			if($quantity > 0){
				$message .= '<tr>';
				$message .= '<td class="item-name"><div class="delete-wpr" style="width: 80px; height: 50px;">' . $itemName . '</div></td>';
				$message .= '<td class="description"><div style="width: 300px; width: 100%; height: 100%;">' .$description . '</div></td>';
				$message .= '<td><div class="cost" style="width: 80px; height: 50px;">' . $quantity . '</div></td>';
				$message .= '<td><div class="cost" style="width: 80px; height: 50px;">' . $monthly . '</div></td>';
				$message .= '<td><div class="cost" style="width: 80px; height: 50px;">' . $nonRecurring . '</div></td>';
				$message .= '</tr>';
			}
		}
		 $message .= '<tr>
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
		<h3 style="text-align:center;">Customer Information:</h3>
		<table id= "customer" style="clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black;">
			<tr class="customer-row">
				<td class="customer-name"><div class="delete-wpr" style="width: 100%; height: 50px;">Name: ' . 	test_input($_SESSION["endusername"]) . '</div></td>
			</tr>
			<tr class = "customer-row">
				<td class="customer-address"><div class="delete-wpr" style="width: 100%; height: 50px;">Address: ' . 	test_input($_SESSION["address1"]) . ' '
						. test_input($_SESSION["address2"]) . ' ' . 	test_input($_SESSION["city"]) . ', ' . 	test_input($_SESSION["state"]) . ', ' . 	test_input($_SESSION["zipcode"]) . '</div></td>
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
		<h3 style="text-align:center;">Order Details:</h3>
			<table id= "orderdetails" style="clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black;">
				<tr class= "order-row">
					<td class="order-details"><div class="delete-wpr" style="width: 100%; height: 50px;">' . 	test_input($_SESSION["orderdetails"]) . '</div></td>
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
					$newnumber = $row["Ported_Number"];
					$nineoneone = $row["Is911"];
					$btnumber = $row["IsBT"] ;
					$message .= '<tr style="border: 1px solid black; border-collapse: collapse;" >';
					$message .= '<td  style="border: 1px solid black; border-collapse: collapse;" class="item-name"><div class="delete-wpr" style="width: 100px; height: 50px;">' . $newnumber . '</div></td>';
					$message .= '<td  style="border: 1px solid black; border-collapse: collapse;" class="description"><div style="width: 50px; width: 100%; height: 100%; text-align: center; ">' .$nineoneone . '</div></td>';
					$message .= '<td style="border: 1px solid black; border-collapse: collapse;" ><div class="cost" style="width: 50px; height: 50px; text-align: center;">' . $btnumber . '</div></td>';
					$message .= '</tr>';
				}
			$message .=' </table>
			<h4 style="text-align:center;">New Numbers: </h4>';

            $newNumbersQT = test_input($_POST["newnumberquantity"]);
            if(strlen($newNumbersQT) == 0){
               $newNumbersQT = "0";
            }
			$message .= '<table id= "numberdetails" style="clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black;">
			    <tr>
					<td class="customer-porting"><div class="delete-wpr" style="width: 100%; height: 50px;">New numbers : ' . 	$newNumbersQT . '</div></td>
				</tr>
			    <tr class="customer-row">
					<td class="customer-porting"><div class="delete-wpr" style="width: 100%; height: 50px;">New number area code: ' . 	test_input($_POST["newnumberac"]) . '</div></td>
				</tr>
			    <tr class="customer-row">
					<td class="customer-porting"><div class="delete-wpr" style="width: 100%; height: 50px;">New number 911 provisioned: ' . 	test_input($_POST["emergnewnumber"]) . '</div></td>
				</tr>';

            $vtnQuantity = test_input($_POST["vtnquantity"]);
            if(strlen($vtnQuantity) == 0){
               $vtnQuantity = "0";
            }

            $message .= '<tr class="customer-row">
					<td class="customer-porting"><div class="delete-wpr" style="width: 100%; height: 50px;">New virtual numbers: ' . $vtnQuantity . '</div></td>
				</tr>';
			$message .= '</table> </div> </div> </body> </html>';
    return $message;
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
