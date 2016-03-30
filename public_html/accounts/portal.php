<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Welcome</title>
<link rel="stylesheet" href="portal.css">
</head>
<body>
<div id="welcome">
			<?php echo "Hi, " . $_SESSION["First_Name"]  . " " . $_SESSION["Last_Name"];?>
</div>
	<div id="menu">
		<ul>
			<li><a href="portal.php"><font color="#21B6A8">Home</font></a></li>
			<li><a href="orderform.html"><font color="#21B6A8">Place an Order</font></a></li>
			<?php if($_SESSION["Approver"] != 1){
				echo "<li><a href='" . $root . "/orders/OrderManagement.php'><font color='#21B6A8'>View Orders</font></a></li>";
			}?>
		</ul>
	</div>
	<div class="content"></div>
</body>
</html>
