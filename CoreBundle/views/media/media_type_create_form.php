<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
	<label for="type_mediastorage"><?= TYPE ?></label>
	<input type="text" name="type_mediastorage" id="type_mediastorage" value="<?= (isset($media_type['type'])) ? $media_type['type'] : '' ?>" /><br />

	<input type="hidden" name="id_media_type_create_mediastorage" value="984156" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>