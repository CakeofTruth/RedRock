<?php if ( empty ( $_POST )) : ?>
	<?php include("CustomerOrderForm.php"); ?>
<?php else: ?>
	<?php include("ItemOrderForm.php"); ?>
<?php endif; ?>