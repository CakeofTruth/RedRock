<?php
$root = $_SERVER ["DOCUMENT_ROOT"];
include_once ($_SERVER ["DOCUMENT_ROOT"] . '/portal/portalheader.php');
include_once $root . '/classes/DBUtils.php';
include_once $root . '/classes/OrderUtils.php';

if (empty ( $_POST )) {
	echo "Something went wrong with the order.";
}

$orderUtils = new OrderUtils();

$dbutils = new DBUtils();
$conn = $dbutils->getDBConnection ();

$customerInsertString = generateCustomerInsertString ();

//echo 'Executing: ' . $customerInsertString . '<br>';

if (mysqli_query ( $conn, $customerInsertString )) {
	//echo "New customer created successfully";
	$customerID = $conn->insert_id;
	//echo "Inserted record " . $customerID . '<br>';
	$orderInsertString = generateOrderInsertString ( $customerID );
	//echo 'Executing: ' . $orderInsertString . '<br>';

	$orderInsertSuccess = mysqli_query ( $conn, $orderInsertString );

	if ($orderInsertSuccess) {
		echo "Order Created Successfully!  <br>";
		$orderNumber = $conn->insert_id;
		sendOrderAlertEmail($orderNumber,$orderUtils);
		$itemizedInsert = generateItemizedInsertString($orderNumber,$orderUtils);
		if (mysqli_query ( $conn, $itemizedInsert)) {
			echo '<a href= "/portal/portal.php">Return to portal</a>';
		}
		else{
			echo "Failed to insert Itemized order";
		}
	} else {
		//echo "Error inserting Order information: " . mysqli_error ( $conn );
	}
} else {
	//echo "Error: " . $customerInsertString . "<br>" . mysqli_error ( $conn );
}

$conn->close ();

