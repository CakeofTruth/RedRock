<!DOCTYPE html>
<html> 
	<head> 
		<title> Customer Order Form </title>
<link rel='stylesheet' id='custom-css'  href='/css/contactform.css' type='text/css' media='all' />
	<style>
		body {
			text-align:center;
			}
		form {
			display: inline-block;
			text-align: center;		
			}
	</style>
	</head>
	<body>
<?php 

	include ($_SERVER ["DOCUMENT_ROOT"] . '/portal/portalheader.php');
	
	include_once $root . '/classes/DBUtils.php';
	
	//$resellerSelect = "generateResellersSelectString("HCON");//Will eventually be a $_SESSION variable
	$dbutils = new DBUtils();
	$conn = $dbutils->getDBConnection();

	$resellerResult = $conn->query ( $resellerSelect );
	
	if ($resellerResult->num_rows > 0) {
		$resellerRow = $resellerResult->fetch_assoc () ;
	}
	else{
		echo "Reseller not found";	
	}
	
	$accountsSelect = generateAccountsSelectString("3");
	$accountResult = $conn->query ( $accountsSelect );
	
	if ($accountResult->num_rows > 0) {

		$accountRow = $accountResult->fetch_assoc () ;
	}
	else{
		echo "Account not found";	
	}
	
