<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
	<label for="tag_mediastorage"><?= TAG ?></label>
	<input type="text" name="tag_mediastorage" id="tag_mediastorage" value="<?= (isset($tag['tag'])) ? $tag['tag'] : '' ?>" /><br />

	<label for="id_media_mediastorage"><?= MEDIA ?></label>
	<select name="id_media_mediastorage" id="id_media_mediastorage"/>
<?php
		while ($media = $medias['data']->fetch_assoc()) {
			echo '<option value="' . $media['id'] . '" ' . ((intval($media['id']) == intval($tag['id_media'])) ? ' selected' : '') . '>' . $media['id'] . '</option>';
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_tag_create_mediastorage" value="984156" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>