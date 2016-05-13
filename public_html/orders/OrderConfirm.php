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
	echo 'Executing: ' . $orderInsertString . '<br>';

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
	echo "Error: " . $customerInsertString . "<br>" . mysqli_error ( $conn );
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
	$salesrep = test_input ( $_POST ["salesrep"] ); // order
	$resellerrefid = test_input ( $_POST ["resellerrefid"] ); // order
	$requestedbuilt = test_input ( $_POST ["requestedbuilt"] ); // order
	$requestedinservice = test_input ( $_POST ["requestedinservice"] ); // order
	$orsooner = test_input ( $_POST ["orsooner"] ); // order
	$addtoexistingcustomer = test_input ( $_POST ["addtoexistingcustomer"] ); // order
	$emergprovisionrequired = test_input ( $_POST ["emergprovisionrequired"] ); // order
	
	$sql = 'INSERT INTO Orders (Emerg_Prov_Req, Order_Details, Customer_ID, Serv_Prov_CD, Res_Cont_Name, Sales_Rep, 
			Reseller_Ref_ID, Request_Built, Request_Service, Or_Sooner, Add_Exist_Cust) VALUES(';
	$sql = $sql . "'" . test_input ( $_POST ["emergprovisionrequired"] ) . "',";
	$sql = $sql . "'" . addslashes(test_input ( $_POST ["orderdetails"] )) . "',";
	$sql = $sql . "'" . $Cust_ID . "',";
	$sql = $sql . "'" . test_input ( $_POST ["spcode"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["resellercn"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["salesrep"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["resellerrefid"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["requestedbuilt"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["requestedinservice"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["orsooner"] ) . "',";
	$sql = $sql . "'" . test_input ( $_POST ["addtoexistingcustomer"] ) . "')";
	
	return $sql;
}
function test_input($data) {
	$data = trim ( $data );
	$data = stripslashes ( $data );
	$data = htmlspecialchars ( $data );
	return $data;
}



function sendOrderAlertEmail($orderNumber,$orderUtils){

	$mail = getMailer();
	$message = '
	Order Number ' . $orderNumber . '
	Details: 
		<br><br>' .
	'Reseller Name: ' .	test_input($_POST["resellername"]) . '<br>' .
	'Telephone Number: ' .	test_input($_POST["telephonenumber"]) . '<br>' .
	'Email Address: ' . 	test_input($_POST["emailaddress"]) . '<br>' .
	'Reseller Contact Name: ' . 	test_input($_POST["resellercn"]) . '<br>' .
	'Salesrep: ' . 	test_input($_POST["salesrep"]) . '<br>' .
	'Reseller Reference ID: ' . 	test_input($_POST["resellerrefid"]) . '<br>' .
	'Requested built by date: ' . 	test_input($_POST["requestedbuilt"]) . '<br>' .
	'Requested inservice by date: ' . 	test_input($_POST["requestedinservice"]) . '<br>' .
	'Or sooner: ' . 	test_input($_POST["orsooner"]) . '<br>' .
	'Add to existing customer: ' . 	test_input($_POST["addtoexistingcustomer"]) . '<br>' .
	'Emergency provisioning required: ' . 	test_input($_POST["emergprovisionrequired"]) . '<br>' .
	'End user name: ' . 	test_input($_POST["endusername"]) . '<br><br>' .
	'<b>Emergency information</b>:<br>' .
	'Telephone: ' . 	test_input($_POST["cmtelephone"]) . '<br>' .
	'Address 1: ' . 	test_input($_POST["emergaddress1"]) . '<br>' .
	'Address 2: ' . 	test_input($_POST["emergaddress2"]) . '<br>' .
	'City: ' . 	test_input($_POST["emergcity"]) . '<br>' .
	'Emergstate: ' . 	test_input($_POST["emergstate"]) . '<br>' .
	'Emergzipcode: ' . 	test_input($_POST["emergzipcode"]) . '<br>' .
	'Emergphonenumber: ' . 	test_input($_POST["emergphonenumber"]) . '<br>' .
	'Customertimezone: ' . 	test_input($_POST["customertimezone"]) . '<br>' .
	'Accountnumber: ' . 	test_input($_POST["accountnumber"]) . '<br>' .
	'Spcode: ' . 	test_input($_POST["spcode"]) . '<br>' .
	'Order Details:<br>' . 	test_input($_POST["orderdetails"]) . '<br>'
	. '<br><br>'
	;
	
	$result = $orderUtils->getResellerItems($_POST["spcode"]);
	while($row  = $result->fetch_array()){
		$itemName = $row["USOC"];
		$quantity = $_POST[$itemName];
		if($quantity > 0){
			$message = $message . $quantity . " "; 
			$message = $message . $itemName . "<br>"; 
		}
		
	}
	
	$mail->SetFrom('noreply@redrocktelecom.com', 'Web App');
	$mail->Subject = 'Order Number: ' . $orderNumber;
	$mail->MsgHTML($message);
	$mail->AddAddress("ops@redrocktelecom.com");
	
	if($mail->Send()) {
		//echo "Message sent!";
	} else {
		//echo "Mailer Error: " . $mail->ErrorInfo;
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

?>