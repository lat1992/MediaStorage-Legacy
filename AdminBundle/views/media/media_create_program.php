<?php

require_once('ClientBundle/views/layout/header.php');

?>

	<script src="AdminBundle/ressources/media/js/media.js"></script>
	<script src="AdminBundle/ressources/fine-uploader/fine-uploader.js"></script>

	<link rel="stylesheet" href="CoreBundle/ressources/layout/css/form.css">
	<link rel="stylesheet" href="AdminBundle/ressources/fine-uploader/fine-uploader-new.css">

	<div id="container">

		<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

		<h2><?= MEDIA ?></h2>

		<?php require_once('AdminBundle/views/media/media_create_form.php'); ?>

		<hr />

		<h2><?= MEDIA_INFO ?></h2>

		<?php require_once('AdminBundle/views/media/media_info_create_form.php'); ?>

		<hr />

		<input type="hidden" name="id_media_create_mediastorage" value="895143" />

		<a id="cancel_button" class="form_button" href="?page=list_program_admin"><?= CANCEL ?></a>
		<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>

		<?php require_once('AdminBundle/views/media_file/media_file_upload_form.php'); ?>

		<?php require_once('AdminBundle/views/media_file/media_file_list_form.php'); ?>

		</form>

	</div>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>
