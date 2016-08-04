<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
	<label for="reference_mediastorage"><?= REFERENCE ?></label>
	<input type="text" name="reference_mediastorage" id="reference_mediastorage" value="<?= (isset($sharelist['reference'])) ? $sharelist['reference'] : '' ?>" /><br />

	<label for="id_user_mediastorage"><?= USER ?></label>
	<select name="id_user_mediastorage" id="id_user_mediastorage"/>
<?php
		while ($user = $users['data']->fetch_assoc()) {
			echo '<option value="' . $user['id'] . '" ' . ((intval($user['id']) == intval($sharelist['id_user'])) ? ' selected' : '') . '>' . $user['username'] . '</option>';
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_sharelist_create_mediastorage" value="54843" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>