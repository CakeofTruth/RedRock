<?php 
$pagetitle = "Portal";
include ($_SERVER ["DOCUMENT_ROOT"] . '/portal/header.php');
?>

	<div id="menu">
		<ul>
			<li><a href="portal.php"><font color="#21B6A8">Home</font></a></li>
			<li><a href="/orders/PlaceOrder.php"><font color="#21B6A8">Place an Order</font></a></li>
			<?php if($_SESSION["Approver"] != 1){
				echo "<li><a href='/orders/OrderManagement.php'><font color='#21B6A8'>View Orders</font></a></li>";
			}?>
		</ul>
	</div>
	<div class="content">Approver status: <?php $_SESSION["Approver"]?></div>
</body>
</html>
