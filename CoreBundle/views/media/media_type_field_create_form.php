<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

	<label for="id_type_mediastorage"><?= TYPE ?></label>
	<select name="id_type_mediastorage" id="id_type_mediastorage"/>
<?php
		while ($media_type = $media_types['data']->fetch_assoc()) {
			echo '<option value="' . $media_type['id'] . '" ' . ((intval($media_type['id']) == intval($media_type_field['id_type'])) ? ' selected' : '') . '>' . $media_type['id'] . '</option>';
		}
?>
	</select>
	<br />

	<label for="id_media_extra_field_mediastorage"><?= FIELD ?></label>
	<select name="id_media_extra_field_mediastorage" id="id_media_extra_field_mediastorage"/>
<?php
		while ($media_extra_field = $media_extra_fields['data']->fetch_assoc()) {
			echo '<option value="' . $media_extra_field['id'] . '" ' . ((intval($media_extra_field['id']) == intval($media_type_field['id_field'])) ? ' selected' : '') . '>' . $media_extra_field['id'] . '</option>';
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_media_type_field_create_mediastorage" value="984156" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>