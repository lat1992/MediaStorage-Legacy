<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
	<label for="tc_in_mediastorage"><?= TC_IN ?></label>
	<input type="text" name="tc_in_mediastorage" id="tc_in_mediastorage" value="<?= (isset($chapter['tc_in'])) ? $chapter['tc_in'] : '' ?>" /><br />

	<label for="tc_out_mediastorage"><?= TC_OUT ?></label>
	<input type="text" name="tc_out_mediastorage" id="tc_out_mediastorage" value="<?= (isset($chapter['tc_out'])) ? $chapter['tc_out'] : '' ?>" /><br />

	<label for="id_media_mediastorage"><?= MEDIA ?></label>
	<select name="id_media_mediastorage" id="id_media_mediastorage"/>
<?php
		while ($media = $medias['data']->fetch_assoc()) {
			echo '<option value="' . $media['id'] . '" ' . ((intval($media['id']) == intval($chapter['id_media'])) ? ' selected' : '') . '>' . $media['id'] . '</option>';
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_chapter_create_mediastorage" value="984156" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>