<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

	<label for="id_group_mediastorage"><?= GROUP ?></label>
	<select name="id_group_mediastorage" id="id_group_mediastorage"/>
<?php
		while ($group = $groups['data']->fetch_assoc()) {
			echo '<option value="' . $group['id'] . '" ' . ((intval($group['id']) == intval($group_language['id_group'])) ? ' selected' : '') . '>' . $group['reference'] . '</option>';
		}
?>
	</select>
	<br />

	<label for="id_language_mediastorage"><?= LANGUAGE ?></label>
	<select name="id_language_mediastorage" id="id_language_mediastorage"/>
<?php
		while ($language = $languages['data']->fetch_assoc()) {
			if ($language['id'] != 1) {
				echo '<option value="' . $language['id'] . '" ' . ((intval($language['id']) == intval($group_language['id_language'])) ? ' selected' : '') . '>' . $language['name'] . '</option>';
			}
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_group_language_create_mediastorage" value="12646" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>