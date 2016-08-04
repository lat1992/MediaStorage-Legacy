<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

	<label for="id_user_mediastorage"><?= USER ?></label>
	<select name="id_user_mediastorage" id="id_user_mediastorage"/>
<?php
		while ($user = $users['data']->fetch_assoc()) {
			echo '<option value="' . $user['id'] . '" ' . ((intval($user['id']) == intval($cart['id_user'])) ? ' selected' : '') . '>' . $user['username'] . '</option>';
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

	<input type="hidden" name="id_cart_create_mediastorage" value="534748" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>