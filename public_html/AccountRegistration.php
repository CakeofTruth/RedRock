<?php if ( empty ( $_POST )) : ?>
	<?php include("AccountRegistrationForm.php"); ?>
<?php else: ?>
	<?php include("AccountRegistrationConfirm.php"); ?>
<?php endif; ?>