<?php 

require_once('CoreBundle/views/layout/header.php');

require_once('CoreBundle/views/layout/menu.php');

?>

<span><?= USER_EDIT_TITLE ?></span>

<div>
	
	<?php require_once('CoreBundle/views/user/user_create_form.php'); ?>

</div>

<?php 

require_once('CoreBundle/views/layout/footer.php');

?>
