<?php

require_once('ClientBundle/views/layout/header.php');

?>


	<script src="AdminBundle/ressources/folder/js/folder.js"></script>
	<script src="AdminBundle/ressources/fine-uploader/fine-uploader.js"></script>

	<link rel="stylesheet" href="CoreBundle/ressources/layout/css/form.css">
	<link rel="stylesheet" href="AdminBundle/ressources/fine-uploader/fine-uploader-new.css">

	<style>

<?php
	    if (isset($designs)) {

	        foreach ($designs as $design) {
?>
	            <?= $design['selector'] ?> {
	                <?= $design['property'] ?> : <?= $design['value'] ?>;
	            }
<?php
	        }
	    }
?>

	</style>

	<?php require_once('AdminBundle/views/folder/folder_create_form.php'); ?>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>
