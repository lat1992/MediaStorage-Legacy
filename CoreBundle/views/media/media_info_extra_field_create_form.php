<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

	<label for="name_mediastorage"><?= TAG ?></label>
	<input type="text" name="name_mediastorage" id="name_mediastorage" value="<?= (isset($media_info_extra_field['name'])) ? $media_info_extra_field['name'] : '' ?>" /><br />

	<label for="id_organization_mediastorage"><?= ORGANIZATION ?></label>
	<select name="id_organization_mediastorage" id="id_organization_mediastorage"/>
<?php
		while ($organization = $organizations['data']->fetch_assoc()) {
			echo '<option value="' . $organization['id'] . '" ' . ((intval($organization['id']) == intval($media_info_extra_field['id_organization'])) ? ' selected' : '') . '>' . $organization['name'] . '</option>';
		}
?>
	</select>
	<br />

	<label for="id_language_mediastorage"><?= LANGUAGE ?></label>
	<select name="id_language_mediastorage" id="id_language_mediastorage"/>
<?php
		while ($language = $languages['data']->fetch_assoc()) {
			if ($language['id'] != 1) {
				echo '<option value="' . $language['id'] . '" ' . ((intval($language['id']) == intval($media_info_extra_field['id_language'])) ? ' selected' : '') . '>' . $language['name'] . '</option>';
			}
		}
?>
	</select>
	<br />

	<label for="type_mediastorage"><?= TYPE ?></label>
	<select name="type_mediastorage" id="type_mediastorage"/>
<?php
		foreach ($enums as $enum) {
			echo '<option value="' . $enum . '" ' . (strcmp($enum, $media_info_extra_field['type']) == 0 ? ' selected' : '') . '>' . $enum . '</option>';
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_media_info_extra_field_create_mediastorage" value="984156" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>