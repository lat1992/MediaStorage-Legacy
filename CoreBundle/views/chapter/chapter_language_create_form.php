<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
	<label for="name_mediastorage"><?= NAME ?></label>
	<input type="text" name="name_mediastorage" id="name_mediastorage" value="<?= (isset($chapter_language['name'])) ? $chapter_language['name'] : '' ?>" /><br />

	<label for="id_chapter_mediastorage"><?= CHAPTER ?></label>
	<select name="id_chapter_mediastorage" id="id_chapter_mediastorage"/>
<?php
		while ($chapter = $chapters['data']->fetch_assoc()) {
			echo '<option value="' . $chapter['id'] . '" ' . ((intval($chapter['id']) == intval($chapter_language['id_chapter'])) ? ' selected' : '') . '>' . $chapter['id'] . '</option>';
		}
?>
	</select>
	<br />

	<label for="id_language_mediastorage"><?= LANGUAGE ?></label>
	<select name="id_language_mediastorage" id="id_language_mediastorage"/>
<?php
		while ($language = $languages['data']->fetch_assoc()) {
			if ($language['id'] != 1) {
				echo '<option value="' . $language['id'] . '" ' . ((intval($language['id']) == intval($chapter_language['id_language'])) ? ' selected' : '') . '>' . $language['name'] . '</option>';
			}
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_chapter_language_create_mediastorage" value="12646" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>