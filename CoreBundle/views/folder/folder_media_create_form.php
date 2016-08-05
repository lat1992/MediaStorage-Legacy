<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

	<label for="id_folder_mediastorage"><?= FOLDER ?></label>
	<select name="id_folder_mediastorage" id="id_folder_mediastorage"/>
<?php
		while ($folder = $folders['data']->fetch_assoc()) {
			echo '<option value="' . $folder['id'] . '" ' . ((intval($folder['id']) == intval($folder_media['id_folder'])) ? ' selected' : '') . '>' . $folder['id'] . '</option>';
		}
?>
	</select>
	<br />

	<label for="id_media_mediastorage"><?= MEDIA ?></label>
	<select name="id_media_mediastorage" id="id_media_mediastorage"/>
<?php
		while ($media = $medias['data']->fetch_assoc()) {
			echo '<option value="' . $media['id'] . '" ' . ((intval($media['id']) == intval($folder_media['id_media'])) ? ' selected' : '') . '>' . $media['id'] . '</option>';
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_folder_media_create_mediastorage" value="84393" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>