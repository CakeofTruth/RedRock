<?php
$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root . '/classes/DBUtils.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$resellername = test_input($_POST["resellername"]);
	$resellerba1 = test_input($_POST["resellerba1"]);
	$resellerba2 = test_input($_POST["resellerba2"]);
	$city = test_input($_POST["city"]);
	$state = test_input($_POST["state"]);
	$zipcode = test_input($_POST["zipcode"]);
	$telephonenumber = test_input($_POST["telephonenumber"]);
	$emailaddress = test_input($_POST["emailaddress"]);
	/***********************************************************************/
	$resellercn = test_input($_POST["resellercn"]);//order
	$salesrep = test_input($_POST["salesrep"]);//order
	$resellerrefid = test_input($_POST["resellerrefid"]);//order
	$requestedbuilt = test_input($_POST["requestedbuilt"]);//order
	$requestedinservice = test_input($_POST["requestedinservice"]);//order
	$orsooner = test_input($_POST["orsooner"]);//order
	$addtoexistingcustomer = test_input($_POST["addtoexistingcustomer"]);//order
	$emergprovisionrequired = test_input($_POST["emergprovisionrequired"]);//order
	/***********************************************************************/
	$endusername = test_input($_POST["endusername"]);//customer
	$cmtelephone= test_input($_POST["cmtelephone"]);//customer
	$emergaddress1 = test_input($_POST["emergaddress1"]);//Customer
	$emergaddress2 = test_input($_POST["emergaddress2"]);//Customer
	$emergcity = test_input($_POST["emergcity"]);//Customer
	$emergstate = test_input($_POST["emergstate"]);//Customer
	$emergzipcode = test_input($_POST["emergzipcode"]);//Customer
	$emergphonenumber = test_input($_POST["emergphonenumber"]);//Customer
	$customertimezone = test_input($_POST["customertimezone"]);
	$accountnumber = test_input($_POST["accountnumber"]);
	$spcode = test_input($_POST["spcode"]);
	/***********************************************************************/
	
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>
<?php 

?>

<?php
 
	$dbutils = new DBUtils();
	$conn = $dbutils->getDBConnection();
 
 $customerInsertString = generateCustomerInsertString();
 
 //echo 'Executing: ' . $customerInsertString . '<br>';
  
  if (mysqli_query($conn, $customerInsertString )) {
  	//echo "New record created successfully";
 	$customerID = $conn -> insert_id;
 	//echo "Inserted record " . $customerID . '<br>';
 	$orderInsertString = generateOrderInsertString($customerID);
 	$orderInsertSuccess = mysqli_query($conn, $orderInsertString);
	if($orderInsertSuccess){
		echo "Order Created Successfully!  <br>";	
		echo '<a href= "/portal/portal.php">Return to portal</a>';	
		//echo  "<script> window.setTimeout(location.href = \"" . $root . "/portal/portal.php" . "\",5000) </script>";
	}
	else{
		echo "Error inserting Order information: " . mysqli_error($conn);
	}
  } else {
  	echo "Error: " . $customerInsertString . "<br>" . mysqli_error($conn);
  }
  
  $conn->close();
  
  function generateCustomerInsertString(){

 	$sql = 'INSERT INTO Customers (End_User_Name, Cust_Telephone, Emerg_Address_1, Emerg_Address_2, Emerg_City, Emerg_State, Emerg_Zip, Emerg_Phone,Customer_Time_Zone) VALUES(';
 	$sql = $sql . "'" . test_input($_POST["endusername"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["cmtelephone"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["emergaddress1"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["emergaddress2"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["emergcity"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["emergstate"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["emergzipcode"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["emergphonenumber"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["customertimezone"]) . "'";
	$sql = $sql . ")";

 	return $sql;
 }
 
 function generateOrderInsertString($Cust_ID){
	$resellercn = test_input($_POST["resellercn"]);//order
	$salesrep = test_input($_POST["salesrep"]);//order
	$resellerrefid = test_input($_POST["resellerrefid"]);//order
	$requestedbuilt = test_input($_POST["requestedbuilt"]);//order
	$requestedinservice = test_input($_POST["requestedinservice"]);//order
	$orsooner = test_input($_POST["orsooner"]);//order
	$addtoexistingcustomer = test_input($_POST["addtoexistingcustomer"]);//order
	$emergprovisionrequired = test_input($_POST["emergprovisionrequired"]);//order

 	$sql = 'INSERT INTO Orders (Emerg_Prov_Req, Order_Details, Customer_ID, Serv_Prov_CD, Res_Cont_Name, Sales_Rep, 
			Reseller_Ref_ID, Request_Built, Request_Service, Or_Sooner, Add_Exist_Cust) VALUES(';
 	$sql = $sql . "'" . test_input($_POST["emergprovisionrequired"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["orderdetails"]) . "',";
 	$sql = $sql . "'" . $Cust_ID . "',";
 	$sql = $sql . "'" . test_input($_POST["spcode"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["resellercn"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["salesrep"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["resellerrefid"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["requestedbuilt"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["requestedinservice"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["orsooner"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["addtoexistingcustomer"]) . "')";
 
 	return $sql;
 }
 
 ?>