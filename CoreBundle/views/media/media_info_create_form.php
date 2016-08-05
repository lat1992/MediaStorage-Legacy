<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
	<label for="title_mediastorage"><?= TITLE ?></label>
	<input type="text" name="title_mediastorage" id="title_mediastorage" value="<?= (isset($media_info['title'])) ? $media_info['title'] : '' ?>" /><br />

	<label for="subtitle_mediastorage"><?= SUBTITLE ?></label>
	<input type="text" name="subtitle_mediastorage" id="subtitle_mediastorage" value="<?= (isset($media_info['subtitle'])) ? $media_info['subtitle'] : '' ?>" /><br />

	<label for="description_mediastorage"><?= DESCRIPTION ?></label>
	<input type="text" name="description_mediastorage" id="description_mediastorage" value="<?= (isset($media_info['description'])) ? $media_info['description'] : '' ?>" /><br />

	<label for="episode_number_mediastorage"><?= EPISODE_NUMBER ?></label>
	<input type="text" name="episode_number_mediastorage" id="episode_number_mediastorage" value="<?= (isset($media_info['episode_number'])) ? $media_info['episode_number'] : '' ?>" /><br />

	<label for="image_version_mediastorage"><?= IMAGE_VERSION ?></label>
	<input type="text" name="image_version_mediastorage" id="image_version_mediastorage" value="<?= (isset($media_info['image_version'])) ? $media_info['image_version'] : '' ?>" /><br />

	<label for="sound_version_mediastorage"><?= SOUND_VERSION ?></label>
	<input type="text" name="sound_version_mediastorage" id="sound_version_mediastorage" value="<?= (isset($media_info['sound_version'])) ? $media_info['sound_version'] : '' ?>" /><br />

	<label for="handover_date_mediastorage"><?= HANDOVER_DATE ?></label>
	<input type="text" name="handover_date_mediastorage" id="handover_date_mediastorage" value="<?= (isset($media_info['handover_date'])) ? $media_info['handover_date'] : '' ?>" /><br />


	<label for="id_media_mediastorage"><?= MEDIA ?></label>
	<select name="id_media_mediastorage" id="id_media_mediastorage"/>
<?php
		while ($media = $medias['data']->fetch_assoc()) {
			echo '<option value="' . $media['id'] . '" ' . ((intval($media['id']) == intval($media_info['id_media'])) ? ' selected' : '') . '>' . $media['id'] . '</option>';
		}
?>
	</select>
	<br />

	<label for="id_language_mediastorage"><?= LANGUAGE ?></label>
	<select name="id_language_mediastorage" id="id_language_mediastorage"/>
<?php
		while ($language = $languages['data']->fetch_assoc()) {
			if ($language['id'] != 1) {
				echo '<option value="' . $language['id'] . '" ' . ((intval($language['id']) == intval($media_info['id_language'])) ? ' selected' : '') . '>' . $language['name'] . '</option>';
			}
		}
?>

	<input type="hidden" name="id_media_info_create_mediastorage" value="12646" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>