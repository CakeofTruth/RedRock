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
	$resellercn = test_input($_POST["resellercn"]);
	$salesrep = test_input($_POST["salesrep"]);
	$accountnumber = test_input($_POST["accountnumber"]);
	$spcode = test_input($_POST["spcode"]);
	$endusername = test_input($_POST["endusername"]);
	$cmtelephone= test_input($_POST["cmtelephone"]);
	$resellerrefid = test_input($_POST["resellerrefid"]);
	$requestedbuilt = test_input($_POST["requestedbuilt"]);
	$requestedinservice = test_input($_POST["requestedinservice"]);
	$orsooner = test_input($_POST["orsooner"]);
	$addtoexistingcustomer = test_input($_POST["addtoexistingcustomer"]);
	$customertimezone = test_input($_POST["customertimezone"]);
	$emergprovisionrequired = test_input($_POST["emergprovisionrequired"]);
	$emergaddress1 = test_input($_POST["emergaddress1"]);
	$emergaddress2 = test_input($_POST["emergaddress2"]);
	$emergcity = test_input($_POST["emergcity"]);
	$emergstate = test_input($_POST["emergstate"]);
	$emergzipcode = test_input($_POST["emergzipcode"]);
	$emergphonenumber = test_input($_POST["emergphonenumber"]);
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>
<?php 
echo $resellername;
echo "<br>";
echo $resellerba1;
echo "<br>";
echo $resellerba2;
echo "<br>";
echo $city;
echo "<br>";
echo $state;
echo "<br>";
echo $zipcode;
echo "<br>";
echo $telephonenumber;
echo "<br>";
echo $emailaddress;
echo "<br>";
echo $resellercn;
echo "<br>";
echo $salesrep;
echo "<br>";
echo $accountnumber;
echo "<br>";
echo $spcode;
echo "<br>";
echo $endusername;
echo "<br>";
echo $cmtelephone;
echo "<br>";
echo $resellerrefid;
echo "<br>";
echo $requestedbuilt;
echo "<br>";
echo $requestedinservice;
echo "<br>";
echo $orsooner;
echo "<br>";
echo $addtoexistingcustomer;
echo "<br>";
echo $customertimezone;
echo "<br>";
echo $emergprovisionrequired;
echo "<br>";
echo $emergaddress1;
echo "<br>";
echo $emergaddress2;
echo "<br>";
echo $emergcity;
echo "<br>";
echo $emergstate;
echo "<br>";
echo $emergzipcode;
echo "<br>";
echo $emergphonenumber;
?>
<?php
 $servername = "localhost";
 $dbusername = "root";
 $dbpassword = "potato";
 $dbname = "RedRock_Cake";
 
 // Create connection
 $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
 // Check connection
 if ($conn->connect_error) {
 	die("Connection failed: " . $conn->connect_error);
 }
 else{
 	echo 'Connection successful <br>';
 }
 
 $sqlInsertString = generateSqlString();
 
 echo 'Executing: ' . $sqlInsertString . '<br>';
  
  if (mysqli_query($conn, $sqlInsertString )) {
  	echo "New record created successfully";
 	$lastinsert = $conn -> insert_id;
 	echo "Inserted record " . $lastinsert . '<br>';
  } else {
  	echo "Error: " . $sqlInsertString . "<br>" . mysqli_error($conn);
  }
  
 $selectString = "select Serv_Prov_CD, Address1, Address2, City, State, Zip, Phone, Company_Name, Reseller_Ref_ID from Resellers";
 
 $result = $conn->query($selectString);
 
 if ($result->num_rows > 0) {
 	// output data of each row
 	while($row = $result->fetch_assoc()) {
 		echo "Serv_Prov_CD: " . $row["Serv_Prov_CD"] . 
 			 " Address1: " . $row["Address1"] . 
 			 " Address2: " . $row["Address2"] . 
 			 " City: " . $row["City"] . 
 			 " State: " . $row["State"] .
 			 " Zip: " . $row["Zip"] .
 			 " Phone: " . $row["Phone"] .
 			 " Company_Name: " . $row["Company_Name"] .
 			 " Reseller_Ref_ID: " . $row["Reseller_Ref_ID"] .
 			 "<br>";
 	}
 } else {
 	echo "0 results";
 }
 
 
  $conn->close();
  
  $selectString = "select Reseller_Ref_ID, End_User_Name, Cust_Telephone, Request_Built, Request_In_Serv, Or_Sooner, Add_To_Existing, Customer_Time_Zone, Order_No from Customers";
  
  $result = $conn->query($selectString);
  
  if ($result->num_rows > 0) {
  	// output data of each row
  	while($row = $result->fetch_assoc()) {
  		echo "Reseller_Ref_ID: " . $row["Reseller_Ref_ID"] .
  		" End_User_Name: " . $row["End_User_Name"] .
  		" Cust_Telephone: " . $row["Cust_Telephone"] .
  		" Request_Built: " . $row["Request_Built"] .
  		" Request_In_Serv: " . $row["Request_In_Serv"] .
  		" Or_Sooner: " . $row["Or_Sooner"] .
  		" Add_To_Existing: " . $row["Add_To_Existing"] .
  		" Customer_Time_Zone: " . $row["Customer_Time_Zone"] .
  		" Order_No: " . $row["Order_No"] .
  		"<br>";
  	}
  } else {
  	echo "0 results";
  }
  
  
  $conn->close();
  
  $selectString = "select Emerg_Prov, Emerg_Address_1, Emerg_Address_2, Emerg_City, Emerg_State, Emerg_Zip, Emerg_Phone, Order_Details from Orders";
  
  $result = $conn->query($selectString);
  
  if ($result->num_rows > 0) {
  	// output data of each row
  	while($row = $result->fetch_assoc()) {
  		echo "Emerg_Prov: " . $row["Emerg_Prov"] .
  		" Emerg_Address_1: " . $row["Emerg_Address_1"] .
  		" Emerg_Address_2: " . $row["Emerg_Address_2"] .
  		" Emerg_City: " . $row["Emerg_City"] .
  		" Emerg_State: " . $row["Emerg_State"] .
  		" Emerg_Zip: " . $row["Emerg_Zip"] .
  		" Emerg_Phone: " . $row["Emerg_Phone"] .
  		" Order_Details: " . $row["Order_Details"] .
  		"<br>";
  	}
  } else {
  	echo "0 results";
  }
  
  
  $conn->close();
  
  function generateSqlString(){
 	$sql = 'INSERT INTO Accounts (Serv_Prov_CD, Address1, Address2, City, State, Zip, Phone, Company_Name, Reseller_Ref_ID) VALUES(';
 	$sql = $sql . "'" . test_input($_POST["spCode"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["resellerBA1"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["resellerBA2"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["city"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["state"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["zipCode"]) . "')";
 	$sql = $sql . "'" . test_input($_POST["telephoneNumber"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["resellerName"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["resellerrefid"]) . "',";
 	
 	return $sql;
 }
 
 function generateSqlString(){
 	$sql = 'INSERT INTO Accounts (Reseller_Ref_ID, End_User_Name, Cust_Telephone, Request_Built, Request_In_Serv, Or_Sooner, Add_To_Existing, Customer_Time_Zone, Order_No) VALUES(';
 	$sql = $sql . "'" . test_input($_POST["resellerrefid"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["endusername"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["cmtelephone"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["requestedbuilt"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["requestedinservice"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["orsooner"]) . "')";
 	$sql = $sql . "'" . test_input($_POST["addtoexistingcustomer"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["customertimezone"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["orderno"]) . "',";
 
 	return $sql;
 }
 
 function generateSqlString(){
 	$sql = 'INSERT INTO Accounts (Order_No, Emerg_Prov, Emerg_Address_1, Emerg_Address_2, Emerg_City, Emerg_State, Emerg_Zip, Emerg_Phone, Order_Details) VALUES(';
 	$sql = $sql . "'" . test_input($_POST["orderno"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["emergprovrequired"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["emergaddress1"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["emergaddress2"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["emergcity"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["emergstate"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["emergzipcode"]) . "')";
 	$sql = $sql . "'" . test_input($_POST["emergphonenumber"]) . "',";
 	$sql = $sql . "'" . test_input($_POST["orderdetails"]) . "',";

 	return $sql;
 }
 
 ?>