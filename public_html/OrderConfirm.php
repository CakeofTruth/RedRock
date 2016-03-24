<?php
$resellername = $resellerba1 = $resellerba2 = $city = $state =$zipcode = $telephonenumber = $emailaddress = $resellercn = $salesrep = $accountnumber = $spcode = 
$endusername = $cmtelephone = $resellerrefid = $requestedbuilt = $requestedinservice = $orsooner = $addtoexistingcustomer = $customertimezone = $emergprovisionrequired = 
$emergaddress1 = $emergaddress2 = $emergcity = $emergstate =$emergzipcode = $emergphonenumber = "";

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
echo $resellername; echo "<br>"; echo $resellerba1; echo "<br>"; echo $resellerba2; echo "<br>"; echo $city; echo "<br>"; echo $state;
echo "<br>"; echo $zipcode; echo "<br>"; echo $telephonenumber; echo "<br>"; echo $emailaddress; echo "<br>"; echo $resellercn; echo "<br>";
echo $salesrep; echo "<br>"; echo $accountnumber; echo "<br>"; echo $spcode; echo "<br>"; echo $endusername; echo "<br>"; echo $cmtelephone;
echo "<br>"; echo $resellerrefid; echo "<br>"; echo $requestedbuilt; echo "<br>"; echo $requestedinservice; echo "<br>"; echo $orsooner;
echo "<br>"; echo $addtoexistingcustomer; echo "<br>"; echo $customertimezone; echo "<br>"; echo $emergprovisionrequired; echo "<br>";
echo $emergaddress1; echo "<br>"; echo $emergaddress2; echo "<br>"; echo $emergcity; echo "<br>"; echo $emergstate; echo "<br>";
echo $emergzipcode; echo "<br>"; echo $emergphonenumber;
?>

<?php
 $conn = getDBConnection();
 
 $customerInsertString = generateCustomerInsertString();
 
 echo 'Executing: ' . $customerInsertString . '<br>';
  
  if (mysqli_query($conn, $customerInsertString )) {
  	echo "New record created successfully";
 	$customerID = $conn -> insert_id;
 	echo "Inserted record " . $customerID . '<br>';
 	$orderInsertString = generateOrderInsertString($customerID);
 	$orderInsertSuccess = mysqli_query($conn, $orderInsertString);
	if($orderInsertSuccess){
		echo "Order Inserted Successfulylylylyl?";	
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
 

function getDBConnection() {
	$servername = "localhost";
	$dbusername = "root";
	$dbpassword = "potato";
	$dbname = "RedRock_Cake";
	
	// Create connection
	$conn = new mysqli ( $servername, $dbusername, $dbpassword, $dbname );
	// Check connection
	if ($conn->connect_error) {
		die ( "Connection failed: " . $conn->connect_error );
	} else {
		return $conn;
	}
}
 
 ?>