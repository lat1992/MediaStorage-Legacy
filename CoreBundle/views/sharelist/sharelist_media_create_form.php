<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

	<label for="id_sharelist_mediastorage"><?= SHARELIST ?></label>
	<select name="id_sharelist_mediastorage" id="id_sharelist_mediastorage"/>
<?php
		while ($sharelist = $sharelists['data']->fetch_assoc()) {
			echo '<option value="' . $sharelist['id'] . '" ' . ((intval($sharelist['id']) == intval($sharelist_media['id_sharelist'])) ? ' selected' : '') . '>' . $sharelist['reference'] . '</option>';
		}
?>
	</select>
	<br />

	<label for="id_media_mediastorage"><?= MEDIA ?></label>
	<select name="id_media_mediastorage" id="id_media_mediastorage"/>
<?php
		while ($media = $medias['data']->fetch_assoc()) {
			echo '<option value="' . $media['id'] . '" ' . ((intval($media['id']) == intval($sharelist_media['id_media'])) ? ' selected' : '') . '>' . $media['id'] . '</option>';
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_sharelist_media_create_mediastorage" value="84393" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>