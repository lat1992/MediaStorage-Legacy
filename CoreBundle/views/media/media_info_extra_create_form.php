<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
	<label for="media_info_extra_mediastorage"><?= DATA ?></label>
	<input type="text" name="data_mediastorage" id="data_mediastorage" value="<?= (isset($media_info_extra['data'])) ? $media_info_extra['data'] : '' ?>" /><br />

	<label for="id_media_info_mediastorage"><?= MEDIA_INFO ?></label>
	<select name="id_media_info_mediastorage" id="id_media_info_mediastorage"/>
<?php
		while ($media_info = $media_infos['data']->fetch_assoc()) {
			echo '<option value="' . $media_info['id'] . '" ' . ((intval($media_info['id']) == intval($media_info_extra['id_info'])) ? ' selected' : '') . '>' . $media_info['id'] . '</option>';
		}
?>
	</select>
	<br />

	<label for="id_media_info_extra_array_mediastorage"><?= MEDIA_INFO_EXTRA_ARRAY ?></label>
	<select name="id_media_info_extra_array_mediastorage" id="id_media_info_extra_array_mediastorage"/>
<?php
		while ($media_info_extra_array = $media_info_extra_arrays['data']->fetch_assoc()) {
			echo '<option value="' . $media_info_extra_array['id'] . '" ' . ((intval($media_info_extra_array['id']) == intval($media_info_extra['id_array'])) ? ' selected' : '') . '>' . $media_info_extra_array['id'] . '</option>';
		}
?>
	</select>
	<br />

	<label for="id_media_info_extra_field_mediastorage"><?= MEDIA_INFO_EXTRA_FIELD ?></label>
	<select name="id_media_info_extra_field_mediastorage" id="id_media_info_extra_field_mediastorage"/>
<?php
		while ($media_info_extra_field = $media_info_extra_fields['data']->fetch_assoc()) {
			echo '<option value="' . $media_info_extra_field['id'] . '" ' . ((intval($media_info_extra_field['id']) == intval($media_info_extra['id_field'])) ? ' selected' : '') . '>' . $media_info_extra_field['id'] . '</option>';
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_media_info_extra_create_mediastorage" value="984156" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>