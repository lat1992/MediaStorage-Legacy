<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
	<label for="data_mediastorage"><?= DATA ?></label>
	<input type="text" name="data_mediastorage" id="data_mediastorage" value="<?= (isset($tag_language['data'])) ? $tag_language['data'] : '' ?>" /><br />

	<label for="id_tag_mediastorage"><?= TAG ?></label>
	<select name="id_tag_mediastorage" id="id_tag_mediastorage"/>
<?php
		while ($tag = $tags['data']->fetch_assoc()) {
			echo '<option value="' . $tag['id'] . '" ' . ((intval($tag['id']) == intval($tag_language['id_tag'])) ? ' selected' : '') . '>' . $tag['tag'] . '</option>';
		}
?>
	</select>
	<br />

	<label for="id_language_mediastorage"><?= LANGUAGE ?></label>
	<select name="id_language_mediastorage" id="id_language_mediastorage"/>
<?php
		while ($language = $languages['data']->fetch_assoc()) {
			if ($language['id'] != 1) {
				echo '<option value="' . $language['id'] . '" ' . ((intval($language['id']) == intval($tag_language['id_language'])) ? ' selected' : '') . '>' . $language['name'] . '</option>';
			}
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_tag_language_create_mediastorage" value="12646" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>