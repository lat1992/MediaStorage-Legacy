<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

	<label for="id_parent_mediastorage"><?= PARENT_FOLDER ?></label>
	<select name="id_parent_mediastorage" id="id_parent_mediastorage"/>
		<option value="NULL"></option>
<?php
		while ($unique_folder = $folders['data']->fetch_assoc()) {
			echo '<option value="' . $unique_folder['id'] . '" ' . ((intval($unique_folder['id']) == intval($folder['id_parent'])) ? ' selected' : '') . '>' . $unique_folder['id'] . '</option>';
		}
?>
	</select>
	<br />

	<label for="id_organization_mediastorage"><?= ORGANIZATION ?></label>
	<select name="id_organization_mediastorage" id="id_organization_mediastorage"/>
<?php
		while ($organization = $organizations['data']->fetch_assoc()) {
			echo '<option value="' . $organization['id'] . '" ' . ((intval($organization['id']) == intval($folder['id_organization'])) ? ' selected' : '') . '>' . $organization['reference'] . ' / ' . $organization['name'] . '</option>';
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_folder_create_mediastorage" value="984156" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>