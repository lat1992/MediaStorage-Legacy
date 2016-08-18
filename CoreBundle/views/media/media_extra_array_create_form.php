<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
	<label for="element_mediastorage"><?= ELEMENT ?></label>
	<input type="text" name="element_mediastorage" id="element_mediastorage" value="<?= (isset($media_extra_array['element'])) ? $media_extra_array['element'] : '' ?>" /><br />

	<label for="id_media_extra_field_mediastorage"><?= MEDIA_EXTRA_FIELD ?></label>
	<select name="id_media_extra_field_mediastorage" id="id_media_extra_field_mediastorage"/>
<?php
		while ($media_extra_field = $media_extra_fields['data']->fetch_assoc()) {
			echo '<option value="' . $media_extra_field['id'] . '" ' . ((intval($media_extra_field['id']) == intval($media_extra_array['id_media_extra_field'])) ? ' selected' : '') . '>' . $media_extra_field['id'] . '</option>';
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_media_extra_array_create_mediastorage" value="984156" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>