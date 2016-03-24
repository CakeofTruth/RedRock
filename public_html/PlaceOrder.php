<?php if ( empty ( $_POST )) : ?>
	<?php include("CustomerOrderForm.php"); ?>
<?php else: ?>
	<?php include("OrderConfirm.php"); ?>
<?php endif; ?>