<?php

require_once('ClientBundle/views/layout/header.php');

?>

	<script src="AdminBundle/ressources/media/js/media.js"></script>
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

	<div id="container">

		<form class="full-width-form" id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

		<div class="left-block-form">

		<h2><?= MEDIA ?></h2>
<?php 
		$path = "";
		if (isset($_GET['media_id'])) {
			$path = "?page=upload_content_thumbnail_admin&media_id=" . $_GET['media_id'];
		}
		$type = "content";

		require_once('AdminBundle/views/media/media_create_form.php');
?>
		<br />

		<h2><?= MEDIA_INFO ?></h2>

		<?php require_once('AdminBundle/views/media/media_info_create_form.php'); ?>

		<br />
		<br />

		<input type="hidden" name="id_media_create_mediastorage" value="895143" />

		<div class="hide-mobile">
			<a id="cancel_button" class="form_button" href="?page=list_content_admin"><?= CANCEL ?></a>
			<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>
		</div>

		</div>
		<div class="right-block-form">

		<h2><?= LINKED_FILE ?></h2>

		<?php

			if (isset($media_files_linked)) {
				require_once('AdminBundle/views/media_file/media_file_with_id_list_form.php');
			}
			else {
				require_once('AdminBundle/views/media_file/media_file_with_id_list_array_form.php');
			}
		?>
		<br />
<?php /*
		<h2><?= UPLOAD ?></h2>

		<?php require_once('AdminBundle/views/media_file/media_file_upload_form.php'); ?>

		<?php require_once('AdminBundle/views/media_file/media_file_list_form.php'); ?>
*/ ?>
		</div>

		<div class="hide-desktop">
			<a id="cancel_button" class="form_button" href="?page=list_content_admin"><?= CANCEL ?></a>
			<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>
		</div>

<?php
		if (isset($_POST['media_file_mediastorage']) && count($_POST['media_file_mediastorage'])) {
			foreach ($_POST['media_file_mediastorage'] as $key => $media_file) {
?>
				<input type="hidden" name="media_file_mediastorage[<?= $key ?>][name]" value="<?= $media_file['name'] ?>" />
				<input type="hidden" name="media_file_mediastorage[<?= $key ?>][right_download]" value="<?= $media_file['right_download'] ?>" />
				<input type="hidden" name="media_file_mediastorage[<?= $key ?>][right_preview]" value="<?= $media_file['right_preview'] ?>" />
<?php
			}
		}
?>

		</form>

	</div>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>