function generateItemizedInsertString($orderNumber,$orderUtils){
	$sql = 'INSERT INTO OrderItems(Order_No, USOC, Quantity) VALUES';
	$result = $orderUtils->getResellerItems($_POST["spcode"]);
	$firstValues = true;
	while($row  = $result->fetch_array()){
		$itemName = $row["USOC"];
		$quantity = $_POST[$itemName];
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

function generateCustomerInsertString() {
	$sql = 'INSERT INTO Customers (End_User_Name, Cust_Telephone, Address_1, Address_2, City, State, Zip, Emerg_Address_1, Emerg_Address_2, Emerg_City, Emerg_State, Emerg_Zip, Emerg_Phone,Customer_Time_Zone) VALUES(';
	$sql = $sql . "'" . test_input($_POST["endusername"]) . "',";
	$sql = $sql . "'" . test_input($_POST["address1"]) ."',";
	$sql = $sql . "'" . test_input($_POST["address2"]) ."',";
	$sql = $sql . "'" . test_input($_POST["city"]) ."',";
	$sql = $sql . "'" . test_input($_POST["state"]) ."',";
	$sql = $sql . "'" . test_input($_POST["zipcode"]) ."',";
	$sql = $sql . "'" . test_input($_POST["cmtelephone"]) . "',";
	$sql = $sql . "'" . test_input($_POST["emergaddress1"]) ."',";
	$sql = $sql . "'" . test_input($_POST["emergaddress2"]) ."',";
	$sql = $sql . "'" . test_input($_POST["emergcity"]) ."',";
	$sql = $sql . "'" . test_input($_POST["emergstate"]) ."',";
	$sql = $sql . "'" . test_input($_POST["emergzipcode"]) ."',";
	$sql = $sql . "'" . test_input($_POST["emergphonenumber"]) ."',";
	$sql = $sql . "'" . test_input($_POST["customertimezone"]) ."')";
	
	return $sql;
}
function generateOrderInsertString($Cust_ID) {
	$resellercn = test_input ( $_POST ["resellercn"] ); // order
	$resellerrefid = test_input ( $_POST ["resellerrefid"] ); // order
	$requestedbuilt = test_input ( $_POST ["requestedbuilt"] ); // order
	$requestedinservice = test_input ( $_POST ["requestedinservice"] ); // order
	$orsooner = test_input ( $_POST ["orsooner"] ); // order
	$addtoexistingcustomer = test_input ( $_POST ["addtoexistingcustomer"] ); // order
	$emergprovisionrequired = test_input ( $_POST ["emergprovisionrequired"] ); // order
	
	$sql = 'INSERT INTO Orders (Emerg_Prov_Req, Order_Details, Customer_ID, Serv_Prov_CD, Res_Cont_Name, 
			Reseller_Ref_ID, Request_Built, Request_Service, Or_Sooner, Add_Exist_Cust) VALUES(';
	$sql = $sql . "'" . test_input ( $_POST ["emergprovisionrequired"] ) . "',";
	$sql = $sql . "'" . addslashes(test_input ( $_POST ["orderdetails"] )) . "',";
	$sql = $sql . "'" . $Cust_ID . "',";
	$sql = $sql . "'" . test_input ( $_POST ["spcode"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["resellercn"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["resellerrefid"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["requestedbuilt"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["requestedinservice"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["orsooner"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["addtoexistingcustomer"] ) . "')";

	return $sql;
}



function sendOrderAlertEmail($orderNumber,$orderUtils){

	$mail = getMailer();
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
            <div id="customer-title" style="font-size: 20px; font-weight: bold; float: left;"><?php echo nl2br("' .	test_input($_POST["resellername"]) . ' \n  
            		' .	test_input($_POST["resellerba1"]) . ' \n ' .	test_input($_POST["city"]) . ' ' .	test_input($_POST["state"]) . ', ' .	test_input($_POST["zipcode"]) . '");?> </div>
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
	
		$result = $orderUtils->getResellerItems($_POST["spcode"]);
		while($row  = $result->fetch_array()){
			$itemName = $row["USOC"];
			$quantity = $_POST[$itemName];
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
		      <td class="total-value" style="border-left: 0; padding: 10px;"><div id="subtotal" style="height: 20px; background: none;" >' . $_POST["totalMonthly"] . '<br></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line" style="border-right: 0; text-align: right;">Non-Recurring Charge:</td>
		      <td class="total-value" style="border-left: 0; padding: 10px;"><div id="total" style="height: 20px; background: none;">' . $_POST["totalNonRecurring"] . '</div></td>
		  </tr>	
		</table>
		<h3>Customer Information:</h3>
		<table id= "customer" style="clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black;">
			<tr class="customer-row">
				<td class="customer-name"><div class="delete-wpr" style="width: 100%; height: 50px;">Name: ' . 	test_input($_POST["endusername"]) . '</div></td>
			</tr>
			<tr class = "customer-row">
				<td class="customer-address"><div class="delete-wpr" style="width: 100%; height: 50px;">Address: ' . 	test_input($_POST["emergaddress1"]) . ' ' 
						. test_input($_POST["emergaddress2"]) . ' ' . 	test_input($_POST["emergcity"]) . ', ' . 	test_input($_POST["emergstate"]) . ', ' . 	test_input($_POST["emergzipcode"]) . '</div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-btn"><div class="delete-wpr" style="width: 100%; height: 50px;">Billing Telephone Number: ' . 	test_input($_POST["cmtelephone"]) . '</div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-time-zone"><div class="delete-wpr" style="width: 100%; height: 50px;">Customer Time Zone:' . 	test_input($_POST["customertimezone"]) . '</div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-requested-built"><div class="delete-wpr" style="width: 100%; height: 50px;">Requested Built/Service Provisioned Date:
						' . 	test_input($_POST["requestedbuilt"]) . ' </div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-requested-service"><div class="delete-wpr" style="width: 100%; height: 50px;">Requested In Service/ Effective Billing Date: 
								' . 	test_input($_POST["requestedinservice"]) . '</div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-existing"><div class="delete-wpr" style="width: 100%; height: 50px;">Add To Existing Customer: ' . 	test_input($_POST["addtoexistingcustomer"]) . '</div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-emergprovisionrequired"><div class="delete-wpr" style="width: 100%; height: 50px;">Does this order require that 911 be provisioned per the data provided below?: 
			 ' . 	test_input($_POST["emergprovisionrequired"]) . ' </div></td>
			</tr>
			<tr class= "customer-row">
				<td class="customer-emergaddress"><div class="delete-wpr" style="width: 100%; height: 50px;">Service/911 Address: ' . 	test_input($_POST["emergaddress1"]) . '
						' . 	test_input($_POST["emergaddress2"]) . ' ' . 	test_input($_POST["emergcity"]) . ', ' . 	test_input($_POST["emergstate"]) . ', ' . 	test_input($_POST["emergzipcode"]) . '</div></td>
			</tr>
		</table>
		<h3>Order Details:</h3>
			<table id= "orderdetails" style="clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black;">
				<tr class= "order-row">
					<td class="order-details"><div class="delete-wpr" style="width: 100%; height: 50px;">' . 	test_input($_POST["orderdetails"]) . '</div></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>'
	;

	$mail->isHTML(true);
	$mail->SetFrom('noreply@redrocktelecom.com', 'Web App');
	$mail->Subject = 'Red Rock Telecom Order Number: ' . $orderNumber;
	$mail->MsgHTML($message);
	$mail->AddAddress("ops@redrocktelecom.com");
	addAttachments($mail,$_POST['attachmentDir'],$_POST["attachments"]);
	
	if($mail->Send()) {
		//echo "Message sent!";
	} else {
		//echo "Mailer Error: " . $mail->ErrorInfo;
	}
	cleanAttachments($_POST['attachmentDir']);
}

function cleanAttachments($dir) {
	$toRemove = $_SERVER['DOCUMENT_ROOT'] . "/tmp/orderData/" . $dir;
	//echo "attempting to remove attachments from dir: " . $toRemove . "<br> ";
	if (is_dir($toRemove)) {
		//echo "is a directory <br>";
		$objects = scandir($toRemove);
		foreach ($objects as $object) {
			//echo "attempting to remove an object";
			if ($object != "." && $object != "..") {
				if (is_dir($toRemove."/".$object))
					rrmdir($toRemove."/".$object);
					else
						unlink($toRemove."/".$object);
			}
		}
		rmdir($toRemove);
	}
	else{
		//echo "Is not a dir";
	}
}

function addAttachments($mail,$attachmentDir,$attachmentString){
	$array = explode(",",$attachmentString);
	foreach($array as $fileName){
		$path = $_SERVER['DOCUMENT_ROOT'] . "/tmp/orderData/" . $attachmentDir . '/' . $fileName;
		//echo "adding attachment from path: " . $path . "<br>";
		if(is_file($path)){
		//	echo " is a file!<br>";
			$mail->addAttachment($path);
		}
	}
}

function getMailer(){
	include_once ($_SERVER ["DOCUMENT_ROOT"] .'/mail/class.phpmailer.php');
	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Host = "email.hostaccount.com";
	$mail->Port = 587;
	$mail->Username = "noreply@redrocktelecom.com";
	$mail->Password = "Telco123!";
	
	return $mail;
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