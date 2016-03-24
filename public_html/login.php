<?php if ( empty ( $_POST )) : ?>
	<?php include("LoginForm.php"); ?>
<?php else: ?>
	<?php include("LoginConfirm.php"); ?>
<?php endif; ?>