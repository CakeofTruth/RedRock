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