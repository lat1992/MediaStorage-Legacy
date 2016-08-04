<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
	<label for="data_mediastorage"><?= DATA ?></label>
	<input type="text" name="data_mediastorage" id="data_mediastorage" value="<?= (isset($role_language['data'])) ? $role_language['data'] : '' ?>" /><br />

	<label for="id_role_mediastorage"><?= ROLE ?></label>
	<select name="id_role_mediastorage" id="id_role_mediastorage"/>
<?php
		while ($role = $roles['data']->fetch_assoc()) {
			echo '<option value="' . $role['id'] . '" ' . ((intval($role['id']) == intval($role_language['id_role'])) ? ' selected' : '') . '>' . $role['role'] . '</option>';
		}
?>
	</select>
	<br />

	<label for="id_language_mediastorage"><?= LANGUAGE ?></label>
	<select name="id_language_mediastorage" id="id_language_mediastorage"/>
<?php
		while ($language = $languages['data']->fetch_assoc()) {
			if ($language['id'] != 1) {
				echo '<option value="' . $language['id'] . '" ' . ((intval($language['id']) == intval($role_language['id_language'])) ? ' selected' : '') . '>' . $language['name'] . '</option>';
			}
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_role_language_create_mediastorage" value="12646" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>