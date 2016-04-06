<?php 
	
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');

	if ( empty ( $_POST )) {
		echo "this isn't going to work<br>";	
	}
	else{
		echo "this might work <br>";
	}
		
	include_once $root . '/classes/DBUtils.php';

	$result = getResellerItems($_POST["spcode"]);

	if ($result->num_rows > 0) {
		echo "found some stuff";
	}
	else{
		echo "didn't find any product information";
	}
?>
<!DOCTYPE html>
<html>
	<head>
	<title> Red Rock Ordering System </title>
	<style>
	h1 {
		font-size: 50px; 
		number-align: center;
	}
	table {
		margin: 0 auto;
	}
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}
	table {
		width: 70%;
	}
	th {
    height: 20px;
	}
	tr:hover {
	background-color: #ff8080
	}
	tr:nth-child(even) {
	background-color: #B3C6FF
	}
	</style>
	</head>
	<body>
	<h1> Red Rock Ordering System </h1>
		<img src= " C:\Users\Rae\Pictures\Red Rock Logo.jpg" style= "float:left;"/>
		<form action="OrderForm.php" method="post">	
		<table>
			<thead>
				<tr>
					<th> Amount </th>
					<th> USOC </th>
					<th> Description </th>
					<th> MRC </th>
					<th> NRC </th>
				</tr>
			</thead>
			<tbody>
				<?php 
					while($row  = $result->fetch_array()){
						echo 'is tacos on tuesdays';
						
						$rowhtml = '<tr>'
							. '<td> <input type="number" name="' . $row["USOC"] . '"> </td>'
							. '<td>' . $row["USOC"] . "</td>" 
							. '<td>' . $row["One_Time_Charge"] . "</td>" 
							. '<td>' . $row["Recurring_Price"] . "</td>"
							. '</tr>';
						echo $rowhtml;
					}
				

				?>
			</table>
			<input type="submit" value="Submit">
		</form>
	</body>
</html>


<?php 
	function getResellerItems($spcode){
		$sql = "select RP.USOC as USOC, P.One_Time_Charge as One_Time_Charge, P.Recurring_Price as Recurring_Price
		from Prices P join ResellerProducts RP on P.USOC = RP.USOC
		where RP.Reseller =\"" . $spcode . "\"";
			
		$dbutils = new DBUtils();
		$conn = $dbutils->getDBConnection();
		return $conn->query ( $sql);
	}
?>