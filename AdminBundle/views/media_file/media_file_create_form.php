<div style="width: 100%; text-align: center;">
	<form action="<?php echo htmlspecialchars('?page=create_content_by_multiple_files_admin'); ?>" method="POST" id="form_media_file" style="margin: 0 auto">

		<?php require_once('AdminBundle/views/media_file/media_file_upload_form.php'); ?>
<?php /*
		<a href="?page=create_program_admin"><?= CREATE_MEDIA_PROGRAM ?></a>
		<a href="?page=create_content_admin"><?= CREATE_MEDIA_CONTENT ?></a>

		<a href="?page=program"><?= LINK_MEDIA_PROGRAM ?></a>
		<a href="?page=content"><?= LINK_MEDIA_CONTENT ?></a>
*/ ?>
		<button class="button button-multiple-qualification" type="submit"><?= MULTIPLE_QUALIFICATION ?></button>

		<input type="hidden" name="id_media_file_create" value="9732" />

		<?php require_once('AdminBundle/views/media_file/media_file_list_form.php'); ?>

	</form>
</div>