?>
		<!--<label for='uploaded_file'>Select A File To Upload:</label>
		input type="file" name="uploaded_file"-->
		<h3>Red Rock Telecommunications</h3>
		<h4>Customer Order Form</h4>
		<h5>Reseller Contact Information</h5>
		<br><br>
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post" enctype="multipart/form-data">
		<input type="submit" value="Next">
        <label for="name">Reseller Name:</label>
        	<input type="text" name="resellername" value="<?php echo $resellerRow["Company_Name"];?>" readonly>
		
		<label for="resellerba1">Reseller Billing Address 1:</label>
 			<input type="text" name="resellerba1" value="<?php echo $resellerRow["Address1"];?>" readonly>
 		
 		<label for="resellerba2">Reseller Billing Address 2:</label>
 			<input type="text" name="resellerba2" value="<?php echo $resellerRow["Address2"];?>" readonly>
 		
 		<label for="city">City:</label>
 			<input type="text" name="city" value="<?php echo $resellerRow["City"];?>" readonly>
 		
 		<label for="state">State:</label>	
 			<input type="text" name="state" value="<?php echo $resellerRow["State"];?>" readonly>
 			
 		<label for="zipcode">Zip Code:</label>
 			<input type="text" name="zipcode" value="<?php echo $resellerRow["Zip"];?>" readonly>
 		
 		<label for="telephonenumber">Telephone Number:</label>
 			<input type="text" name="telephonenumber" value="<?php echo $resellerRow["telephonenumber"];?>" readonly>
 			
 		<label for="emailaddress">Email Address:</label>
 			<input type="text" name="emailaddress" value="<?php echo $accountRow["emailaddress"];?>" readonly>
 			
		<label for="telephone">Telephone: </label>
			<input type="tel" id="telephone" name="telephone" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['Phone'] : '' ?>" />
 
 		<label for="resellercn">Reseller Contact Name: </label>
 			<input type="text" name="resellercn" value="<?php echo $accountRow["First_Name"]; echo " " . $accountRow["Last_Name"]?>">
 			
 		<label for="salesrep">Sales Representative: </label>
 			<select id="salesrep">
						<option value = ""> Select a Sales Representative</option>
						<option value = "Breanda Beall"> Brenda Beall </option>
						<option value = "other"> Other </option> 
					</select>
		
		<label for="accountnumber">Account Number: </label>
			<input type="text" name="accountnumber" value="<?php echo $accountRow["Acct_No"];?>" readonly>
		
		<label for="spcode">Service Provider Code: </label>
			<input type="text" name="spcode" value="<?php echo $resellerRow["Serv_Prov_CD"];?>" readonly>
		
		<h5>Customer Information</h5>
		
		<label for="endusername">End User Customer Name: <span class="required">*</span></label>
			<input type="text" name="endusername" required="required"><?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['endusername'] : '' ?>
		
		<label for="cmtelephone">Billing Telephone Number: <span class="required">*</span></label>
			<input type="text" name="cmtelephone" required="required"><?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['message'] : '' ?>
			
		<label for="resellerrefid">Reseller Reference ID: </label>
			<input type="text" name="resellerrefid">
			
		<label for="requestedbuilt">Requested Built/Service Provisioned Date: <span class="required">*</span></label>
			<input type="date" name= "requestedbuilt" required="required"><?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['message'] : '' ?>
			
		<label for="requestedinservice">Requested In Service/Effective Billing Date: <span class="required">*</span></label>
			<input type="date" name= "requestedbuilt" required="required"><?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['message'] : '' ?>
			
		<label for="orsooner">Or Sooner: </label>
				<input type="radio" name="orsooner" value= "Yes" checked="checked"> Yes
				<input type="radio" name="orsooner" value= "No"> No<br>
		
		<label for="addtoexistingcustomer"> Add to Existing Customer:</label>
			<input type="radio" name="addtoexistingcustomer" value= "Yes"> Yes
			<input type="radio" name="addtoexistingcustomer" value= "No" checked="checked"> No<br>
		
		<label for="customertimezone"> Customer Time Zone:</label>
			<select name="customertimezone">
						<option value = "customertimezone"> Customer Time Zone </option>
						<option value = "easterntimezone"> Eastern Time Zone </option>
						<option value = "centraltimezone"> Central Time Zone </option>
						<option value = "mountaintimezone" selected> Mountain Time Zone </option>
						<option value = "arizonatimezone"> Arizona Time Zone </option>
						<option value = "pacifictimezone"> Pacific Time Zone </option>
						<option value = "alaskatimezone"> Alaska Time Zone </option>
						<option value = "hawaiialeutiantimezone"> Hawaii-Aleutian Time Zone </option>
					</select>
			
		<h5>Service/911 Addresses</h5>
		
		<label for="emergprovisionrequired">Does this order require that 911 be provisioned per the data provided below?<span class="required">*</span></label>
			<input type="radio" name="emergprovisionrequired"  value= "Yes" checked="checked"> Yes
			<input type="radio" name="emergprovisionrequired" value= "No"> No<br>
		
		<label for="emergaddress1">Service/911 Address 1:</label>
			<input type="text" name= "emergaddress1">
			
		<label for="emergaddress2"> Service/911 Address 2:</label>
			<input type="text" name= "emergaddress2">
			
		<label for="emergcity">City:</label>
			<input type="text" name= "emergcity">
			
		<label for="emergstate">State:</label>
			<select name="emergstate">
						<option value= "Alabama">AL</option>
						<option value= "Alaska">AK</option>
						<option value= "Arizona">AZ</option>
						<option value= "Arkansas">AR</option>
						<option value= "California">CA</option>
						<option value= "Colorado">CO</option>
						<option value= "Connecticut">CT</option>
						<option value= "Delaware">AL</option>
						<option value= "District of Columbia">DC</option>
						<option value= "Florida">FL</option>
						<option value= "Georgia">GA</option>
						<option value= "Hawaii">HI</option>
						<option value= "Idaho">ID</option>
						<option value= "Illinois">IL</option>
						<option value= "Indiana">IN</option>
						<option value= "Iowa">IA</option>
						<option value= "Kansas">KS</option>
						<option value= "Kentucky">KY</option>
						<option value= "Louisiana">LA</option>
						<option value= "Maine">ME</option>
						<option value= "Maryland">MD</option>
						<option value= "Massachusetts">MA</option>
						<option value= "Michigan">MI</option>
						<option value= "Minnesota">MN</option>
						<option value= "Mississippi">MS</option>
						<option value= "Missouri">MO</option>
						<option value= "Montana">MT</option>
						<option value= "Nebraska">NE</option>
						<option value= "Nevada">NV</option>
						<option value= "New Hampshire">NH</option>
						<option value= "New Jersey">NJ</option>
						<option value= "New Mexico">NM</option>
						<option value= "New York">NY</option>
						<option value= "North Carolina">NC</option>
						<option value= "North Dakota">ND</option>
						<option value= "Ohio">OH</option>
						<option value= "Oklahoma">OK</option>
						<option value= "Oregon">OR</option>
						<option value= "Pennsylvania">PA</option>
						<option value= "Rhode Island">RI</option>
						<option value= "South Carolina">SC</option>
						<option value= "South Dakota">SD</option>
						<option value= "Tennessee">TN</option>
						<option value= "Texas">TX</option>
						<option value= "Utah">UT</option>
						<option value= "Vermont">VT</option>
						<option value= "Virginia">VA</option>
						<option value= "Washington">WA</option>
						<option value= "West Virginia">WV</option>
						<option value= "Wisconsin">WI</option>
						<option value= "Wyoming">WY</option>
				</select>
				
		<label for="emergzipcode">Zip Code:</label>
			<input type="text" name= "emergzipcode">
			
		<label for="emergzipcode"> 911 Phone Number:</label>
			<input type="text" name="emergphonenumber">
		
 		<h5>Order Details</h5>
		<label for="message">Order Details: <span class="required">*</span></label>
			<textarea rows="4" cols="50" id="orderdetails" name="orderdetails" placeholder="Your message must be greater than 20 characters" 
			required="required" data-minlength="20"><?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['message'] : '' ?></textarea>
 				<span id="loading"></span>
				<input type="submit" value="Submit" id="submit-button" />
				<p id="req-field-desc"><span class="required">*</span> indicates a required field</p>
    </form>
	<!--<?php 
			$name_of_uploaded_file =
				basename($_FILES['uploaded_file']['name']);
			$type_of_uploaded_file =
				substr($name_of_uploaded_file,
				strrpos($name_of_uploaded_file, '.') +1);
			$size_of_uploaded_file =
				$_FILES["uploaded_file"]["size"]/1024;
			$max_allowed_file_size = 500;
			$allowed_extensions = array("jpg", "jpeg", "doc", "pdf", "docx", "xls", "xlsx", "csv");
			if($size_of_uploaded_file > $max_allowed_file_size)
			{
				$errors .= "\n Size of file should be less than $max_allowed_file_size";
			}
			$allowed_ext = false;
			for ($i=0; $i<sizeof($allowed_extensions); $i++)
			{
				if(strcasecmp($allowed_extensions[$i],$type_of_uploaded_file) == 0)
				{
					$allowed_ext = true;
				}
			}
			if(!$allowed_ext)
			{$errors .="\n The uploaded file is not a supported file type.".
			"Only the following file types are supported: ".implode(',',$allowed_extensions);
			}
			$path_of_uploaded_file = $upload_folder . $name_of_upload_file;
			$tmp_path = $_FILES["uploaded_file"]["tmp_name"];
			if(is_uploaded_file($tmp_path))
			{
				if(!copy($tmp_path,$path_of_uploaded_file))
				{
					$errors .= '\n Error while copying the uploaded file';
				}
			}
			//http://www.html-form-guide.com/email-form/php-email-form-attachment.html guide for php email form attachment//
		?> -->
	</body>
</html>
<?php 

function generateResellersSelectString($reseller) {
	$sql = "SELECT `Serv_Prov_CD`, `Address1`, `Address2`, `City`, `State`, `Zip`, `Phone`, `Company_Name`, `Tier` FROM `Resellers`  
			WHERE SERV_PROV_CD = '" . $reseller . "'";		
	return $sql;
}
function generateAccountsSelectString ($Acct_No) {
	$sql = "Select Email ,First_Name, Last_Name, Acct_No FROM Accounts
			WHERE Acct_No = '" . $Acct_No . "'";
	return $sql;
}
?>
</body>