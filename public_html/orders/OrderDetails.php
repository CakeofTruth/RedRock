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


$dbutils = new DBUtils();
$conn = $dbutils->getDBConnection ();

if(isset($_GET["orderNumber"])){
   //check if order belongs to whoever's logged in
    $orderNumber = $_GET["orderNumber"];
    if(isThisYourOrder($orderNumber,$_SESSION["Acct_No"],$conn) OR $_SESSION["Approver"] == "1"){
        echo "Include dat page yo <br>";
        setDetailVariables();
        echo $var1 . "<br>";
        echo $var2 . "<br>";
        echo $var3 . "<br>";
        echo $var4 . "<br>";
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
