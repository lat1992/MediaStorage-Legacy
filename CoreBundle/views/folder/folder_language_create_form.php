<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
	<label for="data_mediastorage"><?= DATA ?></label>
	<input type="text" name="data_mediastorage" id="data_mediastorage" value="<?= (isset($folder_language['data'])) ? $folder_language['data'] : '' ?>" /><br />

	<label for="id_folder_mediastorage"><?= FOLDER ?></label>
	<select name="id_folder_mediastorage" id="id_folder_mediastorage"/>
<?php
		while ($folder = $folders['data']->fetch_assoc()) {
			echo '<option value="' . $folder['id'] . '" ' . ((intval($folder['id']) == intval($folder_language['id_folder'])) ? ' selected' : '') . '>' . $folder['id'] . '</option>';
		}
?>
	</select>
	<br />

	<label for="id_language_mediastorage"><?= LANGUAGE ?></label>
	<select name="id_language_mediastorage" id="id_language_mediastorage"/>
<?php
		while ($language = $languages['data']->fetch_assoc()) {
			if ($language['id'] != 1) {
				echo '<option value="' . $language['id'] . '" ' . ((intval($language['id']) == intval($folder_language['id_language'])) ? ' selected' : '') . '>' . $language['name'] . '</option>';
			}
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_folder_language_create_mediastorage" value="12646" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>