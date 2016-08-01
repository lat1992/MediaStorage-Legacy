<?php 

require_once('/CoreBundle/views/layout/header.php');

?>

<span><?= USER_CREATION_TITLE ?></span>

<div>

<?php
	if (isset($errors_user_create)) {

		foreach ($errors_user_create as $error) {
			echo '<span>' . $error . '</span><br />';
		}
	}
?>

</div>

<div>
	
	<?php require_once('/CoreBundle/views/user/user_create_form.php'); ?>

</div>

<?php 

require_once('/CoreBundle/views/layout/footer.php');

?>
